<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class AddExpenseCommand extends Command
{

    protected static $defaultName = 'app:add-expense';

    protected function configure(): void
    {
        $this->setDescription('Add Expense');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        echo " \n";
        echo "---- ADD NEW EXPENSE ---- \n";
        echo 'Enter amount: ';
        $amount = readline();

        $categories = json_decode(file_get_contents(__DIR__ . '/../files/category.json'), true);
        $expenseCategories = array_filter($categories, fn ($cat) => $cat['type'] === 'EXPENSE');
        $categoryNames = array_column($expenseCategories, 'name');

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

        $expenses = json_decode(file_get_contents(__DIR__ . '/../files/expense.json'), true);
        $expenses[] = ['amount' => $amount, 'category' => $selectedCategory];
        file_put_contents(__DIR__ . '/../files/expense.json', json_encode($expenses));

        echo "Expense added successfully.";

        return Command::SUCCESS;
    }
}
