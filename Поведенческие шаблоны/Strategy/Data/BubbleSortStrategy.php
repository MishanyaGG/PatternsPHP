<?php

namespace Data;

class BubbleSortStrategy implements SortStrategy{
    public function sort($dataset)
    {
        echo 'Sorting using bubble sort';

        return $dataset;
    }
}