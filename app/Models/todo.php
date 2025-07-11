<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;


class todo extends Model
{
    protected $fillable = ['user_id', 'body', 'priority', 'completed'];
    public function user(){
        return $this->belongsTo(User::class);
    }
}
