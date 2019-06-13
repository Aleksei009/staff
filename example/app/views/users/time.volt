{{ content() }}


 {#{{ form('users/correct', 'method': 'post') }}#}

<?php echo Phalcon\Tag::form(array('users/correct/'. $id, 'method' => 'post')); ?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div>Убрать опоздание</div>
            {% if time is empty %}
                <div style="color: green;">Пришел вовремя</div>
                <span>Нет</span> <input type="hidden" name="corDay"  value="none">
                {% else %}
                    {% if time['i_am_late'] == 1 %}
                       <div style="color: pink;">Опоздавший</div>
                        <span>Да</span> <input type="radio" name="corDay" checked value="on">
                        <span>Нет</span> <input type="radio" name="corDay"  value="off">
                    {% endif %}
            {% endif %}

        </div>
    </div>
    <div class="row">
        <div class="col-md-2">
            Дата начала
        </div>
        <div class="col-md-2">
            Дата Конца
        </div>
        <div class="col-md-2">
           Дата
        </div>

    </div>
    <div class="row">
        <div class="col-md-2">
            {{ form.render('time_start') }}
        </div>
        <div class="col-md-2">
            {{ form.render('time_end') }}
        </div>
        <div class="col-md-2">
            {{ form.render('current_date') }}
        </div>
        <div class="col-md-3">
            {{ form.render("go") }}
        </div>
        <div>
            {{ form.render('user_id') }}
        </div>
        <div>
            {{ form.render('id') }}
        </div>
    </div>
</div>

{{ end_form() }}


