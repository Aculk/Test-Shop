<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Кабинет пользователя</title>
    <meta name="description" content="Кабинет пользователя">
    <link rel="stylesheet" href="/public/css/main.css" charset="utf-8">
    <link rel="stylesheet" href="/public/css/user.css" charset="utf-8">
    <script src="https://kit.fontawesome.com/5fadcb377e.js" crossorigin="anonymous"></script>
</head>
<body>
    <?php require 'public/blocks/header.php' ?>

    <div class="container main">
        <h1>Кабинет пользователя</h1>
        <div class="user-info">
            <p>Привет, <?= isset($data['name']) ? htmlspecialchars($data['name']) : 'Гость'; ?></p>

            <!-- Форма для загрузки фото -->
            <form action="/user/uploadPhoto" method="post" enctype="multipart/form-data" class="upload-photo-form">
                <label for="profile_image">Загрузите фото:</label>
                <input type="file" name="profile_image" id="profile_image" accept="image/*">
                <button type="submit" class="btn">Загрузить</button>
            </form>

            <!-- Отображение загруженной фотографии -->
            <?php if (!empty($data['profile_image'])): ?>
                <div class="profile-photo">
                    <img src="/public/uploads/profile_images/<?= htmlspecialchars($data['profile_image']); ?>" alt="Ваше фото">
                </div>
            <?php endif; ?>

            <!-- Форма для выхода -->
            <form action="/user/dashboard" method="post">
                <input type="hidden" name="exit_btn">
                <button type="submit" class="btn">Выйти</button>
            </form>
        </div>
    </div>

    <?php require 'public/blocks/footer.php' ?>
</body>
</html>
