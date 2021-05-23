<?php
declare(strict_types = 1);

namespace Vacation\Entity;

use DateTime;

/**
 * Employee
 *
 * @package Vacation\Entity
 * @author Mohamed Sheir <mohamed.sheir2014@gmail.com>
 * @copyright Mohamed Sheir
 */
class Employee
{
    /**
     * Employee Name
     *
     * @var string $name
     */
    protected $name;

    /**
     * Employee Birthday
     *
     * @var DateTime $birthday
     */
    protected $birthday;

    /**
     * Contract Start Date
     *
     * @var DateTime $contractStartDate
     */
    protected $contractStartDate;

    /**
     * Special Contract Vacation Days
     *
     * @var integer|null $specialContractVacationDays
     */
    protected $specialContractVacationDays;

    /**
     * Get Employee Name
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Set Employee Name
     *
     * @param string $name
     */
    public function setName(string $name): Employee
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get Employee Birthday
     *
     * @return DateTime
     */
    public function getBirthday(): DateTime
    {
        return $this->birthday;
    }

    /**
     * Set Employee Birthday
     *
     * @param DateTime $birthday
     */
    public function setBirthday(DateTime $birthday): Employee
    {
        $this->birthday = $birthday;

        return $this;
    }

    /**
     * Get Contract Start Date
     *
     * @return DateTime
     */
    public function getContractStartDate(): DateTime
    {
        return $this->contractStartDate;
    }

    /**
     * Set Contract Start Date
     *
     * @param DateTime $contractStartDate
     */
    public function setContractStartDate(DateTime $contractStartDate): Employee
    {
        $this->contractStartDate = $contractStartDate;

        return $this;
    }

    /**
     * Get Special Contract Vacation Days
     *
     * @return int|null
     */
    public function getSpecialContractVacationDays(): ?int
    {
        return $this->specialContractVacationDays;
    }

    /**
     * Set Special Contract Vacation Days
     *
     * @param int|null $specialContractVacationDays
     */
    public function setSpecialContractVacationDays(?int $specialContractVacationDays): Employee
    {
        $this->specialContractVacationDays = $specialContractVacationDays;

        return $this;
    }

    /**
     * calculate age by given year
     *
     * @param $year
     * @return int|null
     */
    public function calculateAge($year): ?int
    {
        $yearBegin = (new \DateTime())->setDate($year, 1, 1);

        return ($yearBegin > $this->getBirthday()) ? $yearBegin->diff($this->getBirthday())->y : null;
    }
}
