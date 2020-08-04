<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PostMaster extends Model
{
    protected $primaryKey = 'pid';
    protected $table = 'post_master';
    public $keyType = 'string';
    public $incrementing = false;
}
