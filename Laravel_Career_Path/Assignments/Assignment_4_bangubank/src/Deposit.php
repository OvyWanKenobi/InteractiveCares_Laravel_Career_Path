<?php

namespace App;

use App\Transaction;

class Deposit
{

    private $customer_id;
    private $amount;
    private $transaction;

    private $file_path = "../File/transaction.json";

    public $errorBag = [];

    public function __construct(Transaction $transaction, $customer_id)
    {
        $this->transaction = $transaction->getAllTransactions();
        $this->customer_id = $customer_id;
    }


    public function deposit($amount)
    {
        $this->validate($amount);

        if (!empty($this->errorBag)) {
            return false;
        } else {

            $transaction = $this->transaction;
            $transaction[] = ['customer_id' => $this->customer_id, 'type' => 'deposit', 'amount' => $amount, 'date' => date('Y-m-d\TH:i:s\Z')];

            file_put_contents($this->file_path, json_encode($transaction));

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
