<?php

use Api\Actions\Json\{ Relation, BasePark2, BasePark1, BasePark3, BasePark4, BasePark5, BaseFake };
use Api\Actions\Html\Form;

ini_set('display_errors', true);
error_reporting(E_ALL);
const ERROR_LOGGING = false;

const PATH_LOG = PATH_APP.'../log/';
const PATH_TPL = PATH_APP.'tpl/';

const DB = [
  'base_park_1' => [
    'base' => 'base_park_1',
    'user' => 'base_park_1',
    'pass' => '55555555',
    'host' => '127.0.0.1',
    'port' => '5432',
  ],
  'base_park_2' => [
    'base' => 'base_park_2',
    'user' => 'base_park_2',
    'pass' => '55555555',
    'host' => '127.0.0.1',
    'port' => '5432',
  ],
  'base_park_3' => [
    'base' => 'base_park_3',
    'user' => 'base_park_3',
    'pass' => '55555555',
    'host' => '127.0.0.1',
    'port' => '5432',
  ],
  'base_park_4' => [
    'base' => 'base_park_4',
    'user' => 'base_park_4',
    'pass' => '55555555',
    'host' => '127.0.0.1',
    'port' => '5432',
  ],
  'base_park_5' => [
    'base' => 'base_park_5',
    'user' => 'base_park_5',
    'pass' => '55555555',
    'host' => '127.0.0.1',
    'port' => '5432',
	]
];

const REG = [
	'num' => '/(^[а-яa-z]\d{3}[а-яa-z]{2}\d{2,3}$)|(^[а-яa-z]{2}\d{5,6}$)|(^\d{4}[а-яa-z]{2}\d{2}$)/ui', // госномер
	'vin' => '/^[0-9a-zа-я]{17}$/iu', // VIN
	'bn' => '/^[0-9a-zа-я_-]{5,17}$/iu', // номер кузова
	'ch' => '/^[0-9a-zа-я_-]{5,17}$/iu', // шасси
	'client' => '/^[0-9a-z]{40}$/iu',
];

// Первый сегмент URL-адреса
const FIRST_SEGMENT = 'api';

// Мапинг URL-адреса на обработчик запроса
//
// Ключ - второй сегмент URL-адреса
//   segments - сколько сегментов после второго сегмента нужно обработчику (они будут доступны в поле $this->segments)
//   class - класс обработчика
//
// Примеры:
//   http://localhost:8080/api/park1/num/a333aa33?client=admin4hgfvuv26idis4n8q7p6jl7yvz7uvurabjo
//   http://localhost:8080/api/fake/num/a333aa33?client=admin4hgfvuv26idis4n8q7p6jl7yvz7uvurabjo
//   http://localhost:8080/api/form?client=admin4hgfvuv26idis4n8q7p6jl7yvz7uvurabjo
const ACTIONS = [
	'rel' => ['segments' => 2, 'class' => Relation::class],

  'park1' => ['segments' => 2, 'class' => BasePark1::class],
	'park2' => ['segments' => 2, 'class' => BasePark2::class],
	'park3' => ['segments' => 2, 'class' => BasePark3::class],
	'park4' => ['segments' => 2, 'class' => BasePark4::class],
	'park5' => ['segments' => 0, 'class' => BasePark5::class],

	'fake' => ['segments' => 2, 'class' => BaseFake::class],

	'form' => ['segments' => 0, 'class' => Form::class],
];

const FORMAT_JSON = 'json';
const FORMAT_HTML = 'html';
const FORMATS = [
	FORMAT_JSON,
	FORMAT_HTML,
];

const CLIENT_KEY_ADMIN = 'admin4hgfvuv26idis4n8q7p6jl7yvz7uvurabjo';
const CLIENT_KEY_QUEST = 'quest26j99B9teylxzx0i0qybff0l6rsk6mvcjj0';
const CLIENT_KEY_SERVICE_1 = 'dzwyua6frpxzr14lfyuhs8oljf5vx38c7jiadv4b';
const CLIENT_KEY_SERVICE_2 = '3ktqht0yk9hzcelong0peftxd6srf3dlr6w45793';
const CLIENT_KEY_SERVICE_3 = 'yw89x8pnehfyha5c8plze0sndgwd1zah3le0vglq';

const CLIENTS = [
	CLIENT_KEY_ADMIN => ['slug' => 'admin'],
	CLIENT_KEY_QUEST => ['slug' => 'quest'],
  CLIENT_KEY_SERVICE_1 => ['slug' => 'service1'],
  CLIENT_KEY_SERVICE_2 => ['slug' => 'service2'],
  CLIENT_KEY_SERVICE_3 => ['slug' => 'service3'],
];

const ALLOWED_IP = [
	'108.27.110.33', // офис, оттуда идут запросы (admin, guest)
	'74.106.24.54', // сервер с которого идут запросы (service1)
	'74.106.45.31', // сервер с которого идут запросы (service2, service3)
	'82.22.114.34', // дом (admin)
	'127.0.0.1',
];
