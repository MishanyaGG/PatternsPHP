# Посредник

Когда вы говорите с кем-то по мобильнику, то между вами и собеседником находится мобильный оператор. То есть сигнал передаётся через него, а не напрямую. В данном примере оператор — посредник.
<h3><strong>Вкратце</strong></h3>
Шаблон «Посредник» подразумевает добавление стороннего объекта («посредника») для управления взаимодействием между двумя объектами («коллегами»). Шаблон помогает уменьшить связанность (coupling) классов, общающихся друг с другом, ведь теперь они не должны знать о реализациях своих собеседников.

<h3><strong>Пример</strong></h3>

Простейший пример: чат («посредник»), в котором пользователи («коллеги») отправляют друг другу сообщения.\
Создадим «посредника»:

```php
namespace Data;

interface ChatRoomMediatorInterface{
    public function showMessage(User $user, $message);
}
```

```php
namespace Data;

class ChatRoom implements ChatRoomMediatorInterface{
    public function showMessage(User $user, $message)
    {
        $time = date('M d, y H:i');
        $sender = $user->getName();

        echo $time . ' ['. $sender . ']: ' . $message;
    }
}
```

Теперь создадим «коллег»:

```php
namespace Data;

class User{
    protected $name;
    protected $chatMediator;

    public function __construct($name, ChatRoomMediatorInterface $chatMediator)
    {
        $this->name = $name;
        $this->chatMediator = $chatMediator;
    }

    public function getName(){
        return $this->name;
    }

    public function send($message){
        $this->chatMediator->showMessage($this,$message);
    }
}
```

<h3><strong>Использование</strong></h3>

```php
use Data\ChatRoom;
use Data\User;

// Автозагрузчик
spl_autoload_register(function ($className) {
    $fileName = __DIR__ . '/' . str_replace('\\', '/', $className) . '.php';

    if (file_exists($fileName)) {
        require_once $fileName;
    }
});

$mediator = new ChatRoom();

$jhon = new User('John Doe', $mediator);
$jane = new User('Jane Doe',$mediator);

$jhon->send('Hi there! <br>');
$jane->send('Hey!');
```