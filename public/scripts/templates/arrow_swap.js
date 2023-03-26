// Функция для переворачивания стрелок
export function arrow_swap(p) {
    if (p.hasClass('down'))
        p.removeClass('down').addClass('up');
    else
        p.removeClass('up').addClass('down');
}