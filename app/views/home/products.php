<div class="row" style="margin: 0 auto;width: 90%;">
<?php
foreach($data['products'] as $row){
    echo '<div class="col-sm-6 col-md-5">
         <div class="thumbnail">
         <img style="height:100px;"src="'.$row["product_img"].'" alt="...">
         <div class="caption">
         <h3>'.$row["product_name"].'</h3>
         <p style="height:60px;">'.$row["product_desc"].'</p>
         <div class="rating-input-wrapper" id="'.$row["product_id"].'">
         <input type="number" name="rating" id="'.$row["product_id"].'" class="rating" value="'.$Cart->getavg($row["product_id"]).'" >
         </div>
         <h4>'.sprintf('%0.2f',$row["product_price"]).'</h4>
         <p>';
         if ($Cart->checkCart((isset($_SESSION['uid']) ? $_SESSION['uid'] : 0),$row["product_id"]) || !isset($_SESSION['uid']))
         {
           echo '<input type="button" class="btn btn-primary" role="button" value="Add To Cart" disabled>';
         }
         else
         {
           echo '<input type="button" onclick="addcart('.(isset($_SESSION['uid']) ? $_SESSION['uid'] : 0).','.$row["product_id"].','.$row["product_price"].')" class="btn btn-primary" role="button" value="Add To Cart">';
         }
           echo     '</div>
                 </div>
                </div>';
    }
?>
</div>
