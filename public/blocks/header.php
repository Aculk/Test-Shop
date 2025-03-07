<header>
    <div class="container top-menu">
        <div class="nav">
            <a href="/">Главная</a>
            <a href="/contact">Контакты</a>
            <a href="/contact/about">Про компанию</a>
        </div>
        <div class="tel">
            <i class="fa-solid fa-phone"></i> +7 (000) 000 - 00 - 00
        </div>
    </div>
    <div class="container middle">
        <div class="logo">
            <img src="/public/img/logo.svg" alt="Logo">
            <span>Мы знаем что вы хотите!</span>
        </div>
        <div class="auth-checkout">
            <a href="/basket">

                <?php
                    require_once 'app/models/BasketModel.php';
                    $BasketModel = new BasketModel;
                ?>

                <button class="btn basket">Корзина <b>(<?=$BasketModel->countItems()?>)</b></button>
            </a><br>
            <?php if (isset($_COOKIE['login']) && $_COOKIE['login'] != ''): ?>
                <a href="/user/dashboard">
                    <button class="btn dashboard">Кабинет пользователя</button>
                </a>
            <?php else: ?>
                <a href="/user/auth">
                    <button class="btn auth">Войти</button>
                </a>
                <a href="/user/reg">
                    <button class="btn">Регистрация</button>
                </a>
            <?php endif; ?>
        </div>
    </div>
    <div class="container menu">
        <ul>
            <li><a href="/categories">Все товары</a></li>
            <li><a href="/categories/shoes">Обувь</a></li>
            <li><a href="/categories/hats">Кепки</a></li>
            <li><a href="/categories/shirts">Футболки</a></li>
            <li><a href="/categories/watches">Часы</a></li>
        </ul>
    </div>     
</header>
