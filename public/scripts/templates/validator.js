// Регулярное выражение для русского языка
let rus_string_regexp = /^[А-ЯЁ][а-яё]*$/u;

// Функция для проверки строки
export function test_string(string_value) {
    if (!(string_value == null)) {
        let OK_input_string = rus_string_regexp.test(string_value);

        return !!OK_input_string;
    }
}

// Регулярные выражения для номера
let reg_num_regexp = /^[АВЕКМНОРСТУХавекмнорстух][0-9]{3}(?<!0{3})[АВЕКМНОРСТУХавекмнорстух]{2}$/u;

// Функция для проверки номера
export function test_reg_num(reg_num_value) {
    if (!(reg_num_value == null)) {
        let OK_reg_num = reg_num_regexp.exec(reg_num_value);

        return !!OK_reg_num;
    }
}

// Регулярные выражения для региона
let reg_reg_regexp = /\d{2,3}$/u;

// Функция для проверки региона
export function test_reg_reg(reg_reg_value) {
    if (!(reg_reg_value == null)) {
        let OK_reg_reg = reg_reg_regexp.exec(reg_reg_value);

        return !!OK_reg_reg;
    }
}