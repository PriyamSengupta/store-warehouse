<?php
	session_start();

	if(@$_SESSION['valid_admin'] == "" )
	{

		@header("Location:login.php");
	}

	include_once("include/inc.php");

	$sku=trim($_REQUEST['sku']);
    $sqlquery=mysqli_query($db_handle,"SELECT product_id,combo_product_id FROM tbl_sku WHERE name='".$sku."' AND flag='1'");
    $sqlquery1=mysqli_fetch_object($sqlquery);
    $pro_id=$sqlquery1->product_id;
    $combo_pro_id=$sqlquery1->combo_product_id;
    if($pro_id!=0)
    {
    	$sqlQuery=mysqli_query($db_handle,"SELECT p.name,p.id FROM tbl_sku s LEFT JOIN tbl_products p ON s.product_id=p.id WHERE p.id='".$pro_id."'");
    	if(mysqli_num_rows($sqlQuery)>0)
    	{	
    		$sqlResult=mysqli_fetch_object($sqlQuery);
    		 
    	    $name=$sqlResult->name;
    	   // $json['id']=$sqlResult->id;
    	}
    }
    elseif($combo_pro_id!=0)
    {
        $sqlQuery=mysqli_query($db_handle,"SELECT c.name,c.id FROM tbl_sku s LEFT JOIN tbl_combo_product c ON s.combo_product_id=c.id WHERE c.id='".$combo_pro_id."'");
    	if(mysqli_num_rows($sqlQuery)>0)
    	{	
    		$sqlResult=mysqli_fetch_object($sqlQuery);
    		 
    	    $name=$sqlResult->name;
    	   // $json['id']=$sqlResult->id;
    	}
    }
    
    echo $name;
?>