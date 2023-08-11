<?php

namespace Data;

interface EmployeeInterface{
    public function __construct($name, $salary);
    public function getName();
    public function setSalary($salary);
    public function getSalary();
    public function getRoles();
}
