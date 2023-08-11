# Мост

Допустим, у вас есть сайт с несколькими страницами. Вы хотите позволить пользователям менять темы оформления страниц. Как бы вы поступили? Создали множественные копии каждой страницы для каждой темы или просто сделали отдельные темы и подгружали их в соответствии с настройками пользователей? Шаблон «Мост» позволяет реализовать второй подход.

![Пример с "Мостом"](https://habrastorage.org/files/693/d31/e70/693d31e709f249bfab95520c182af6d6.jpg)

Шаблон «Мост» — это предпочтение компоновки наследованию. Подробности реализации передаются из одной иерархии другому объекту с отдельной иерархией.

<h3><strong>Пример</strong></h3>

Отделим иерархию тем:

```php
namespace Data;

interface ThemeInterface{
    public function getColor();
}
```

```php
namespace Data;

class DarkTheme implements ThemeInterface{
    public function getColor()
    {
        return 'Dark black';
    }
}
```

```php
namespace Data;

class LightTheme implements ThemeInterface{
    public function getColor()
    {
        return 'Off white';
    }
}
```

```php
namespace Data;

class AquaTheme implements ThemeInterface{
    public function getColor()
    {
        return 'Light blue';
    }
}
```

Реализуем вышеописанный пример с веб-страницами. Сделаем иерархию `WebPage`:

```php
namespace Data;

interface WebPageInterface{
    public function __construct(ThemeInterface $theme);
    public function getContent();
}
```

```php
namespace Data;

class About implements WebPageInterface{
    protected $theme;

    public function __construct(ThemeInterface $theme)
    {
        $this->theme = $theme;
    }

    public function getContent()
    {
        return "Aout page in ". $this->theme->getColor();
    }
}
```

```php
namespace Data;

class Careers implements WebPageInterface{
    protected $theme;

    public function __construct(ThemeInterface $theme)
    {
        $this->theme = $theme;
    }

    public function getContent()
    {
        return "Careers page in ". $this->theme->getColor();
    }
}
```

Обе иерархии:

```php
use Data\DarkTheme;
use Data\About;
use Data\Careers;
use Data\LightTheme;

// Автозагрузчик классов
spl_autoload_register(function ($className) {
    $fileName = __DIR__ . '/' . str_replace('\\', '/', $className) . '.php';

    if (file_exists($fileName)) {
        require_once $fileName;
    }
});

$darkTheme = new DarkTheme();
$whiteTheme = new LightTheme();

$about = new About($darkTheme);
$careers = new Careers($whiteTheme);

echo $about->getContent();
echo $careers->getContent();
```

<div align="center">
    <h2> Структура проекта </h2>
    <img src="https://sun9-21.userapi.com/impg/-06ZTSUGBTOE-FTg5rRlK56eoTcl1XzLg3MlCw/ZTB91LJpUf0.jpg?size=534x617&quality=96&sign=b95aa3dfdd23ab70433f40635f60f59c&type=album" alt="SimpleFactory">
</div>