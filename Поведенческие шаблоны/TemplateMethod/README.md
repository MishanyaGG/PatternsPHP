# Шаблонный метод

Допустим, вы собрались строить дома. Этапы будут такими:

- Подготовка фундамента.
- Возведение стен.
- Настил крыши.
- Настил перекрытий.

Порядок этапов никогда не меняется. Вы не настелите крышу до возведения стен — и т. д. Но каждый этап модифицируется: стены, например, можно возвести из дерева, кирпича или газобетона.
<h3><strong>Вкратце</strong></h3>
«Шаблонный метод» определяет каркас выполнения определённого алгоритма, но реализацию самих этапов делегирует дочерним классам.

<h3><strong>Пример</strong></h3>

Допустим, у нас есть программный инструмент, позволяющий тестировать, проводить контроль качества кода (lint), выполнять сборку, генерировать отчёты сборки (отчёты о покрытии кода, о качестве кода и т. д.), а также развёртывать приложение на тестовом сервере.\
Сначала наш базовый класс определяет каркас алгоритма сборки.
Допустим, у нас есть программный инструмент, позволяющий тестировать, проводить контроль качества кода (lint), выполнять сборку, генерировать отчёты сборки (отчёты о покрытии кода, о качестве кода и т. д.), а также развёртывать приложение на тестовом сервере.\
Сначала наш базовый класс определяет каркас алгоритма сборки.

```php
namespace Data;

abstract class Builder{
    final public function build(){
        $this->test();
        $this->lint();
        $this->assemble();
        $this->deploy();
    }

    abstract public function test();
    abstract public function lint();
    abstract public function assemble();
    abstract public function deploy();
}
```

Теперь создаём реализации:

```php
namespace Data;

class AndroidBuilder extends Builder{
    public function test()
    {
        echo 'Running android tests';
    }

   public function lint()
   {
       echo 'Linting the android code';
   }

   public function assemble()
   {
       echo 'Assembling the android build';
   }

   public function deploy()
   {
       echo 'Deploying android build to server';
   }
}
```

```php
namespace Data;

class IosBuilder extends Builder{
    public function test()
    {
        echo 'Running ios tests';
    }

    public function lint()
    {
        echo 'Linting the ios code';
    }

    public function assemble()
    {
        echo 'Assembling the ios build';
    }

    public function deploy()
    {
        echo 'Deploying ios build to server';
    }
}
```

<h3><strong>Использование</strong></h3>

```php
use Data\AndroidBuilder;
use Data\IosBuilder;

// Автозагрузчик
spl_autoload_register(function ($className) {
    $fileName = __DIR__ . '/' . str_replace('\\', '/', $className) . '.php';

    if (file_exists($fileName)) {
        require_once $fileName;
    }
});

$androidBuilder = new AndroidBuilder();
$androidBuilder->build();

$iosBuilder = new IosBuilder();
$iosBuilder->build();
```

<div align="center">
    <h2> Структура проекта </h2>
    <img src="https://sun9-35.userapi.com/impg/4kTRwcAVCcdUgM_888l-gg4HRkgmFXN2rJeKJA/-1yZxcrr8dE.jpg?size=437x504&quality=96&sign=7417e9716bf14f9c893801555f9dac1c&type=album" alt="SimpleFactory">
</div>