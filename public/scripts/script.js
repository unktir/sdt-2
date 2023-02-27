/*--------------------------------        Общие скрипты        --------------------------------*/

// Функция для переворачивания стрелок
function arrow_swap(p) {
    if (p.hasClass('down'))
        p.removeClass('down').addClass('up');
    else
        p.removeClass('up').addClass('down');
}

// Регулярное выражение для гос. рег. номера
let reg_num_regexp = /^[АВЕКМНОРСТУХавекмнорстух]{1}[0-9]{3}(?<!0{3})[АВЕКМНОРСТУХавекмнорстух]{2}$/u;
let reg_reg_regexp = /\d{2,3}$/u;

// Функция для проверки гос. рег. номера
function test_gov_reg_num(input_reg_reg, input_reg_num) {
    if (!((input_reg_num.value == null) && (input_reg_reg.value == null))) {
        let OK_reg_num = reg_num_regexp.exec(input_reg_reg.value);
        let OK_reg_reg = reg_reg_regexp.exec(input_reg_num.value);

        if (OK_reg_num)
            $('#registered_number').removeClass('error');
        else
            $('#registered_number').addClass('error');
        if (OK_reg_reg)
            $('#registered_region').removeClass('error');
        else
            $('#registered_region').addClass('error');

        if (OK_reg_num && OK_reg_reg) {
            return true;
        } else {
            return false;
        }
    } else {
        return false;
    }
}

/*--------------------------------       Скрипты штрафов       --------------------------------*/
//
$(document).ready(function () {
    // Вход
    $('.sign-in').on('click', function () {
        let gov_reg_num_flag = test_gov_reg_num(document.getElementById('registered_number'), document.getElementById('registered_region'))
        if (gov_reg_num_flag) {
            $('.functional').show();
            $('.authorisation-block').hide();
            $('.fines-block').show();
        }
    });
    // Выход
    $('#exit').on('click', function () {
        $('.functional').hide();
        $('.authorisation-block').show();
        $('.fines-block').hide();
    });
    // Принятие формы входа
    $('#sign-in-form').on('submit', function (e) {
        e.preventDefault();
        $.ajax({
            url: '/signIn',
            method: 'POST',
            dataType: 'html',
            data: $(this).serialize(),
            success: function () {
                document.getElementById('sign-in-form').reset();
                $('main').append($('<div class="popup-wrap"><div class="popup">Вы вошли!</div></div>'));
                $(document).on('click', function () {
                    $('.popup-wrap').remove();
                });
            }
        });
    });
    // Раскрытие и закрытие гармошки штрафов
    $('.fine-payment-wrap').on('click', function (e) {
        let qsw = $(this);
        let qwsb = $('.fine-payment-block', qsw.parent());
        if (!$(e.target).is('label') && !$(e.target).is('input')) {
            if (!qsw.hasClass('open')) {
                arrow_swap($('.arrow', qsw));
                qsw.addClass('open');
                qwsb.slideToggle(400);
            } else {
                arrow_swap($('.arrow', qsw));
                qwsb.slideToggle(400);
                setTimeout(function () {
                    qsw.removeClass('open');
                }, 400);
            }
        }
    });
});

/*-------------------------------Скрипты панели администратора-------------------------------*/
//
$(document).ready(function () {
    // Раскрытие и закрытие гармошки описания штрафов
    $('.offence-article-description-wrap').on('click', function () {
        let qsw = $(this);
        let qwsb = $('.offence-article-description-block', qsw.parent());
        if (!qsw.hasClass('open')) {
            arrow_swap($('.arrow', qsw));
            qsw.addClass('open');
            qwsb.slideToggle(400);
        } else {
            arrow_swap($('.arrow', qsw));
            qwsb.slideToggle(400);
            setTimeout(function () {
                qsw.removeClass('open');
            }, 400);
        }
    });
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
                success: function (popup_message) {
                    document.getElementById('add-the-fine-form').reset();
                    $('main').append($('<div class="popup-wrap"><div class="popup" id="popup_message"></div></div>'));
                    document.getElementById('popup_message').innerHTML = popup_message;
                    $(document).on('click', function () {
                        $('.popup-wrap').remove();
                    });
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
            success: function () {
                document.getElementById('add-the-fine-form').reset();
                $('main').append($('<div class="popup-wrap"><div class="popup">Штраф добавлен!</div></div>'));
                $(document).on('click', function () {
                    $('.popup-wrap').remove();
                });
            }
        });
    });

    // При изменение ФИО вызывает функцию для получения списка авто
    document.getElementById('pay_first_name').onchange = function () {
        get_car_list_by_full_name()
    };
    document.getElementById('pay_middle_name').onchange = function () {
        get_car_list_by_full_name()
    };
    document.getElementById('pay_last_name').onchange = function () {
        get_car_list_by_full_name()
    };
    // При изменение раздела вызывает функцию для получения списка статей
    document.getElementById('chapter_id').onchange = function () {
        get_article_by_chapter_id()
    };
    // При изменение статьи вызывает функцию для получения описания статьи
    document.getElementById('offense_id').onchange = function () {
        get_description_by_article_id()
    };
});

// Регулярное выражение для ФИО
let full_name_regexp = /^[а-яё]/iu;

// Функция для проверки ФИО
function test_full_name(input_first_name, input_middle_name, input_last_name) {
    if (!((input_first_name.value == null) && (input_middle_name.value == null) && (input_last_name.value == null))) {
        let OK_first_name = full_name_regexp.exec(input_first_name.value);
        let OK_middle_name = full_name_regexp.exec(input_middle_name.value);
        let OK_last_name = full_name_regexp.exec(input_last_name.value);

        if (OK_first_name)
            $('#add_first_name').removeClass('error');
        else
            $('#add_first_name').addClass('error');
        if (OK_middle_name)
            $('#add_middle_name').removeClass('error');
        else
            $('#add_middle_name').addClass('error');
        if (OK_last_name)
            $('#add_last_name').removeClass('error');
        else
            $('#add_last_name').addClass('error');

        if (OK_first_name && OK_middle_name && OK_last_name) {
            return true;
        } else {
            return false;
        }
    } else {
        return false;
    }
}

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
        }
    });
    chapter_select.change(function () {
        $('.offence-article-description-wrap-block').hide();
    });
}


