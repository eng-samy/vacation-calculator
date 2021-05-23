<?php
declare(strict_types = 1);

namespace Vacation\Repository;

use Vacation\Entity\Employee;

/**
 * EmployeeRepository
 *
 * @package Vacation\Repository
 * @author Mohamed Sheir <mohamed.sheir2014@gmail.com>
 * @copyright Mohamed Sheir
 */
class EmployeeRepository
{
    /**
     * Return All Employees
     *
     * @return Employee[]
     * @throws \Exception
     */
    public function fetchAll(): array
    {
        $employees = [];

        // import dummy data from a file
        $employeesItems = include __DIR__ . '/../../data/employees.php';

        foreach ($employeesItems as $employeeItem) {
            $employee = new Employee();
            $employee->setName($employeeItem['name']);
            $employee->setBirthday(new \DateTime($employeeItem['birthday']));
            $employee->setContractStartDate(new \DateTime($employeeItem['contractStartDate']));
            $employee->setSpecialContractVacationDays($employeeItem['specialContractVacationDays']);
            $employees[] = $employee;
        }

        return $employees;
    }
}