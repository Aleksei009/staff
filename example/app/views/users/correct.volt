{{ content() }}

<?php echo Phalcon\Tag::form(array('users/correct/'. $user->id, 'method' => 'post')); ?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div>Убрать опоздание</div>

            <span>Да</span> <input type="radio" name="corDay" value="on">
            <span>Нет</span> <input type="radio" name="corDay" checked value="off">
        </div>
        <div class="col-md-6">Date start</div>
        <div class="col-md-6">Date end</div>
        {% if curTimeForUser is empty %}
            <div>Данных по пользователю нет.</div>
            {% else %}

                {% for time in curTimeForUser %}

                    <input type="hidden" name="current_date" value="{{ time.current_date }}">
                    <div class="col-md-6">
                        <input type="text" name="time_start[]" value="{{ time.time_start }}">
                    </div>
                    <div class="col-md-6">
                        <input type="text" name="time_end[]" value="{{ time.time_end }}">
                    </div>
                {% endfor %}

        {% endif %}

        <input type="hidden" name="userId" value="{{ user.id }}">
        <div class="col-md-12"><button class="btn btn-primary" type="submit">Сохранить</button></div>
    </div>
</div>



{{ end_form() }}

<div>asdasdasdasd</div>
