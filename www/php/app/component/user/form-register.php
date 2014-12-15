<form id="<?=$data['id']?>" method="post" action="<?=$data['action']?>">
    <h1 class="text-center">Регистрация</h1>
    <h2 class="text-center">Заполните форму</h2>
    <input id="username" type="text" name="username" placeholder="Имя пользователя">
    <div class="alert alert-error" data-error="username">
        <small></small>
    </div>
    <input id="email" type="text" name="email" placeholder="Адрес электронной почты">
    <div class="alert alert-error" data-error="email">
        <small></small>
    </div>
    <div class="col-lg-6 col-md-6">
        <input id="password" type="password" name="password" placeholder="Пароль">
        <div class="alert alert-error" data-error="password">
            <small></small>
        </div>
    </div>
    <div class="col-lg-6 col-md-6">
        <input id="password_repeat" type="password" name="password_repeat" placeholder="Подтверждение пароля">
        <div class="alert alert-error" data-error="password_repeat">
            <small></small>
        </div>
    </div>
    <div class="row text-center">
        <input class="btn btn-order" type="submit" value="Зарегистрироваться">
    </div>
</form>