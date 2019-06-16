{{ content() }}
<div><h2>Create</h2></div>

{% if success %}
    <div><div class="alert alert-success"><?php $this->flashSession->output() ?></div></div>
    {% else %}
        <p></p>
{% endif %}



{{ form('articles/create', 'method': 'POST') }}


{{ form.render('title') }}
{{ form.messages('title') }}

{{ form.render('desc') }}
{{ form.messages('desc') }}

{{ form.render('text') }}
{{ form.messages('text') }}

{{ form.render('create') }}

{{ endForm() }}