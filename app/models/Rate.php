<?php

use Illuminate\Database\Eloquent\Model as Eloquent;

class Rate extends Eloquent
{
    public $timestamps = [];
    protected $table = 'rate';
    protected $fillable = ['customer_id','product_id','rating'];

}
?>
