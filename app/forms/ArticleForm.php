<?php

namespace Staff\Forms;

use Phalcon\Forms\Form;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\Submit;
use Phalcon\Forms\Element\TextArea;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\Identical;


class ArticleForm extends Form
{

    public function initialize()
    {

        $title = new Text('title',[
            'placeholder' => 'Заголовок',
            'class' => 'form-control'
        ]);

        $title->addValidators([
            new PresenceOf([
                'message' => 'Поле Заголовок обязательно для заполнения!'
            ])
        ]);

        $this->add($title);

        $desc = new Text('desc',[
            'placeholder' => 'Краткое описание',
            'class' => 'form-control'
        ]);

        $desc->addValidators([
            new PresenceOf([
                'message' => 'Поле краткое описание обязательно для заполнения!'
            ])
        ]);

        $this->add($desc);

        $text = new Text('text',[
            'placeholder' => 'Полное описание',
            'class' => 'form-control'
        ]);

        $text->addValidators([
            new PresenceOf([
                'message' => 'Поле полное описание обязательно для заполнения!'
            ])
        ]);
        $this->add($text);

        $this->add(new Submit('create',[
            'class' => 'btn btn-success'
        ]));
    }

    /**
     * Prints messages for a specific element
     */
    public function messages($name)
    {
        if ($this->hasMessagesFor($name)) {
            foreach ($this->getMessagesFor($name) as $message) {
                $this->flash->error($message);
            }
        }
    }

}