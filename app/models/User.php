<?php

use Illuminate\Database\Eloquent\Model as Eloquent;

class User extends Eloquent
{
    public $timestamps = [];
    protected $table = 'Users';
    protected $fillable = ['username','password','email','balance'];
}
?>
