<?= $this->getContent() ?>



 <?= $this->tag->form(['users/holiday', 'method' => 'post']) ?>


    <?= $form->render('name') ?><br>


    <?= $form->render('date') ?><br>


    <span>В каждом году</span><?= $form->render('everyYear') ?><br>

    <?= $form->render('go') ?>


<?= $this->tag->endform() ?>

