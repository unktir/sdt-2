<main>
    <div class="container">
        <section class="authorisation-block content">
            <h1>Проверка и оплата штрафов ГИБДД</h1>
            <form id="sign-in-form" name="sign-in-form">
                <fieldset>
                    <label id="car_number">Гос. рег. номер:</label>
                    <div class="car-number-input">
                        <input required id="registered_number" name="registered_number"
                               aria-labelledby="car_number"
                               type="text" placeholder="А000АА" maxlength="6">
                        <input required id="registered_region" name="registered_region"
                               aria-labelledby="car_number"
                               type="text" placeholder="777" maxlength="3">
                    </div>
                </fieldset>
                <button class="button submit">Проверить штрафы</button>
            </form>
        </section>
    </div>
</main>