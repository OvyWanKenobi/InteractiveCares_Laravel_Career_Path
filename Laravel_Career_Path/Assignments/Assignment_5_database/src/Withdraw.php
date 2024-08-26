<?php

namespace App;

use App\Transaction;
use App\DataStorage\DataStorageConfig;

class Withdraw
{

    private $customer_id;


    private $balance;

    private $storage;
    public $errorBag = [];

    public function __construct(Transaction $transaction, $customer_id)
    {
        $this->storage = DataStorageConfig::createStorage();

        $this->balance = $transaction->getCustomerBalance();
        $this->customer_id = $customer_id;
    }


    public function withdraw($amount)
    {
        $this->validate($amount);

        if (!empty($this->errorBag)) {
            return false;
        } else if ($this->balance <= $amount) {
            flash('error', 'Insufficient Balance!');
            return false;
        } else {

            $data = [
                'customer_id' => $this->customer_id,
                'type' => 'withdraw',
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
