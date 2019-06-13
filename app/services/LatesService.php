<?php


namespace Staff\Services;


use Staff\Models\Lates;

class LatesService extends MainService
{

    public function getLates()
    {
        $lates = Lates::find([
            'conditions' => 'current_month = :cur_month: ORDER BY count_lates > :lates: DESC LIMIT 3 ',
            'bind' => [
                'cur_month' => date('Y-m'),
                'lates' => 0
            ]
        ]);
        return $lates;
    }

}