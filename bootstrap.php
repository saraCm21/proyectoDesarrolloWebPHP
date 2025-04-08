<?php
use Illuminate\Container\Container;
use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Events\Dispatcher;
use Illuminate\Translation\ArrayLoader;
use Illuminate\Translation\Translator;
use Illuminate\Validation\Factory as ValidatorFactory;
use Illuminate\Validation\DatabasePresenceVerifier;

require_once __DIR__ . '/vendor/autoload.php';

$capsule = new Capsule();
$capsule->addConnection([
    'driver'    => 'mysql',
    'host'      => '127.0.0.1',
    'database'  => 'aplicativo_web_bd',
    'username'  => 'root',
    'password'  => '',
    'charset'   => 'utf8',
    'collation' => 'utf8_unicode_ci',
    'prefix'    => '',
]);

$capsule->setEventDispatcher(new Dispatcher(new Container()));
$capsule->setAsGlobal();
$capsule->bootEloquent();

$translator = new Translator(new ArrayLoader(), 'en');
$validatorFactory = new ValidatorFactory($translator);

$presenceVerifier = new DatabasePresenceVerifier($capsule->getDatabaseManager());
$validatorFactory->setPresenceVerifier($presenceVerifier);

Container::getInstance()->instance(ValidatorFactory::class, $validatorFactory);