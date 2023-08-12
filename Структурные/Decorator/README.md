# Декоратор

Допустим, у вас свой автосервис, оказывающий различные услуги. Как выставлять клиентам счёт? Добавлять последовательно услуги и их стоимость — и в конце концов получится итоговая сумма к оплате. Здесь каждый тип услуги — это «декоратор».
<h3><strong>Вкратце</strong></h3>
Шаблон «Декоратор» позволяет во время выполнения динамически изменять поведение объекта, обёртывая его в объект класса «декоратора».

<h3><strong>Пример</strong></h3>
Возьмём в качестве примера кофе. Сначала просто реализуем интерфейс

```php
namespace Data;

interface CoffeeInterface{
    public function getCost();
    public function getDesription();
}
```

```php
namespace Data;

class SimpleCoffee implements CoffeeInterface{
    public function getCost()
    {
        return 10;
    }

    public function getDesription()
    {
        return 'Simple coffee';
    }
}
```

Можно сделать код расширяемым, чтобы при необходимости вносить модификации. Добавим «декораторы»:

```php
namespace Data;

class MilkCoffee implements CoffeeInterface{
    protected $coffee;

    public function __construct(CoffeeInterface $coffee)
    {
        $this->coffee = $coffee;
    }

    public function getCost()
    {
        return $this->coffee->getCost() + 2;
    }

    public function getDesription()
    {
        return $this->coffee->getDesription(). ', milk';
    }
}
```

```php
namespace Data;

class WhipCoffee implements CoffeeInterface{
    protected $coffee;

    public function __construct(CoffeeInterface $coffee)
    {
        $this->coffee = $coffee;
    }

    public function getCost()
    {
        return $this->coffee->getCost() + 5;
    }

    public function getDesription()
    {
        return $this->coffee->getDesription() . ', whip';
    }
}
```

```php
namespace Data;

class VanilCoffee implements CoffeeInterface{
    protected $coffee;

    public function __construct(CoffeeInterface $coffee)
    {
        $this->coffee = $coffee;
    }

    public function getCost()
    {
        return $this->coffee->getCost() + 3;
    }

    public function getDesription()
    {
        return $this->coffee->getDesription() . ', vanilla';
    }
}
```

Теперь приготовим кофе:

```php
use Data\SimpleCoffee;
use Data\MilkCoffee;
use Data\WhipCoffee;
use Data\VanilCoffee;

// Автозагрузчик
spl_autoload_register(function ($className) {
    $fileName = __DIR__ . '/' . str_replace('\\', '/', $className) . '.php';

    if (file_exists($fileName)) {
        require_once $fileName;
    }
});

$someCoffee = new SimpleCoffee();

echo $someCoffee->getCost(); echo '<br>';
echo $someCoffee->getDesription(); echo '<br>';

$someCoffee = new MilkCoffee($someCoffee);
echo $someCoffee->getCost(); echo '<br>';
echo $someCoffee->getDesription(); echo '<br>';

$someCoffee = new WhipCoffee($someCoffee);
echo $someCoffee->getCost(); echo '<br>';
echo $someCoffee->getDesription(); echo '<br>';

$someCoffee = new VanilCoffee($someCoffee);
echo $someCoffee->getCost(); echo '<br>';
echo $someCoffee->getDesription(); echo '<br>';
```