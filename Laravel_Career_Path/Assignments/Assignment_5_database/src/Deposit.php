<?php

namespace App;

use App\DataStorage\DataStorageConfig;

class Deposit
{

    private $customer_id;

    public $errorBag = [];

    private $storage;


    public function __construct($customer_id)
    {
        $this->storage = DataStorageConfig::createStorage();

        $this->customer_id = $customer_id;
    }


    public function deposit($amount)
    {
        $this->validate($amount);

        if (!empty($this->errorBag)) {
            return false;
        } else {

            $data = [
                'customer_id' => $this->customer_id,
                'type' => 'deposit',
                'amount' => $amount,
                'transfer_to' => null,
                'transfer_from' => null,
                'date' => date('Y-m-d\TH:i:s\Z')
            ];

            $this->storage->insert('transactions', $data);

            return true;
        }
    }


    private function validate($amount)
    {

        if (empty($amount)) {
            $this->errorBag['amount'] = 'Please enter an Amount';
        } elseif (!is_numeric($amount)) {
            $this->errorBag['amount'] = 'The amount must be a number';
        } elseif ($amount < 0) {
            $this->errorBag['amount'] = 'The amount cannot be negative';
        }
    }
}
