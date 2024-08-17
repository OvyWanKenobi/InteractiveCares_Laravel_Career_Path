<?php

namespace App;

use App\Traits\readJsonFileTrait;

class AccountInfo
{

    private $unique_id;
    private $name;
    private $email;

    private $filePath = "../File/customers.json";


    public function getAccountInfo($unique_id)
    {

        $customers = $this->allCustomers();


        $myAccount = array_filter($customers, function ($myAccount) use ($unique_id) {

            return $myAccount['unique_id'] === $unique_id;
        });
        $myAccount = reset($myAccount);


        $this->unique_id = $myAccount['unique_id'];
        $this->name = $myAccount['name'];
        $this->email = $myAccount['email'];

        $accountInfo =  [
            'unique_id' => $this->unique_id,
            'name' => $this->name,
            'email' => $this->email,
        ];

        return $accountInfo;
    }


    public function getAccountInfoByEmail($email)
    {
        $customers = $this->allCustomers();


        $myAccount = array_filter($customers, function ($myAccount) use ($email) {

            return $myAccount['email'] === $email;
        });
        $myAccount = reset($myAccount);

        // echo $myAccount;

        if ($myAccount) {
            $this->unique_id = $myAccount['unique_id'];
            $this->name = $myAccount['name'];
            $this->email = $myAccount['email'];

            $accountInfo =  [
                'unique_id' => $this->unique_id,
                'name' => $this->name,
                'email' => $this->email,
            ];

            return $accountInfo;
        } else {
            return [];
        }
    }


    public function getAllCustomersInfo()
    {
        $allCustomersInfo = [];

        $customers = $this->allCustomers();

        foreach ($customers as $myAccount) {
            $this->unique_id = $myAccount['unique_id'];
            $this->name = $myAccount['name'];
            $this->email = $myAccount['email'];

            $allCustomersInfo[] =  [
                'unique_id' => $this->unique_id,
                'name' => $this->name,
                'email' => $this->email,
            ];
        }



        return $allCustomersInfo;
    }

    use readJsonFileTrait;

    private function allCustomers()
    {
        return $this->readJsonFileContent($this->filePath);
    }
}
