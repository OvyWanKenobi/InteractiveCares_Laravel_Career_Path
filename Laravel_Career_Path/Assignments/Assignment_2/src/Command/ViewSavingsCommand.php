<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ViewSavingsCommand extends Command
{

    protected static $defaultName = 'app:view-saving';

    protected function configure(): void
    {
        $this->setDescription('View Saving');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        echo " \n";

        $incomes = json_decode(file_get_contents(__DIR__ . '/../files/income.json'), true);
        $expenses = json_decode(file_get_contents(__DIR__ . '/../files/expense.json'), true);

        $total_income = 0;
        $total_expense = 0;

        if (empty($incomes)) {
            $total_income = 0;
        } else {
            foreach ($incomes as $index => $income) {
                $total_income += $income['amount'];
            }
        }

        if (empty($expenses)) {
            $total_expense = 0;
        } else {
            foreach ($expenses as $index => $expense) {
                $total_expense += $expense['amount'];
            }
        }

        $saving = $total_income - $total_expense;

        echo "---- SAVINGS ---- \n";
        echo "Total Income: " . $total_income . "\n";
        echo "Total Expense: " . $total_expense . "\n";
        echo "-----------------------\n";
        echo "SAVINGS: " . $saving . "\n";
        echo " \n";

        return Command::SUCCESS;
    }
}
