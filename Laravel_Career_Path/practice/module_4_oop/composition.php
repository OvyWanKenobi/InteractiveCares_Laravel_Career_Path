<?php

// inheritence - relate classes using - is a - relationship

// composition - relate classes using - has a - relationship
//using many objects to compose a object
// eg - Vehicle has a Engine. Ship also has a Engine

class Vehicle {

    private Engine $engine; //taking an object of Engine class with it functionalities  in Vehicle Class

    public function start(){
        $this->engine->start(); //uses start function of the engine object for this vehicle

        //other logic
    }

}

class Ship {

    private Engine $engine; //taking an object of Engine class with it functionalities  in Ship Class
}

class Engine {
    private $model;
    private $brand;

    public function start(){
        //logic
    }
}

$vehicle = new Vehicle();
$ship = new Ship();

$vehicle->start();