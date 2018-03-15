<?php

class Home extends Controller
{

    protected $data = [];

    public function __construct()
    {
         session_start();
    }

    public function index()
    {
       $this->data = ['products'=>$this->getProducts(),'balance'=>$this->getBalance(), 'cart'=>$this->getCart()];
       $this->view('home/index',$this->data);
    }

    // function to get product for the view
    public function getProducts()
    {
      $Products = $this->model('Products');
      $Productsobj = $Products::All();
      return $Productsobj;
    }

    // function to get products on cart
    public function getCart($uid='')
    {
        $OrderDetails = $this->model('OrderDetails');

        $OrderDetailsobj = $OrderDetails::join('Products', 'Products.product_id', '=', 'order_details.product_id')
        ->select('order_details.order_detail_id','Products.product_id', 'Products.product_name', 'Products.product_price','order_details.product_qty as oqty','Products.product_qty as stock')
        ->where('order_details.checkout',0)
        ->where('order_details.customer_id',(isset($_SESSION["uid"]) ? $_SESSION["uid"]:$uid))
        ->get();
        return $OrderDetailsobj;
    }

    // function to get balance of user base on uid
    public function getBalance($uid='')
    {
        $data = User::Where('id',(isset($_SESSION["uid"]) ? $_SESSION["uid"]:$uid))->first();
        return (isset($data->balance) ? $data->balance:null);
    }

}


?>
