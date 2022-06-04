<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $guarded =[];

    public function rate(){
        return $this->hasOne(Rate::class, 'comment_id');
    }
    public function getCreatedAttribute(){
        return $this->attributes['created_at'];
    }
    public function getUserName(){
        return User::where('id', $this->attributes['user_id'])->first()->name;
    }
}
