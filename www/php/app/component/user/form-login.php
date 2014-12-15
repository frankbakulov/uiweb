<form id="<?=$data['id']?>" method="post" action="<?=$data['action']?>">
    <h1 class="text-center">Войти на сайт</h1>
    <h2 class="text-center">Введите логин и пароль для авторизации</h2>
    <div class="alert alert-success" id="success">
        <small>Вы успешно авторизовались</small>
    </div>
    <div class="alert alert-error" id="error">
        <small>Неверная комбинация логина и пароля</small>
    </div>
    <input id="username" type="text" name="username" placeholder="Логин">
    <div class="alert alert-error" data-error="username">
        <small></small>
    </div>
    <input id="password" type="password" name="password" placeholder="Пароль">
    <div class="alert alert-error" data-error="password">
        <small></small>
    </div>
    <!--<input type="checkbox" value="remember">-->
    <div class="row text-center">
        <input class="btn btn-order" type="submit" value="Войти">
    </div>
</form>
<script src="/php/assets/component/form-login/form-login.js"></script>