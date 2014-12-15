<div class="container">
    <div class="row">
        <table>
            <thead>
            <tr>
                <td>id</td>
                <td>name</td>
            </tr>
            </thead>
            <tbody>
            <?if(count($data['projects']) > 1){?>
                <?foreach($data['projects'] as $project){ ?>
                    <tr>
                        <form id="<?=$project->id?>" data-type="old" method="post" action="/ajax/project-password">
                            <td><input id="id-<?=$project->id?>" value="<?=$project->id?>" disabled></td>
                            <td><input id="name-<?=$project->id?>" value="<?=$project->name?>"></td>
                            <td><button >Изменить</button></td>
                            <td><button>Удалить</button></td>
                        </form>
                    </tr>
                <?}?>
            <?}?>
            </tbody>
            <tfoot>
            <tr>
                <form data-type="new" method="post" action="/ajax/project-password">
                    <td></td>
                    <td><input type="text" id="name-new"></td>
                    <td><input type="submit" value="Добавить"></td>
                    <td></td>
                </form>
            </tr>
            </tfoot>
        </table>
    </div>
</div>
<script>
    "use strict";
    document.addEventListener('DOMContentLoaded', function () {
        var form_new = document.querySelector('form[data-type=new]');
        form_new.addEventListener("submit", function (e) {
            console.log(form_new);
            var send_data = '';
            var n = 0;
            var checkbox_values = [];
            var checkbox_counter = [];
            var prefix;
            console.log(this.elements);
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
                console.log(send_data);
            });

            var request = new XMLHttpRequest();
            request.open(this.method, this.action, true);
            request.onload = function (response) {

                //написать проверку на вернувшиеся значения
                var get_data_json = JSON.parse(response.target.responseText)
                console.log(get_data_json);
                var inputs;
                var input_error;
                //обнуляем ошибки форму
                inputs = form_new.querySelectorAll('input, textarea');
                document.getElementById('error').style.display = 'none';
                Array.prototype.forEach.call(inputs, function (v, k) {
                    if (v.type == 'text') {
                        v.classList.remove('error');

                        var error_cheat = form_new.querySelector('div[data-error="' + v.name + '"]');
                        error_cheat.style.display = 'none';
                        error_cheat.firstElementChild.textContent = '';
                    }
                    if (v.type == 'textarea') {
                        v.classList.remove('error');
                    }
                    if (v.type == 'checkbox') {
                        form_new.querySelector('label[for="' + v.id + '"] span').classList.remove('error');
                    }
                });
                if (get_data_json.result == 'success') {
                    document.getElementById('success').style.display = 'block';
                    submit_button.classList.add('disabled');
                    Array.prototype.forEach.call(inputs, function (v, k) {
                        if (v.type == 'text') {
                            v.value = '';
                        }
                        if (v.type == 'textarea') {
                            v.value = '';
                        }
                        if (v.type == 'checkbox') {
                            form_new.querySelector('label[for="' + v.id + '"] span').classList.remove('active');
                        }
                    });
                }
                if (get_data_json.result == 'error') {
                    document.getElementById('error').style.display = 'block';
                    for (var error in get_data_json.errors) {
                        input_error = form_new.querySelector('input[name="' + error + '"], textarea[name="' + error + '"]');

                        if (input_error.type == 'text') {
                            input_error.classList.add('error');
                            var error_cheat = form_new.querySelector('div[data-error="' + input_error.name + '"]');
                            error_cheat.style.display = 'block';
                            error_cheat.firstElementChild.textContent = get_data_json.errors[input_error.name];
                        }
                        if (input_error.type == 'textarea') {
                            input_error.classList.add('error');
                        }
                        if (input_error.type == 'checkbox') {
                            var checkboses = form_feedback.querySelectorAll('input[name="' + input_error.name + '"]');
                            Array.prototype.forEach.call(checkboses, function (v, k) {
                                document.querySelector('label[for="' + v.id + '"] span').classList.add('error');
                            });
                        }
                    }
                }

            };
            request.onerror = function (get_data) {
                console.log(get_data);
            };
            request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            request.send(send_data);
            e.preventDefault();
        });
    });
</script>