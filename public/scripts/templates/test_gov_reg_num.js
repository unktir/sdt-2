// Регулярное выражение для гос. рег. номера
let reg_num_regexp = /^[АВЕКМНОРСТУХавекмнорстух]{1}[0-9]{3}(?<!0{3})[АВЕКМНОРСТУХавекмнорстух]{2}$/u;
let reg_reg_regexp = /\d{2,3}$/u;

// Функция для проверки гос. рег. номера
export function test_gov_reg_num(input_reg_reg, input_reg_num) {
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