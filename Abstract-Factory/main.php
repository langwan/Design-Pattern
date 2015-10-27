<?php

/**
 * 抽象工厂(Abstract Factory)
 * 2015-10-25 langwanluo@gmail.com
 *
 * 如果你要创建的是多个对象的组合，例如牛排配刀叉，拉面配筷子，那么你适合用抽象工厂。
 *
 * 组成
 * 1. 内部元素的抽象类，例如 IFood、IDishes。
 * 2. 抽象工厂，例如 IFactory
 * 3. 具体的元素，例如 Steak、Noolde。
 * 4. 具体的工厂，例如 SteakFactory、NoodleFactory。
 */

/**
 * 食品的抽象
 */
interface IFood {
    public function run();
}

/**
 * 餐具的抽象
 */
interface IDishes {
    public function run();
}

interface IFactory {
    public function createFood(); /* IFood */
    public function createDishes(); /* IDishes */
    public function run();
}

/**
 * 西式牛排
 */
class Steak implements IFood {
    public function run() {
        print("this is steak.\n");
    }
}

/**
 * 中式拉面
 */
class Noodle implements IFood {
    public function run() {
        print("this is noodle.\n");
    }
}

/**
 * 刀叉
 */
class Cutlery implements IDishes {
    public function run() {
        print("use knives and forks.\n");
    }
}

/**
 * 筷子
 */
class Chopsticks implements IDishes {
    public function run() {
        print("use kuai zi.\n");
    }
}

/**
 * 牛排套餐
 */
class SteakFactory implements IFactory {

    private $food = null;
    protected $dishes = null;

    public function createFood() {
        return new Steak();
    }
    public function createDishes()
    {
        return new Cutlery();
    }

    public function run() {
        $this->food = $this->createFood();
        $this->food->run();

        $this->dishes = $this->createDishes();
        $this->dishes->run();
    }
}

/**
 * 拉面套餐
 */
class NoodleFactory implements IFactory {

    private $food = null;
    protected $dishes = null;

    public function createFood() {
        return new Noodle();
    }

    public function createDishes() {
        return new Chopsticks();
    }

    public function run() {
        $this->food = $this->createFood();
        $this->food->run();

        $this->dishes = $this->createDishes();
        $this->dishes->run();
    }
}

function main() {

    // 来一个牛排套餐
    $steak = new SteakFactory();
    $steak->run();

    // 来一个拉面套餐
    $noodle = new NoodleFactory();
    $noodle->run();

}main();