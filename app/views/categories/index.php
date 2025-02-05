<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?=$data['title']?></title>
    <meta name="description" content="<?=$data['title']?>">
    <link rel="stylesheet" href="/public/css/main.css" charset="utf-8">
    <script src="https://kit.fontawesome.com/5fadcb377e.js" crossorigin="anonymous"></script>
</head>
<body>
    <?php require 'public/blocks/header.php' ?>

    <div class="container main">
        <h1><?=$data['title']?></h1>
        <div class="products">
            <?php for($i = 0; $i < count($data['products']); $i++): ?>
            <div class="product">
                <div class="image">
                    <img src="/public/img/<?=$data['products'][$i]['img']?>" alt="<?=$data['products'][$i]['title']?>">
                </div>
                <h3><?=$data['products'][$i]['title']?></h3>
                <p><?=$data['products'][$i]['anons']?></p>
                <a href="/product/<?=$data['products'][$i]['id']?>"><button class="btn">Детальнее</button></a>
            </div>
            <?php endfor; ?>
        </div>
        <div class="pagination">
            <?php if (!empty($data['currentPage']) && $data['currentPage'] > 1): ?>
                <a href="/categories/<?= $data['currentPage'] - 1 ?>" class="btn">Назад</a>
            <?php endif; ?>

            <?php if (!empty($data['totalPages'])): ?>
                <?php for ($i = 1; $i <= $data['totalPages']; $i++): ?>
                    <a href="/categories/<?= $i ?>" class="btn <?= !empty($data['currentPage']) && $i == $data['currentPage'] ? 'active' : '' ?>">
                        <?= $i ?>
                    </a>
                <?php endfor; ?>
            <?php endif; ?>

            <?php if (!empty($data['currentPage']) && $data['currentPage'] < $data['totalPages']): ?>
                <a href="/categories/<?= $data['currentPage'] + 1 ?>" class="btn">Вперёд</a>
            <?php endif; ?>
        </div>

    </div>

    <?php require 'public/blocks/footer.php' ?>
</body>
</html>