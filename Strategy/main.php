<?php

/**
 * 策略接口
 */
interface IStrategy {
    public function run($items);
}

/**
 * 冒泡排序
 */
class BubbleSort implements IStrategy {
    public function run($items) {
        $n = count($items);
        for($i = 0; $i < $n - 1; $i++) {
            for($j = 0; $j < $n - 1 - $i; ++$j) {
                if($items[$j] > $items[$j+1]) {
                    $tmp = $items[$j];
                    $items[$j] = $items[$j+1];
                    $items[$j+1] = $tmp;
                }
            }
        }
        return $items;
    }
}

/**
 * 插入排序
 */
class InsertSort implements IStrategy {
    public function run($items) {
        $n = count($items);
        for($i = 1; $i < $n; $i++) {
            if ($items[$i] < $items[$i - 1]) {
                $j = $i - 1;
                $x = $items[$i];
                $items[$i] = $items[$i - 1];
                while($x < $items[$j]) {
                    $items[$j + 1] = $items[$j];
                    $j--;
                }
                $items[$j + 1] = $x;
            }
        }
        return $items;
    }
}

/**
 * 排行榜
 */
class SortTable {
    public function run($items, $strategy) {
        return $strategy->run($items);
    }
}

function main() {

    $items = array(1, 3, 4, 5, 2, 8, 6, 1);
    $st = new SortTable();

    $items = $st->run($items, new BubbleSort());
    print_r($items);

    $items = $st->run($items, new InsertSort());
    print_r($items);

}main();