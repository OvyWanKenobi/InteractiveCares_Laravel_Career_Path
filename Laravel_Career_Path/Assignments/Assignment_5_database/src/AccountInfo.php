<?php

namespace App;

use App\DataStorage\DataStorageConfig;

class AccountInfo
{

    private $unique_id;
    private $name;
    private $email;

    protected $storage;

    public function __construct()
    {
        $this->storage = DataStorageConfig::createStorage();
    }


    public function getAccountInfo($key, $value)
    {

        $customer = $this->storage->select('customers', [$key => $value]);
        $customer = reset($customer);

        // var_dump($customer);

        if ($customer) {
            $this->unique_id = $customer['unique_id'];
            $this->name = $customer['name'];
            $this->email = $customer['email'];

            $accountInfo =  [
                'unique_id' => $this->unique_id,
                'name' => $this->name,
                'email' => $this->email,
            ];

            return $accountInfo;
        }
        return [];
    }




    public function getAllCustomersInfo()
    {
        $allCustomersInfo = [];

        $customers = $this->storage->getAll('customers');

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
}
