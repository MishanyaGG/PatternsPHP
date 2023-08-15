# Состояние

Допустим, в графическом редакторе вы выбрали инструмент «Кисть». Она меняет своё поведение в зависимости от настройки цвета: т. е. рисует линию выбранного цвета.
<h3><strong>Вкратце</strong></h3>
Шаблон позволяет менять поведение класса при изменении состояния.

<h3><strong>Пример</strong></h3>

Текстовый редактор меняет состояние текста, который вы печатаете, т. е. если выбрано полужирное начертание — то редактор печатает полужирным и т. д.\
Сначала сделаем интерфейс состояний и сами состояния

```php
namespace Data;

interface  WritingStateInterface{
    public function write($words);
}
```

```php
namespace Data;

class UpperCase implements WritingStateInterface{
    public function write($words)
    {
        echo strtoupper($words);
    }
}
```

```php
namespace Data;

class LowerCase implements WritingStateInterface{
    public function write($words)
    {
        echo strtolower($words);
    }
}
```

Сделаем редактор

```php
namespace Data;

class DefaultModel implements WritingStateInterface{
    public function write($words)
    {
        echo $words;
    }
}
```

```php
namespace Data;

class TextEditor{
    protected $state;

    public function __construct(WritingStateInterface $state)
    {
        $this->state = $state;
    }

    public function setState(WritingStateInterface $state){
        $this->state = $state;
    }

    public function type($words){
        $this->state->write($words);
    }
}
```

<h3><strong>Использование</strong></h3>

```php
use Data\TextEditor;
use Data\LowerCase;
use Data\UpperCase;
use Data\DefaultModel;

// Автозагрузчик
spl_autoload_register(function ($className) {
    $fileName = __DIR__ . '/' . str_replace('\\', '/', $className) . '.php';

    if (file_exists($fileName)) {
        require_once $fileName;
    }
});

$editor = new TextEditor(new DefaultModel());

$editor->type('First line'); echo '<br>';

$editor->setState(new UpperCase());

$editor->type('Second line'); echo '<br>';
$editor->type('Thrid line'); echo '<br>';

$editor->setState(new LowerCase());

$editor->type('Fourth line'); echo '<br>';
$editor->type('Fifth line');
```

<div align="center">
    <h2> Структура проекта </h2>
    <img src="https://sun9-37.userapi.com/impg/h6ujCHu9076_B6p45qyB2jUZDrCVzDBo9W_MDg/Yubnlnn2VZE.jpg?size=615x513&quality=96&sign=d4f2ebdfda6dbdb0c0ec9d70924e25fa&type=album" alt="SimpleFactory">
</div>