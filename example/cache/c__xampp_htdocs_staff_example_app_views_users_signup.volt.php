
<div class="container">
    <?= $this->getContent() ?>

    <?= $this->tag->form(['users/create', 'method' => 'post']) ?>

    <h2>
        Форма регистрации
    </h2>

    <?= $form->label('name') ?>

    <?= $form->render('name') ?>
    <?= $form->messages('name') ?>


    <?= $form->label('email') ?>

    <?= $form->render('email') ?>
    <?= $form->messages('email') ?>


    <?= $form->label('password') ?>

    <?= $form->render('password') ?>
    <?= $form->messages('password') ?>


    <?= $form->label('confirmPassword') ?>

    <?= $form->render('confirmPassword') ?>
    <?= $form->messages('confirmPassword') ?>


    <p><?= $form->render('Sign Up') ?></p>

    <?= $form->render('csrf', ['value' => $this->security->getToken()]) ?>
    <?= $form->messages('csrf') ?>

    <hr>

    <?= $this->tag->endform() ?>
</div>

