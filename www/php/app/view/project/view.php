<div class="container">
    <div class="row">
        <form id="<?=$data['project']->id?>" method="post" action="/ajax/project-password">
            <table id="nodes">
                <thead>
                    <tr>
                        <td>id</td>
                        <td>name</td>
                        <td>url</td>
                        <td>description</td>
                        <td>login</td>
                        <td>password</td>
                    </tr>
                </thead>
                <tbody>
                    <? foreach($data['project_passwords'] as $password){ ?>
                        <tr id="<?=$password->id?>" data-type="old">
                            <td><input id="id-<?=$password->id?>" value="<?=$password->id?>" disabled></td>
                            <td><input id="name-<?=$password->id?>" value="<?=$password->name?>"></td>
                            <td><input id="url-<?=$password->id?>" value="<?=$password->url?>"></td>
                            <td><input id="description-<?=$password->id?>" value="<?=$password->description?>"></td>
                            <td><input id="login-<?=$password->id?>" value="<?=$password->login?>"></td>
                            <td><input id="password-<?=$password->id?>" value="<?=$password->password?>"></td>
                            <td><input data-type="update" type="submit" value="Изменить"></td>
                            <td><input data-type="delete" type="submit" value="Удалить"></td>
                        </tr>
                    <? } ?>
                </tbody>
                <tfoot>
                    <tr id="<?=$data['project']->id?>" data-type="new">
                        <td></td>
                        <td><input id="name-new" name="name"></td>
                        <td><input id="url-new" name="url"></td>
                        <td><input id="description-new" name="description"></td>
                        <td><input id="login-new" name="login"></td>
                        <td><input id="password-new" name="password"></td>
                        <td><input data-type="insert" type="submit" value="Добавить"></td>
                        <td></td>
                    </tr>
                </tfoot>
            </table>
        </form>
    </div>
</div>
<script>
    "use strict";
    document.addEventListener('DOMContentLoaded', function () {
        var nodes = document.querySelector('#nodes tbody');
        var submit = document.querySelectorAll('input[type="submit"]');

        console.log(submit);
        submit.addEventListener("click", function (e) {
            console.log(submit);


            /*console.log(form);
            var send_data = '';
            var n = 0;
            var checkbox_values = [];
            var checkbox_counter = [];
            var prefix;
            Array.prototype.forEach.call(this.elements, function (v, k) {
                //префикс
                prefix = n == 0 ? '' : '&';

                if (v.type == 'text' || v.type == 'textarea') {
                    send_data += prefix + v.name + "=" + v.value;
                }

                if (v.type == 'checkbox') {
                    if (typeof checkbox_values[v.name] == 'undefined') {
                        checkbox_values[v.name] = [];
                        checkbox_counter[v.name] = 0;
                    }
                    if (v.checked) {
                        //checkbox_values[v.name][checkbox_counter[v.name]] = v.value;
                        send_data += prefix + v.name + "=" + v.value;
                    }
                    //считаем чекбоксы определнного имени
                    checkbox_counter[v.name]++;
                }
                n++;
            });

            var request = new XMLHttpRequest();
            request.open(this.method, this.action, true);
            request.onload = function (response) {

                //написать проверку на вернувшиеся значения
                var get_data_json = JSON.parse(response.target.responseText)
                var inputs;
                var input_error;
                //обнуляем ошибки форму
                inputs = form.querySelectorAll('input, textarea');
                if (get_data_json.result == 'success') {

                }
                if (get_data_json.result == 'error') {

                }

            };
            request.onerror = function (get_data) {
                console.log(get_data);
            };
            request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            //добавляем id текущего проекта
            send_data += "&project_id=" + form.id;
            //request.send(send_data);*/
            e.preventDefault();
        });
    });
</script>