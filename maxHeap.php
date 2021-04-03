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

    public function print() {
        echo json_encode($this->arr)."\n";
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
        if ($this->_isEmpty() || $this->size == 1) return;
        $this->arr[1] = $this->arr[$this->size--];
        $this->heapifyDown();
    }

    private function heapifyDown() {
        $index = 1;
        while ($index < $this->size) {
            $maxChildIndex = $this->_getMaxChildIndex($index);
            if ($maxChildIndex == -1) break;
            if ($this->arr[$index] >= $this->arr[$maxChildIndex]) break;
            $tmp = $this->arr[$index];
            $this->arr[$index] = $this->arr[$maxChildIndex];
            $this->arr[$maxChildIndex] = $tmp;
            $index = $maxChildIndex;
        }
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
        $leftVal = 2 * $i <= $this->size ? $this->arr[2*$i] : null;
        $rightVal = 2*$i + 1 <= $this->size ? $this->arr[2*$i + 1] : null;
        if (is_null($leftVal) && is_null($rightVal)) return -1;
        if (is_null($rightVal)) return $leftVal;
        if (is_null($leftVal)) return $rightVal;
        return $leftVal >= $rightVal ? 2*$i : 2*$i + 1;
    }

    //获取当前下标的父节点的值
    private function _getParentVal($i) {
        return $this->arr[intval(floor($i/2))];
    }
}