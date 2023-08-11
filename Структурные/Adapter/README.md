# Адаптер

Допустим, у вас на карте памяти есть какие-то картинки. Их нужно перенести на компьютер. Нужен адаптер, совместимый с входным портом компьютера, в который можно вставить карту памяти. В данном примере адаптер — это картридер. Ещё один пример: переходник, позволяющий использовать американский блок питания с российской розеткой. Третий пример: переводчик — это адаптер, соединяющий двух людей, говорящих на разных языках.
<h3><strong>Вкратце</strong></h3>

Шаблон «Адаптер» позволяет помещать несовместимый объект в обёртку, чтобы он оказался совместимым с другим классом.

<h3><strong>Пример</strong></h3>

Представим себе охотника на львов.\
Создадим интерфейс `Lion`, который реализует все типы львов.

```php
namespace Data;

interface LionInterface{
    public function roar();
}
```

```php
namespace Data;

class AfricanLion implements LionInterface{
    public function roar()
    {

    }
}
```

```php
namespace Data;

class AsianLion implements LionInterface{
    public function roar()
    {

    }
}
```

Охотник должен охотиться на все реализации интерфейса `Lion`.

```php
namespace Data;

class Hunter{
    public function hunt(LionInterface $lion){

    }
}
```
Добавим теперь дикую собаку `WildDog`, на которую охотник тоже может охотиться. Но у нас не получится сделать это напрямую, потому что у собаки другой интерфейс. Чтобы она стала совместима с охотником, нужно создать подходящий адаптер.

```php
namespace Data;

class WildDog{
    public function bark(){

    }
}
```

```php
class WildDogAdapter implements LionInterface{
    protected $dog;

    public function __construct(WildDog $dog)
    {
        $this->dog = $dog;
    }

    public function roar()
    {
        $this->dog->bark();
    }
}
```

Теперь `WildDog` может вступить в игру действие благодаря `WildDogAdapter`

```php
require_once ('Data/LionInterface.php');
require_once ('Data/WildDog.php');
require_once ('Data/WildDogAdapter.php');
require_once ('Data/Hunter.php');

use Data\LionInterface;
use Data\WildDog;
use Data\WildDogAdapter;
use Data\Hunter;

$wildDog = new WildDog();
$wildDogAdapter = new WildDogAdapter($wildDog);

$hunter = new Hunter();
$hunter->hunt($wildDogAdapter);
```

<div align="center">
    <h2> Структура проекта </h2>
    <img src="https://sun9-14.userapi.com/impg/piuY082l2J5JoZ2SKMT--1WM-K3p5zYeKPfauw/Gjr5QxMLz_g.jpg?size=615x430&quality=96&sign=a3d5f89bfeebea44ce51dd65674be026&type=album" alt="SimpleFactory">
</div>