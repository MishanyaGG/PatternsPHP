<?php

namespace Data;

class Sorter{
    protected $sorter;

    public function __construct(SortStrategy $sorter)
    {
        $this->sorter = $sorter;
    }

    public function sort ($dataset){
        return $this->sorter->sort($dataset);
    }
}