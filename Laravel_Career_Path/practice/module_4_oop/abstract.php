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

class Car extends Vehicle
{
    public function getBaseFare(): int
    {
        return 50;
    }

    public function getPerKiloFare(): int
    {
        return 10;
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


$car = new Car();
$totalCar = $car->getTotal(10);

$bike = new Bike();
$totalBike = $bike->getTotal(6);

var_dump($totalCar);

var_dump($totalBike);
