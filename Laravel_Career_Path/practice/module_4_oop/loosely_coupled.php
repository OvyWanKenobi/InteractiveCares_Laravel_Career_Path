<?php

//program to an interface, not an implementation
//here the driver is loosely coupled to the vehicle type. using the interface, 
//as interface is inherited by both car and bike. the driver class can use vehicleinterface  to get any of the bike or car which ever is passed

class Driver
{
    protected VehicleInterface $vehicle;

    public function __construct(VehicleInterface $vehicle)
    {
        $this->vehicle = $vehicle;
    }

    public function startVehicle()
    {
        $this->vehicle->start();
    }
}

interface VehicleInterface
{
    public function start();
}

class Bike implements VehicleInterface
{

    public function start()
    {
        printf("the bike has started \n");
    }
}

class Car implements VehicleInterface
{

    public function start()
    {
        printf("the car has started \n");
    }
}


$car = new Car();
$driver = new Driver($car);
$driver->startVehicle();

$bike = new Bike();
$driver = new Driver($bike);
$driver->startVehicle();
