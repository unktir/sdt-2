import {pop_up_message} from '../templates/pop_up_message.js';
import {arrow_swap} from '../templates/arrow_swap.js';
import {test_full_name} from '../templates/test_full_name.js';
import {test_gov_reg_num} from '../templates/test_gov_reg_num.js';

// Функция создания списка автомобилей водителя с помощью ФИО
function get_car_list_by_full_name() {
    let car_select = $('#car_id');
    let fine_form = document.forms.fine_form;
    let first_name = fine_form.elements.pay_first_name.value;
    let middle_name = fine_form.elements.pay_middle_name.value;
    let last_name = fine_form.elements.pay_last_name.value;

    if (!(first_name == null || first_name === "") && !(middle_name == null || middle_name === "") && !(last_name == null || last_name === "")) {
        $.ajax({
            url: '/admin/getCarList',
            method: 'GET',
            dataType: 'html',
            data: {
                first_name: first_name,
                middle_name: middle_name,
                last_name: last_name
            },
            success: function (option) {
                car_select.html(option);
                car_select.prop('disabled', false);
            },
            error: function () {
                pop_up_message('Ошибка отправки! Попробуйте повторить позже')
            }
        });
    } else {
        car_select.prop('disabled', true);
    }
}

// Функция создания списка статей с помощью Раздела
function get_article_by_chapter_id() {
    let chapter_select = $('#chapter_id');
    let article_select = $('#offense_id');

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
}

// Функция создания описания нарушения с помощью Статьи
function get_description_by_article_id() {
    let chapter_select = $('#chapter_id')
    let article_select = $('#offense_id');

    $('.offence-article-description-wrap-block').show();
    $.ajax({
        url: '/admin/findDescription',
        method: 'GET',
        dataType: 'html',
        data: {
            id: article_select.val(),
        },
        success: function (description) {
            $('.offence-article-description-block').html(description);
        },
        error: function () {
            pop_up_message('Ошибка отправки! Попробуйте повторить позже')
        }
    });

    chapter_select.change(function () {
        $('.offence-article-description-wrap-block').hide();
    });
}

//
$(document).ready(function () {
    // Добавление данных о водителе в базу данных
    $('#add-the-driver-form').on('submit', function (e) {
        e.preventDefault();
        let gov_reg_num_flag = test_gov_reg_num(document.getElementById('registered_number'), document.getElementById('registered_region'));
        let full_name_flag = test_full_name(document.getElementById('add_first_name'), document.getElementById('add_middle_name'), document.getElementById('add_last_name'));
        if (gov_reg_num_flag && full_name_flag) {
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
        }
    });

    // Добавление данных о штрафе в базу данных
    $('#add-the-fine-form').on('submit', function (e) {
        e.preventDefault();
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

    // При изменение ФИО вызывается функция get_car_list_by_full_name()
    document.getElementById('pay_first_name').onchange = function () {
        get_car_list_by_full_name()
    };
    document.getElementById('pay_middle_name').onchange = function () {
        get_car_list_by_full_name()
    };
    document.getElementById('pay_last_name').onchange = function () {
        get_car_list_by_full_name()
    };

    // При изменение раздела вызывается функция get_article_by_chapter_id()
    document.getElementById('chapter_id').onchange = function () {
        get_article_by_chapter_id()
    };

    // При изменение статьи вызывается функция get_description_by_article_id()
    document.getElementById('offense_id').onchange = function () {
        get_description_by_article_id()
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
});
