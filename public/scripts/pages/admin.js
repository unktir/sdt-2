import {pop_up_message} from '../templates/pop_up_message.js';
import {arrow_swap} from '../templates/arrow_swap.js';
import {test_string, test_reg_num, test_reg_reg} from '../templates/validator.js';

// Секция формы добавления водителя и/или автомобиля
$(document).ready(function () {
    // Валидация ФИО
    $('.driver-form input', '#add-the-driver-form').on('change', function (e) {
        let result = test_string(e.target.value);

        if (result)
            $(this).removeClass('error');
        else
            $(this).addClass('error');
    });

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

    // Добавление данных формы в базу данных
    $('#add-the-driver-form').on('submit', function (e) {
        e.preventDefault();
        let full_name_flag = $('.driver-form input', this).hasClass('error');
        let gov_reg_num_flag = $('.car-number-and-name-form input', this).hasClass('error');

        if (gov_reg_num_flag || full_name_flag) {
            return;
        }

        $.ajax({
            url: '/admin/storeDriver',
            method: 'POST',
            dataType: 'html',
            data: $(this).serialize(),
            success: function (message) {
                document.getElementById('add-the-fine-form').reset();
                pop_up_message(message);
            },
            error: function () {
                pop_up_message('Ошибка отправки! Попробуйте повторить позже')
            }
        });
    });
});

// Секция формы добавления штрафа
$(document).ready(function () {
    // Получение списка автомобилей по ФИО
    $('.fine-driver-form input', '#add-the-fine-form').on('change', function (e) {
        let result = test_string(e.target.value);
        let car_select = $('#car_id');

        if (!result) {
            $(this).addClass('error');
            car_select.prop('disabled', true);
        } else {
            $(this).removeClass('error');
        }

        let full_name = $('.fine-driver-form input', '#add-the-fine-form').map(function () {
            return $(this).val();
        });
        let full_name_empty_flag = full_name.is(function () {
            return (this === '');
        });

        if (full_name_empty_flag) {
            return;
        }

        let full_name_error_flag = $('.fine-driver-form input', '#add-the-fine-form').hasClass('error');

        if (full_name_error_flag) {
            return;
        }

        $.ajax({
            url: '/admin/getCarList',
            method: 'GET',
            dataType: 'html',
            data: {
                last_name: full_name[0],
                first_name: full_name[1],
                middle_name: full_name[2]
            },
            success: function (option) {
                car_select.html(option);
                car_select.prop('disabled', false);
            },
            error: function () {
                pop_up_message('Ошибка отправки! Попробуйте повторить позже')
            }
        });
    });

    // Получение статьи по разделу
    document.getElementById('chapter_id').onchange = function () {
        let chapter_select = $(this);
        let article_select = $('#offense_id');
        let oadwb = $('.offence-article-description-wrap-block');

        oadwb.hide();

        $.ajax({
            url: '/admin/getOffensesArticle',
            method: 'GET',
            dataType: 'html',
            data: {
                chapter_id: chapter_select.val()
            },
            success: function (option) {
                article_select.html(option);
                article_select.prop('disabled', false);
            },
            error: function () {
                pop_up_message('Ошибка отправки! Попробуйте повторить позже')
            }
        });
    };

    // Получение описания по статьи
    document.getElementById('offense_id').onchange = function () {
        let article_select = $(this);
        let oadwb = $('.offence-article-description-wrap-block');
        let oadb = $('.offence-article-description-block');

        oadwb.show();

        $.ajax({
            url: '/admin/findDescription',
            method: 'GET',
            dataType: 'html',
            data: {
                id: article_select.val(),
            },
            success: function (description) {
                oadb.html(description);
            },
            error: function () {
                pop_up_message('Ошибка отправки! Попробуйте повторить позже')
            }
        });
    };

    // Раскрытие и закрытие гармошки описания штрафов
    $('.fine-details').on('click', function () {
        let oadw = $(this).parent();
        let oadb = $('.offence-article-description-block', oadw.parent());

        if (!oadw.hasClass('open')) {
            arrow_swap($('.arrow', $(this)));
            oadw.addClass('open');
            oadb.slideToggle(400);
        } else {
            arrow_swap($('.arrow', $(this)));
            oadb.slideToggle(400);
            setTimeout(function () {
                oadw.removeClass('open');
            }, 400);
        }
    });

    // Добавление данных формы в базу данных
    $('#add-the-fine-form').on('submit', function (e) {
        e.preventDefault();
        let full_name_error_flag = $('.fine-driver-form input', this).hasClass('error');

        if (full_name_error_flag) {
            return;
        }

        $.ajax({
            url: '/admin/storeOffense',
            method: 'POST',
            dataType: 'html',
            data: $(this).serialize(),
            success: function (message) {
                // document.getElementById('add-the-fine-form').reset();
                pop_up_message(message);
            },
            error: function () {
                pop_up_message('Ошибка отправки! Попробуйте повторить позже')
            }
        });
    });
});
