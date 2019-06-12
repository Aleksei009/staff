
<div class="container">
    <div class="row">
        <div class="com-md-12">
            <?= $this->getContent() ?>
            <?= $this->tag->form(['session/auth', 'method' => 'post']) ?>

            <h2>Форма входа</h2>
            <div class="form-grope" style=" display: flex; flex-direction: column; ">
                <?php if (($form)) { ?>

                    <?= $form->render('email') ?>
                    <?= $form->render('password') ?>

                    <?= $form->render('csrf', ['value' => $this->security->getToken()]) ?>

                    <?= $form->render('go') ?>

                <?php } ?>
            </div>

            <?= $this->tag->endForm() ?>
        </div>
    </div>

</div>






