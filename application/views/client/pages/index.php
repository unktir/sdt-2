<main>
    <div class="container">
        <!-- Авторизация -->
        <section class="authorisation-block content" style="display: none;">
            <h1>Авторизация</h1>
            <form id="sign-in-form" name="sign-in-form">
                <fieldset>
                    <label id="car_number">Государственный регистрационный номер:</label>
                    <input required id="registered_number" name="registered_number" aria-labelledby="car_number"
                           type="text" placeholder="А000АА" maxlength="6">
                    <input required id="registered_region" name="registered_region" aria-labelledby="car_number"
                           type="text" placeholder="777" maxlength="3">
                </fieldset>
                <button class="button sign-in">Войти</button>
            </form>
        </section>
        <!-- Штрафы -->
        <section class="fines-block content">
            <h1>Штрафы</h1>
            <div class="fine-payments-block">
                <h2>Платежи</h2>
                <div class="fine-payment-wrap-block">
                    <div class="fine-payment-wrap">
                        <div class="fine-checkbox">
                            <input id="fine-0" name="0.0 Название штрафа" type="checkbox">
                            <label for="fine-0">0.0 Название штрафа</label>
                        </div>
                        <p><b>Сумма</b></p>
                        <div class="arrow up"></div>
                    </div>
                    <div class="fine-payment-block">
                        <h3>0.0 Название штрафа</h3>
                        <p>Описание штрафа</p>
                        <p>Дата получения штрафа</p>
                    </div>
                </div>
                <div class="payment-block">
                    <fieldset>
                        <legend>
                            <b>Оплата</b>
                        </legend>
                        <div class="form-group-row">
                            <label for="payment">Сумма к оплате:</label>
                            <input required name="payment" id="payment" type="number" min="0">
                        </div>
                    </fieldset>
                    <button class="button submit" type="submit">Оплатить</button>
                </div>
            </div>
        </section>
    </div>
</main>