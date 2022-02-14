<?php

namespace App\FlexNGate\Positions;

use App\Models\Position;

class EloquentPositionRepository implements PositionInterface
{
    public function create($info){
        Position::create([
            'position' => $info->position,
            'posted_on' => date('Y-m-d',strtotime($info->posted_on)),
            'created_by' => $info->created_by
        ]);
    }
}
