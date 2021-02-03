<?php 

	session_start();
	if(@$_SESSION['valid_admin'] == "" )
	{
	    @header("Location:login.php");
	}
	include_once("include/inc.php");
    if(isset($_POST["add2"]))
	{
	   // $sku=$_REQUEST['sku'];
    //     $product_id=$_REQUEST['pro_id'];
    //     $prev_warehouse=$_REQUEST['warehouse1'];
    //     $prev_rack=$_REQUEST['rack1'];
    //     $prev_quant=$_REQUEST['quantity1'];
    //     $stock_quant=$_REQUEST['quantity'];
    //     $wholeseller=$_REQUEST['ws_name'];
    //     $comment=$_REQUEST['comment'];
       
        echo "<pre>";
        print_r($_POST);
        echo "</pre>";
	}
?>