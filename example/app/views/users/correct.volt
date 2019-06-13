
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
        <tr>
            <td>Данных нет</td>
        </tr>
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
