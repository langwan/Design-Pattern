<?php

/**
 * 原型模式比new出新对象的效率要高，可以通过浅拷贝或者深拷贝来返回一个新的对象。
 * 其实在php当中clone就是原型模式的深拷贝，我们仅仅是为了体现原型模式的本来面目。
 */

/**
 * 原型的抽象
 */
abstract class Prototype {

    public function copy() {
        //如果使用 return $this 会进行浅拷贝，会输出两个三国演义，clone在PHP语言中表示深拷贝。
        return clone $this;
    }
}

/**
 * 图书
 */
class Book extends  Prototype {
    private $name = null;
    public function setName($name) {
        $this->name = $name;
    }

    public function getName() {
        return $this->name;
    }
}

/**
 * 当深拷贝的时候返回正确的名字，当浅拷贝的时候下面一段代码返回两本相同的书名。
 */
function main() {

    $sanGuoYanYi = new Book();
    $sanGuoYanYi->setName("水浒");

    $shuiHu = $sanGuoYanYi->copy();
    $sanGuoYanYi->setName("三国演义");

    echo sprintf("%s\n", $sanGuoYanYi->getName());
    echo sprintf("%s\n", $shuiHu->getName());

} main();