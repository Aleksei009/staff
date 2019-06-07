<div class="container">
    {{ content() }}


    {{ form('users/auth', 'method': 'post')}}

    <h2>Форма входа</h2>
    <div class="form-grope" style=" display: flex; flex-direction: column; ">
        {% if (form) %}

            {{ form.render("email") }}
            {{ form.render('password') }}

            {{ form.render('csrf', ['value': security.getToken()]) }}

            {{ form.render("go") }}

        {% endif %}
    </div>

    {{ end_form() }}
</div>




