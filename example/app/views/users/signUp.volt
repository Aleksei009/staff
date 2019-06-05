
<div class="container">
    {{ content() }}

    {#
    {{ form('users/create','method': 'post') }}
    <div class="form-grope" style=" display: flex; flex-direction: column; ">

        {% if (form) %}

            {{ form.render("name") }}
            {{ form.render('email') }}
            {{ form.render('password') }}
            {{ form.render('Sign Up') }}

        {% endif %}

    </div>

    {{ end_form() }}#}

    {{ form('users/create', 'method': 'post') }}

    <h2>
        Sign Up
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
    {{ form.messages('csrf') }}

    <hr>

    {{ endForm() }}
</div>

