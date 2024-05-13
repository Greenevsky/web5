<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ассортимент</title>
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/shop.css">
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
            <div class="search-bar-box">
                <div class="filter-type">
                    <label for="selection">Тип фильтра:</label>
                    <select class="filter-type-selection" name="selection">
                        <option value="Название">Название</option>
                        <option value="Ширина">Ширина</option>
                        <option value="Высота">Высота</option>
                        <option value="Длина">Длина</option>
                        <option value="Количество Клавиш">Количество Клавиш</option>
                        <option value="Цена">Цена</option>
                    </select>
                </div>
                <input class="search-bar-input" type="text" placeholder="Поиск">
                <div class="search-bar-button">
                    <p>Найти</p>
                </div>
           </div>
           <div class="items-container">

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
    <script src="js/shop-builder.js"></script>
    <script src="js/registration.js"></script>
    <script src="js/authorization.js"></script>
    <script src="js/script.js"></script>
</body>
</html>