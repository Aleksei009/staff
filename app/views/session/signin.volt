
<div class="container">
    <div class="row">
        <div class="com-md-12">
            {{ content() }}
            {{ form('session/auth', 'method': 'post')}}

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
    </div>

</div>






