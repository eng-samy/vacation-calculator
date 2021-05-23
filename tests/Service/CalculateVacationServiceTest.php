<?php
declare(strict_types = 1);

namespace Service;

use PHPUnit\Framework\TestCase;
use Vacation\Entity\Employee;
use Vacation\Service\Vacation\CalculateVacationService;

/**
 * CalculateVacationServiceTest
 *
 * @package Service
 * @author Mohamed Sheir <mohamed.sheir2014@gmail.com>
 * @copyright Mohamed Sheir
 */
class CalculateVacationServiceTest extends TestCase
{
    /**
     * @dataProvider employeesProvider
     * @param Employee $employee
     * @param integer $year
     * @param $calculatedVacationDays
     * @throws \Exception
     */
    public function testCalculateEmployeeVacationDays($employee, $year, $calculatedVacationDays): void
    {
        $calculateVacationService = new CalculateVacationService($employee, $year);
        self::assertEquals($calculatedVacationDays, $calculateVacationService->calculateEmployeeVacationDays());
    }

    /**
     * @return array
     * @throws \Exception
     */
    public function employeesProvider(): array
    {
        return [
            // Experienced, Age 60, Full year
            [
                'employee' => (new Employee())->setBirthday(new \DateTime('01.10.1960'))
                    ->setContractStartDate(new \DateTime('10.03.2019')),
                'year' => 2021,
                'calculatedVacationDays' => 33 // (basic + (30 years / 5) + 1),
            ],
            // Fresh, Age 20, Half year
            [
                'employee' => (new Employee())->setBirthday(new \DateTime('01.06.1992'))
                    ->setContractStartDate(new \DateTime('01.07.2021')),
                'year' => 2021,
                'expectedVacationDays' => 13, // round(26 * 6/12)
            ],
            // Future Employee
            [
                'employee' => (new Employee())->setBirthday(new \DateTime('01.06.1992'))
                    ->setContractStartDate(new \DateTime('01.01.2022')),
                'year' => 2021,
                'expectedVacationDays' => 0,
            ],
            // Full year basic employee
            [
                'employee' => (new Employee())->setBirthday(new \DateTime('01.06.1992'))
                    ->setContractStartDate(new \DateTime('01.01.2020')),
                'year' => 2021,
                'expectedVacationDays' => 26,
            ],
        ];
    }
}