
<div class="container">
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


                                <p>You have: 32:05</p>
                                <p>You have/Assigned: 18.23%</p>
                                <p>Assigned: 176</p>
                                <p>Ты опоздал: 0 раз
                                    Если общее кол-во опозданий превысит 80 в мае. В мае будут применятся штрафные санкции.
                                </p>
                                <div class="w3-container w3-red w3-center" title="Осталось -30" style="width:100%;border: 1px solid red;margin-bottom: 12px;border-radius: 30px;text-align: center;">110</div>
                            </div>
                        </div>
                        <div class="right">
                            <div class="late-users">
                                <h5>Главные опоздуны</h5>
                                <div class="users" style="display: flex;">
                                    <div class="user" style="padding: 0 10px;">
                                        <div class="img-user">
                                            <div class="img">
                                                <img style="height:50px;width: 50px;" src="https://i0.wp.com/www.winhelponline.com/blog/wp-content/uploads/2017/12/user.png?fit=256%2C256&quality=100&ssl=1" alt="">
                                            </div>
                                            <div class="name-user">Aidar</div>
                                            <div class="how-much-you-late">12</div>
                                        </div>
                                    </div>
                                    <div class="user" style="padding: 0 10px;">
                                        <div class="img-user">
                                            <div class="img">
                                                <img style="height:50px;width: 50px;" src="https://i0.wp.com/www.winhelponline.com/blog/wp-content/uploads/2017/12/user.png?fit=256%2C256&quality=100&ssl=1" alt="">
                                            </div>
                                            <div class="name-user">Aidar</div>
                                            <div class="how-much-you-late">12</div>
                                        </div>
                                    </div>
                                    <div class="user" style="padding: 0 10px;">
                                        <div class="img-user">
                                            <div class="img">
                                                <img style="height:50px;width: 50px;" src="https://i0.wp.com/www.winhelponline.com/blog/wp-content/uploads/2017/12/user.png?fit=256%2C256&quality=100&ssl=1" alt="">
                                            </div>

                                            <div class="name-user">Aidar</div>
                                            <div class="how-much-you-late">12</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="menu-option" style="display: flex; justify-content: center; margin-bottom: 25px">
                        <form action="" method="GET">
                            <select name="month" onchange="this.form.submit();">
                                <option value="1">January</option>
                                <option value="2">February</option>
                                <option value="3">March</option>
                                <option value="4">April</option>
                                <option value="5" selected="selected">May</option>
                                <option value="6">June</option>
                                <option value="7">July</option>
                                <option value="8">August</option>
                                <option value="9">September</option>
                                <option value="10">October</option>
                                <option value="11">November</option>
                                <option value="12">December</option>
                            </select>&nbsp;&nbsp;&nbsp;&nbsp;
                            <select name="year" onchange="this.form.submit();">
                                <option value="2009">2009</option>
                                <option value="2010">2010</option>
                                <option value="2011">2011</option>
                                <option value="2012">2012</option>
                                <option value="2013">2013</option>
                                <option value="2014">2014</option>
                                <option value="2015">2015</option>
                                <option value="2016">2016</option>
                                <option value="2017">2017</option>
                                <option value="2018">2018</option>
                                <option value="2019" selected="selected">2019</option>
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
                        <?= $this->tag->linkTo(['users/removeAuth', 'Logout']) ?>
                    </div>

                    <?= $this->tag->form(['session/signup', 'method' => 'post']) ?>

                    <h2>
                        Sign Up new User
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


                    <p style="text-align: right; margin-top: 10px;"><?= $form->render('Sign Up') ?></p>

                    <?= $form->render('csrf', ['value' => $this->security->getToken()]) ?>
                    <?= $form->messages('csrf') ?>

                    <hr>

                    <?= $this->tag->endform() ?>

                </div>
            </div>
        </div>

    </div>
</div>

    <div class="main-table-content">
        <div class="content">
            <div class="table">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th scope="col">
                            <a href="#">Hide/Show</a>
                        </th>

                        <?php foreach ($users as $user) { ?>

                            <th scope="col"><?= $user['name'] ?></th>

                        <?php } ?>

                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($currentWeks as $item) { ?>
                        <?php if (($item['week'] == 'Saturday' || $item['week'] == 'Sunday')) { ?>
                            <tr style="background: #ffdf38;">
                        <?php } else { ?>

                            <tr style="background: #fbffef;">

                        <?php } ?>
                        <th scope="row">

                            <div class="day-now" style="text-align: center;"><?= $item['day'] ?></div>
                            <div class="week-now" style="text-align: center;font-size: 16px;font-weight: normal;border: 1px solid #a7a6a6;"><?= $item['week'] ?></div>
                        </th>



                        <?php foreach ($users as $user) { ?>

                            <td>
                                <div>
                                    <?php if (($item['week'] == 'Saturday' || $item['week'] == 'Sunday')) { ?>
                                        <label for="">Fullday</label>
                                        <input type="checkbox" >
                                    <?php } else { ?>

                                        <label for="">Fullday</label>
                                        <input type="checkbox" checked >

                                    <?php } ?>


                                    <?php foreach ($times as $time) { ?>

                                    <?php if ($user['id'] == $time->user_id) { ?>
                                    <?php if (($item['year'] == $time->current_date)) { ?>
                                    <div class="time-start-finaly">

                                        <div><span class="time-start"><?= $time->time_start ?> - <?= $time->time_end ?></span></div>

                                        <?php } else { ?>
                                            <div></div>
                                        <?php } ?>
                                        <?php } ?>

                                        <?php } ?>


                                        <?php if (($user['id'] === $auth['id'] && $item['year'] == $time->current_date)) { ?>
                                           <div class="my-start-stop">
                                               <?php if ($time->time_end != null) { ?>
                                                   <button class="str active"><?= $this->tag->linkTo(['index/setstart', 'Start']) ?></button>
                                                   <?php } else { ?>
                                                       <button class="end"><?= $this->tag->linkTo(['index/setend', 'End']) ?></button>
                                               <?php } ?>

                                           </div>
                                            <?php if (($time->time_end != null)) { ?>
                                                <div class="total">total: <?= $totalResultTime ?></div>
                                            <?php } ?>

                                        <?php } else { ?>
                                            <div></div>
                                        <?php } ?>

                                    </div>
                                </div>
                            </td>
                        <?php } ?>

                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

