<div id="alert_main">
</div>
<nav class="navbar navbar-default">
     <a class="navbar-brand" href="/">NETSHOP</a>
     <button class="navbar-toggle" type="button" data-toggle="collapse" data-target="#optionnav" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
       <span class="icon-bar"></span>
       <span class="icon-bar"></span>
       <span class="icon-bar"></span>
     </button>
     <div class="collapse navbar-collapse" id="optionnav">
       <ul class="nav navbar-nav">
        <?php
        echo '<li>';
           if (isset($_SESSION["username"]))
           {
             echo '<a id="logout" name="logout" class="nav-link" href="#" data-toggle="modal">Logout</a></li>';
           }
           else
           {
             echo '<a class="nav-link" href="#login" data-toggle="modal">Login</a>
                   </li>
                   <li class="nav-item">
                   <a class="nav-link" href="#register" data-toggle="modal">Register</a>
                   </li>';
           }
         ?>
       </ul>
       <ul class="nav navbar-nav navbar-right">
       <?php
       if (isset($data["balance"]) && isset($_SESSION["uid"]))
       {
         echo '<li class="nav-item">';
         if ($Cart->cartstat($_SESSION["uid"])>0)
         {
          echo  '<a class="nav-link" id="cartstat" href="#cart" data-toggle="modal"><span class="glyphicon glyphicon-shopping-cart"></span>'.$Cart->cartstat($_SESSION["uid"]).'</a>';
         }
         else {
           echo  '<a class="nav-link" id="cartstat" href="#cart" data-toggle="modal" style="pointer-events: none;"><span class="glyphicon glyphicon-shopping-cart"></span>'.$Cart->cartstat($_SESSION["uid"]).'</a>';
         }
            echo '</li>
                <li class="nav-item">
                <a id="balance" name="balance" class="nav-link">Balance:'.$data["balance"].'</a>
                </li>';
       }
       ?>
       </ul>
     </div>
   </nav>
