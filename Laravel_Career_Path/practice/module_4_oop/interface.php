<?php

abstract class Vehicle
{
    abstract public function getBaseFare(): int;

    abstract public function getPerKiloFare(): int;

    public function getTotal(int $kilo): int
    {
        return $this->getBaseFare() + ($kilo * $this->getPerKiloFare());
    }
}

interface HourlyRentable{
    public function getHourlyRate(): int;
}

interface DailyRentable{
    public function getDailyRate(): int;
}

class Car extends Vehicle implements HourlyRentable, DailyRentable
{
    public function getBaseFare(): int
    {
        return 50;
    }

    public function getPerKiloFare(): int
    {
        return 10;
    }

    public function getHourlyRate(): int{
        return 100;
    }

    public function getDailyRate(): int
    {
        return 2000;
    }
}

class Bike extends Vehicle
{
    public function getBaseFare(): int
    {
        return 25;
    }

    public function getPerKiloFare(): int
    {
        return 5;
    }
}

class CNG extends Vehicle implements HourlyRentable
{
    public function getBaseFare(): int
    {
        return 30;
    }

    public function getPerKiloFare(): int
    {
        return 7;
    }

    public function getHourlyRate(): int{
        return 50;
    }
}


// $car = new Car();
// $totalCar = $car->getTotal(10);

// $bike = new Bike();
// $totalBike = $bike->getTotal(6);

// var_dump($totalCar);

// var_dump($totalBike);
