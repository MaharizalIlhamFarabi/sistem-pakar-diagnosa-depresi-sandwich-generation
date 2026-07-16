
  <ul class="nav nav-stacked nav-pills " id="navpo">
    <li>
     <a class="nav-link" href="?r=home"><i class="glyphicon glyphicon-home"></i>  Home</a> </li>
     <li> 
     <a  class="nav-link " href="?r=gejala" ><i class="glyphicon glyphicon-list"></i>  Information </a></li>
      <li>
       <a  class="nav-link "   href="?r=registeruser" ><i class="glyphicon glyphicon-pencil"></i>   Register</a></li>
       <li>
     <a class="nav-link" href="?r=loginuser"><i class="glyphicon glyphicon-log-in"></i>  Login</a></li>
     <li>
       <a class="nav-link" href="?r=bantuan"><i class="glyphicon glyphicon-info-sign"></i>   Bantuan Penggunaan</a></li>
      </ul>


 </ul>
 </div>

<div class="dh9">
 <div id="isiadmin">

  	<?php
  if(@$_GET["r"] == "home"){
    include "home.php";


  } else if(@$_GET["r"] == "gejala"){
    include "modules/member/gejala.php";

  } else if(@$_GET["r"] == "bantuan"){
    include "modules/member/bantuan.php";

  }else if(@$_GET["r"] == "registeruser"){
    include "modules/member/registeruser.php";

	}else if(@$_GET["r"] == "loginuser"){
    include "modules/member/loginuser.php";


	}else{
	include "home.php";}
	?>
 </div>
