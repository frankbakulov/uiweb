<div id="form-feedback-block" class="page">
    <form id="<?=$data['id']?>" action="<?=$data['action']?>" method="post">
        <h1 class="text-center">Готовы сделать заказ?</h1>
        <h2 class="text-center">Заполните форму и мы свяжемся с Вами</h2>
        <div class="alert alert-success" id="success">
            <small>Мы получили ваш заказ и в ближайшее время мы свяжемся с вами</small>
        </div>
        <div class="alert alert-error" id="error">
            <small>Некоторые поля формы заполенены неправильно.</small>
        </div>
        <input type="text" name="name" placeholder="Как вас зовут">
        <div class="alert alert-error" data-error="name">
            <small></small>
        </div>
        <input type="text" name="email" placeholder="Адрес электронной почты">
        <div class="alert alert-error" data-error="email">
            <small></small>
        </div>
        <input type="text" name="phone" placeholder="Телефон">
        <div class="alert alert-error" data-error="phone">
            <small></small>
        </div>
        <h2>Что вас интересует?</h2>
        <label for="website">
            <span class="one-line">Веб-сайт</span>
        </label>
        <input type="checkbox" id="website" name="topic[]" value="website">
        <label for="apps">
            <span class="two-line">Мобильные приложения</span>
        </label>
        <input type="checkbox" id="apps" name="topic[]" value="apps">
        <label for="seo">
            <span class="one-line">SEO</span>
        </label>
        <input type="checkbox" id="seo" name="topic[]" value="seo">
        <textarea name="text" rows="7" placeholder="Напишите о своём проекте"></textarea>
        <div class="row text-center">
            <input class="btn btn-order" type="submit" value="Сделать заказ">
        </div>
    </form>
</div>
<link rel="stylesheet" href="/php/assets/common/css/form-feedback.css">
<script src="/php/assets/component/form-feedback/form-feedback.js"></script>