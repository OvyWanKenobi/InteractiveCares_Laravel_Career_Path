#!/usr/bin/env php
<?php

require __DIR__ . '/vendor/autoload.php';

use Symfony\Component\Console\Application;

use App\Command\AddIncomeCommand;
use App\Command\AddExpenseCommand;
use App\Command\ViewIncomeCommand;
use App\Command\ViewCatagoryCommand;
use App\Command\ViewExpenseCommand;
use App\Command\ViewSavingsCommand;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Output\ConsoleOutput;


$application = new Application();

$application->add(new AddIncomeCommand());
$application->add(new AddExpenseCommand());
$application->add(new ViewIncomeCommand());
$application->add(new ViewExpenseCommand());
$application->add(new ViewSavingsCommand());
$application->add(new ViewCatagoryCommand());



while (true) {

    echo "---------------- \n";
    echo "----- MENU ----- \n";
    echo "---------------- \n";

    echo "1. Add Income\n";
    echo "2. Add Expense\n";
    echo "3. View Income List\n";
    echo "4. View Expense List\n";
    echo "5. View Saving\n";
    echo "6. View Category\n";
    echo "7. Exit\n";

    $choice = readline("Enter your option: ");

    switch ($choice) {
        case '1':
            $input = new ArrayInput(['command' => 'app:add-income']);
            $application->doRun($input, new ConsoleOutput());
            break;
        case '2':
            $input = new ArrayInput(['command' => 'app:add-expense']);
            $application->doRun($input, new ConsoleOutput());
            break;
        case '3':
            $input = new ArrayInput(['command' => 'app:view-income']);
            $application->doRun($input, new ConsoleOutput());
            break;
        case '4':
            $input = new ArrayInput(['command' => 'app:view-expense']);
            $application->doRun($input, new ConsoleOutput());
            break;
        case '5':
            $input = new ArrayInput(['command' => 'app:view-saving']);
            $application->doRun($input, new ConsoleOutput());
            break;
        case '6':
            $input = new ArrayInput(['command' => 'app:view-category']);
            $application->doRun($input, new ConsoleOutput());
            break;
        case '7':
            echo "---- EXITING ---- \n";
            exit();
        default:
            echo "Invalid Input\n";
    }
}
