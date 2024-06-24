<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ViewIncomeCommand extends Command
{
    protected static $defaultName = 'app:view-income';

    protected function configure(): void
    {
        $this->setDescription('View Income');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        echo " \n";

        $incomes = json_decode(file_get_contents(__DIR__ . '/../files/income.json'), true);

        if (empty($incomes)) {
            echo "No Income Found \n";
        } else {
            echo "---- INCOME LIST ---- \n";

            foreach ($incomes as $index => $income) {
                echo ($index + 1). '. Amount:' .$income['amount'] .', Category:' .$income['category'] ."\n";
            }
        }

        return Command::SUCCESS;
    }
}
