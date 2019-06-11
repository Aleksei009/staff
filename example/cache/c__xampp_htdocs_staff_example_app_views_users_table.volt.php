

<table class="table">
    <thead>
    <tr>
        <th scope="col">#ID</th>
        <th scope="col">name</th>
        <th scope="col">email</th>
        <th scope="col">Понель для инструментов</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($users as $user) { ?>
        <?php if ($user->deleted == 1) { ?>
            <tr style="background: pink">
                <th scope="row"><?= $user->id ?></th>
                <td><?= $user->name ?></td>
                <td><?= $user->email ?></td>
                <td> данный пользователь удален</td>
            </tr>
            <?php } else { ?>


                <tr>
                    <th scope="row"><?= $user->id ?></th>
                    <td><?= $user->name ?></td>
                    <td><?= $user->email ?></td>
                    <?php if ($user->role == 'admin') { ?>
                        <td></td>
                        <?php } else { ?>
                            <td><?php echo $this->tag->linkTo(["users/delete/" . $user->id, "Delete"]); ?></td>
                    <?php } ?>

                </tr>
        <?php } ?>

    <?php } ?>
    </tbody>
</table>