<?php

require '../bootloader.php';

$nav = generate_nav();

$form = [
    'attr' => [
        'method' => 'POST',
    ],
    'fields' => [
        'email' => [
            'label' => 'Email',
            'type' => 'text',
            'validators' => [
                'validate_field_not_empty',
                'validate_email',
                'validate_user_unique',
            ],
            'extra' => [
                'attr' => [
                    'placeholder' => 'Type email',
                    'class' => 'input-field',
                ]
            ]
        ],
        'password' => [
            'label' => 'Password',
            'type' => 'text',
            'validators' => [
                'validate_field_not_empty',
            ],
            'extra' => [
                'attr' => [
                    'placeholder' => 'Type password',
                    'class' => 'input-field',
                ]
            ]
        ],
        'password_repeat' => [
            'label' => 'Password repeat',
            'type' => 'text',
            'validators' => [
                'validate_field_not_empty',
            ],
            'extra' => [
                'attr' => [
                    'placeholder' => 'Reapeat password',
                    'class' => 'input-field',
                ]
            ]
        ],
    ],
    'buttons' => [
        'send' => [
            'title' => 'Registruokis',
            'type' => 'submit',
            'extra' => [
                'attr' => [
                    'class' => 'btn',
                ]
            ]
        ]
    ],
    'validators' => [
        'validate_fields_match' => [
            'password',
            'password_repeat'
        ]
    ]
];

$clean_inputs = get_clean_input($form);

if ($clean_inputs) {
    $is_valid = validate_form($form, $clean_inputs);

    if ($is_valid) {
        unset($clean_inputs['password_repeat']);

        $input_from_json = new FileDB(DB_FILE);
        $input_from_json->load();
        $input_from_json->createTable('users');
        $input_from_json->insertRow('users',$clean_inputs);
        $input_from_json->save();


        $text_output = 'Sveikinu užsiregistravus';
        redirect('index.php');
    } else {
        $text_output = 'Registracija nesekminga';
    }
}

?>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register</title>
    <link rel="stylesheet" href="media/styles.css ">
</head>
<body>
<header>
    <?php require ROOT . '/core/templates/navigation.tpl.php'; ?>
</header>
<main>
    <h2>Registruokis</h2>
    <?php require ROOT . '/core/templates/form.tpl.php'; ?>
    <?php if (isset($text_output)) print $text_output; ?>
</main>
</body>
</html>

