import {pop_up_message} from '../templates/pop_up_message.js';
import {arrow_swap} from '../templates/arrow_swap.js';

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

    // При изменение чекбоксов вызывается функция countChecks()
    $('.fine-checkbox input[type="checkbox"]').on('change', function () {
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
        e.preventDefault();
        let payment_block = $('.payment-block');

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