<?php

namespace App;

use App\Transaction;

class Transfer extends AccountInfo
{

    private $customer_id;
    private $amount;

    private $receiver_id;
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


    public function transfer($receiver_email, $amount)
    {
        $this->validate($receiver_email, $amount);

        if (!empty($this->errorBag)) {
            return false;
        } else if ($this->balance <= $amount) {
            flash('error', 'Insufficient Balance!');
            return false;
        } else if ($this->getAccountInfoByEmail($receiver_email)) {


            $receiverInfo = $this->getAccountInfoByEmail($receiver_email);
            $this->receiver_id = $receiverInfo['unique_id'];

            if ($this->receiver_id === $this->customer_id) {
                flash('error', 'Transfer to Self is not allowed.');
                return false;
            } else {
                $transaction = $this->transaction;
                $transaction[] = ['customer_id' => $this->customer_id, 'type' => 'transfer', "to" => $this->receiver_id, 'amount' => $amount, 'date' => date('Y-m-d\TH:i:s\Z')];
                $transaction[] = ['customer_id' => $this->receiver_id, 'type' => 'received', "from" => $this->customer_id, 'amount' => $amount, 'date' => date('Y-m-d\TH:i:s\Z')];
                file_put_contents($this->file_path, json_encode($transaction));

                return true;
            }
        } else {
            flash('error', 'Email is not Valid. Please Try Again.');
            return false;
        }
    }


    private function validate($email, $amount)
    {

        if (empty($amount)) {
            $this->errorBag['amount'] = 'Please enter an Amount';
        } elseif (!is_numeric($amount)) {
            $this->errorBag['amount'] = 'The amount must be a number';
        } elseif ($amount < 0) {
            $this->errorBag['amount'] = 'The amount cannot be negative';
        }

        if (empty($email)) {
            $this->errorBag['email'] = 'Please provide an email';
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->errorBag['email'] = 'Please provide a valid email address.';
        }
    }
}
