<?php

class MaxHeap {
    
    private $arr;
    private $cap;   //总容量
    private $size;  //当前大小

    public function __construct($cap) {
        $this->cap = $cap;
        $this->size = 0;
        $this->arr = [null];
    }

    public function getSize() {
        return $this->size;
    }

    public function print() {
        $res = [];
        for ($i = 1; $i <= $this->size; $i++) {
            $res[] = $this->arr[$i];
        }
        echo '['.implode($res, ', ')."]\n";
    }

    public function printSize() {
        echo $this->size."\n";
    }

    public function getMax() {
        if ($this->size == 0) return null;
        return $this->arr[1];
    }

    public function insert($val) {
        if ($this->_isFull()) return;
        $this->arr[++$this->size] = $val;
        $this->heapifyUp($this->size);
    }

    public function deleteMax() {
        if ($this->_isEmpty()) return;
        $this->arr[1] = $this->arr[$this->size--];  //把排在最后的元素放到第一位
        $this->heapifyDown(1);
    }

    //向下堆化 $i是下标
    private function heapifyDown($i) {
        $tmp = $this->arr[$i];
        while (2*$i <= $this->size) {
            $maxChildIndex = $this->_getMaxChildIndex($i);
            if ($tmp >= $this->arr[$maxChildIndex]) break;
            $this->arr[$i] = $this->arr[$maxChildIndex];    //往上顶
            $i = $maxChildIndex;    //往下沉
        }
        $this->arr[$i] = $tmp;
    }

    //向上堆化 $i是下标
    private function heapifyUp($i) {
        $newVal = $this->arr[$i];
        while ($i > 1 && $this->_getParentVal($i) < $newVal) {
            $this->arr[$i] = $this->_getParentVal($i);
            $i = intval(floor($i/2));
        }
        $this->arr[$i] = $newVal;
    }

    private function _isEmpty() {
        return $this->size == 0;
    }

    private function _isFull() {
        return $this->size == $this->cap;
    }

    private function _getMaxChildIndex($i) {
        return $this->arr[2*$i] >= $this->arr[2*$i + 1] ? 2*$i : 2*$i + 1;
    }

    //获取当前下标的父节点的值
    private function _getParentVal($i) {
        return $this->arr[intval(floor($i/2))];
    }
}