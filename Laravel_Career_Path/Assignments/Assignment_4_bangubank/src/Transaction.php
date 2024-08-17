<?php

namespace App;

use App\Traits\readJsonFileTrait;

class Transaction extends AccountInfo
{

    private $transactions = [];

    private $balance = 0.0;


    private $filePath = "../File/transaction.json";

    public function __construct($unique_id = null, $admin_all_view = false)
    {
        [$this->transactions, $this->balance] = $this->customerTransactions($unique_id, $admin_all_view);
    }

    private function customerTransactions($unique_id = null, $admin_all_view = false)
    {


        $allTransactions = $this->getAllTransactions();

        if ($unique_id) {
            $customer_trans = array_filter($allTransactions, function ($customer_trans) use ($unique_id) {

                return $customer_trans['customer_id'] === $unique_id;
            });
        } else {
            $customer_trans = $allTransactions;
        }


        $balance = 0.0;
        $transactions = [];



        foreach ($customer_trans as $tran) {
            if ($tran['type'] === 'withdraw') {

                $balance -= (float)$tran['amount'];
                $receiver_info = $this->getAccountInfo($tran['customer_id']);
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
                $receiver_info = $this->getAccountInfo($tran['customer_id']);
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

                $receiver_info = $this->getAccountInfo(($admin_all_view) ? $tran['customer_id'] : $tran['to']);

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

                $receiver_info = $this->getAccountInfo(($admin_all_view) ? $tran['customer_id'] : $tran['from']);

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

    use readJsonFileTrait;

    public function getAllTransactions()
    {
        return $this->readJsonFileContent($this->filePath);
    }
}
