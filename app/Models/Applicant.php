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

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function position(){
        return $this->hasOne(Position::class, 'position_id','position_id');
    }

    /**
     * @param $query
     * @param $status
     * @return mixed
     */
    public function scopeStatus($query, $status)
    {

        if ($status!=='all') {
            return $query->where('status',$status);
        }
        return $query;
    }
}
