{{ content() }}

<div class="container">
    <div class="row">
        <div class="col-md-2 mb-2">
            <div style="text-align: center; font-weight: bold; border:1px solid #c1b5b5;font-size: 18px;">
                {{ link_to('index/index', 'To-STAFF') }}
            </div>
        </div>
    </div>


    {{ form('users/holiday', 'method': 'post') }}


    {{ form.render('name') }}<br>


    {{ form.render('date') }}<br>


    <span>В каждом году</span>{{ form.render('everyYear') }}<br>

    {{ form.render('go') }}


    {{ endForm() }}
</div>


