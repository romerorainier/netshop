<?php

use Illuminate\Database\Eloquent\Model as Eloquent;

class OrderDetails extends Eloquent
{
    public $timestamps = [];
    protected $table = 'order_details';
    protected $fillable = ['customer_id','product_id','product_qty','product_price','checkout'];

}
?>
