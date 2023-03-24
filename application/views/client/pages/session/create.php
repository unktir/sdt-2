<main>
    <div class="container">
        <section class="authorisation-block content">
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
    </div>
</main>