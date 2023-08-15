# Команда

Вы пришли в ресторан. Вы `Client` просите официанта `Invoker` принести блюда `Command`. Официант перенаправляет запрос шеф-повару `Receiver`, который знает, что и как готовить. Другой пример: вы `Client` включаете `Command` телевизор `Receiver` с помощью пульта `Invoker`.
<h3><strong>Вкратце</strong></h3>
Шаблон «Команда» позволяет инкапсулировать действия в объекты. Ключевая идея — предоставить средства отделения клиента от получателя.

<h3><strong>Пример</strong></h3>
Сначала сделаем получателя, содержащего реализации каждого действия, которое может быть выполнено

```php
namespace Data;

class Bulb{
    public function turnOn(){
        echo 'Bulb has been lit';
    }

    public function turnOff(){
        echo 'Darkness!';
    }
}
```

Теперь сделаем интерфейс, который будет реализовывать каждая команда. Также сделаем набор команд.

```php
namespace Data;

interface CommandInterface{
    public function execute();
    public function undo();
    public function redo();
}
```

```php
namespace Data;

class TurnOn implements CommandInterface{
    protected $bulb;

    public function __construct(Bulb $bulb)
    {
        $this->bulb = $bulb;
    }

    public function execute()
    {
        $this->bulb->turnOn();
    }

    public function undo()
    {
        $this->bulb->turnOff();
    }

    public function redo()
    {
        $this->execute();
    }
}
```

```php
namespace Data;

class TurnOff implements CommandInterface{
    protected $bulb;

    public function __construct(Bulb $bulb)
    {
        $this->bulb = $bulb;
    }

    public function execute()
    {
        $this->bulb->turnOff();
    }

    public function undo()
    {
        $this->bulb->turnOn();
    }

    public function redo()
    {
        $this->execute();
    }
}
```

Теперь сделаем вызывающего `Invoker`, с которым будет взаимодействовать клиент для обработки команд.

```php
namespace Data;

class RemoteControl{
    public function submit(CommandInterface $command){
        $command->execute();
    }
}
```

Посмотрим, как всё это может использовать клиент

```php
use Data\Bulb;
use Data\TurnOn;
use Data\TurnOff;
use Data\RemoteControl;

// Автозагрузчик
spl_autoload_register(function ($className) {
    $fileName = __DIR__ . '/' . str_replace('\\', '/', $className) . '.php';

    if (file_exists($fileName)) {
        require_once $fileName;
    }
});

$turnOn = new TurnOn(new Bulb());
$turnOff = new TurnOff(new Bulb());

$remote = new RemoteControl();
$remote->submit($turnOn);
$remote->submit($turnOff);
```

Шаблон «Команда» можно использовать и для реализации системы на основе транзакций. То есть системы, в которой вы сохраняете историю команд по мере их выполнения. Если последняя команда выполнена успешно, то всё хорошо. В противном случае система итерирует по истории и делает undo для всех выполненных команд.

<div align="center">
    <h2> Структура проекта </h2>
    <img src="https://sun9-54.userapi.com/impg/rio0-YoI7rUz7YUb3B5gKVo2VGfM9bCAdNczOA/IJciqJt_nl8.jpg?size=608x583&quality=96&sign=21e3ec962ab9f4361e8db4785563b4a8&type=album" alt="SimpleFactory">
</div>