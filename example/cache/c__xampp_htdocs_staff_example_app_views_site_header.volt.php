
<div class="main-site clearfix" style="padding: 30px 0;">
    <div class="main-header">
        <div class="float-left-need" style="float: left; width: 805px;">
            <div class="header">
                <div class="users-late-your-inform clearfix">
                    <div class="left" style="float: left;">
                        <div class="infom" style="width: 400px;">
                            <h1>My Hours Log</h1>
                            <h2>You are: <?= $auth['role'] ?></h2>
                            <h3>Your name: <?= $auth['name'] ?></h3>

                            <p>Ваши рабочии часы за месяц: <?= $resultTimeR['hour'] ?>ч:<?= $resultTimeR['minutes'] ?>м</p>
                            <p>You have/Assigned: <?= $procent ?>%</p>
                            <p>Assigned: <?= $resultTimeUser ?></p>
                            <p>Ты опоздал: <?= $lateI->count_lates ?> раз:</p>
                            
                            <div class="progress mb-2">
                                <div class="progress-bar" role="progressbar" style="width: <?= $procent ?>%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"><?= $procent ?>%</div>
                            </div>
                        </div>
                    </div>
                    <div class="right">
                        <div class="late-users">
                            <h5>Главные опоздуны</h5>
                            <div class="users" style="display: flex;">
                                <?php foreach ($latesUsers as $lated) { ?>
                                    <div class="user" style="padding: 0 10px;">
                                        <div class="img-user">
                                            <div class="img">
                                                <img style="height:50px;width: 50px;" src="https://i0.wp.com/www.winhelponline.com/blog/wp-content/uploads/2017/12/user.png?fit=256%2C256&quality=100&ssl=1" alt="">
                                            </div>
                                            <div class="name-user"><?= $lated->getUser()->name ?></div>
                                            <div class="how-much-you-late"><?= $lated->count_lates ?></div>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="menu-option" style="display: flex; justify-content: center; margin-bottom: 25px">
                    <form action="" method="GET">
                        <select name="month" onchange="this.form.submit();">
                            <?php foreach ($months as $item) { ?>
                                <?php if (empty($getData['month'])) { ?>
                                    <?php if ($item['date'] == (date('m'))) { ?>
                                        <option value="<?= $item['num'] ?>" selected="selected" ><?= $item['month'] ?></option>
                                        <?php } else { ?>
                                            <option value="<?= $item['num'] ?>"><?= $item['month'] ?></option>
                                    <?php } ?>
                                    <?php } else { ?>

                                        <?php if ($getData['month'] == $item['num']) { ?>

                                            <option value="<?= $item['num'] ?>" selected="selected"><?= $item['month'] ?></option>
                                            <?php } else { ?>
                                                <option value="<?= $item['num'] ?>"><?= $item['month'] ?></option>
                                        <?php } ?>

                                <?php } ?>

                            <?php } ?>
                        </select>&nbsp;&nbsp;&nbsp;&nbsp;
                        <select name="year" onchange="this.form.submit();">
                            <?php foreach ($years as $item) { ?>

                                <?php if (empty($getData['year'])) { ?>
                                    <?php if ($item['year'] == (date('Y'))) { ?>
                                        <option value="<?= $item['year'] ?>" selected="selected" ><?= $item['year'] ?></option>
                                    <?php } else { ?>
                                        <option value="<?= $item['year'] ?>"><?= $item['year'] ?></option>
                                    <?php } ?>
                                <?php } else { ?>

                                    <?php if ($getData['year'] == $item['year']) { ?>
                                        <option value="<?= $item['year'] ?>" selected="selected"><?= $item['year'] ?></option>
                                        <?php } else { ?>
                                            <option value="<?= $item['year'] ?>"><?= $item['year'] ?></option>

                                    <?php } ?>



                                <?php } ?>

                            <?php } ?>

                        </select>&nbsp;&nbsp;&nbsp;&nbsp;
                    </form>
                </div>
            </div>
        </div>
        <div class="float-right-need" style="float: right;width: 300px">

            <div class="form-group">
                <h4>
                    <span style="color: red;">LogOut</span> from your account.
                </h4>
                <div class="button" style="text-align: center; font-weight: bold; border:1px solid #c1b5b5;font-size: 18px;">
                    <?= $this->tag->linkTo(['session/removeAuth', 'Logout']) ?>
                </div>
                <div class="button" style="text-align: center; font-weight: bold; border:1px solid #c1b5b5;font-size: 18px;">
                    <?= $this->tag->linkTo(['users/changePassword', 'Chanch Password']) ?>
                </div>
                <?php if ($auth['role'] == 'admin') { ?>
                    <div class="button" style="text-align: center; font-weight: bold; border:1px solid #c1b5b5;font-size: 18px;">
                        <?= $this->tag->linkTo(['users/table', 'look users']) ?>
                    </div>
                    <div class="button" style="text-align: center; font-weight: bold; border:1px solid #c1b5b5;font-size: 18px;">
                        <?= $this->tag->linkTo(['users/signUp', 'Registration']) ?>
                    </div>
                    <div class="button" style="text-align: center; font-weight: bold; border:1px solid #c1b5b5;font-size: 18px;">
                        <?= $this->tag->linkTo(['users/holiday', 'Holiday']) ?>
                    </div>
                <?php } ?>

            </div>
        </div>
    </div>

</div>