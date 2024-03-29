<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <link rel="stylesheet" href="/public/css/style.css">
    <title>{{meta.title}}</title>
</head>
<body>
<div class="wrap">
    <header class="header">
        <div class="header__body _container">
            <img class="header__logo" src="/public/img/logo.png" alt="">
            <div class="header__icons">
                <form method="post" class="header__icon header__profile icon_reg_auth">
                    <span class="icon-user"></span>
                    <span class="header__subtitle">
                    {{user_fio}}
                </span>
                    <input type="text" readonly value="Выйти" hidden name="exit">
                </form>
                <form method="post" class="header__icon header__exit icon_reg_auth">
                    <span class="icon-exit"></span>
                    <span class="header__subtitle">
                    Выйти
                </span>
                    <input type="text" readonly value="Выйти" hidden name="exit">
                </form>
            </div>
        </div>
    </header>
    <main class="content">
        <div class="content__body _container">
            <div class="navigation-chain">
                <div class="navigation-chain__item"><a href="http://trans/permission">Разрешения / </a></div>
                <div class="navigation-chain__item navigation-chain__item_active">История разрешения</div>
            </div>
            <div class="content__table table-content story-table">
                <div class="table-content__row table-content__row_head story-table__row">
                    <div class="table-content__col table-content__head">№</div>
                    <div class="table-content__col table-content__head">Дата и время</div>
                    <div class="table-content__col table-content__head">Фактические дата и время</div>
                    <div class="table-content__col table-content__head">Статус</div>
                    <div class="table-content__col table-content__head">Автор</div>
                    <div class="table-content__col table-content__head">Комментарий</div>
                </div>

                {% for log in logs %}
                <div class="table-content__row story-table__row">
                    <div class="table-content__col table-col table-permission__col">
                        {{loop.index}}
                    </div>
                    <div class="table-content__col table-col table-permission__col">
                        {{log.date}}
                    </div>
                    <div class="table-content__col table-col table-permission__col">
                        {{log.date_change_status}}
                    </div>
                    <div class="table-content__col table-col table-permission__col">
                        {{log.status_name}}
                    </div>
                    <div class="table-content__col table-col table-permission__col">
                        {{log.lastname}} {{log.name}} {{log.patronymic}}
                    </div>
                    <div class="table-content__col table-col table-permission__col">
                        {{log.comment}}
                    </div>
                </div>
                {% endfor %}
            </div>
        </div>
    </main>
    <footer class="footer">
        <div class="footer__body _container">
            <address class="footer__mail">vitalinosov2000@gmail.com</address>
            <div class="footer__copy">&copy; АО "Транснефть - Север" 2022</div>
            <div class="footer__links">
                <a href="https://vk.com/transneftofficial" target="_blank" class="icon-vk footer__link"></a>
                <a href="https://www.facebook.com/TRANSNEFT" target="_blank" class="icon-facebook footer__link"></a>
                <a href="https://twitter.com/transneftRu" target="_blank" class="icon-twitter footer__link"></a>
                <a href="https://www.instagram.com/transneftru/" target="_blank" class="icon-instagram-second footer__link"></a>
                <a href="https://t.me/transneftofficial" target="_blank" class="icon-telegram footer__link"></a>
                <a href="https://invite.viber.com/?g2=AQAJmjbSlaVw3kiGiek7m4%2BbhLm0X01ggdP5DAoiuQUSUvejqFEpi8Rp5Wy6uqI7&lang=ru" target="_blank" class="icon-viber footer__link"></a>
                <a href="https://www.youtube.com/user/transneftru" target="_blank" class="icon-youtube footer__link"></a>
            </div>
        </div>
    </footer>
</div>
<script src="/public/js/imask.js"></script>
<script src="/public/js/functions.js"></script>
<script src="/public/js/permission.js"></script>
</body>
</html>