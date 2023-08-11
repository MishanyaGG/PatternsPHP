# Фабричный метод

Одна кадровичка не в силах провести собеседования со всеми кандидатами на все должности. В зависимости от вакансии она может делегировать разные этапы собеседований разным сотрудникам.
<h3><strong>Вкратце</strong></h3>
Это способ делегирования логики создания объектов (instantiation logic) дочерним классам.
<h3><strong>Пример</strong></h3>
Сначала создадим интерфейс сотрудника, проводящего собеседование, и некоторые реализации для него.
```php
namespace Data;

interface Interviewer{
    public function askQuestions();
}
```

```php
namespace Data;

class Developer implements Interviewer{
    public function askQuestions()
    {
        echo 'Asking about design patterns!';
    }
}
```

```php
namespace Data;

class CommunityExecutive implements Interviewer{
    public function askQuestions()
    {
        echo 'Asking about community building';
    }
}
```
Теперь создадим кадровичку HiringManager
```php
namespace Data;

abstract class HiringManager{

    abstract public function makeInterviewer(): Interviewer;

    public function takeInterview(){
        $interviewer = $this->makeInterviewer();
        $interviewer->askQuestions();
    }
}
```
Любой дочерний класс может расширять его и предоставлять нужного собеседующего
```php
namespace Data; 

class DeveloperManager extends HiringManager {
    public function makeInterviewer(): Interviewer
    {
        return new Developer();
    }
}
```
```php
namespace Data;

class MarketingManager extends HiringManager{
    public function makeInterviewer(): Interviewer
    {
        return new CommunityExecutive();
    }
}
```
<h3><strong>Использование</strong></h3>

```php
require_once ('Data/HiringManager.php');
require_once ('Data/Interviewer.php');
require_once ('Data/DeveloperManager.php');
require_once ('Data/MarketingManager.php');
require_once ('Data/CommunityExecutive.php');
require_once ('Data/Developer.php');

$devManager = new DeveloperManager();
$devManager->takeInterview();

$marketingManager = new MarketingManager();
$marketingManager->takeInterview();
```

<h3><strong>Когда использовать?</strong></h3>
Этот шаблон полезен для каких-то общих обработок в классе, но требуемые подклассы динамически определяются в ходе выполнения (runtime). То есть когда клиент не знает, какой именно подкласс может ему понадобиться.

<div align="center">
    <h2> Структура проекта </h2>
    <img src="https://sun9-46.userapi.com/impg/2AnFMqPSojQsmw1qTobAycjRe4YaFLgNJIsOTQ/gj3lz8OmCV0.jpg?size=592x568&quality=96&sign=7dafeb8fcab43721c484880e03b0a69e&type=album" alt="SimpleFactory">
</div>