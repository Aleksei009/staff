<div class="container">
    <?php $this->partial('site/header'); ?></div>
</div>

<div class="main-table-content">
    <div class="content">
        <div class="table">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th scope="col" class="hide-show">
                        <a href="#">Hide/Show</a>
                    </th>

                    {% for user in users %}

                        <th scope="col">{{ user['name'] }}</th>

                    {% endfor %}

                </tr>
                </thead>
                <tbody>

                {% for item  in currentWeks %}
                    {% if (item['week'] == 'Saturday' or item['week'] == 'Sunday')  %}

                        {% if item['day'] == (date('d')) %}
                            <tr style="background: #ffdf38;" class="hide-show-block active-important">

                        {% else %}
                            <tr style="background: #ffdf38;" class="hide-show-block">
                        {% endif %}

                    {% else %}

                        {% if item['day'] == (date('d')) %}
                            <tr style="background: #fbffef;" class="hide-show-block active-important">

                        {% else %}
                            <tr style="background: #fbffef;" class="hide-show-block">
                        {% endif %}

                    {% endif %}
                    <th scope="row">

                        <div class="day-now" style="text-align: center;">{{ item['day'] }}</div>
                        <div class="week-now" style="text-align: center;font-size: 16px;font-weight: normal;border: 1px solid #a7a6a6;">{{ item['week'] }}</div>
                    </th>



                    {% for user  in users %}

                        <td>
                            <div>
                                {% if (item['week'] == 'Saturday' or item['week'] == 'Sunday')  %}
                                    <input type="checkbox" disabled>
                                {% else %}

                                    <input type="checkbox" checked disabled>

                                {% endif %}


                                {% if  times is empty %}
                                <div class="time-start-finaly" style="text-align: center;">
                                    {% else %}
                                    {% if i_am_late  is empty %}
                                    {% for time in times %}
                                    {% if user['id'] == time['user_id'] and time['i_am_late'] == 1 %}
                                    <div class="time-start-finaly" style="background: pink; text-align: center;">
                                        {% else %}
                                        <div class="time-start-finaly" style="text-align: center;">
                                            {% endif %}
                                            {% endfor %}

                                            {% else %}
                                            {% if i_am_late['user_id'] == user['id']%}
                                            <div class="time-start-finaly" style="background: pink; text-align: center;">

                                                {% else %}

                                                {% for time in times %}
                                                {% if user['id'] == time['user_id'] and time['i_am_late'] == 1 %}
                                                <div class="time-start-finaly" style="background: pink; text-align: center;">
                                                    {% else %}
                                                    <div class="time-start-finaly" style="text-align: center;">
                                                        {% endif %}
                                                        {% endfor %}
                                                        {% endif %}
                                                        {% endif %}

                                                        {% endif %}


                                    {% if times is empty %}
                                        <div></div>
                                    {% else %}

                                        {% for time in times %}

                                            {% if user['id'] == time['user_id'] %}
                                                {% if (item['year'] == time['current_date']) %}

                                                    <div><span class="time-start">{{ time['time_start'] }} - {{ time['time_end'] }}</span></div>

                                                {% else %}
                                                    <div></div>
                                                {% endif %}
                                            {% endif %}

                                        {% endfor %}

                                    {% endif %}




                                    {% if userAuthTimes is empty and user['id'] === auth['id'] and item['year'] == date('Y-m-d') %}
                                        <div>
                                            <div>Начать</div>
                                            <button class="str active">{{ link_to('index/setstart','Start') }}</button>
                                        </div>

                                    {% else %}

                                        {% if userAuthTimes is empty and user['id'] === auth['id'] %}

                                            {% else %}

                                            {% for timeUserAuth  in  userAuthTimes  %}

                                            {% endfor %}

                                                {% if (user['id'] === auth['id'] and item['year'] == date('Y-m-d')) %}
                                                    <div class="my-start-stop">
                                                        {% if timeUserAuth['time_end'] != null  %}
                                                            <button class="str active">{{ link_to('index/setstart','Start') }}</button>
                                                        {% else %}
                                                            <button class="end">{{ link_to('index/setend','End') }}</button>
                                                        {% endif %}
                                                    </div>
                                                {% else %}
                                                    <div></div>
                                                {% endif %}

                                        {% endif %}

                                    {% endif %}
                                    {#Result block#}
                                    {% for result in results %}

                                        {% if result['user_id'] == user['id'] and item['year'] == result['date'] %}

                                            {% if result['result_time'] < 9 %}

                                                <div class="total" style="color: red; font-weight: bold;">total: {{ result['result_time'] }}</div>
                                            {% else %}
                                                <div class="total" style="color: green; font-weight: bold;">total: {{ result['result_time'] }}</div>

                                            {% endif %}

                                        {% endif %}

                                    {% endfor %}
                                    {#/Result block#}
                                </div>
                            </div>
                        </td>
                    {% endfor %}

                    </tr>
                {% endfor %}
                </tbody>
            </table>
        </div>
    </div>
</div>



