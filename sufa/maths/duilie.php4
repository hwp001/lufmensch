<?php
//用php实现一个双向队列
class Deque{
    private $queue = array();
    public function addFirst($item){
        //array_unshift 数组开头插入
        return array_unshift($this->queue,$item);
    }
    public function addLast($item){
        //将数值压入数组末尾（看成栈）
        return array_push($this->queue,$item);
    }
    public function removeFirst(){
        //将数组开头移出
        return array_shift($this->queue);
    }
    public function removeLast(){
        return array_pop($this->queue);
    }
}