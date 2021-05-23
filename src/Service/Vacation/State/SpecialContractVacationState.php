<?php
declare(strict_types = 1);

namespace Vacation\Service\Vacation\State;

use Vacation\Entity\Employee;

/**
 * SpecialContractVacationState
 *
 * @package Vacation\Service\Vacation\State
 * @author Mohamed Sheir <mohamed.sheir2014@gmail.com>
 * @copyright Mohamed Sheir
 */
class SpecialContractVacationState implements VacationDaysStateInterface
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
        return $employee->getSpecialContractVacationDays();
    }
}