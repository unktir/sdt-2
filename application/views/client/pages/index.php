<main>
    <div class="container">
        <section class="fines-block content">
            <h1>Штрафы</h1>
            <div class="payments-container">
                <h2>Платежи</h2>
                <div class="fines-container">
                    <?php if (!empty($unpaid_car_offenses) || !empty($paid_car_offenses)): ?>
                        <!-- Меню -->
                        <div class="fines-menu">
                            <div class="fines-menu-item selected" data-show="unpaid-list">Неоплаченные</div>
                            <div class="fines-menu-item" data-show="paid-list">Оплаченные</div>
                        </div>
                        <!-- Неоплаченные штрафы -->
                        <div class="fines-list" id="unpaid-list" style="display: block;">
                            <?php if (!empty($unpaid_car_offenses)): ?>
                                <div class="fines-payment-panel">
                                    <div class="select-all">
                                        <input id="select-all" type="checkbox">
                                        <label for="select-all">Все</label>
                                    </div>
                                    <div class="fines-payment-panel-info" style="display: none">
                                        <p>Штрафов: <b><span id="counter">0</span></b></p>
                                        <p><b><span id="amount">0</span> ₽</b></p>
                                    </div>
                                </div>
                                <form id="fines-payment-form" name="fines-payment-form">
                                    <ul>
                                        <?php foreach ($unpaid_car_offenses as $offense):
                                            if (!$offense['status']): ?>
                                                <li class="fine-payment-wrap-block">
                                                    <div class="fine-payment-wrap">
                                                        <div class="fine-checkbox">
                                                            <input id="car-offense-<?= $offense['id'] ?>"
                                                                   name="car-offense-id[]"
                                                                   value="<?= $offense['id'] ?>"
                                                                   type="checkbox">
                                                            <label for="car-offense-<?= $offense['id'] ?>">
                                                                Постановления от
                                                                <time datetime="<?= $offense['pay_bill_date'] ?>">
                                                                    <?= date('d.m.Y', strtotime($offense['pay_bill_date'])) ?>
                                                                </time>
                                                                <br>
                                                                <b>10673342223462201<span><?= $offense['id'] ?></span></b>
                                                            </label>
                                                        </div>
                                                        <div class="fine-date-and-time">
                                                            <p>
                                                                <img class="date-and-time-svg"
                                                                     src="images\calendar-regular.svg"
                                                                     alt="calendar">
                                                                <time datetime="<?= $offense['offense_date'] ?>">
                                                                    <?= date('d.m.Y', strtotime($offense['offense_date'])) ?>
                                                                </time>
                                                            </p>
                                                            <p>
                                                                <img class="date-and-time-svg"
                                                                     src="images\clock-regular.svg"
                                                                     alt="clock">
                                                                <time datetime="<?= $offense['offense_time'] ?>">
                                                                    <?= date('H:i', strtotime($offense['offense_time'])) ?>
                                                                </time>
                                                            </p>
                                                        </div>
                                                        <div class="fine-car-info" style="display: none">
                                                            <p><span><?= 'Название авто' ?></span></p>
                                                            <p><span><?= 'Рег. номер' ?></span>
                                                                <span><?= 'Рег. регион' ?></span>
                                                            </p>
                                                        </div>
                                                        <div class="fine-pay-bill-amount">
                                                            <?php if ($now < $offense['last_bill_date']): ?>
                                                                <?php if ($now < $offense['gis_discount_uptodate']): ?>
                                                                    <p>
                                                                        <b><span><?= $offense['pay_bill_amount'] / 2 ?></span>
                                                                            ₽</b>
                                                                    </p>
                                                                    <p class="success">
                                                                        -50% до
                                                                        <time datetime="<?= $offense['gis_discount_uptodate'] ?>">
                                                                            <?= date('d.m', strtotime($offense['gis_discount_uptodate'])) ?>
                                                                        </time>
                                                                    </p>
                                                                <?php else: ?>
                                                                    <p>
                                                                        <b><span><?= $offense['pay_bill_amount'] ?></span>
                                                                            ₽</b>
                                                                    </p>
                                                                <?php endif; else: ?>
                                                                <p>
                                                                    <b><span><?= $offense['pay_bill_amount'] ?></span> ₽</b>
                                                                </p>
                                                                <p class="failure">
                                                                    Просрочен
                                                                </p>
                                                            <?php endif; ?>
                                                        </div>
                                                        <div class="fine-details">
                                                            <span>Детали</span>
                                                            <img class="arrow down" src="images\chevron-down-solid.svg"
                                                                 alt="arrow">
                                                        </div>
                                                    </div>
                                                    <div class="fine-payment-block">
                                                        <p>
                                                            <b>Статья</b><br>
                                                            <span><?= $offense['offense_article_number'] ?></span> -
                                                            <span><?= $offense['offense_article'] ?></span>
                                                        </p>
                                                        <p style="display: none">
                                                            Постановления от
                                                            <time datetime="<?= $offense['pay_bill_date'] ?>">
                                                                <?= date('d.m.Y', strtotime($offense['pay_bill_date'])) ?>
                                                            </time>
                                                            <br>
                                                            10673342223462201<span><?= $offense['id'] ?></span>
                                                        </p>
                                                        <p>
                                                            Подразделение<br>
                                                            УФК по Республике Башкортостан (МВД по РБ)
                                                        </p>
                                                        <p>
                                                            <b>Оплатить до: </b>
                                                            <time datetime="<?= $offense['last_bill_date'] ?>">
                                                                <?= date('d.m.Y', strtotime($offense['last_bill_date'])) ?>
                                                            </time>
                                                        </p>
                                                        <p>
                                                            <b>Водитель: </b>
                                                            <span><?= $full_name['last_name'] . ' ' . $full_name['first_name'] . ' ' . $full_name['middle_name'] ?></span>
                                                        </p>
                                                    </div>
                                                </li>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    </ul>
                                    <div class="payment-block">
                                        <!--                        <p>Сумма штрафов: <span>5500</span> руб.<br>-->
                                        <!--                            Сумма скидки: <span>2500</span> руб.</p>-->
                                        <p><b>Итого к оплате с учётом скидки:</b> <span id="final-amount">0</span> руб.
                                        </p>
                                        <button class="button submit" type="submit">Оплатить</button>
                                    </div>
                                </form>
                            <?php else: ?>
                                <h3>Нет неоплаченных штрафов</h3>
                            <?php endif; ?>
                        </div>
                        <!-- Оплаченные штрафы -->
                        <div class="fines-list" id="paid-list" style="display: none;">
                            <?php if (!empty($paid_car_offenses)): ?>
                                <ul>
                                    <?php foreach ($paid_car_offenses as $offense):
                                        if ($offense['status']): ?>
                                            <li class="fine-payment-wrap-block">
                                                <div class="fine-payment-wrap">
                                                    <div class="fine-info">
                                                        <p>
                                                            Постановления от
                                                            <time datetime="<?= $offense['pay_bill_date'] ?>">
                                                                <?= date('d.m.Y', strtotime($offense['pay_bill_date'])) ?>
                                                            </time>
                                                            <br>
                                                            <b>10673342223462201<span><?= $offense['id'] ?></span></b>
                                                        </p>
                                                    </div>
                                                    <div class="fine-date-and-time">
                                                        <p>Дата:
                                                            <time datetime="<?= $offense['offense_date'] ?>">
                                                                <?= date('d.m.Y', strtotime($offense['offense_date'])) ?>
                                                            </time>
                                                        </p>
                                                        <p>Время:
                                                            <time datetime="<?= $offense['offense_time'] ?>">
                                                                <?= date('H:i', strtotime($offense['offense_time'])) ?>
                                                            </time>
                                                        </p>
                                                    </div>
                                                    <div class="fine-car-info" style="display: none">
                                                        <p><span><?= 'Название авто' ?></span></p>
                                                        <p>
                                                            <span><?= 'Рег. номер' ?></span>
                                                            <span><?= 'Рег. регион' ?></span>
                                                        </p>
                                                    </div>
                                                    <div class="fine-pay-bill-amount">
                                                        <p>
                                                            <b><span><?= $offense['pay_bill_amount'] ?></span> ₽</b>
                                                        </p>
                                                        <p>
                                                            оплачен
                                                            <time datetime="<?= $offense['date_paid'] ?>">
                                                                <?= date('d.m', strtotime($offense['date_paid'])) ?>
                                                            </time>
                                                        </p>
                                                    </div>
                                                    <div class="fine-details">
                                                        <span>Детали</span>
                                                        <img class="arrow down" src="images\chevron-down-solid.svg"
                                                             alt="arrow">
                                                    </div>
                                                </div>
                                                <div class="fine-payment-block">
                                                    <p>
                                                        <b>Статья</b><br>
                                                        <span><?= $offense['offense_article_number'] ?></span> -
                                                        <span><?= $offense['offense_article'] ?></span>
                                                    </p>
                                                    <p style="display: none">
                                                        Постановления от
                                                        <time datetime="<?= $offense['pay_bill_date'] ?>">
                                                            <?= date('d.m.Y', strtotime($offense['pay_bill_date'])) ?>
                                                        </time>
                                                        <br>
                                                        10673342223462201<span><?= $offense['id'] ?></span>
                                                    </p>
                                                    <p>
                                                        Администратор<br>
                                                        ГИБДД
                                                    </p>
                                                    <p>
                                                        <b>Оплачен: </b>
                                                        <time datetime="<?= $offense['date_paid'] ?>">
                                                            <?= date('d.m.Y', strtotime($offense['date_paid'])) ?>
                                                        </time>
                                                    </p>
                                                    <p>
                                                        <b>Водитель: </b>
                                                        <span><?= '' ?></span>
                                                    </p>
                                                </div>
                                            </li>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </ul>
                            <?php else: ?>
                                <h3>Нет оплаченных штрафов</h3>
                            <?php endif; ?>
                        </div>
                    <?php else: ?>
                        <h3>Штрафов нет</h3>
                    <?php endif; ?>
                </div>
            </div>
        </section>
    </div>
</main>