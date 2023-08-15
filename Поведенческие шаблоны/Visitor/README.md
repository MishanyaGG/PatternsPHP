# Посетитель


Туристы собрались в Дубай. Сначала им нужен способ попасть туда (виза). После прибытия они будут посещать любую часть города, не спрашивая разрешения, ходить где вздумается. Просто скажите им о каком-нибудь месте — и туристы могут там побывать. Шаблон «Посетитель» помогает добавлять места для посещения.
<h3><strong>Вкратце</strong></h3>
Шаблон «Посетитель» позволяет добавлять будущие операции для объектов без их модифицирования.

<h3><strong>Пример</strong></h3>

Возьмём зоопарк: у нас есть несколько видов животных, и нам нужно послушать издаваемые ими звуки.

```php
namespace Data;

interface AnimalInterface{
    public function accept(AnimalOperationInrerface $operation);
}
```

```php
namespace Data;

interface AnimalOperationInrerface{
    public function visitMonkey(Monkey $monkey);
    public function visitLion(Lion $lion);
    public function visitDolphin(Dolphin $dolphin);
}
```

Реализуем животных

```php
namespace Data;

class Monkey implements AnimalInterface{
    public function shout(){
        echo 'Ooh oo aa aa!';
    }

    public function accept(AnimalOperationInrerface $operation)
    {
        $operation->visitMonkey($this);
    }
}
```

```php
namespace Data;

class Lion implements AnimalInterface{
    public function shout(){
        echo 'Roaaar!';
    }

    public function accept(AnimalOperationInrerface $operation)
    {
        $operation->visitLion($this);
    }
}
```

```php
namespace Data;

class Dolphin implements AnimalInterface{
    public function speak(){
        echo 'Tuut tuttu tuutt!';
    }

    public function accept(AnimalOperationInrerface $operation)
    {
        $operation->visitDolphin($this);
    }
}
```

Реализуем посетителя

```php
namespace Data;

class Speak implements AnimalOperationInrerface{
    public function visitMonkey(Monkey $monkey)
    {
        $monkey->shout();
    }

    public function visitLion(Lion $lion)
    {
        $lion->shout();
    }

    public function visitDolphin(Dolphin $dolphin)
    {
        $dolphin->speak();
    }
}
```

<h3><strong>Использование</strong></h3>

```php
use Data\Monkey;
use Data\Lion;
use Data\Dolphin;
use Data\Speak;

// Автозагрузчик
spl_autoload_register(function ($className) {
    $fileName = __DIR__ . '/' . str_replace('\\', '/', $className) . '.php';

    if (file_exists($fileName)) {
        require_once $fileName;
    }
});

$monkey = new Monkey();
$lion = new Lion();
$dolphin = new Dolphin();

$speak = new Speak();

$monkey->accept($speak);
$lion->accept($speak);
$lion->accept($speak);
```

<div align="center">
    <h2> Структура проекта </h2>
    <img src="https://sun9-46.userapi.com/impg/lsfPfKkYn7QoIHSqx08cpCCBA-OJKNce1khY2Q/KzzT6oxwrAc.jpg?size=710x687&quality=96&sign=d73353c65f83c9a5658e462c73e948f2&type=album" alt="SimpleFactory">
</div>