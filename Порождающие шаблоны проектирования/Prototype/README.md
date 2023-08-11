# Прототип
Помните клонированную овечку Долли? Так вот, этот шаблон проектирования как раз посвящён клонированию.
<h3><strong>Вкратце</strong></h3>
Объект создаётся посредством клонирования существующего объекта.
<h3><strong>Википедия</strong></h3>
`Шаблон «Прототип» используется, когда типы создаваемых объектов определяются экземпляром-прототипом, клонированным для создания новых объектов.
То есть шаблон позволяет дублировать существующий объект и модифицировать копию в соответствии с потребностями. Без заморочек с созданием объекта с нуля и его настройкой.`
<h3><strong>Пример</strong></h3>
В **PHP** это легко можно сделать с помощью clone:
```php
class Sheep{
    protected $name;
    protected $category;

    public function __construct($name, $category = 'Mountain Sheep')
    {
        $this->name = $name;
        $this->category = $category;
    }

    public function setName($name){
        $this->name = $name;
    }

    public function getName(){
        return $this->name;
    }

    public function setCategory($category){
        $this->category = $category;
    }

    public function getCategory(){
        return $this->category;
    }
}
```
Затем можно клонировать так:
```php
require_once ('Sheep.php');

$original = new Sheep('Jolly');

echo $original->getName();
echo $original->getCategory();
echo '<br>';

$cloned = clone $original;

$cloned->setName('Dolly');

echo $cloned->getName();
echo $cloned->getCategory();
```
Также для модификации процедуры клонирования можно обратиться к магическому методу `__clone`.
<h3><strong>Когда использовать?</strong></h3>
Когда необходимый объект аналогичен уже существующему или когда создание с нуля дороже клонирования.
<div align="center">
    <h2> Структура проекта </h2>
    <img src="https://sun9-77.userapi.com/impg/tIbJMdsFaXYscrMzQIiQW09Qda_xIzFswoH4wA/Q80r8W_KBSo.jpg?size=456x307&quality=96&sign=3dd9e848763224b42b4f7781d787eec9&type=album" alt="SimpleFactory">
</div>