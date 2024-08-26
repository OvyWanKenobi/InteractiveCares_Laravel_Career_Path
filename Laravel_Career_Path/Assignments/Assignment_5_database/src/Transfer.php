<?php

namespace App;

use App\Transaction;
use App\DataStorage\DataStorageConfig;

class Transfer extends AccountInfo
{

    private $customer_id;

    private $receiver_id;

    private $balance;



    public $errorBag = [];

    public function __construct(Transaction $transaction, $customer_id)
    {
        parent::__construct();
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
        } else if ($this->getAccountInfo('email', $receiver_email)) {


            $receiverInfo = $this->getAccountInfo('email', $receiver_email);
            $this->receiver_id = $receiverInfo['unique_id'];

            if ($this->receiver_id === $this->customer_id) {
                flash('error', 'Transfer to Self is not allowed.');
                return false;
            } else {

                $data_to = [
                    'customer_id' => $this->customer_id,
                    'type' => 'transfer',
                    'amount' => $amount,
                    "transfer_to" => $this->receiver_id,
                    "transfer_from" => null,
                    'date' => date('Y-m-d\TH:i:s\Z')
                ];

                $data_from = [
                    'customer_id' => $this->receiver_id,
                    'type' => 'received',
                    'amount' => $amount,
                    "transfer_to" => null,
                    "transfer_from" => $this->customer_id,
                    'date' => date('Y-m-d\TH:i:s\Z')
                ];

                $this->storage->insert('transactions', $data_to);
                $this->storage->insert('transactions', $data_from);


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
