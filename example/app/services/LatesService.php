<?php


namespace Staff\Services;


use Staff\Models\Lates;

class LatesService extends MainService
{

    public function getLates()
    {
        $lates = Lates::find([
            'conditions' => 'current_mounth = :cur_month: LIMIT 3',
            'bind' => [
                'cur_month' => date('Y-m')
            ]
        ]);
        return $lates;
    }

}