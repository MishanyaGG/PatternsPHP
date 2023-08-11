# Строитель
Допустим, вы пришли в забегаловку, заказали бургер дня, и вам выдали его без вопросов. Это пример «Простой фабрики». Но иногда логика создания состоит из большего количества шагов. К примеру, при заказе бургера дня есть несколько вариантов хлеба, начинки, соусов, дополнительных ингредиентов. В таких ситуациях помогает шаблон «Строитель».
<h3><strong>Вкратце</strong></h3>
Шаблон позволяет создавать разные свойства объекта, избегая загрязнения конструктора (constructor pollution). Это полезно, когда у объекта может быть несколько свойств. Или когда создание объекта состоит из большого количества этапов.
<h3><strong>Википедия</strong></h3>
`Шаблон "Строиетль" предназначен для поиска решения проблем антипаттерна Telescoping counsructor`

Поясню, что такое антипаттерн Telescoping constructor. Каждый из нас когда-либо сталкивался с подобным конструктором:
```php
public function __construct($size, $cheese = true, $pepperoni = true, $tomato = false, $lettuce = true)
{
}
```
Как видите, количество параметров может быстро разрастись, и станет трудно разобраться в их структуре. Кроме того, этот список параметров будет расти и дальше, если в будущем вы захотите добавить новые опции. Это и есть антипаттерн Telescoping constructor.
<h3><strong>Пример</strong></h3>
Разумная альтернатива — шаблон «Строитель». Сначала создадим бургер:
```php
namespace Data;

class Burger{
    protected $size;

    protected $cheese = false;
    protected $pepperoni = false;
    protected $lettuce = false;
    protected $tomato = false;

    public function __construct(BurgerBuilder $builder)
    {
        $this->size = $builder->size;
        $this->cheese = $builder->cheese;
        $this->pepperoni = $builder->pepperoni;
        $this->lettuce = $builder->lettuce;
        $this->tomato = $builder->tomato;
    }
}
```
А затем добавим «строителя»:
```php
namespace Data;

class BurgerBuilder{
    public $size;

    public $cheese = false;
    public $pepperoni = false;
    public $lettuce = false;
    public $tomato = false;

    public function __construct($size)
    {
        $this->size = $size;
    }

    public function addPepperoni(){
        $this->pepperoni = true;
        return $this;
    }

    public function addCheese(){
        $this->cheese = true;
        return $this;
    }

    public function addLettuce(){
        $this->lettuce = true;
        return $this;
    }

    public function addTomato(){
        $this->tomato = true;
        return $this;
    }

    public function build() : Burger{
        return new Burger($this);
    }
}
```
<h3><strong>Использование</strong></h3>
```php
require_once ('Data/Burger.php');
require_once ('Data/BurgerBuilder.php');

$burger = (new BurgerBuilder(14))
    ->addPepperoni()
    ->addLettuce()
    ->addTomato()
    ->addCheese();
```
<h3><strong>Когда использовать?</strong></h3>
Когда у объекта может быть несколько свойств и когда нужно избежать Telescoping constructor. Ключевое отличие от шаблона «Простая фабрика»: он используется в одноэтапном создании, а «Строитель» — в многоэтапном.
<div align="center">
    <h2> Структура проекта </h2>
    <img src="https://sun9-1.userapi.com/impg/FJ_WBMfnM4FqHl4_wYC7bsnKni-zqvgVO2TFRA/LgOjIIYszrQ.jpg?size=522x403&quality=96&sign=58bc3123aaa7bff7a428b9d322cfac40&type=album" alt="SimpleFactory">
</div>