<div class="container">
    <div class="main-site clearfix" style="padding: 30px 0;">

        <div class="float-left-need" style="float: left; width: 805px;">

            <div class="header">
                <div class="users-late-your-inform clearfix">
                    <div class="left" style="float: left;">
                        <div class="infom" style="width: 400px;">
                            <h1>My Hours Log</h1>
                            <h2>You are: {{ auth['role'] }}</h2>
                            <h3>Your name: {{ auth['name'] }}</h3>


                            <p>You have: 32:05</p>
                            <p>You have/Assigned: 18.23%</p>
                            <p>Assigned: 176</p>
                            <p>Ты опоздал: 0 раз
                                Если общее кол-во опозданий превысит 80 в мае. В мае будут применятся штрафные санкции.
                            </p>
                            <div class="w3-container w3-red w3-center" title="Осталось -30" style="width:100%;border: 1px solid red;margin-bottom: 12px;border-radius: 30px;text-align: center;">110</div>
                        </div>
                    </div>
                    <div class="right">
                        <div class="late-users">
                            <h5>Главные опоздуны</h5>
                            <div class="users" style="display: flex;">
                                <div class="user" style="padding: 0 10px;">
                                    <div class="img-user">
                                        <img src="" alt="">
                                        <div class="name-user">Aidar</div>
                                        <div class="how-much-you-late">12</div>
                                    </div>
                                </div>
                                <div class="user" style="padding: 0 10px;">
                                    <div class="img-user">
                                        <img src="" alt="">
                                        <div class="name-user">Aidar</div>
                                        <div class="how-much-you-late">12</div>
                                    </div>
                                </div>
                                <div class="user" style="padding: 0 10px;">
                                    <div class="img-user">
                                        <img src="" alt="">
                                        <div class="name-user">Aidar</div>
                                        <div class="how-much-you-late">12</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="menu-option" style="display: flex; justify-content: center; margin-bottom: 25px">
                    <form action="" method="GET">
                        <select name="month" onchange="this.form.submit();">
                            <option value="1">January</option>
                            <option value="2">February</option>
                            <option value="3">March</option>
                            <option value="4">April</option>
                            <option value="5" selected="selected">May</option>
                            <option value="6">June</option>
                            <option value="7">July</option>
                            <option value="8">August</option>
                            <option value="9">September</option>
                            <option value="10">October</option>
                            <option value="11">November</option>
                            <option value="12">December</option>
                        </select>&nbsp;&nbsp;&nbsp;&nbsp;
                        <select name="year" onchange="this.form.submit();">
                            <option value="2009">2009</option>
                            <option value="2010">2010</option>
                            <option value="2011">2011</option>
                            <option value="2012">2012</option>
                            <option value="2013">2013</option>
                            <option value="2014">2014</option>
                            <option value="2015">2015</option>
                            <option value="2016">2016</option>
                            <option value="2017">2017</option>
                            <option value="2018">2018</option>
                            <option value="2019" selected="selected">2019</option>
                        </select>&nbsp;&nbsp;&nbsp;&nbsp;
                    </form>
                </div>
            </div>
        </div>


        <div class="float-right-need" style="float: right;width: 300px">
            <div class="button" style="text-align: center; font-weight: bold; border:1px solid #c1b5b5;">
                {{ link_to('users/removeAuth', 'Logout') }}
            </div>

            <h5>Register new User</h5>
            {{ form('users/create', 'method': 'post') }}

            {#<div class="form-group" style=" display: flex; flex-direction: column; ">
                {% if (form) %}

                    {{  form.render("name") }}

                    {{  form.render("email") }}

                    {{  form.render("password") }}

                    {{ form.render('Sign Up') }}

                {% endif %}
            </div>

            {{ end_form() }}#}
        </div>
    </div>
</div>


<div class="main-table-content">
    <div class="content">
        <div class="table">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th scope="col">
                        <a href="#">Hide/Show</a>
                    </th>

                    {% for user in users %}

                        <th scope="col">{{ user.name }}</th>

                    {% endfor %}

                    {# <?php foreach($users as $user){?>

                     <th scope="col"> <?php echo $user->name ?></th>


                     <?php }?>#}
                </tr>
                </thead>
                <tbody>
                {# <tr>

                    #}{# {% for user in users %}

                         #}{##}{#<th scope="col">{{ user.name }}</th>#}{##}{#

                         <th scope="row">



                             <div class="day-now"></div>
                             <div class="week-now">

                                 {{ urrent_week }}
                             </div>
                         </th>

                     {% endfor %}#}{#

                     <th scope="row">

                          <div class="day-now">1</div>
                            <div class="week-now">Wednesday</div>
                     </th>
                     <td>
                         <div>



                             <label for="" disabled>Fullday</label>
                             <input type="checkbox" checked disabled>
                             <div class="time-start-finaly">
                                 <span class="time-start">8:45 -</span>

                                 {{ link_to('index/setstart','Start') }}
                                 {{ link_to('index/setend','End') }}
                                #}{# <span><button name="active" value="1">Start</button></span>
                                 <span><button name="active" value="0">End</button></span>#}{#
                             </div>
                             <div class="total">total:07:53</div>

                         </div>
                     </td>
                     <td>Otto</td>
                     <td>@mdo</td>
                 </tr>#}

                {% for item  in currentWeks %}
                    {% if (item['week'] == 'Saturday' or item['week'] == 'Sunday')  %}
                        <tr style="background: #ffdf38;">
                    {% else %}

                        <tr style="background: #fbffef;">

                    {% endif %}
                    <th scope="row">

                        <div class="day-now" style="text-align: center;">{{ item['day'] }}</div>
                        <div class="week-now" style="text-align: center;font-size: 16px;font-weight: normal;border: 1px solid #a7a6a6;">{{ item['week'] }}</div>
                    </th>



                    {% for user  in users %}

                        <td>
                            <div>
                                {% if (item['week'] == 'Saturday' or item['week'] == 'Sunday')  %}
                                    <label for="">Fullday</label>
                                    <input type="checkbox" >
                                {% else %}

                                    <label for="">Fullday</label>
                                    <input type="checkbox" checked >

                                {% endif %}


                                {% for time in times %}

                                {% if user.id == time.user_id %}
                                {% if (item['year'] == time.current_date) %}
                                <div class="time-start-finaly">

                                    <div><span class="time-start">{{ time.time_start }} - {{ time.time_end }}</span></div>

                                    {% else %}
                                        <div></div>
                                    {% endif %}
                                    {% endif %}

                                    {% endfor %}

                                    {#{% if (time.user_id == auth['id']) %}

                                    {% endif %}#}

                                    {% if (user.id === auth['id'] and item['year'] == time.current_date) %}
                                        {{ link_to('index/setstart','Start') }}
                                        {{ link_to('index/setend','End') }}
                                    {% else %}
                                        <div></div>
                                    {% endif %}


                                    {# <span><button name="active" value="1">Start</button></span>
                                     <span><button name="active" value="0">End</button></span>#}
                                </div>

                                {#  <div class="total">total: 07:53</div>#}
                            </div>
                        </td>
                    {% endfor %}

                    </tr>
                {% endfor %}
                {#{% for item  in currentWeks %}

                <tr>
                    <th scope="row">

                        <div class="day-now" style="text-align: center;">{{ item['day'] }}</div>
                        <div class="week-now" style="text-align: center;font-size: 16px;font-weight: normal;border: 1px solid #a7a6a6;">{{ item['week'] }}</div>
                    </th>


                    <td>
                        <div>
                            <label for="" disabled>Fullday</label>
                            <input type="checkbox" checked disabled>
                            <div class="time-start-finaly">
                                <span class="time-start">8:45 -</span>

                                {{ link_to('index/setstart','Start') }}
                                {{ link_to('index/setend','End') }}
                                #}{# <span><button name="active" value="1">Start</button></span>
                                 <span><button name="active" value="0">End</button></span>#}{#
                            </div>
                            <div class="total">total:07:53</div>
                        </div>
                    </td>
                    <td>Jacob</td>
                    <td>Thornton</td>
                    <td>@fat</td>
                </tr>
                #}{#<tr>
                    <th scope="row">3</th>
                    <td colspan="2">Larry the Bird</td>
                    <td>@twitter</td>
                </tr>#}{#
                {% endfor %}#}
                </tbody>
            </table>
        </div>
    </div>
</div>

