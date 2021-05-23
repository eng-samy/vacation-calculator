<?php
declare(strict_types = 1);

namespace Entity;

use PHPUnit\Framework\TestCase;
use Vacation\Entity\Employee;

/**
 * EmployeeTest
 *
 * @package Entity
 * @author Mohamed Sheir <mohamed.sheir2014@gmail.com>
 * @copyright Mohamed Sheir
 */
class EmployeeTest extends TestCase
{
    /**
     * Test Employee Entity Setters and Getters
     */
    public function testSettersAndGetters(): void
    {
        $employee = new Employee();
        $employee->setName('Thomas Müller')
            ->setBirthday(new \DateTime('13.09.1989'))
            ->setContractStartDate(new \DateTime('15.08.2008'))
            ->setSpecialContractVacationDays(null);

        static::assertEquals('Thomas Müller', $employee->getName());
        static::assertEquals('13.09.1989', $employee->getBirthday()->format('d.m.Y'));
        static::assertEquals('15.08.2008', $employee->getContractStartDate()->format('d.m.Y'));
        static::assertEquals(null, $employee->getSpecialContractVacationDays());
    }

    /**
     * Test Calculate Age Method
     *
     * @dataProvider ageProvider
     * @param $birthday
     * @param $year
     * @param $calculatedAge
     * @return void
     * @throws \Exception
     */
    public function testCalculateAge($birthday, $year, $calculatedAge): void
    {
        $employee = new Employee();
        $employee->setBirthday(new \DateTime($birthday));

        static::assertEquals($calculatedAge, $employee->calculateAge($year));
    }

    /**
     * Age Data Provider
     */
    public function ageProvider(): array
    {
        return [
            [
                'birthday' => '30.12.1950',
                'year' => 2021,
                'calculatedAge' => 70,
            ],
            [
                'birthday' => '01.06.1992',
                'year' => 2021,
                'calculatedAge' => 28,
            ],
            [
                'birthday' => '12.10.2025',
                'year' => 2021,
                'calculatedAge' => null,
            ],
            [
                'birthday' => '10.07.2020',
                'year' => 2021,
                'calculatedAge' => 0,
            ],
        ];
    }
}