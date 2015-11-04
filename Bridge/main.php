<?php

/**
 * 桥接的目的是为了让抽象和实现解耦，把继承的强关系改变成弱关系进行聚合。
 */

/**
 * 车的抽象
 */
interface ICar {
    public function run();
}

/**
 * 跑车
 */
class Roadster implements ICar {
    private $speed = 300;
    public function run() {
        echo sprintf("跑车正在以每小时 %d 公里的速度奔跑着。\n", $this->speed);
    }
}

/**
 * 老爷车
 */
class Jalopy implements  ICar {
    private $speed = 50;
    public function run() {
        echo sprintf("老爷车正在以每小时 %d 公里的速度爬行着。\n", $this->speed);
    }
}

/**
 * 公路
 */
class Road {
    private $car;
    public function setCar($car) {
        $this->car = $car;
    }
    public function run() {
        $this->car->run();
    }
}

function main() {

    $road = new Road();
    $car = new Roadster();
    $road->setCar($car);
    $road->run();

    $car = new Jalopy();
    $road->setCar($car);
    $road->run();

}main();