<?= $this->getContent() ?>
<div><h2>Create</h2></div>

<?php if ($success) { ?>
    <div><div class="alert alert-success"><?php $this->flashSession->output() ?></div></div>
    <?php } else { ?>
        <p></p>
<?php } ?>



<?= $this->tag->form(['articles/create', 'method' => 'POST']) ?>


<?= $form->render('title') ?>
<?= $form->messages('title') ?>

<?= $form->render('desc') ?>
<?= $form->messages('desc') ?>

<?= $form->render('text') ?>
<?= $form->messages('text') ?>

<?= $form->render('create') ?>

<?= $this->tag->endform() ?>