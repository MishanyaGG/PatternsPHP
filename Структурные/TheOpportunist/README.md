# Приспособленец

Обычно в заведениях общепита чай заваривают не отдельно для каждого клиента, а сразу в некой крупной ёмкости. Это позволяет экономить ресурсы: газ/электричество, время и т. д. Шаблон «Приспособленец» как раз посвящён общему использованию (sharing).
<h3><strong>Вкратце</strong></h3>
Шаблон применяется для минимизирования использования памяти или вычислительной стоимости за счёт общего использования как можно большего количества одинаковых объектов.

<h3><strong>Пример</strong></h3>

Сделаем типы чая и чайника

```php
namespace Data;

// Приспособленец - то, что будет закешировано
// Типы чая здесь - приспособленцы
class KarakTea{}
```

```php
namespace Data;

class TeaMaker{
    protected $availablTea = [];

    public function make($preference){
        if(empty($this->availablTea[$preference])){
            $this->availablTea[$preference] = new KarakTea();
        }

        return $this->availablTea[$preference];
    }
}
```

Сделаем забегаловку `TeaShop`, принимающую и обрабатывающую заказы:

```php
namespace Data;

class TeaShop{
    protected $orders;
    protected $teaMaker;

    public function __construct(TeaMaker $teaMaker)
    {
        $this->teaMaker = $teaMaker;
    }

    public function takeOrder(string $teaType, int $table){
        $this->orders[$table] = $this->teaMaker->make($teaType);
    }

    public function serve(){
        foreach ($this->orders as $table => $tea){
            echo 'Serving tea to table# '. $table. '<br>';
        }
    }
}
```

<h3><strong>Использование</strong></h3>

```php
use Data\TeaMaker;
use Data\TeaShop;

// Автозагрузчик
spl_autoload_register(function ($className) {
    $fileName = __DIR__ . '/' . str_replace('\\', '/', $className) . '.php';

    if (file_exists($fileName)) {
        require_once $fileName;
    }
});

$teaMaker = new TeaMaker();
$shop = new TeaShop($teaMaker);

$shop->takeOrder('less sugar', 1);
$shop->takeOrder('more milk', 2);
$shop->takeOrder('without sugar', 5);

$shop->serve();
// Serving tea to table# 1
// Serving tea to table# 2
// Serving tea to table# 5
```

<div align="center">
    <h2> Структура проекта </h2>
    <img src="https://sun9-67.userapi.com/impg/IRMsBgze8vuTiZBN4KAopr0vQsVOiw9iUvxMtA/_ekcRACFr20.jpg?size=511x491&quality=96&sign=0ca9091596324e51a304c318c46742e3&type=album" alt="SimpleFactory">
</div>