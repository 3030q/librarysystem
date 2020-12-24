<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Record extends Model
{
    use HasFactory;
    public function scopeNotReturned($query, $sth){
        if($sth){
            return $query->where('date_returned', '=',null);
        }
        else{
            return $query->where('date_returned', '!=',null);
        }

    }

    public function scopeId($query, $parametr){
        return $query->where("id",'like',"%".$parametr."%");
    }

}
