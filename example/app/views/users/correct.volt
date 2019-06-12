{#{{ content() }}#}

{#<?php echo Phalcon\Tag::form(array('users/correct/'. $user->id, 'method' => 'post')); ?>

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



{{ end_form() }}#}

<div class="container">
    <div class="row">
        <div class="col-md-6"><h2 style="text-align: center">{{ user.name }}</h2></div>
        <div class="col-md-6">
            {{ link_to('users/table', 'Назад в таблицу') }}
        </div>

    </div>
</div>
<table class="table">
    <thead>
    <tr>
        <th scope="col">#ID</th>
        <th scope="col">time_start</th>
        <th scope="col">time_end</th>
        <th scope="col">current_date</th>
        <th scope="col">Понель</th>
    </tr>
    </thead>
    <tbody>
    {% if times is empty %}

        <div>Данных нет</div>

        {% else %}
        {% for time in times  %}
            <tr>
                <th scope="row">{{ time.id }}</th>
                <td>{{ time.time_start }}</td>
                <td>{{ time.time_end }}</td>
                <td>{{ time.current_date }}</td>
                <td><?php echo $this->tag->linkTo(["users/time/" . $time->id, "Редактировать" ]); ?></td>
            </tr>
        {% endfor %}
    {% endif %}

    </tbody>
</table>
