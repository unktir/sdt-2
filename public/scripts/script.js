/*--------------------------------        Общие скрипты        --------------------------------*/

// Функция для переворачивания стрелок
function arrow_swap(p) {
    if (p.hasClass('down'))
        p.removeClass('down').addClass('up');
    else
        p.removeClass('up').addClass('down');
}

// Функция для всплывающего сообщения
function pop_up_message(message) {
    $('main').append($('<div class="popup-wrap"><div class="popup" id="popup_message"></div></div>'));
    document.getElementById('popup_message').innerHTML = message;
    $(document).on('click', function () {
        $('.popup-wrap').remove();
    });
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

/*--------------------------------     Скрипты авторизации     --------------------------------*/
//
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

/*--------------------------------       Скрипты штрафов       --------------------------------*/

//Счётчик количества выбранных штрафов
function countChecks() {
    const checked = document.querySelectorAll('.fine-checkbox input[type="checkbox"]:checked');
    let panel_info = $('.fines-payment-panel-info');
    let counter = document.getElementById('counter');
    let amount = document.getElementById('amount');
    let final_amount = document.getElementById('final-amount');
    let payment_block = $('.payment-block');

    if (checked.length !== 0) {
        let sum = 0;

        panel_info.show();
        counter.innerHTML = checked.length;
        for (let checkbox of checked) {
            let parent = document.getElementById(checkbox.id).parentElement.parentElement;

            sum += parseInt($('.fine-pay-bill-amount span', parent)[0].textContent);
        }
        amount.innerHTML = sum;
        final_amount.innerHTML = sum;
        payment_block.show();
    } else {
        panel_info.hide();
        counter.innerHTML = 0;
        amount.innerHTML = 0;
        final_amount.innerHTML = 0;
        payment_block.hide();
    }
}

//
$(document).ready(function () {
    //Выход
    $('#exit').on('click', function () {
        $.ajax({
            url: '/session',
            method: 'DELETE',
            dataType: 'html',
            success: function () {
                pop_up_message('Вы вышли!');
                window.location = '/login'
            },
            error: function () {
                pop_up_message('Ошибка отправки! Попробуйте повторить позже')
            }
        });
    });
    //Выбрать все чекбоксы
    $('#select-all').click(function () {
        if (this.checked) {
            $(':checkbox').each(function () {
                this.checked = true;
            });
        } else {
            $(':checkbox').each(function () {
                this.checked = false;
            });
        }
        countChecks();
    });
    // Раскрытие и закрытие гармошки штрафов
    $('.fine-details').on('click', function () {
        let fpw = $(this).parent();
        let fpb = $('.fine-payment-block', fpw.parent());
        if (!fpw.hasClass('open')) {
            arrow_swap($('.arrow', $(this)));
            fpw.addClass('open');
            fpb.slideToggle(400);
        } else {
            arrow_swap($('.arrow', $(this)));
            fpb.slideToggle(400);
            setTimeout(function () {
                fpw.removeClass('open');
            }, 400);
        }
    });
    // Переключение списка штрафов
    $('.fines-menu-item').on('click', function () {
        let show = $(this).get(0).dataset.show;
        let fm = $('.fines-menu').children();

        fm.removeClass('selected');
        $('.fines-list').hide();
        $(this).addClass('selected');
        $('#' + show).show();
    });
    //Оплата штрафа
    $('#fines-payment-form').on('submit', function (e) {
        let payment_block = $('.payment-block');
        e.preventDefault();
        if (payment_block.css('display') === "block") {
            $.ajax({
                url: '/updateOffense',
                method: 'POST',
                dataType: 'html',
                data: $(this).serialize(),
                success: function () {
                    pop_up_message('Оплата прошла успешно!');
                    window.location.reload()
                },
                error: function () {
                    pop_up_message('Ошибка отправки! Попробуйте повторить позже')
                }
            });
        }
    });
});

/*-------------------------------Скрипты панели администратора-------------------------------*/
//
$(document).ready(function () {
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


