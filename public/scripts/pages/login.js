import {pop_up_message} from '../templates/pop_up_message.js';
import {test_reg_num, test_reg_reg} from "../templates/validator.js";

// Валидация рег. номера
$('#registered_number').on('change', function (e) {
    let result = test_reg_num(e.target.value);

    if (result)
        $(this).removeClass('error');
    else
        $(this).addClass('error');
});

// Валидация рег. региона
$('#registered_region').on('change', function (e) {
    let result = test_reg_reg(e.target.value);

    if (result)
        $(this).removeClass('error');
    else
        $(this).addClass('error');
});

// Вход
$('#sign-in-form').on('submit', function (e) {
    e.preventDefault();
    let gov_reg_num_flag = $('input', this).hasClass('error');

    if (gov_reg_num_flag) {
        pop_up_message('Введите корректный гос. рег. номер!')
        return;
    }

    $.ajax({
        url: '/session',
        method: 'POST',
        dataType: 'html',
        data: $(this).serialize(),
        success: function (message) {
            pop_up_message(message);
            window.location = '/';
        },
        error: function () {
            pop_up_message('Ошибка отправки! Попробуйте повторить позже')
        }
    });
});