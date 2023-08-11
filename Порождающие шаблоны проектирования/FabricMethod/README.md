# Фабричный метод

Одна кадровичка не в силах провести собеседования со всеми кандидатами на все должности. В зависимости от вакансии она может делегировать разные этапы собеседований разным сотрудникам.
<h3><strong>Вкратце</strong></h3>
Это способ делегирования логики создания объектов (instantiation logic) дочерним классам.
<h3><strong>Пример</strong></h3>
Сначала создадим интерфейс сотрудника, проводящего собеседование, и некоторые реализации для него.
```php
namespace Data\Interviewer;

interface Interviewer{
    public function askQuestions();
}
```
```php
namespace Data\Developer;

class Developer implements Interviewer{
    public function askQuestions()
    {
        echo 'Asking about design patterns!';
    }
}
```
```php
namespace Data\CommunityExecutive;

class CommunityExecutive implements Interviewer{
    public function askQuestions()
    {
        echo 'Asking about community building';
    }
}
```
Теперь создадим кадровичку HiringManager
```php
namespace Data\HiringManager;

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
namespace Data\DeveloperManager; 

class DeveloperManager extends HiringManager {
    public function makeInterviewer(): Interviewer
    {
        return new Developer();
    }
}
```
```php
namespace Data\MarketingManager;

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