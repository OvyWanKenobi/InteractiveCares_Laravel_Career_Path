<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;


class AddIncomeCommand extends Command
{
    protected static $defaultName = 'app:add-income';

    protected function configure(): void
    {
        $this->setDescription('Add Income');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        echo " \n";
        echo "---- ADD NEW INCOME ---- \n";
        $amount = readline('Enter amount: ');

        $categories = json_decode(file_get_contents(__DIR__ . '/../files/category.json'), true);
        $incomeCategories = array_filter($categories, fn ($cat) => $cat['type'] === 'INCOME');
        $categoryNames = array_column($incomeCategories, 'name');

        echo "Select category: \n";
        foreach ($categoryNames as $index => $categoryName) {
            echo ($index + 1) . '. ' . $categoryName . "\n";
        }
        $selectedIndex = readline();

        if (!isset($categoryNames[$selectedIndex - 1])) {
            echo "Invalid category selected. \n";
            return Command::FAILURE;
        }
        $selectedCategory = $categoryNames[$selectedIndex - 1];

        $incomes = json_decode(file_get_contents(__DIR__ . '/../files/income.json'), true);
        $incomes[] = ['amount' => $amount, 'category' => $selectedCategory];
        file_put_contents(__DIR__ . '/../files/income.json', json_encode($incomes));

        echo "Income added successfully. \n";

        return Command::SUCCESS;
    }
}
