<?php

namespace Data;

interface CommandInterface{
    public function execute();
    public function undo();
    public function redo();
}
