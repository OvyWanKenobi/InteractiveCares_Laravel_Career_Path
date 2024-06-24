<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ViewCatagoryCommand extends Command
{
    protected static $defaultName = 'app:view-category';

    protected function configure(): void
    {
        $this->setDescription('View Category');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        echo " \n";

        $categories = json_decode(file_get_contents(__DIR__ . '/../files/category.json'), true);

        if (empty($categories)) {
            echo "No Catagory Found \n";
        } else {
            echo "---- CATAGORY LIST ---- \n";
            foreach ($categories as $index => $category) {
                echo ($index + 1) . '. Name: ' . $category['name'] . ", Type: " . $category['type'] . "\n";
            }
        }

        return Command::SUCCESS;
    }
}
