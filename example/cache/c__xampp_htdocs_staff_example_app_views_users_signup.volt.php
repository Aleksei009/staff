

<?= $this->getContent() ?>



<?= $this->tag->form(['users/create', 'method' => 'post']) ?>

<h2>
    Sign Up
</h2>

<p><?= $form->label('name') ?></p>
<p>
    <?= $form->render('name') ?>
    <?= $form->messages('name') ?>
</p>

<p><?= $form->label('email') ?></p>
<p>
    <?= $form->render('email') ?>
    <?= $form->messages('email') ?>
</p>

<p><?= $form->label('password') ?></p>
<p>
    <?= $form->render('password') ?>
    <?= $form->messages('password') ?>
</p>

<p><?= $form->label('confirmPassword') ?></p>
<p>
    <?= $form->render('confirmPassword') ?>
    <?= $form->messages('confirmPassword') ?>
</p>

<p>
    <?= $form->render('terms') ?> <?= $form->label('terms') ?>
    <?= $form->messages('terms') ?>
</p>

<p><?= $form->render('Sign Up') ?></p>

<?= $form->render('csrf', ['value' => $this->security->getToken()]) ?>
    <?= $form->messages('csrf') ?>

<hr>

<?= $this->tag->endform() ?>
