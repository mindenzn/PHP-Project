<?php

require '../../bootloader.php';

$nav = generate_nav();

$form = [
    'attr' => [
        'method' => 'POST',
    ],
    'fields' => [
        'item_name' => [
            'label' => 'Item name',
            'type' => 'text',
            'value' => '',
            'validators' => [
                'validate_field_not_empty',
            ],
            'extra' => [
                'attr' => [
                    'placeholder' => 'Type item name',
                    'class' => 'input-field',
                ],
            ],
        ],
        'item_photo' => [
            'label' => 'Item photo',
            'type' => 'text',
            'value' => '',
            'validators' => [
                'validate_field_not_empty',
            ],
            'extra' => [
                'attr' => [
                    'placeholder' => 'Insert image http://',
                    'class' => 'input-field',
                ],
            ],
        ],
        'item_price' => [
            'label' => 'Item price',
            'type' => 'number',
            'value' => '',
            'validators' => [
                'validate_field_not_empty',
            ],
            'extra' => [
                'attr' => [
                    'placeholder' => 'Type price $ ',
                    'class' => 'input-field',
                ],
            ],
        ],
    ],
    'buttons' => [
        'send' => [
            'title' => 'Upload image',
            'type' => 'submit',
            'extra' => [
                'attr' => [
                    'class' => 'btn',
                ],
            ],
        ],
    ],
    'validators' => [
        'validate_login' => [
            'email',
            'password',
        ]
    ]
];

$clean_inputs = get_clean_input($form);


if ($clean_inputs) {
    $items = new FileDB(DB_FILE);
    $items->load();
    $items->insertRow('items', $clean_inputs);
    $items->save();

} else {
    $text_output = 'Fields are empty ';

}

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../media/styles.css">
    <title>Document</title>
</head>
<body>
<header>
    <?php require ROOT . '/core/templates/navigation.tpl.php'; ?>
</header>
<main>
    <?php require ROOT . '/core/templates/form.tpl.php'; ?>
    <?php if (isset($text_output)) print $text_output; ?>
</main>
</body>
</html>
