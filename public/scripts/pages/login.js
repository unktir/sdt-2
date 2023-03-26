import {pop_up_message} from '../templates/pop_up_message.js';

// Вход
$('#sign-in-form').on('submit', function (e) {
    e.preventDefault();

    $.ajax({
        url: '/session',
        method: 'POST',
        dataType: 'html',
        data: $(this).serialize(),
        success: function () {
            pop_up_message('Вы вошли!');
            window.location = '/'
        },
        error: function () {
            pop_up_message('Ошибка отправки! Попробуйте повторить позже')
        }
    });
});