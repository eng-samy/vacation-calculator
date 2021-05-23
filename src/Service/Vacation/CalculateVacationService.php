<?php
declare(strict_types = 1);

namespace Vacation\Service\Vacation;

use Vacation\Base\Employee\EmployeeBaseAware;
use Vacation\Entity\Employee;
use Vacation\Service\Vacation\State\BasicVacationState;
use Vacation\Service\Vacation\State\OverAgeVacationState;
use Vacation\Service\Vacation\State\SpecialContractVacationState;
use Vacation\Service\Vacation\State\VacationDaysStateInterface;

/**
 * CalculateVacationService
 *
 * @package Vacation\Service\Vacation
 * @author Mohamed Sheir <mohamed.sheir2014@gmail.com>
 * @copyright Mohamed Sheir
 */
class CalculateVacationService
{
    /**
     * Employee instance
     *
     * @var Employee $employee
     */
    private $employee;

    /**
     * Report Year
     *
     * @var integer $year
     */
    private $year;

    public function __construct(Employee $employee, int $year)
    {
        $this->employee = $employee;
        $this->year = $year;
    }

    /**
     * Calculate employee vacation days
     *
     * @throws \Exception
     */
    public function calculateEmployeeVacationDays(): float
    {
        $vacationDays = $this->getVacationState()->getVacationDays($this->employee, $this->year);
        $partOfYearVacation= $this->calculatePartOfYearVacation();

        return round($vacationDays * $partOfYearVacation);
    }

    /**
     * Return the suitable state of employee contract
     *
     * @return VacationDaysStateInterface
     */
    private function getVacationState(): VacationDaysStateInterface
    {
        // Check if the employee has special contract vacation
        if ($this->employee->getSpecialContractVacationDays()) {
            return new SpecialContractVacationState();
        }

        // Check if the employee's aga is over the starting age of getting bonus
        if ($this->employee->calculateAge($this->year) >= EmployeeBaseAware::START_GETTING_BONUS_AGE) {
            return new OverAgeVacationState();
        }

        return new BasicVacationState();
    }

    /**
     * Part of year when the employee had an active contract (from 0 to 1)
     * @return float
     * @throws \Exception
     */
    protected function calculatePartOfYearVacation(): float
    {
        $yearBegin = (new \DateTime())->setDate($this->year, 1, 1);
        $yearEnd = (new \DateTime())->setDate($this->year + 1, 1, 1);

        // The employee started job after the given year
        if ($this->employee->getContractStartDate() > $yearEnd) {
            return 0;
        }

        // The employee started job before the given year (Full Year)
        if ($this->employee->getContractStartDate() < $yearBegin) {
            return 1;
        }

        $currentYearWorkedMonths = $yearEnd->diff($this->employee->getContractStartDate())->m;

        return $currentYearWorkedMonths / 12;
    }
}