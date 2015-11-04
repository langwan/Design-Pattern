<?php

/**
 * 事件
 * 1. 员工自己写请假申请
 * 2. 经理处理请假申请
 * 3. CEO处理请假申请
 * 4. 人事审批
 */
abstract class Handler {
    public $successor;
    abstract public function run($context);
    public function execute($context) {
        $this->run($context);
        if(isset($this->successor)) {
            $this->successor->execute($context);
        } else {
            echo sprintf("流程处理完成。\n");
        }
    }
}

/**
 * 员工自己填表
 */
class MyHandler extends Handler {
    public function run($context) {
        $context['body'] = sprintf("%s 申请 休假 %d 天。", $context['username'], $context['days']);
        echo sprintf("%s\n", $context['body']);
        return $context;
    }
}

/**
 * 经理审批
 */
class ManagerHandler extends Handler {
    public function run($context) {
        $context['Sign'] = true;
        echo sprintf("经理意见：同意。\n");
        return $context;
    }
}

/**
 * CEO审批
 */
class CeoHandler extends Handler {
    public function run($context) {
        $context['Sign'] = true;
        echo sprintf("CEO意见：同意。\n");
        return $context;
    }
}

/**
 * 人力资源审批
 */
class HrHandler extends Handler {
    public function run($context) {
        $context['Sign'] = true;
        echo sprintf("人事意见：同意。\n");
        return $context;
    }
}

/**
 * 请假流程
 */
class Workflow {

    public function run($name, $days) {
        $handler = new MyHandler();
        $start = $handler;
        if($days <= 3) {
            $handler->successor = new ManagerHandler();
        } else {
            $handler->successor = new CeoHandler();
        }
        $handler = $handler->successor;
        $handler->successor = new HrHandler();

        $start->execute(array('username' => $name, 'days' => $days));
    }
}

function main() {
    $workflow = new Workflow();
    $workflow->run('Tom', 2);
    echo "\n";
    $workflow->run('John', 8);
} main();