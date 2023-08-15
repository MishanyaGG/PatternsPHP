<?php

namespace Data;

class LowerCase implements WritingStateInterface{
    public function write($words)
    {
        echo strtolower($words);
    }
}
