<div id="cart" class="modal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" onclick="javascript:window.location.reload()" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" style="max-height:500px;overflow:auto;">
        <form method="POST" action="" id="pay_form">
              <div id="alert_cart">
              </div>
              <div class="form-group">
                <?php
                $count=0;
                $stotal=0;
                $ids = array();

                foreach($data['cart'] as $row)
                {
                    $count++;
                    $ids[] = $row["order_detail_id"];
                    echo '<div id='.$row["order_detail_id"].' class="row">
                          <div class="col-sm-6 col-md-2 form-group"><a class="btn btn-xs btn-danger" onclick="removecart('.$row['order_detail_id'].')"><span class="glyphicon glyphicon-remove-sign"></span></a></div>
                          <div class="col-sm-6 col-md-4">'.$row['product_name'].'</div>
                          <div class="col-md-2">
                          <select name="qty_'.$row["order_detail_id"].'" id="qty_'.$row["order_detail_id"].'" onchange="changeqty('.$row["order_detail_id"].','.$row["product_price"].','.$count.')">';
                          for($i=1; $i<=$row["stock"]; $i++)
              						{
              							if ($i==$row["oqty"])
              							{
              								echo "<option value=".$i." selected>".$i."</option>";
              							}
              							else
              							{
              								echo "<option value=".$i.">".$i."</option>";
              							}
              						}

                          $ptotal = sprintf('%0.2f',($row["oqty"] * $row["product_price"]));

                    echo '</select>
                          </div>
                          <div class="col-sm-6 col-md-4"><span>$</span><span id="p_'.$count.'">'.$ptotal.'</span></div>
                          </div>';

                          $stotal = sprintf('%0.2f',($stotal + $ptotal));
                }

                echo '<input type="hidden" id="fcount" name="fcount" value="'.$count.'">';
                         echo '<hr style="border-top: 1px solid #8c8b8b;">
                              <div class="row">
                               <div class="col-md-6">
                               <span>Transport Type:</span>
                               <select id="mode"  onchange="changemode()">
                                  <option value=""></option>
                                  <option value="0">Pick Up</option>
                                  <option value="5">UPS</option>
                               </select>
                               </div>
                               </div>
                               <div class="row">
                               <div class="col-md-8">
                               <span>SubTotal: </span><span>$</span><span id="psubtotal" class="lead">'.$stotal.'</span>
                               </div>
                               </div>
                               <div class="row">
                               <div class="col-md-8">
                               <span>Transport Charge: </span><span>$</span><span id="transsub" class="lead">'.sprintf('%0.2f',0).'</span>
                               </div>
                               </div>
                               <div class="row">
                               <div class="col-md-8">
                               <span>GrandTotal: </span><span>$</span><span id="gtotal" class="lead">'.$stotal.'</span>
                               </div>
                               </div>
                               </div>
                               <input type="button" value="Pay" id="payb" class="btn btn-info btn-block" onclick="pay(\''.trim(implode(",", $ids)).'\')">';
                               ?>
      </div>
    </div>
  </div>
</div>
