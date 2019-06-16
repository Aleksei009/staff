
<div class="container">
    {{ content() }}

    {% if success %}
        <div><div class='alert alert-danger'><?php $this->flashSession->output() ?></div></div>
    {% endif %}
    {{ link_to('index', 'На главную') }}
    {{ form('users/signUp', 'method': 'post') }}

    <h2>
        Форма регистрации
    </h2>

    {{ form.label('name') }}

    {{ form.render('name') }}
    {{ form.messages('name') }}


    {{ form.label('email') }}

    {{ form.render('email') }}
    {{ form.messages('email') }}


    {{ form.label('password') }}

    {{ form.render('password') }}
    {{ form.messages('password') }}


    {{ form.label('confirmPassword') }}

    {{ form.render('confirmPassword') }}
    {{ form.messages('confirmPassword') }}


    <p>{{ form.render('Sign Up') }}</p>

    {{ form.render('csrf', ['value': security.getToken()]) }}

    <hr>

    {{ endForm() }}
</div>

