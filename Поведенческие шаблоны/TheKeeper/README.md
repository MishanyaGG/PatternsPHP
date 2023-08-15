# Хранитель

В качестве примера можно привести калькулятор («создатель»), у которого любая последняя выполненная операция сохраняется в памяти («хранитель»), чтобы вы могли снова вызвать её с помощью каких-то кнопок («опекун»).
<h3><strong>Вкратце</strong></h3>
Шаблон «Хранитель» фиксирует и хранит текущее состояние объекта, чтобы оно легко восстанавливалось.\
Обычно шаблон применяется, когда нужно реализовать функциональность отмены операции.

<h3><strong>Пример</strong></h3>

Текстовый редактор время от времени сохраняет своё состояние, чтобы можно было восстановить текст в каком-то прошлом виде.\
Сначала создадим объект «хранитель», в котором можно сохранять состояние редактора.

```php
namespace Data;

class EditorMemento{
    protected $content;

    public function __construct($content)
    {
        $this->content = $content;
    }

    public function getContent(){
        return $this->content;
    }
}
```

Теперь сделаем редактор («создатель»), который будет использовать объект «хранитель».

```php
namespace Data;

class Editor{
    protected $content = '';

    public function type($words){
        $this->content = $this->content . ' ' . $words;
    }

    public function getContent(){
        return $this->content;
    }

    public function save(){
        return new EditorMemento($this->content);
    }

    public function restore(EditorMemento $memento){
        $this->content = $memento->getContent();
    }
}
```

<h3><strong>Использование</strong></h3>

```php
use Data\Editor;

// Автозагрузчик
spl_autoload_register(function ($className) {
    $fileName = __DIR__ . '/' . str_replace('\\', '/', $className) . '.php';

    if (file_exists($fileName)) {
        require_once $fileName;
    }
});

$editor = new Editor();

// Пишем что-нибудь
$editor->type('This is first sentence.');
$editor->type('This is second');

// Сохранение состояния в: This is the first sentence. This is second.
$saved = $editor->save();

$editor->type('And this is third');

//Output: Содержимое до сохранения
echo $editor->getContent() . '<br>'; // This is the first sentence. This is second. And this is third.

$editor->restore($saved);

echo $editor->getContent(); // This is the first sentence. This is second.
```