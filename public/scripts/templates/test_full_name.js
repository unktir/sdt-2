// Регулярное выражение для ФИО
let full_name_regexp = /^[а-яё]/iu;

// Функция для проверки ФИО
export function test_full_name(input_first_name, input_middle_name, input_last_name) {
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