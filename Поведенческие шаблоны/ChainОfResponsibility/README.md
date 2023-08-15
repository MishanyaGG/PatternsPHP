# Цепочка ответственности
Допустим, для вашего банковского счёта доступны три способа оплаты (`A`, `B` и `C`). Каждый подразумевает разные доступные суммы денег: `A — 100 долларов`, `B — 300`, `C — 1000`. Приоритетность способов при оплате: `А`, затем `В`, затем `С`. Вы пытаетесь купить что-то за 210 долларов. На основании «цепочки ответственности» система попытается оплатить способом `А`. Если денег хватает — то оплата проходит, а цепочка прерывается. Если денег не хватает — то система переходит к способу `В`, и т. д.
<h3><strong>Вкратце</strong></h3>
Шаблон «Цепочка ответственности» позволяет создавать цепочки объектов. Запрос входит с одного конца цепочки и движется от объекта к объекту, пока не будет найден подходящий обработчик.

<h3><strong>Пример</strong></h3>

Создадим основной банковский счёт, содержащий логику связывания счетов в цепочки, и сами счета.

```php
namespace Data;

use Exception;

abstract class Account{
    protected $successor;
    protected $balance;

    public function setNext(Account $account){
        $this->successor = $account;
    }

    public function pay($amountToPay){
        if($this->canPay($amountToPay)){
            echo sprintf('Paid %s using %s <br>',$amountToPay, get_called_class());
        } elseif ($this->successor){
            echo sprintf('Cannot pay using %s. Proceeding.. <br>', get_called_class());
            $this->successor->pay($amountToPay);
        } else{
            throw new Exception('None of the accounts have enough balance');
        }
    }

    public function canPay($amount) : bool{
        return $this->balance >= $amount;
    }
}
```

```php
namespace Data;

class Bank extends Account{
    protected $balance;

    public function __construct($balance)
    {
        $this->balance = $balance;
    }
}
```

```php
namespace Data;

class PayPal extends Account {
    protected $balance;

    public function __construct($balance)
    {
        $this->balance = $balance;
    }
}
```

```php
namespace Data;

class Bitcoin extends Account{
    protected $balance;

    public function __construct($balance)
    {
        $this->balance = $balance;
    }
}
```

Теперь с помощью определённых выше линков (`Bank`, `Paypal`, `Bitcoin`) подготовим цепочку:

```php
use Data\Bank;
use Data\PayPal;
use Data\Bitcoin;

// Автозагрузчик
spl_autoload_register(function ($className) {
    $fileName = __DIR__ . '/' . str_replace('\\', '/', $className) . '.php';

    if (file_exists($fileName)) {
        require_once $fileName;
    }
});

// Сделаем такую цепочку
//      $bank->$paypal->$bitcoin
//
// Приоритет у банка
//      Если банк не может оплатить, переходим к Paypal
//      Если Paypal не может, переходим к Bitcoin

$bank = new Bank(100);
$paypal = new PayPal(200);
$bitcoin = new Bitcoin(300);

$bank->setNext($paypal);
$paypal->setNext($bitcoin);

//Data\Bank Object (
//    [successor:protected] => Data\PayPal Object (
//        [successor:protected] => Data\Bitcoin Object (
//            [successor:protected] => [balance:protected] => 300
//        ) [balance:protected] => 200
//    ) [balance:protected] => 100 )

// Начнём с банка
$bank->pay(259);

// Выходной вид
// ==============
// Нельзя оплатить с помощью банка. Обрабатываю...
// Нельзя оплатить с помощью Paypal. Обрабатываю...
// Оплачено 259 с помощью Bitcoin!
```

<div align="center">
    <h2> Структура проекта </h2>
    <img src="https://sun9-65.userapi.com/impg/dpAgvrzYaXneMlt_v7MqzbBaV8tkPJu-Oox9mw/M0gfeICmcyE.jpg?size=689x450&quality=96&sign=8c46bb9a5179bcdd561977c7964abf56&type=album" alt="SimpleFactory">
</div>