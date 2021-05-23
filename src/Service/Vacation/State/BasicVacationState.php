<?php
declare(strict_types = 1);

namespace Vacation\Service\Vacation\State;

use Vacation\Base\Employee\EmployeeBaseAware;
use Vacation\Entity\Employee;

/**
 * BasicVacationState
 *
 * @package Vacation\Service\Vacation
 * @author Mohamed Sheir <mohamed.sheir2014@gmail.com>
 * @copyright Mohamed Sheir
 */
class BasicVacationState implements VacationDaysStateInterface
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
        return EmployeeBaseAware::BASIC_VACATION_DAYS;
    }
}