# Фасад

Как включить компьютер? Вы скажете: «Нажать кнопку включения». Это потому, что вы используете простой интерфейс, предоставляемый компьютером наружу. А внутри него происходит очень много процессов. Простой интерфейс для сложной подсистемы — это фасад.
<h3><strong>Вкратце</strong></h3>
Шаблон «Фасад» предоставляет упрощённый интерфейс для сложной подсистемы.

<h3><strong>Пример</strong></h3>

Создадим класс `Computer`

```php
namespace Data;

class Computer{
    public function getElectricShock(){
        echo 'Ouch!';
    }

    public function makeSound(){
        echo "Beep beep!";
    }

    public function showLoadingScreen(){
        echo 'Loading..';
    }

    public function bam(){
        echo 'Ready to be used!';
    }

    public function closeEverything(){
        echo 'Bup bup bup buzzzz';
    }

    public function sooth(){
        echo 'Zzzzzz';
    }

    public function pullCurrent(){
        echo 'Haaah!';
    }
}
```

Теперь "фасад":

```php
namespace Data;

class ComputerFacade{
    protected $computer;

    public function __construct(Computer $computer)
    {
        $this->computer = $computer;
    }

    public function turnOn(){
        $this->computer->getElectricShock();
        $this->computer->makeSound();
        $this->computer->showLoadingScreen();
        $this->computer->bam();
    }

    public function turnOff(){
        $this->computer->closeEverything();
        $this->computer->pullCurrent();
        $this->computer->sooth();
    }
}
```

<h3><strong>Использование</strong></h3>

```php
use Data\Computer;
use Data\ComputerFacade;

// Автозагрузчик
spl_autoload_register(function ($className) {
    $fileName = __DIR__ . '/' . str_replace('\\', '/', $className) . '.php';

    if (file_exists($fileName)) {
        require_once $fileName;
    }
});

$computer = new ComputerFacade(new Computer());

$computer->turnOn();
echo '<br>';
$computer->turnOff();
```

<div align="center">
    <h2> Структура проекта </h2>
    <img src="https://sun9-23.userapi.com/impg/0MCxBmrCV_kcVbgOKCHRYuaa9QmFxsLQlXBERw/DRfwsIjUHOI.jpg?size=481x308&quality=96&sign=a13d09467f92fd8d331879c113ee2886&type=album" alt="SimpleFactory">
</div>

