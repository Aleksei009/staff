<div class="container">
    <nav class="navbar navbar-expand-lg navbar navbar-light bg-light">

        

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">

                <h2>Регистрация и Авторизация</h2>
               
            </ul>

            <ul class="nav pull-right">
                <li class="styleA"  style=" font-size: 16px; border: 1px solid red;"><?= $this->tag->linkTo(['session/signIn', 'Войти']) ?></li>
                <li class="styleA"  style=" font-size: 16px; border: 1px solid red;"><?= $this->tag->linkTo(['users/signUp', 'Зарегистрироваться']) ?></li>

            </ul>
            
        </div>
    </nav>
</div>