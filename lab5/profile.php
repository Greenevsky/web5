<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Личный Кабинет</title>
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/profile.css">
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
            <h1 class="section-header">Информация о профиле</h1>
            <div class="row">
                <p class="label">Имя:</p>
                <p class="value" id="user-name-display">unknown</p>
                <input type="text" class="input hidden" id="user-name-input">
                <p class="change-button" id="user-name-edit-button">(изменить)</p>
                <p class="change-button hidden" id="user-name-edit-submit-button">(подтвердить)</p>
                <p class="change-button hidden" id="user-name-edit-discard-button">(сброс)</p>
            </div>
            <div class="row">
                <p class="label">Пароль:</p>
                <p class="value" id="password-display">***</p>
                <input type="text" class="input hidden" id="password-input">
                <p class="change-button" id="password-edit-button">(изменить)</p>
                <p class="change-button hidden" id="password-edit-submit-button">(подтвердить)</p>
                <p class="change-button hidden" id="password-edit-discard-button">(сброс)</p>
            </div>
            <div class="row">
                <p class="label">Адрес:</p>
                <p class="value" id="address-display">unknown</p>
                <input type="text" class="input hidden" id="address-input">
                <p class="change-button" id="address-edit-button">(изменить)</p>
                <p class="change-button hidden" id="address-edit-submit-button">(подтвердить)</p>
                <p class="change-button hidden" id="address-edit-discard-button">(сброс)</p>
            </div>
            <h1 class="section-header">История заказов</h1>
            <div class="orders">

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
    <script src="js/profile.js"></script>
    <script src="js/registration.js"></script>
    <script src="js/authorization.js"></script>
    <script src="js/script.js"></script>
</body>
</html>