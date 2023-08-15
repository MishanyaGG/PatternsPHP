<?php

namespace Data;

class DefaultModel implements WritingStateInterface{
    public function write($words)
    {
        echo $words;
    }
}