<?php

namespace App;

use App\DataStorage\DataStorageConfig;


class Registration
{

    private $filePath;
    public $errorBag = [];
    private $storage;

    public function __construct()
    {
        $this->storage = DataStorageConfig::createStorage();
    }

    public function register($name, $email, $password)
    {
        $this->validate($name, $email, $password);

        if (!empty($this->errorBag)) {
            return false;
        }

        $customers = $this->storage->getAll('customers');



        if ($this->emailExists($email, $customers)) {
            $this->errorBag['email'] = 'Email already taken.';
            return false;
        }

        if (empty($customers)) {
            $unique_id = $this->generate_unique_id();
        } else {
            $existingIds = array_column($customers, 'unique_id');
            $unique_id = $this->generate_unique_id($existingIds);
        }


        if (empty($this->errorBag)) {
            $password = password_hash($password, PASSWORD_DEFAULT);

            $data = [
                'unique_id' => $unique_id,
                'name' => $name,
                'email' => $email,
                'password' => $password
            ];

            $this->storage->insert('customers', $data);
        
            return true;
        } else {
            return false;
        }
    }

    private function validate($name, $email, $password)
    {

        if (empty($name)) {
            $this->errorBag['name'] = 'Please provide a name';
        } elseif (str_word_count($name) < 2) {
            $this->errorBag['name'] = 'Must contain atleast a First and Last Name.';
        }

        if (empty($email)) {
            $this->errorBag['email'] = 'Please provide an email';
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->errorBag['email'] = 'Please provide a valid email address.';
        }

        if (empty($password)) {
            $this->errorBag['password'] = 'Please provide a password';
        } elseif (strlen($password) < 8) {
            $this->errorBag['password'] = 'Password should be longer than 8 characters';
        }
    }

    private function emailExists($email, $customers)
    {

        foreach ($customers as $customer) {
            if ($customer['email'] === $email) {
                return true;
            }
        }
        return false;
    }



    private function generate_unique_id($existingIds = [])
    {
        $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $charactersLength = strlen($characters);
        $uniqueid = '';

        do {
            $uniqueid = '';
            for ($i = 0; $i < 7; $i++) {
                $uniqueid .= $characters[rand(0, $charactersLength - 1)];
            }
        } while (in_array($uniqueid, $existingIds));

        return $uniqueid;
    }
}
