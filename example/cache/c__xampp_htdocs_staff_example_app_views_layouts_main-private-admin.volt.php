<div class="container">
    <?php $this->partial('site/header'); ?></div>
</div>

<div class="main-table-content">
    <div class="content">
        <div class="table">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th scope="col" class="hide-show">
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
                        <tr style="background: #ffdf38;" class="hide-show-block">

                    <?php } else { ?>


                        <tr style="background: #fbffef;" class="hide-show-block">


                    <?php } ?>
                    <th scope="row">

                        <div class="day-now" style="text-align: center;"><?= $item['day'] ?></div>
                        <div class="week-now" style="text-align: center;font-size: 16px;font-weight: normal;border: 1px solid #a7a6a6;"><?= $item['week'] ?></div>
                    </th>



                    <?php foreach ($users as $user) { ?>

                        <td>
                            <div>
                                <?php if (($item['week'] == 'Saturday' || $item['week'] == 'Sunday')) { ?>
                                    <input type="checkbox" disabled>
                                <?php } else { ?>

                                    <input type="checkbox" checked disabled>

                                <?php } ?>

                                <?php if (empty($times)) { ?>
                                <div class="time-start-finaly" style="text-align: center;">
                                    <?php } else { ?>
                                    <?php if (empty($i_am_late)) { ?>
                                    <?php foreach ($times as $time) { ?>
                                    <?php if ($user['id'] == $time['user_id'] && $time['i_am_late'] == 1) { ?>
                                    <div class="time-start-finaly" style="background: pink; text-align: center;">
                                        <?php } else { ?>
                                        <div class="time-start-finaly" style="text-align: center;">
                                            <?php } ?>
                                            <?php } ?>

                                            <?php } else { ?>
                                            <?php if ($i_am_late['user_id'] == $user['id']) { ?>
                                            <div class="time-start-finaly" style="background: pink; text-align: center;">

                                                <?php } else { ?>

                                                <?php foreach ($times as $time) { ?>
                                                <?php if ($user['id'] == $time['user_id'] && $time['i_am_late'] == 1) { ?>
                                                <div class="time-start-finaly" style="background: pink; text-align: center;">
                                                    <?php } else { ?>
                                                    <div class="time-start-finaly" style="text-align: center;">
                                                        <?php } ?>
                                                        <?php } ?>
                                                        <?php } ?>
                                                        <?php } ?>

                                                        <?php } ?>


                                                        <?php if (empty($times)) { ?>
                                                            <div></div>
                                                        <?php } else { ?>

                                                            <?php foreach ($times as $time) { ?>

                                                                <?php if ($user['id'] == $time['user_id']) { ?>
                                                                    <?php if (($item['year'] == $time['current_date'])) { ?>

                                                                        <div><span class="time-start"><?= $time['time_start'] ?> - <?= $time['time_end'] ?></span></div>

                                                                    <?php } else { ?>
                                                                        <div></div>
                                                                    <?php } ?>
                                                                <?php } ?>

                                                            <?php } ?>

                                                        <?php } ?>




                                                        <?php if (empty($userAuthTimes) && $user['id'] === $auth['id'] && $item['year'] == date('Y-m-d')) { ?>
                                                            <div>
                                                                <div>Начать</div>
                                                                <button class="str active"><?= $this->tag->linkTo(['index/setstart', 'Start']) ?></button>
                                                            </div>

                                                        <?php } else { ?>

                                                            <?php if (empty($userAuthTimes) && $user['id'] === $auth['id']) { ?>

                                                            <?php } else { ?>

                                                                <?php foreach ($userAuthTimes as $timeUserAuth) { ?>

                                                                <?php } ?>

                                                                <?php if (($user['id'] === $auth['id'] && $item['year'] == date('Y-m-d'))) { ?>
                                                                    <div class="my-start-stop">
                                                                        <?php if ($timeUserAuth['time_end'] != null) { ?>
                                                                            <button class="str active"><?= $this->tag->linkTo(['index/setstart', 'Start']) ?></button>
                                                                        <?php } else { ?>
                                                                            <button class="end"><?= $this->tag->linkTo(['index/setend', 'End']) ?></button>
                                                                        <?php } ?>
                                                                    </div>
                                                                <?php } else { ?>
                                                                    <div></div>
                                                                <?php } ?>

                                                            <?php } ?>

                                                        <?php } ?>
                                                        
                                                        <?php foreach ($results as $result) { ?>

                                                            <?php if ($result['user_id'] == $user['id'] && $item['year'] == $result['date']) { ?>

                                                                <?php if ($result['result_time'] < 9) { ?>

                                                                    <div class="total" style="color: red; font-weight: bold;">total: <?= $result['result_time'] ?></div>
                                                                <?php } else { ?>
                                                                    <div class="total" style="color: green; font-weight: bold;">total: <?= $result['result_time'] ?></div>

                                                                <?php } ?>

                                                            <?php } ?>

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



