<?php
require '../bootloader.php';

$fileDB = new FileDB(DB_FILE);

$fileDB->createTable('users');
$fileDB->insertRow('users', ['email' => 'test@test.com', 'password' => '123']);

$fileDB->createTable('items');

$fileDB->save();

var_dump('ISVALYTA');
