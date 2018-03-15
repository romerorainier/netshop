
$('#regsub').click(function(){
  $(".alert").alert();

  $.ajax({
    type:'post',
    url:'users/register',
    data:$('#regForm').serializeArray(),
    success:function(data){
      if (data.indexOf("success")>0)
      {
        showalert("alert_register",data,"alert-success",true,2000);
      }
    }
   })
});

$('#logsub').click(function(){

console.log($('#log_form').serializeArray());
  $.ajax({
    type:'post',
    url:'users/login',
    data:$('#log_form').serializeArray(),
    success:function(data){
      if (data.indexOf("success")>0)
      {
        showalert("alert_login",data,"alert-success",true,2000);
      }
      else
      {
        showalert("alert_login",data,"alert-danger",false,1000);
      }
    }
   })
});

$('#logout').click(function(){

  $.ajax({
    type:'post',
    url:'users/logout',
    success:function(data){
      showalert("alert_main","Logged out","alert-info",true,2000);
    }
   })
});

$('#cart').on('hidden.bs.modal', function () {
  document.location.reload();
})

function showalert(alertbox,message,alerttype,success,fadespeed) {

    $('#'+alertbox).append('<div id="alertdiv" class="alert ' +  alerttype + '"><a class="close" data-dismiss="alert">×</a><span>'+message+'</span></div>')

    setTimeout(function() { // this will automatically close the alert and remove this if the users doesnt close it in 2 secs
      $("#alertdiv").remove();
      if (success)
      {
          location.reload();
      }
    }, fadespeed);
  }


function addcart(uid, pid, pprice)
{
     $.ajax({
          url:'cart/addcart',
          type:'POST',
          data: {uid:uid,pid:pid, pprice:pprice},
          success:function(response) {
              showalert("alert_main",response,"alert-success",true,1000);
          }
          });
          return false;
}

function removecart(oid)
{
     $.ajax({
          url:'cart/removecart',
          type:'POST',
          data: {oid:oid},
          success:function(response) {
                recalc();
                document.getElementById('mode').value = '';
                var elem = document.getElementById(oid);
                showalert("alert_cart",response,"alert-info",false,1000);
                return elem.parentNode.removeChild(elem);
          }
          });
          return false;
}

function recalc()
{
          $.ajax({
          url:'cart/recalculate',
          type:'POST',
          success:function(response) {
              if(!response.trim()=='')
              {
                document.getElementById("psubtotal").innerHTML = response;
                document.getElementById("gtotal").innerHTML = response;
                if(parseFloat(response)==0)
                {
                  document.getElementById('mode').disabled= true;
                  document.getElementById('payb').disabled= true;
                  showalert("alert_cart","There are no items in your cart","alert-info",true,2000);
                }
              }

          }
          });
          return false;
}

function changeqty(oid,pprice,itemcount)
{
    qty = document.getElementById("qty_"+oid).value;
    ptid = "p_" + itemcount;
    ptotal = qty * pprice;

    $.ajax({
          url:'cart/changeqty',
          type:'POST',
          data: {oid:oid, qty:qty},
          success:function(response) {
             document.getElementById(ptid).innerHTML = parseFloat(ptotal).toFixed(2);
             recalc();
             document.getElementById('mode').value = '';
          }
          });
          return false;
}

function changemode()
{
  var e = document.getElementById("mode");
  var s = e.options[e.selectedIndex].value;

   if(!s.trim()=='')
     {
       document.getElementById("gtotal").innerHTML = parseFloat(parseFloat(s) + parseFloat(document.getElementById("psubtotal").innerHTML)).toFixed(2);
       document.getElementById("transsub").innerHTML = parseFloat(s).toFixed(2);
     }
   else
     {
       document.getElementById("transsub").innerHTML = parseFloat(0).toFixed(2);
     }

}

$('.rating-input-wrapper').on('click', '.rating-input i', function () {

   // rating happens here
   rate = $(this).data().value;
   pid = $(this).closest('.rating-input-wrapper').attr('id');

   $.ajax({
        url:'cart/rate',
        type:'POST',
        data: {rate:rate, pid:pid },
        success:function(response) {

           if(!response.trim()=='')
           {
             showalert("alert_main",response,"alert-info",true,1000);
           }
        }
    });
    return false;

});

function pay(dids)
{
  s = document.getElementById('mode').value;
  gtotal=document.getElementById("gtotal").innerHTML;
  baltemp=document.getElementById("balance").innerHTML;
  bal = baltemp.split(":");

   if(!s.trim()=='')
     {

       if (parseFloat(bal[1])<parseFloat(gtotal))
       {
         showalert("alert_cart","Insufficient funds","alert-danger",false,1000);
       }
       else
       {
         $.ajax({
          url:'cart/pay',
          type:'POST',
          data: {dids:dids,gtotal:gtotal},
          success:function(response) {
              if(!response.trim()=='' && response==1)
              {
                showalert("alert_cart","Items successfully paid! Transaction Completed","alert-success",true,2000);
              }

          }
          });
          return false;
        }
     }
   else
     {
       showalert("alert_cart","Please select transport type","alert-danger",false,1000);
     }

}
