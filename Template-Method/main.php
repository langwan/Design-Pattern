<?php

/**
 * 模板方法是用一个模板类实现流程，用一些具体的实现类来实现过程，用流程来控制过程的一种设计模式。
 * 如果某件事的流程是基本固定的，只是具体的办事人或细节不同，你就可以使用模板方法来抽象出固定的
 * 流程，用不同的实现类来满足不同的情况。
 */

/**
 * 抽象的中国菜
 */
interface ICate {
    public function getFood();
    public function getSeasoning();
    public function getOil();
    public function getName();
}

/**
 * 炒菜流程
 */
class FlowTemplate {
    public function run(ICate $cate) {
        echo sprintf("加入 %s 待热\n", $cate->getOil());
        echo sprintf("加入 %s 翻炒\n", $cate->getSeasoning());
        echo sprintf("放入 %s 炒熟\n", $cate->getFood());
        echo sprintf("盛盘 %s\n\n", $cate->getName());
    }
}

/**
 * 清炒土豆丝
 */
class TDC implements  ICate {

    public function getFood() {
        return "土豆丝";
    }

    public function getSeasoning() {
        return "葱花";
    }

    public function getOil() {
        return "花生油";
    }

    public function getName() {
        return "清炒土豆丝";
    }
}

/**
 * 小炒肉
 */

class XCR implements ICate {
    public function getFood() {
        return "肉片";
    }

    public function getSeasoning() {
        return "辣椒、姜沫";
    }

    public function getOil() {
        return "色拉油";
    }

    public function getName() {
        return "小炒肉";
    }
}

function main() {

    $flow = new FlowTemplate();
    $cate = new TDC();
    $flow->run($cate);
    $cate = new XCR();
    $flow->run($cate);

} main();