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
        $this->arr[1] = $this->arr[$this->size--];
        $this->heapifyDown();
    }

    private function heapifyDown() {
        $index = 1;
        while ($index <= $this->size) {
            $maxChildIndex = $this->_getMaxChildIndex($index);
            if ($this->arr[$index] >= $this->arr[$maxChildIndex]) break;
            $tmp = $this->arr[$index];
            $this->arr[$index] = $this->arr[$maxChildIndex];
            $this->arr[$maxChildIndex] = $tmp;
            $index = $maxChildIndex;
        }
    }

    //向上堆化 $i是下标
    private function heapifyUp($i) {
        if ($i <= 1) return;
        $newVal = $this->arr[$i];
        $index = $i;
        while ($this->_getParentVal($index) < $newVal) {
            $this->arr[$index] = $this->_getParentVal($index);
            $index = intval(floor($index/2));
        }
        $this->arr[$index] = $newVal;
    }

    private function _isEmpty() {
        if ($this->size == 0) return true;
        return false;
    }

    private function _isFull() {
        if ($this->size == $this->cap) return true;
        return false;
    }

    private function _getMaxChildIndex($i) {
        $leftVal = $this->arr[2*$i];
        $rightVal = $this->arr[2*$i + 1];
        return $leftVal >= $rightVal ? 2*$i : 2*$i + 1;
    }

    //获取当前下标的父节点的值
    private function _getParentVal($i) {
        return $this->arr[intval(floor($i/2))];
    }
}