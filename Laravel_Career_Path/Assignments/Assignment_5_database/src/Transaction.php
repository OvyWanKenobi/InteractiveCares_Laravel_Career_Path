<?php

namespace App;

use App\DataStorage\DataStorageConfig;

class Transaction extends AccountInfo
{

    private $transactions = [];

    private $balance = 0.0;

    // private $storage;


    public function __construct($unique_id = null, $admin_all_view = false)
    {
        parent::__construct();

        [$this->transactions, $this->balance] = $this->customerTransactions($unique_id, $admin_all_view);
    }

    private function customerTransactions($unique_id = null, $admin_all_view = false)
    {


        if ($unique_id) {

            $customer_trans = $this->storage->select('transactions', ['customer_id' => $unique_id]);

            // var_dump($customer_trans);
        } else {

            $customer_trans = $this->storage->getAll('transactions');
        }


        $balance = 0.0;
        $transactions = [];



        foreach ($customer_trans as $tran) {

            // var_dump($tran['customer_id']);

            if ($tran['type'] === 'withdraw') {

                $balance -= (float)$tran['amount'];
                $receiver_info = $this->getAccountInfo('unique_id', $tran['customer_id']);
                $transactions[] = [
                    'receiver' => $unique_id ? 'SELF' : $receiver_info['name'],
                    'email' => $unique_id ? 'SELF' : $receiver_info['email'],
                    'amount' =>
                    number_format($tran['amount'], 2),
                    'type' => 'debit',
                    'date' => $tran['date']
                ];
            }

            if ($tran['type'] === 'deposit') {
                $balance += (float)$tran['amount'];
                $receiver_info = $this->getAccountInfo('unique_id', $tran['customer_id']);
                $transactions[] = [
                    'receiver' => $unique_id ? 'SELF' : $receiver_info['name'],
                    'email' => $unique_id ? 'SELF' : $receiver_info['email'],
                    'amount' =>
                    number_format($tran['amount'], 2),
                    'type' => 'credit',
                    'date' => $tran['date']
                ];
            }




            if ($tran['type'] === 'transfer') {
                $balance -= (float)$tran['amount'];

                $receiver_info = $this->getAccountInfo('unique_id', (($admin_all_view) ? $tran['customer_id'] : $tran['transfer_to']));

                $transactions[] = [
                    'receiver' => $receiver_info['name'],
                    'email' => $receiver_info['email'],
                    'amount' =>
                    number_format($tran['amount'], 2),
                    'type' => 'debit',
                    'date' => $tran['date']
                ];
            }


            if ($tran['type'] === 'received') {
                $balance += (float)$tran['amount'];

                $receiver_info = $this->getAccountInfo('unique_id', (($admin_all_view) ? $tran['customer_id'] : $tran['transfer_from']));

                $transactions[] = [
                    'receiver' => $receiver_info['name'],
                    'email' => $receiver_info['email'],
                    'amount' => number_format($tran['amount'], 2),
                    'type' => 'credit',
                    'date' => $tran['date']
                ];
            }
        }

        return [$transactions, $balance];
    }

    public function getCustomerBalance()
    {
        return $this->balance;
    }
    public function getCustomerTransactions()
    {
        return $this->transactions;
    }
}
