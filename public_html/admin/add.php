<?php

use App\App;
use App\Views\BasePage;
use App\Views\Forms\RegisterForm;
use App\Views\Navigation;

require '../../bootloader.php';

$nav = new Navigation();

$form = new RegisterForm();

if ($form->validate()) {
    $clean_inputs = $form->values();
    $items= App::$db->insertRow('items', $clean_inputs);
}

$page = new BasePage([
        'title' => 'Add',
        'content' => $form->render(),
    ]
);

print $page->render();

?>

