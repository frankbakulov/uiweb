"use strict";
document.addEventListener('DOMContentLoaded', function () {
    var form_login = document.getElementById('form-login');
    form_login.addEventListener("submit", function (e) {
        var submit_button = this.querySelector('input[type="submit"]');
        if (!submit_button.classList.contains('disabled')) {
            var send_data = '';
            var n = 0;
            var prefix;
            Array.prototype.forEach.call(this.elements, function (v, k) {

                //префикс
                prefix = n == 0 ? '' : '&';

                if (v.type == 'text' || v.type == 'password') {
                    send_data += prefix + v.name + "=" + v.value;
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
                inputs = form_login.querySelectorAll('input');
                document.getElementById('error').style.display = 'none';
                Array.prototype.forEach.call(inputs, function (v, k) {
                    if (v.type == 'text' || v.type == 'password') {
                        v.classList.remove('error');

                        var error_cheat = form_login.querySelector('div[data-error="' + v.name + '"]');
                        error_cheat.style.display = 'none';
                        error_cheat.firstElementChild.textContent = '';
                    }
                });
                if (get_data_json.result == 'success') {
                    document.getElementById('success').style.display = 'block';
                    submit_button.classList.add('disabled');
                    Array.prototype.forEach.call(inputs, function (v, k) {
                        if (v.type == 'text' || v.type == 'password') {
                            v.value = '';
                        }
                    });
                }
                if (get_data_json.result == 'error') {
                    document.getElementById('error').style.display = 'block';
                    for (var error in get_data_json.errors) {
                        console.log(error);
                        if(error !== 'auth') {
                            input_error = form_login.querySelector('input[name="' + error + '"]');

                            if (input_error.type == 'text' || input_error.type == 'password') {
                                input_error.classList.add('error');
                                var error_cheat = form_login.querySelector('div[data-error="' + input_error.name + '"]');
                                error_cheat.style.display = 'block';
                                error_cheat.firstElementChild.textContent = get_data_json.errors[input_error.name];
                            }
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
});