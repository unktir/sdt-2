// Регулярные выражения для гос. рег. номера
// Регулярные выражения для номера
let reg_num_regexp = /^[АВЕКМНОРСТУХавекмнорстух]{1}[0-9]{3}(?<!0{3})[АВЕКМНОРСТУХавекмнорстух]{2}$/u;
// Регулярные выражения для региона
let reg_reg_regexp = /\d{2,3}$/u;

// Функции для проверки гос. рег. номера
// Функция для проверки номера
export function test_reg_num(input_reg_num) {
    if (!(input_reg_num.value == null)) {
        let OK_reg_num = reg_num_regexp.exec(input_reg_num.value);

        return !!OK_reg_num;
    }
}

// Функция для проверки региона
export function test_reg_reg(input_reg_reg) {
    if (!(input_reg_reg.value == null)) {
        let OK_reg_reg = reg_reg_regexp.exec(input_reg_reg.value);

        return !!OK_reg_reg;
    }
}