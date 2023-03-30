import {pop_up_message} from '../templates/pop_up_message.js';
import {test_reg_num, test_reg_reg} from "../templates/test_gov_reg_num.js";

//
document.getElementById('registered_number').onchange = function (e) {
    let result = test_reg_num(e.target)

    if (result)
        $(this).removeClass('error');
    else
        $(this).addClass('error');
};

//
document.getElementById('registered_region').onchange = function (e) {
    let result = test_reg_reg(e.target);

    if (result)
        $(this).removeClass('error');
    else
        $(this).addClass('error');
};

// Вход
$('#sign-in-form').on('submit', function (e) {
    e.preventDefault();

    if (!$('input', this).hasClass('error')) {
        $.ajax({
            url: '/session',
            method: 'POST',
            dataType: 'html',
            data: $(this).serialize(),
            success: function () {
                pop_up_message('Вы вошли!');
                window.location = '/';
            },
            error: function () {
                pop_up_message('Ошибка отправки! Попробуйте повторить позже')
            }
        });
    } else {
        pop_up_message('Введите корректный гос. рег. номер!')
    }
});