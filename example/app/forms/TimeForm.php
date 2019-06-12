<?php

namespace Staff\Forms;


use Phalcon\Forms\Form;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\Submit;
use Phalcon\Forms\Element\Hidden;
use Phalcon\Forms\Element\Date;
use Phalcon\Forms\Element\Time;
use Phalcon\Validation\Validator\PresenceOf;

class TimeForm extends Form
{
    public function initialize()
    {
        $timeStart = new Text('time_start', [
            'type' => 'time',
            'placeholder' => '00:00:00',
        ]);
        $timeStart->addValidators([
            new PresenceOf([
                'message' => 'Поле обязательно для заполнения'
            ])
        ]);
        $this->add($timeStart);

        $timeEnd = new Text('time_end', [
            'placeholder' => '00:00:00',
        ]);

        $timeEnd->addValidators([
            new PresenceOf([
                'message' => 'Поле обязательно для заполнения'
            ])
        ]);
        $this->add($timeEnd);

        $timeCurrDate = new Date('current_date', [
            'placeholder' => '00:00:00',
        ]);

        $timeCurrDate->addValidators([
            new PresenceOf([
                'message' => 'Поле обязательно для заполнения'
            ])
        ]);
        $this->add($timeCurrDate);

        $userID = new Hidden('user_id');
        $this->add($userID);

        $id = new Hidden('id');
        $this->add($id);



        $this->add(new Submit('go',[
            'class' => 'btn btn-success',
            'value' =>'Редактировать'
        ]));

    }
}