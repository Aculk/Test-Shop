<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Корзина товаров</title>
    <meta name="description" content="Корзина товаров">
    <link rel="stylesheet" href="/public/css/main.css" charset="utf-8">
    <link rel="stylesheet" href="/public/css/products.css" charset="utf-8">
    <script src="https://kit.fontawesome.com/5fadcb377e.js" crossorigin="anonymous"></script>
</head>
<body>
    <?php require 'public/blocks/header.php' ?>

    <div class="container main">
        <h1>Корзина товаров</h1>
        <?php if (!isset($data['products']) || count($data['products']) == 0): ?>
    <p><?= isset($data['empty']) ? $data['empty'] : 'Корзина пуста'; ?></p>
<?php else: ?>
    <form action="/basket/clearCart" method="post">
        <button type="submit" class="btn clear-cart">
            Удалить все товары <i class="fa fa-trash"></i>
        </button>
    </form>
    <div class="products">
        <?php
        $sum = 0;
        foreach ($data['products'] as $product):
            $sum += $product['price'];
        ?>
            <div class="row">
                <img src="/public/img/<?= htmlspecialchars($product['img']) ?>" alt="<?= htmlspecialchars($product['title']) ?>">
                <h4><?= htmlspecialchars($product['title']) ?></h4>
                <span><?= $product['price'] ?> рублей</span>
                <form action="/basket/removeItem" method="post">
                    <input type="hidden" name="item_id" value="<?= $product['id'] ?>">
                    <button type="submit" class="btn remove-item">
                        Удалить из корзины <i class="fa fa-trash"></i>
                    </button>
                </form>
            </div>
        <?php endforeach; ?>
        <form action="/basket/confirm" method="post">
            <input type="hidden" name="amount" value="<?= $sum ?>">
            <button type="submit" class="btn">
                Приобрести (<b><?= $sum ?> рублей</b>)
            </button>
        </form>
    </div>
<?php endif; ?>


        
    </div>
        

    <?php require 'public/blocks/footer.php' ?>
</body>
</html>