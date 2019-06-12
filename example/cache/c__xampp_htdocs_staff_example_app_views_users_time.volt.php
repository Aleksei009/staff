<?= $this->getContent() ?>


 <?= $this->tag->form(['users/correct', 'method' => 'post']) ?>


<div class="container">
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

<div class="hello"> Hello</div>


