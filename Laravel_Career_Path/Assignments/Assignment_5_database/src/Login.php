<?php

namespace App;

use App\DataStorage\DataStorageConfig;

class Login
{

    public $errorBag = [];


    public $storage;
    public function __construct()
    {

        $this->storage =  DataStorageConfig::createStorage();
    }

    public function login($email, $password)
    {

        $this->validate($email, $password);

        if (!empty($this->errorBag)) {
            return false;
        }

        $customers = $this->storage->getAll('customers');

        if (empty($customers)) {
            flash('error', 'Server Error. Try Again Later.');
            return false;
        } else {


            $customer = $this->storage->select('customers', ['email' => $email]);
            $customer = reset($customer);

            if ($customer && password_verify($password, $customer['password'])) {

                if ($customer['unique_id'] === 'admin') {
                    $_SESSION['adminLoggedIn'] = true;
                } else {
                    $_SESSION['customer_uniqueid'] = $customer['unique_id'];
                }


                // $_SESSION['customer_name'] = $customer['name'];
                // $_SESSION['customer_email'] = $customer['email'];
                return true;
            } else {
                flash('error', 'Password or Email is not Valid. Please Try Again.');
                return false;
            }
        }
    }

    private function validate($email, $password)
    {

        if (empty($email)) {
            $this->errorBag['email'] = 'Please provide an email';
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->errorBag['email'] = 'Please provide a valid email address.';
        }

        if (empty($password)) {
            $this->errorBag['password'] = 'Please provide a password';
        }
    }
}
