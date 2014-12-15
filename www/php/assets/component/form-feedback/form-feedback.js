document.addEventListener('DOMContentLoaded', function () {
    "use strict";

    var form_feedback = document.getElementById('form-feedback');
    form_feedback.addEventListener("submit", function (e) {
        var submit_button = this.querySelector('input[type="submit"]');
        if (!submit_button.classList.contains('disabled')) {
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
                inputs = form_feedback.querySelectorAll('input, textarea');
                document.getElementById('error').style.display = 'none';
                Array.prototype.forEach.call(inputs, function (v, k) {
                    if (v.type == 'text') {
                        v.classList.remove('error');

                        var error_cheat = form_feedback.querySelector('div[data-error="' + v.name + '"]');
                        error_cheat.style.display = 'none';
                        error_cheat.firstElementChild.textContent = '';
                    }
                    if (v.type == 'textarea') {
                        v.classList.remove('error');
                    }
                    if (v.type == 'checkbox') {
                        form_feedback.querySelector('label[for="' + v.id + '"] span').classList.remove('error');
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
                            form_feedback.querySelector('label[for="' + v.id + '"] span').classList.remove('active');
                        }
                    });
                }
                if (get_data_json.result == 'error') {
                    document.getElementById('error').style.display = 'block';
                    for (var error in get_data_json.errors) {
                        input_error = form_feedback.querySelector('input[name="' + error + '"], textarea[name="' + error + '"]');

                        if (input_error.type == 'text') {
                            input_error.classList.add('error');
                            var error_cheat = form_feedback.querySelector('div[data-error="' + input_error.name + '"]');
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
        }
        e.preventDefault();
    });

    //установка чекбоксов
    Array.prototype.forEach.call(form_feedback['topic[]'], function (v, k) {
        //after ie10
        v.addEventListener("click", function (e) {
            var id = this.id;
            var checkbox = this.parentNode.querySelectorAll('label[for="' + id + '"] span');
            var input = document.getElementById(id);

            input.checked = !checkbox[0].classList.contains('active');
            checkbox[0].classList.toggle('active');
        });
    });
});