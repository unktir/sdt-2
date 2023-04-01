// Регулярное выражение для русского языка
let rus_string_regexp = /^[А-ЯЁ][а-яё]*$/u;

// Функция для проверки строки
export function test_string(string_value) {
    if (!(string_value == null)) {
        let OK_input_string = rus_string_regexp.test(string_value);

        return !!OK_input_string;
    }
}