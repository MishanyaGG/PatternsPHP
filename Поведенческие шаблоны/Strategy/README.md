# Стратегия

Возьмём пример с пузырьковой сортировкой. Мы её реализовали, но с ростом объёмов данных сортировка стала выполняться очень медленно. Тогда мы сделали быструю сортировку (Quick sort). Алгоритм работает быстрее на больших объёмах, но на маленьких он очень медленный. Тогда мы реализовали стратегию, при которой для маленьких объёмов данных используется пузырьковая сортировка, а для больших — быстрая.
<h3><strong>Вкратце</strong></h3>
Шаблон «Стратегия» позволяет переключаться между алгоритмами или стратегиями в зависимости от ситуации.

<h3><strong>Пример</strong></h3>

```php
namespace Data;

interface SortStrategy{
    public function sort($dataset);
}
```

```php
namespace Data;

class BubbleSortStrategy implements SortStrategy{
    public function sort($dataset)
    {
        echo 'Sorting using bubble sort';

        return $dataset;
    }
}
```

```php
namespace Data;

class QuickSortStrategy implements SortStrategy{
    public function sort($dataset)
    {
        echo 'Sorting using quick sort';

        return $dataset;
    }
}
```

Теперь реализуем клиента, который будет использовать нашу стратегию.

```php
namespace Data;

class Sorter{
    protected $sorter;

    public function __construct(SortStrategy $sorter)
    {
        $this->sorter = $sorter;
    }

    public function sort ($dataset){
        return $this->sorter->sort($dataset);
    }
}
```

<h3><strong>Использование</strong></h3>

```php
use Data\Sorter;
use Data\BubbleSortStrategy;
use Data\QuickSortStrategy;

// Автозагрузчик
spl_autoload_register(function ($className) {
    $fileName = __DIR__ . '/' . str_replace('\\', '/', $className) . '.php';

    if (file_exists($fileName)) {
        require_once $fileName;
    }
});

$dataset = [1,5,4,3,2,8];

$sorter = new Sorter(new BubbleSortStrategy());
$sorter->sort($dataset);

$sorter = new Sorter(new QuickSortStrategy());
$sorter->sort($dataset);
```

<div align="center">
    <h2> Структура проекта </h2>
    <img src="https://sun9-42.userapi.com/impg/j7S9VdRhb_S56ZhPYa_Npr8n-M2fQH_HOObTEg/TcQF33928UI.jpg?size=669x497&quality=96&sign=c65806bf65178783ee9e5127d18ea17d&type=album" alt="SimpleFactory">
</div>