# API БДИП ФССП России

```
Официальный ответ ФССП:

В целях предотвращения кибератак доступ по API остановлен. Вопрос о возможности возобновления доступа к общедоступным сведениям из Банка данных посредством API на сегодняшний день не рассматривается.
```

Текущая версия API - 1.0.0

## Документация:

- [Регистрация пользователя API](https://api-ip.fssprus.ru/register)
- [Описание системы API](https://api-ip.fssprus.ru/about)
- [Справочник API](https://api-ip.fssprus.ru/swagger)

## Условия предоставления доступа к API

Выдержка из [Описание системы API](https://api-ip.fssprus.ru/about).

Максимальное число подзапросов в групповом запросе — 50 (если требуется отправить большее число, следует разбивать
запрос на несколько).

Максимальное число одиночных запросов в час — 100. (Ограничение на одиночные запросы считается, как минус час от
текущего времени)

Максимальное число одиночных запросов в сутки — 1000. (Ограничение на одиночные запросы считается, как минус сутки от
текущего времени)

Максимальное число групповых запросов в сутки — 5000.

Срок хранения результатов запроса (промежуток между обращениями к методам /search/ и методу /result) — 24 часа.

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
$birthday = new \DateTime('2000-01-01');
$region = 02;
$p1 = new Physical( 'Фамилия', 'Имя', 'Отчество', new \DateTime('2002-01-01'), 21);
$p2 = new Physical( 'Фамилия2', 'Имя2', '', new \DateTime('2001-01-01'), $region);
$p3 = new Physical( 'Фамилия3', 'Имя3', '', $birthday, $region);
$fssp = new Fssp($token);

// создадим запрос
try {
    $response = $fssp->searchGroup([$p1, $p2, $p3]);
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
