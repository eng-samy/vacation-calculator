# Employees' Vacation Calculator
Calculates employees' vacation days for dummy date listed in data/employees.php

### Assumptions
The tool calculates 4 cases of employees' vacation contracts
1. The basic standard contract (26 days)
2. Experienced employees who have 30 years old or more, They will get one additional vacation day every 5 years.
3. The employee has special contract vacation days, It will overwrite the basic vacation days.
4. When the employees join in the course of the year. In this case, hey will get 12 of the yearly vacation days for each full
   month

## Requirements
PHP 7.2+
Composer

## Installation
Run in main project folder
```
composer install
```

## Run Calculation Script
To calculate employees' vacation run the following command:

_The console will ask for the interest year_
```
php console employee:calculate-vacation
```

You can add the year in the command line arguments like the following:
```
php console employee:calculate-vacation 2021
```

## Run Test Cases
```
vendor/bin/phpunit tests
```