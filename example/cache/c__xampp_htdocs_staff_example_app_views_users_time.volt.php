<?= $this->getContent() ?>


 

<?php echo Phalcon\Tag::form(array('users/correct/'. $id, 'method' => 'post')); ?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div>Убрать опоздание</div>
            <?php if (empty($time)) { ?>
                <div style="color: green;">Пришел вовремя</div>
                <?php } else { ?>
                    <?php if ($time['i_am_late'] == 1) { ?>
                       <div style="color: pink;">Опоздавший</div>
                        <span>Да</span> <input type="radio" name="corDay" checked value="on">
                        <span>Нет</span> <input type="radio" name="corDay"  value="off">
                    <?php } ?>
            <?php } ?>

        </div>
    </div>
    <div class="row">
        <div class="col-md-2">
            Дата начала
        </div>
        <div class="col-md-2">
            Дата Конца
        </div>
        <div class="col-md-2">
           Дата
        </div>

    </div>
    <div class="row">
        <div class="col-md-2">
            <?= $form->render('time_start') ?>
        </div>
        <div class="col-md-2">
            <?= $form->render('time_end') ?>
        </div>
        <div class="col-md-2">
            <?= $form->render('current_date') ?>
        </div>
        <div class="col-md-3">
            <?= $form->render('go') ?>
        </div>
        <div>
            <?= $form->render('user_id') ?>
        </div>
    </div>
</div>



<?= $this->tag->endForm() ?>


