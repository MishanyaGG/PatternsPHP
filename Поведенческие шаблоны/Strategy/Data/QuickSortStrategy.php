<?php

namespace Data;

class QuickSortStrategy implements SortStrategy{
    public function sort($dataset)
    {
        echo 'Sorting using quick sort';

        return $dataset;
    }
}