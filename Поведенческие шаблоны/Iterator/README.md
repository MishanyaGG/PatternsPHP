# Итератор

Хороший пример — радиоприёмник. Вы начинаете с какой-то радиостанции, а затем перемещаетесь по станциям вперёд/назад. То есть устройство предоставляет интерфейс для итерирования по каналам.
<h3><strong>Вкратце</strong></h3>
Шаблон — это способ доступа к элементам объекта без раскрытия базового представления.

<h3><strong>Пример</strong></h3>

В PHP довольно легко реализовать этот шаблон с помощью стандартной библиотеки PHP. Сначала создадим радиостанцию RadioStation.

```php
namespace Data;

class RadioStation{
    protected $frequecy;

    public function __construct($frequecy)
    {
        $this->frequecy = $frequecy;
    }

    public function getFrequency(){
        return $this->frequecy;
    }
}
```

Теперь создадим итератор

```php
namespace Data;

use Countable;
use Iterator;
use JetBrains\PhpStorm\Internal\TentativeType;

class StationList implements Countable,Iterator{
    protected $stations = [];

    protected $counter;

    public function addStation(RadioStation $station){
        $this->stations[] = $station;
    }

    public function removeStation(RadioStation $toRemove){
        $toRemoveFrequency = $toRemove->getFrequency();
        $this->stations = array_filter($this->stations,function (RadioStation $station) use ($toRemoveFrequency) {
            return $station->getFrequency() !== $toRemoveFrequency;
        });
    }

    public function count() : int
    {
        return $this->stations[$this->counter];
    }

    public function current(): RadioStation
    {
        return $this->stations[$this->counter];
    }


    public function key() : mixed
    {
        return $this->counter;
    }

    public function next() : void
    {
        $this->counter++;
    }

    public function rewind() : void
    {
        $this->counter = 0;
    }

    public function valid(): bool
    {
        return isset($this->stations[$this->counter]);
    }
}
```

<h3><strong>Использование</strong></h3>

```php
use Data\StationList;
use Data\RadioStation;

// Автозагрузчик
spl_autoload_register(function ($className) {
    $fileName = __DIR__ . '/' . str_replace('\\', '/', $className) . '.php';

    if (file_exists($fileName)) {
        require_once $fileName;
    }
});

$stationList = new StationList();

$stationList->addStation(new RadioStation(89));
$stationList->addStation(new RadioStation(101));
$stationList->addStation(new RadioStation(102));
$stationList->addStation(new RadioStation(103.2));

foreach ($stationList as $station) {
    echo $station->getFrequency().'<br>';
}

$stationList->removeStation((new RadioStation(89)));
```

<div align="center">
    <h2> Структура проекта </h2>
    <img src="https://sun9-22.userapi.com/impg/yEOlvlamClq-sJF6WDQPX6fRRHonT8Tp0AYLjw/SX8c1Nd14V8.jpg?size=644x789&quality=96&sign=4485237146202dd56ac4ee9cde5600fc&type=album" alt="SimpleFactory">
</div>