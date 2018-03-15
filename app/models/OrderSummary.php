<?php

use Illuminate\Database\Eloquent\Model as Eloquent;

class OrderSummary extends Eloquent
{
    public $timestamps = [];
    protected $table = 'order_summary';
    protected $fillable = ['customer_id','order_detail_ids','order_date','order_total'];

}
?>
