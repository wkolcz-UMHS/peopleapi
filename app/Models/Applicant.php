<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Applicant extends Model
{
    use HasFactory;

    protected $table="Applicants";
    protected $primaryKey = 'id';
    protected $fillable = ['name','status','created_by','position_id'];

    public function position(){
        return $this->hasOne(Position::class, 'position_id','position_id');
    }
}
