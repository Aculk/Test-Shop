<!doctype html>
<html lang="ru">

<head>

    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Регистрация</title>
    <meta name="description" content="Регистрация">

    <link rel="stylesheet" href="/public/css/main.css" charset="utf-8">
    <link rel="stylesheet" href="/public/css/form.css" charset="utf-8">

    <script src="https://kit.fontawesome.com/5fadcb377e.js" crossorigin="anonymous"></script>
</head>
<body>
    <?php require 'public/blocks/header.php' ?>

    <div class="container main">
        <h1>Регистрация</h1>
        <p>Здесь вы можете зарегистрироваться</p>
        <form action="/user/reg" method="post" class="form-control">
            <input type="text" name="name" placeholder="Введите имя" value="<?= htmlspecialchars($_POST['name'] ?? '') ?>"> <br>
            <input type="email" name="email" placeholder="Введите email" value="<?= htmlspecialchars($_POST['email'] ?? '') ?>"> <br>
            <input type="password" name="pass" placeholder="Введите пароль" value="<?= htmlspecialchars($_POST['pass'] ?? '') ?>"> <br>
            <input type="password" name="re_pass" placeholder="Повторите пароль" value="<?= htmlspecialchars($_POST['re_pass'] ?? '') ?>">
            <div class="<?= isset($data['message']) && $data['message'] === 'Сообщение успешно отправлено!' ? 'success' : 'error' ?>">
            <?= htmlspecialchars($data['message'] ?? '') ?>
            </div>
            <button class="btn" id="send">Готово</button>
        </form>
    </div>

    <?php require 'public/blocks/footer.php' ?>
</body>
</html>