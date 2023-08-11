# Абстрактная фабрика

Вернёмся к примеру с дверями из «Простой фабрики». В зависимости от своих потребностей вы можете купить деревянную дверь в одном магазине, стальную — в другом, пластиковую — в третьем. Для монтажа вам понадобятся разные специалисты: деревянной двери нужен плотник, стальной — сварщик, пластиковой — спец по ПВХ-профилям.

<h3><strong>Вкратце</strong></h3>
Это фабрика фабрик. То есть фабрика, группирующая индивидуальные, но взаимосвязанные/взаимозависимые фабрики без указания для них конкретных классов.
<h3><strong>Пример</strong></h3>
Создадим интерфейс Door и несколько реализаций для него.

```php
namespace Data;

interface DoorInterface{
    public function getDescription();
}
```
```php
namespace Data;

class WoodenDoor implements DoorInterface{
    public function getDescription()
    {
        echo 'I am a wooden door';
    }
}
```
```php
namespace Data;

class IronDoor implements DoorInterface{
    public function getDescription()
    {
        echo 'I am an iron door';
    }
}
```
Теперь нам нужны специалисты по установке каждого вида дверей.
```php
namespace Data;

interface DoorFittingExpertInterface{
    public  function getDescription();
}
```
```php
namespace Data;

class Welder implements DoorFittingExpertInterface{
    public function getDescription()
    {
        echo 'I can only fir iron doors';
    }
}
```
```php
namespace Data;

class Carpenter implements DoorFittingExpertInterface{
    public function getDescription()
    {
        echo 'I can only fit wooden doors';
    }
}
```
Мы получили абстрактную фабрику, которая позволяет создавать семейства объектов или взаимосвязанные объекты. То есть фабрика деревянных дверей создаст деревянную дверь и человека для её монтажа, фабрика стальных дверей — стальную дверь и соответствующего специалиста и т. д.
```php
namespace Data;

interface DoorFactoryInterface{
    public function makeDoor() : DoorInterface;
    public function makeFittingExpert() : DoorFittingExpertInterface;
}
```
```php
namespace Data;

class WoodenDoorFactory implements DoorFactoryInterface {
    public function makeDoor(): DoorInterface
    {
        return  new WoodenDoor();
    }

    public function makeFittingExpert(): DoorFittingExpertInterface
    {
        return new Carpenter();
    }
}
```
```php
namespace Data;

class IronDoorFactory implements DoorFactoryInterface{
    public function makeDoor(): DoorInterface
    {
        return new IronDoor();
    }

    public function makeFittingExpert(): DoorFittingExpertInterface
    {
        return new Welder();
    }
}
```

<h3><strong>Использование</strong></h3>
```php
require_once ('Data/DoorInterface.php');
require_once ('Data/DoorFactoryInterface.php');
require_once ('Data/DoorFittingExpertInterface.php');
require_once ('Data/WoodenDoor.php');
require_once ('Data/Carpenter.php');
require_once ('Data/IronDoor.php');
require_once ('Data/IronDoorFactory.php');
require_once ('Data/Welder.php');
require_once ('Data/WoodenDoorFactory.php');

$woodenFactory = new WoodenDoorFactory();

$door = $woodenFactory->makeDoor();
$expert = $woodenFactory->makeFittingExpert();

$ironFactory = new IronDoorFactory();

$door = $ironFactory->makeDoor();
$expert = $ironFactory->makeFittingExpert();

$door->getDescription();
$expert->getDescription();
```
Здесь фабрика деревянных дверей инкапсулировала carpenter и wooden door, фабрика стальных дверей — iron door and welder. То есть можно быть уверенными, что для каждой из созданных дверей мы получим правильного специалиста.
<h3><strong>Когда использовать?</strong></h3>
Когда у вас есть взаимосвязи с не самой простой логикой создания (creation logic).
<div align="center">
    <h2> Структура проекта </h2>
    <img src="https://sun9-70.userapi.com/impg/eRQAhDwDyoHv72ZJ0NaYm8E5ya4IC1g17Dyg8g/CollCN8Pmd0.jpg?size=801x601&quality=96&sign=89052e5ffdfbef010f07bfcad5af513e&type=album" alt="SimpleFactory">
</div>