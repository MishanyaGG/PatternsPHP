<?php

abstract class HiringManager{

    abstract public function makeInterviewer(): Interviewer;

    public function takeInterview(){
        $interviewer = $this->makeInterviewer();
        $interviewer->askQuestions();
    }
}