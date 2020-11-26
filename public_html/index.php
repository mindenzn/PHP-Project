<?php
require '../bootloader.php';

$h1 = 'Welcome to my SHOP';

$nav = generate_nav();

$db = new FileDB(DB_FILE);
$db->load();
$items = $db->getRowsWhere('items')

?>
<html>
<head>
    <meta charset="UTF-8">
    <title>Index</title>
    <link rel="stylesheet" href="media/styles.css">
</head>
<body>
<header>
    <?php require ROOT . '/core/templates/navigation.tpl.php'; ?>
</header>
<main>
    <h1 class="title"><?php print $h1 ?></h1>
    <section class="grid-container">
        <?php foreach ($items as $product) : ?>
            <div class="grid-item">
                <h2 class="item-name"><?php print $product['item_name']; ?></h2>
                <img class="item-img" src="<?php print $product['item_photo']; ?>" alt="">
                <h2><?php print $product['item_price']?> eur</h2>
            </div>
        <?php endforeach; ?>
    </section>
</main>
</body>
</html>

