<?php

namespace Data;

class TextEditor{
    protected $state;

    public function __construct(WritingStateInterface $state)
    {
        $this->state = $state;
    }

    public function setState(WritingStateInterface $state){
        $this->state = $state;
    }

    public function type($words){
        $this->state->write($words);
    }
}
