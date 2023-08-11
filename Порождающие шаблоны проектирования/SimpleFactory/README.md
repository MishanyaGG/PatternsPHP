# Простая фабрика

Допустим, вы строите дом и вам нужны двери. Будет бардак, если каждый раз, когда вам требуется дверь, вы станете вооружаться инструментами и делать её на стройплощадке. Вместо этого вы закажете двери на фабрике.\
<h3><strong>Вкратце</strong></h3>\
Простая фабрика просто генерирует экземпляр для клиента без предоставления какой-либо логики экземпляра.

<h3><strong>Пример</strong></h3>

Для начала нам нужен интерфейс двери и его реализация
```php
namespace Factory\DoorInterface;

interface DoorInterface{
    public function getWidth();
    public function getHeight();
}
```

```php
namespace Factory\WoodenDoor;

class WoodenDoor implements DoorInterface
{
    protected $widht;
    protected $height;

    public function __construct($widht, $height)
    {
        $this->height = $height;
        $this->widht = $widht;
    }

    public function getWidth()
    {
        return $this->widht;
    }

    public function getHeight()
    {
        return $this->height;
    }
}
```
Теперь создадим фабрику дверей, которая создаёт и возвращает нам двери

```php
namespace Factory\DoorFactory;

class DoorFactory{
    public static function makeDoor($width, $height){
        return new WoodenDoor($width,$height);
    }
}
```

<h3><strong>Использование</strong></h3>

```php
require_once('Factory/DoorFactory.php');
require_once('Factory/DoorInterface.php');
require_once('Factory/WoodenDoor.php');

$door = DoorFactory::makeDoor(100,200);

echo 'Width: '. $door->getWidth();
echo 'Height: '. $door->getHeight();
```
<h3><strong>Когда использовать?</strong></h3>
Когда создание объекта подразумевает какую-то логику, а не просто несколько присваиваний, то имеет смысл делегировать задачу выделенной фабрике, а не повторять повсюду один и тот же код.

![Изображение](https://sun9-17.userapi.com/impg/NnWvz8qOPDe4OlSRqplVXdEJtkNUy2_PajQ4Kw/UmdRuEjW75g.jpg)
