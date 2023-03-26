<main>
    <div class="container">
        <!-- Форма добавления водителя и/или автомобиля -->
        <section class="add-the-driver-form-block content">
            <h2>Добавить водителя и/или автомобиль</h2>
            <form id="add-the-driver-form" name="add-the-driver-form">
                <div class="add-the-driver-block">
                    <!-- Поле формы водителя -->
                    <fieldset class="driver-form">
                        <legend>ФИО водителя</legend>
                        <div class="form-group-row">
                            <label for="add_last_name">Фамилия:</label>
                            <input required id="add_last_name" name="add_last_name" type="text"
                                   placeholder="Иванов">
                        </div>
                        <div class="form-group-row">
                            <label for="add_first_name">Имя:</label>
                            <input required id="add_first_name" name="add_first_name" type="text"
                                   placeholder="Иван">
                        </div>
                        <div class="form-group-row">
                            <label for="add_middle_name">Отчество:</label>
                            <input required id="add_middle_name" name="add_middle_name" type="text"
                                   placeholder="Иванович">
                        </div>
                    </fieldset>
                    <!-- Поле формы автомобиля -->
                    <fieldset class="car-number-and-name-form">
                        <legend>Гос. рег. номер и название авто</legend>
                        <div class="form-group-row">
                            <label id="car_number">Гос. рег. номер:</label>
                            <div class="car-number-input">
                                <input required id="registered_number" name="registered_number"
                                       aria-labelledby="car_number"
                                       type="text" placeholder="А000АА" maxlength="6">
                                <input required id="registered_region" name="registered_region"
                                       aria-labelledby="car_number"
                                       type="text" placeholder="777" maxlength="3">
                            </div>
                        </div>
                        <div class="form-group-row">
                            <label for="auto_name">Название авто:</label>
                            <input required id="auto_name" name="auto_name" type="text"
                                   placeholder="Volkswagen Polo">
                        </div>
                    </fieldset>
                </div>
                <button class="button submit" id="add-the-driver-button" type="submit">Добавить</button>
            </form>
        </section>
        <!-- Форма составления нарушения -->
        <section class="add-the-fine-form-block content">
            <h2>Составление нарушения</h2>
            <form id="add-the-fine-form" name="fine_form">
                <div class="add-the-fine-block">
                    <!-- Поле формы водителя -->
                    <fieldset class="fine-driver-form">
                        <legend>ФИО водителя</legend>
                        <div class="form-group-row">
                            <label for="pay_last_name">Фамилия:</label>
                            <input required id="pay_last_name" name="pay_last_name" type="text" placeholder="Иванов">
                        </div>
                        <div class="form-group-row">
                            <label for="pay_first_name">Имя:</label>
                            <input required id="pay_first_name" name="pay_first_name" type="text" placeholder="Иван">
                        </div>
                        <div class="form-group-row">
                            <label for="pay_middle_name">Отчество:</label>
                            <input required id="pay_middle_name" name="pay_middle_name" type="text"
                                   placeholder="Иванович">
                        </div>
                    </fieldset>
                    <!-- Поле формы автомобиля -->
                    <fieldset class="fine-car-form">
                        <legend>Гос. рег. номер и название автомобиля</legend>
                        <div class="form-group-row">
                            <label for="car_id">Автомобиль:</label>
                            <select required disabled name="car_id" id="car_id">
                                <option hidden="" value="">Выберите автомобиль</option>
                            </select>
                        </div>
                    </fieldset>
                    <!-- Поле формы раздела и статьи штрафа -->
                    <fieldset class="offense-title-and-article-form">
                        <legend>Раздел и статья</legend>
                        <div class="form-group-row">
                            <label for="chapter_id">Раздел:</label>
                            <select required name="chapter_id" id="chapter_id">
                                <option hidden="" value="">Выберите раздел</option>
                                <?php foreach ($offenses_chapters as $key => $section): ?>
                                    <option value="<?= $section['id'] ?>">
                                        <?= $section['title'] ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group-row">
                            <label for="offense_id">Статья:</label>
                            <select required disabled name="offense_id" id="offense_id">
                                <option hidden="" value="">Выберите статью</option>
                            </select>
                        </div>
                    </fieldset>
                    <div class="offence-article-description-wrap-block">
                        <div class="offence-article-description-wrap">
                            <h3>Описание штрафа</h3>
                            <div class="fine-details">
                                <span>Детали</span>
                                <img class="arrow down" src="images\chevron-down-solid.svg"
                                     alt="arrow">
                            </div>
                        </div>
                        <div class="offence-article-description-block"></div>
                    </div>
                    <!-- Поле формы даты и суммы штрафа -->
                    <fieldset class="date-and-punishment-form">
                        <legend>Дата и сумма нарушения</legend>
                        <div class="form-group-row">
                            <label for="offense_date_and_time">Дата нарушения:</label>
                            <input required id="offense_date_and_time" name="offense_date_and_time"
                                   type="datetime-local"
                                   aria-labelledby="offense_date_and_time">
                        </div>
                        <div class="form-group-row">
                            <label for="pay_bill_amount">Штраф:</label>
                            <input required id="pay_bill_amount" name="pay_bill_amount" type="number" min="0"
                                   placeholder="Сумма"><span>руб.</span>
                        </div>
                    </fieldset>
                </div>
                <button class="button submit" id="add-the-fine-button" type="submit">Отправить</button>
            </form>
        </section>
    </div>
</main>