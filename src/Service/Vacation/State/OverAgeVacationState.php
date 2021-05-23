<?php
declare(strict_types = 1);

namespace Vacation\Service\Vacation\State;

use Vacation\Base\Employee\EmployeeBaseAware;
use Vacation\Entity\Employee;

/**
 * OverAgeVacationState
 *
 * @package Vacation\Service\Vacation\State
 * @author Mohamed Sheir <mohamed.sheir2014@gmail.com>
 * @copyright Mohamed Sheir
 */
class OverAgeVacationState implements VacationDaysStateInterface
{
    /**
     * Get Vacation Days
     *
     * @param Employee $employee
     * @param $year
     * @return float
     */
    public function getVacationDays(Employee $employee, $year): float
    {
        $employeeAge = $employee->calculateAge($year);
        $bonusDays = ceil(($employeeAge + 1 - EmployeeBaseAware::START_GETTING_BONUS_AGE) / 5);

        return $bonusDays + EmployeeBaseAware::BASIC_VACATION_DAYS;
    }
}