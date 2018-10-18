# API БДИП ФССП России
Текущая версия API - 1.0.0

## Документация:
- [Регистрация пользователя API](https://api-ip.fssprus.ru/register)
- [Описание системы API](https://api-ip.fssprus.ru/about)
- [Справочник API](https://api-ip.fssprus.ru/swagger)

## Пример:
```php
<?php
require_once __DIR__ . '/vendor/autoload.php';

use Fssp\Exception\FsspException;
use Fssp\Fssp;
use Fssp\Subject\Physical;
use GuzzleHttp\Exception\GuzzleException;

// полученный токен после регистрации
$token = '[token]';
$p1 = new Physical(21, 'Имя', 'Фамилия', 'Отчество');
$p2 = new Physical(02, 'Имя2', 'Фамилия2');
$fssp = new Fssp($token);

// создадим запрос
try {
    $response = $fssp->searchGroup([$p1, $p2]);
} catch (FsspException $e) {
    die('error: ' . $e->getMessage());
} catch (GuzzleException $e) {
    die('error: ' . $e->getMessage());
}
print_r($response);

// ждем обработки запроса
sleep(10);

// получим результат
try {
    $response = $fssp->result($fssp->task());
} catch (GuzzleException $e) {
    die('error result: ' . $e->getMessage());
}
print_r($response);
```