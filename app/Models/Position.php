<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    use HasFactory;

    protected $table="positions";
    protected $primaryKey = 'position_id';
    protected $fillable = ['position','posted_on','created_by'];

    public function applicants(){
        return $this->hasMany(Applicant::class, 'position_id','position_id');
    }
}
