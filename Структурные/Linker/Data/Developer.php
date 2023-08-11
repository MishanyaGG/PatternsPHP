<?php

namespace Data;

class Developer implements EmployeeInterface{
    protected $salary;
    protected $name;
    protected $roles;

    public function __construct($name, $salary)
    {
        $this->name = $name;
        $this->salary = $salary;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setSalary($salary)
    {
        $this->salary = $salary;
    }

    public function getSalary()
    {
        return $this->salary;
    }

    public function getRoles()
    {
        return $this->roles;
    }
}