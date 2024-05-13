<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Корзина</title>
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/cart.css">
</head>
<body>
    <div class="header">
        <div class="container">
            <a class="logo" href="index.php"></a>
            <div class="buttons"></div>
        </div>
    </div>

    <div class="content">
        <div class="container">
            <div class="left">

            </div>
            <div class="right">
                <div class="top">
                    <h1 class="title">Офорление заказа</h1>
                    <p class="price" id="full-price-display">Полная стоимость: </p>
                </div>
                <div class="bottom">
                    <p class="submit-button" id="submit-order-button">Оформить заказ</p>
                </div>
            </div>
        </div>
    </div>

    <div class="footer">
        <div class="container">
            <div class="insides">
                <p>ООО "СиЭл Кибс"</p>
                <p>Лоншаков М.О.</p>
                <p>Санкт-Петербург, ул. Бесславская, д. 35, пом. 3</p>
                <p>shop@clkeebs.ru</p>
            </div>
        </div>
    </div>

    <div class="popup-background hidden"></div>

    <div class="popup-box hidden" id="registration-popup">
        <div class="registration-content">
            <h1 class="title">Регистрация</h1>
            <form id="registration">
                <input name="registration[login]" type="text" class="field" placeholder="Логин">
                <input name="registration[password]" type="password" class="field" placeholder="Пароль">
                <input name="registration[address]" type="text" class="field" placeholder="Адрес">
                <input type="submit" value="Зарегистрироваться">
            </form>
            <p class="response-display invisible">Сообщение</p>
        </div>
    </div>

    <div class="popup-box hidden" id="authorization-popup">
        <div class="authorization-content">
            <h1 class="title">Авторизация</h1>
            <form id="authorization">
                <input name="authorization[login]" type="text" class="field" placeholder="Логин">
                <input name="authorization[password]" type="password" class="field" placeholder="Пароль">
                <input type="submit" value="Войти">
            </form>
            <p class="response-display invisible">Сообщение</p>
        </div>
    </div>

    <script src="js/header-builder.js"></script>
    <script src="js/script.js"></script>
    <script src="js/registration.js"></script>
    <script src="js/authorization.js"></script>
    <script src="js/cart.js"></script>
</body>
</html>