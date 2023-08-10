<?php

class DeveloperManager extends HiringManager {
    public function makeInterviewer(): Interviewer
    {
        return new Developer();
    }
}