<?php

use App\Pagination\Builder;
use Doctrine\DBAL\Configuration;
use Doctrine\DBAL\DriverManager;


require_once 'vendor/autoload.php';

$config = new Configuration();

$connectionParams = array(
    'dbname' => 'codecourse_php',
    'user' => 'root',
    'password' => '',
    'host' => 'localhost',
    'driver' => 'pdo_mysql',
);

$conn = DriverManager::getConnection($connectionParams, $config);

$queryBuilder = $conn->createQueryBuilder();
$queryBuilder->select('*')->from('users');

$builder = new Builder($queryBuilder);


$users = $builder->paginate($_GET['page'],10);


foreach($users->get() as $user){
    echo $user['id'] . ' - ' . $user['first_name'] . '<br>';
}
echo $users->render([
    'order' => $_GET['order'],
    'abc' => $_GET['abc'],
]);













interface Subject
{
    public function attach(Observer $observer);
    public function detach(Observer $observer);
    public function notify();
}

interface Observer
{
    public function handle(User $user);
}

trait Subjectable
{
    protected $observer = [];

    public function attach(Observer $observer)
    {
        $this->observer[] = $observer;
    }

    public function detach(Observer $observer)
    {
        for($i = 0;$i < count($this->observer);$i++)
        {
            if($this->observer[$i] == $observer){
                unset($this->observer[$i]);
            }
        }
    }

    public function notify()
    {
        for($i = 0;$i < count($this->observer);$i++)
        {
            $this->observer[$i]->handle($this->user);
        }
    }
}

class User
{
    public $id = 1;
    public $name = 'madz';

}

class MailingListSignup implements Subject
{
    use Subjectable;
    
    protected $user;
    
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    
}


class UpdateMailingStatusInDatabase implements Observer
{
    public function handle(User $user)
    {
        echo 'Update mailing status in database - ' . $user->name . '<br>';
    }
}


class SubscribeUserToService implements Observer
{
    public function handle(User $user)
    {
        echo 'Subscribe user to service - ' . $user->name . '<br>';
    }
}

$mailing = new MailingListSignup(new User);

$mailing->attach(new UpdateMailingStatusInDatabase);
$mailing->attach(new SubscribeUserToService);


$mailing->notify();

var_dump($mailing);













