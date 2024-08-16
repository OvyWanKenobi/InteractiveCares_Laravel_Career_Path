<?php

namespace App;

use App\Transaction;

class Withdraw
{

    private $customer_id;
    private $amount;
    private $transaction;

    private $balance;

    private $file_path = "../File/transaction.json";

    public $errorBag = [];

    public function __construct(Transaction $transaction, $customer_id)
    {
        $this->transaction = $transaction->getAllTransactions();
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

            $transaction = $this->transaction;
            $transaction[] = ['customer_id' => $this->customer_id, 'type' => 'withdraw', 'amount' => $amount, 'date' => date('Y-m-d\TH:i:s\Z')];

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
