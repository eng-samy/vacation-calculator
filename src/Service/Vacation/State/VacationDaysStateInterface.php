<?php
declare(strict_types = 1);

namespace Vacation\Service\Vacation\State;

use Vacation\Entity\Employee;

/**
 * VacationDaysStateInterface
 *
 * @package Vacation\Service\Vacation\VacationDaysStateInterface
 * @author Mohamed Sheir <mohamed.sheir2014@gmail.com>
 * @copyright Mohamed Sheir
 */
interface VacationDaysStateInterface
{
    /**
     * Get Vacation Days
     *
     * @param Employee $employee
     * @param $year
     * @return float
     */
    public function getVacationDays(Employee $employee, $year): float;
}