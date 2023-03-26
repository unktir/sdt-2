// Функция для всплывающего сообщения
export function pop_up_message(message) {
    $('main').append($('<div class="popup-wrap"><div class="popup" id="popup_message"></div></div>'));
    document.getElementById('popup_message').innerHTML = message;

    $(document).on('click', function () {
        $('.popup-wrap').remove();
    });
}