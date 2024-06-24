<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ViewExpenseCommand extends Command
{

    protected static $defaultName = 'app:view-expense';

    protected function configure(): void
    {
        $this->setDescription('View Expense');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {

        echo " \n";

        $expenses = json_decode(file_get_contents(__DIR__ . '/../files/expense.json'), true);

        if (empty($expenses)) {
            echo "No expense Found \n";
        } else {
            echo "---- EXPENSE LIST ---- \n";
            foreach ($expenses as $index => $expense) {
                echo ($index + 1) . '. Amount:' . $expense['amount'] . ', Category:' . $expense['category'] . "\n";
            }
        }

        return Command::SUCCESS;
    }
}
