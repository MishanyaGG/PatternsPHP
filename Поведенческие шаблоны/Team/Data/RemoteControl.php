<?php

namespace Data;

class RemoteControl{
    public function submit(CommandInterface $command){
        $command->execute();
    }
}