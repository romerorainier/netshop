<?php
use Illuminate\Database\Capsule\Manager as DB;

class Cart extends Controller
{

  protected $data = [];

  public function __construct()
  {
       if (!isset($_SESSION)) session_start();
  }

  public function checkCart($uid='',$product_id='')
  {
      $OrderDetails = $this->model('OrderDetails');
      $this->data = $OrderDetails::Where('customer_id',$uid)
                                  ->Where('product_id',$product_id)
                                  ->Where('checkout',0)->first();
      return $this->data;
  }

  public function addcart($uid='', $product_id='', $product_price='')
  {
      $OrderDetails = $this->model('OrderDetails');
      $this->data = $OrderDetails::create([
          'customer_id' => $uid,
          'product_id' => $product_id,
          'product_qty' => 1,
          'product_price' => $product_price,
          'checkout' => 0
      ])->count();

      if ($this->data>0)
      {
        echo 'Product added on cart';
      }
  }

  public function cartstat($uid='')
  {
      $OrderDetails = $this->model('OrderDetails');
      $this->data = $OrderDetails::Where('customer_id',$uid)->where('checkout',0)->get()->count();
      return $this->data;
  }

  public function removecart($oid='')
  {
      $OrderDetails = $this->model('OrderDetails');
      $this->data = $OrderDetails::where('order_detail_id',$oid)->delete();

      if ($this->data>0)
      {
        echo 'Removed from cart';
      }
  }

  public function recalculate($uid='')
  {
    $OrderDetails = $this->model('OrderDetails');
    $total = $OrderDetails::selectRaw('sum(product_qty * product_price) as total')
                            ->where('customer_id', (isset($_SESSION["uid"]) ? $_SESSION["uid"]:$uid))
                            ->where('checkout',0)
                            ->get();

    $total = $total->toArray();

    print_r(is_null($total[0]['total']) ? 0: $total[0]['total']);
  }

  public function changeqty($oid='', $qty='')
  {
    $OrderDetails = $this->model('OrderDetails');
    $OrderDetails::where('order_detail_id', $oid)->update(['product_qty' => $qty]);
  }

  public function pay($dids='',$gtotal='',$uid='')
  {
    $OrderDetails = $this->model('OrderDetails');
  //  DB::enableQueryLog();
    $payobj = $OrderDetails::join('Products', 'Products.product_id', '=', 'order_details.product_id')
            ->join('Users', 'Users.id', '=', 'order_details.customer_id')
            //->get();
            ->whereIn('order_details.order_detail_id', explode(",",$dids))
            ->where('order_details.checkout', 0)
            ->update(array('Products.product_qty' => DB::raw('Products.product_qty - order_details.product_qty'),
              'Users.balance' => DB::raw('Users.balance - '.$gtotal),
              'order_details.checkout'=> 1
            ));

          //  dd(DB::getQueryLog());

    if ($payobj>0)
    {
      $this->insertSummary($dids,$gtotal,(isset($_SESSION["uid"]) ? $_SESSION["uid"]:$uid));
    }
    else
    {
      echo "Error: ";
    }

  }

  public function insertSummary($dids='',$gtotal='',$uid='')
  {

    $OrderSummary = $this->model('OrderSummary');
    $OrderSummary::create([
                     'customer_id' => $uid,
                     'order_detail_ids' => $dids,
                     'order_date' => date("Y-m-d"),
                     'order_total' => $gtotal
                 ]);

    if ($OrderSummary)
    {
      echo "1";
    }
    else
    {
      echo "Error: ";
    }
  }

  public function rate($rate='',$product_id='',$uid='')
  {
    $Rate = $this->model('Rate');

    if (!empty((isset($_SESSION["uid"]) ? $_SESSION["uid"]:$uid)) && !empty($product_id) && !empty($rate))
    {

      $Rateobj = $Rate::where('customer_id',(isset($_SESSION["uid"]) ? $_SESSION["uid"]:$uid))
                        ->where('product_id',$product_id)->get()->count();

     if($Rateobj>0)
     {
       echo "You can only rate once";
     }
     else
     {
         $Rateobj = $Rate::create([
             'customer_id' => (isset($_SESSION["uid"]) ? $_SESSION["uid"]:$uid),
             'product_id' => $product_id,
             'rating' => $rate
         ]);

         echo 'You Rated it '.$rate;
     }
    }

    else {
      echo "You must login to rate!";
    }
  }

  function getavg($product_id='')
  {
    $Rate = $this->model('Rate');

    $avg = $Rate::selectRaw('round(avg(rating)) as average')
                            ->where('product_id',$product_id)->get();

    $avg = $avg->toArray();
    return (is_null($avg[0]['average']) ? 0: $avg[0]['average']);
  }

}

?>
