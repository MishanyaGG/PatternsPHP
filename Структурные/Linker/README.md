# Компоновщик

Каждая компания состоит из сотрудников. У каждого сотрудника есть одни и те же свойства: зарплата, обязанности, отчётность перед кем-то, субординация...
<h3><strong>Вкратце</strong></h3>
Шаблон «Компоновщик» позволяет клиентам обрабатывать отдельные объекты в едином порядке.

<h3><strong>Пример</strong></h3>

Вот разные виды сотрудников:

```php
namespace Data;

interface EmployeeInterface{
    public function __construct($name, $salary);
    public function getName();
    public function setSalary($salary);
    public function getSalary();
    public function getRoles();
}
```
```php
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
```

```php
namespace Data;

class Designer implements EmployeeInterface{

    protected $salary;
    protected $name;
    protected $rules;

    public function __construct($name,$salary)
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
```

А вот компания, которая состоит из сотрудников разных типов:

```php
namespace Data;

class Organization{
    protected $employees;

    public function addEmployee(EmployeeInterface $employee){
        $this->employees[] = $employee;
    }

    public function getNetSalaries(){
        $netSalary = 0;

        foreach ($this->employees as $employee){
            $netSalary += $employee->getSalary();
        }

        return $netSalary;
    }
}
```

<h3><strong>Использование</strong></h3>

```php
use Data\EmployeeInterface;
use Data\Developer;
use Data\Designer;
use Data\Organization;


// Автозагрузчик
spl_autoload_register(function ($className) {
    $fileName = __DIR__ . '/' . str_replace('\\', '/', $className) . '.php';

    if (file_exists($fileName)) {
        require_once $fileName;
    }
});

$jhon = new Developer('Jhon Doe', 12000);
$jane = new Designer('Jane Doe', 15000);

$organization = new Organization();
$organization->addEmployee($jhon);
$organization->addEmployee($jane);

echo "Net salaries: " . $organization->getNetSalaries();
```

