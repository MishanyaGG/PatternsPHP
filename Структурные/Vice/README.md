# Заместитель
Открыть дверь с электронным замком можно с помощью карточки доступа (access card) или кнопки для обхода системы безопасности. То есть основная функциональность двери — открыться, а поверх неё может быть ещё какая-то функциональность — «заместитель».
<h3><strong>Вкратце</strong></h3>
С помощью шаблона «Заместитель» класс представляет функциональность другого класса.
<h3><strong>Пример</strong></h3>
Реализуем интерфейс двери и саму дверь
```php
namespace Data;

interface DoorInterface{
    public function open();
    public function close();
}
```

```php
namespace Data;

class LabDoor implements DoorInterface {
    public function open()
    {
        echo 'Opening lab door';
    }

    public function close()
    {
        echo 'Closing the lab dor';
    }
}
```

Сделаем "заместителя", чтобы дверь могла выполнять защитную функцию
```php
namespace Data;

class Security{
    protected $door;

    public function __construct(DoorInterface $door)
    {
        $this->door = $door;
    }

    public function authenticate($password){
        return $password === '$ecr@t';
    }

    public function open($password){
        if ($this->authenticate($password)){
            $this->door->open();
        } else{
            echo 'Big no! It ain`t possible';
        }
    }

    public function close(){
        $this->door->close();
    }
}
```

<h3><strong>Использование</strong></h3>
```php
use Data\Security;
use Data\LabDoor;

// Автозагрузчик
spl_autoload_register(function ($className) {
    $fileName = __DIR__ . '/' . str_replace('\\', '/', $className) . '.php';

    if (file_exists($fileName)) {
        require_once $fileName;
    }
});

$door = new Security(new LabDoor());
$door->open('invalid'); // Big no! It ain't possible.

$door->open('$ecr@t'); // Opening lab door
$door->close(); // Closing lab door
```