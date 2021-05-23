<?php
declare(strict_types = 1);

namespace Vacation\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;
use Vacation\Repository\EmployeeRepository;
use Vacation\Service\Vacation\CalculateVacationService;

/**
 * CalculateVacationCommand
 *
 * @package Vacation\Command
 * @author Mohamed Sheir <mohamed.sheir2014@gmail.com>
 * @copyright Mohamed Sheir
 */
class CalculateVacationCommand extends Command
{
    /**
     * Command Configuration Method
     */
    protected function configure(): void
    {
        $this->setName('employee:calculate-vacation')
            ->setDescription('Calculate employees\' vacation days for a specific year')
            ->addArgument('year', InputArgument::OPTIONAL, 'Year');
    }

    /**
     * Command Execution Method
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $year = (int)$input->getArgument('year');

        if (!$year) {
            $helper = $this->getHelper('question');
            $yearQuestion = new Question('<question>What is the year of interest?</question>');
            $year = (int)$helper->ask($input, $output, $yearQuestion);
        }

        $output->writeln('<info>Starting Calculating</info>');

        $employeeRepository = new EmployeeRepository();
        try {
            // Get All Employees
            $employees = $employeeRepository->fetchAll();
        } catch (\Exception $e) {
            $output->write('<error> Error:' . $e->getMessage() . ' </error>');
            return Command::FAILURE;
        }

        foreach ($employees as $employee) {
            // Calculate vacation days for each employee in the given year
            $vacationDaysCalculator = new CalculateVacationService($employee, $year);
            try {
                $vacationDays = $vacationDaysCalculator->calculateEmployeeVacationDays();
            } catch (\Exception $e) {
                $output->write('<error> Error:' . $e->getMessage() . ' </error>');
                return Command::FAILURE;
            }

            $output->writeln($employee->getName() . ' (Age ' . $employee->calculateAge($year) . '): ' . $vacationDays . ' Days');
        }

        return Command::SUCCESS;
    }
}