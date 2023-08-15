<?php

namespace Data;

class UpperCase implements WritingStateInterface{
    public function write($words)
    {
        echo strtoupper($words);
    }
}