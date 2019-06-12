<?= $this->getContent() ?>

<?php echo Phalcon\Tag::form(array('users/correct/'. $user->id, 'method' => 'post')); ?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div>Убрать опоздание</div>

            <span>Да</span> <input type="radio" name="corDay" value="on">
            <span>Нет</span> <input type="radio" name="corDay" checked value="off">
        </div>
        <div class="col-md-6">Date start</div>
        <div class="col-md-6">Date end</div>
        <?php if (empty($curTimeForUser)) { ?>
            <div>Данных по пользователю нет.</div>
            <?php } else { ?>

                <?php foreach ($curTimeForUser as $time) { ?>

                    <input type="hidden" name="current_date" value="<?= $time->current_date ?>">
                    <div class="col-md-6">
                        <input type="text" name="time_start[]" value="<?= $time->time_start ?>">
                    </div>
                    <div class="col-md-6">
                        <input type="text" name="time_end[]" value="<?= $time->time_end ?>">
                    </div>
                <?php } ?>

        <?php } ?>

        <input type="hidden" name="userId" value="<?= $user->id ?>">
        <div class="col-md-12"><button class="btn btn-primary" type="submit">Сохранить</button></div>
    </div>
</div>



<?= $this->tag->endForm() ?>

<div>asdasdasdasd</div>
