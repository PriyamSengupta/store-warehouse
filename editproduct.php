<?php 







	session_start();







	if(@$_SESSION['valid_admin'] == "" )







	{







	@header("Location:login.php");







	}







	include_once("include/inc.php");







	







	if(isset($_POST["edit"]))







	{

$ref_no=$_REQUEST['ref_no'];

$filename = $ref_no.".csv";



$fp = fopen('php://output', 'w');



header('Content-type: application/csv');



header('Content-Disposition: attachment; filename='.$filename);





$list = array();



$list[] = array("Reference No.",$ref_no); 



foreach($list as $newlist){


 
fputcsv($fp, $newlist);



}



$list = array();



$list[] = array("Barcode No","Product Brand","Product Category","Product Unit", "Product Size","Barcode Text","Product Quantity",  "Product Price",  "Total Price"); 



foreach($list as $newlist){



fputcsv($fp, $newlist);



} 



		



		



		



		



		$sl=0;



		$id=$_REQUEST['id'];



		$brand=$_REQUEST['product_brand'];



		$category=$_REQUEST['product_category'];



		$unit=$_REQUEST['product_unit'];



		$size=$_REQUEST['product_size'];
		
		
		$barcode_text=$_REQUEST['barcode_text'];

		

		$barcode_no=$_REQUEST['barcode_no'];



		$quantity=$_REQUEST['product_quantity'];



		



		foreach(array_filter($_REQUEST['product_price']) as $tst)



		{



	$sqlupdate = mysql_query("UPDATE ".TBL_PRODUCT." SET product_category='".$category[$sl]."',unit='".$unit[$sl]."',size='".$size[$sl]."',product_price='".$tst."',last_modified_date=NOW(),last_modified_by='".$_SESSION['id']."' WHERE id = '".$id[$sl]."'");



	





	





	



	



	



$query = "SELECT * FROM tbl_productbrand where id='".$brand[$sl]."' ORDER BY id asc";



$resultbrand = mysql_fetch_assoc(mysql_query($query));







$query = "SELECT * FROM tbl_productcategory where id='".$category[$sl]."' ORDER BY id asc";



$resultcat = mysql_fetch_assoc(mysql_query($query));




$p_unit="SELECT * FROM `tbl_product_unit` WHERE id='".$unit[$sl]."' ORDER BY id asc";

$result_unit=mysql_fetch_assoc(mysql_query($p_unit));



$p_size="SELECT * FROM `tbl_product_size` WHERE id='".$size[$sl]."' ORDER BY id asc";

$result_size=mysql_fetch_assoc(mysql_query($p_size));






$query="SELECT * FROM tbl_product where id='".$id[$sl]."'";



$barcode=mysql_fetch_assoc(mysql_query($query));







$barcode_no[$i]=$barcode['barcode_no'];



$product_brand[$i]=$resultbrand['brand_name'];



$product_cat[$i]=$resultcat['category_name'];


$product_unit[$i]=$result_unit['unit'];

$product_size[$i]=' '.$result_size['size'];


$product_barcode_text[$i]=$barcode_text[$sl];


$product_quantity[$i]=$quantity[$sl];



$product_price[$i]=$tst/$quantity[$sl];



$price[$i]=$tst;



$toatal_qty=$toatal_qty+$product_quantity[$i];



$total_price=$total_price+$price[$i];



$list = array();

$list[$i] = array($barcode_no[$i],$product_brand[$i],$product_cat[$i],$product_unit[$i],$product_size[$i],$product_barcode_text[$i],$product_quantity[$i], $product_price[$i], $price[$i]);





$i++;



foreach($list as $newlist){



fputcsv($fp, $newlist);



}  







	$sl++;



	



	}



		if($sqlupdate){











$filename = "product_list.csv";



$fp = fopen('php://output', 'w');



header('Content-type: application/csv');



header('Content-Disposition: attachment; filename='.$filename);



$list = array();



$list[] = array(" "," "," "," "," ","Total Quantity",$toatal_qty,"Total Price", $total_price); 



foreach($list as $newlist){



fputcsv($fp, $newlist);



} 















     echo "<script>alert('Successfully Inserted');window.location.href='product_list.php'</script>";



	}



	else{



		echo "<script>window.open('barcode/html/BCGcode39.php?text=$fbar','_blank')</script>";



	}







	}







	else if(isset($_POST["barcode"]))







	{

		



     $amount = array_values($_REQUEST['product_price']);



	 $quantity=$_REQUEST['product_quantity'];

	  $barcode_no=$_REQUEST['barcode_no'];



$fbar="";

      $sl=0;



      $count=$_REQUEST['product_name'];

      

      



       foreach($_REQUEST['barcode_no'] as $tst)



	    {

	    	

	    	

		

	if ( !next( $_REQUEST['barcode_no'] ) )



    { 



	   $fbar .=$barcode_no[$sl].'$'.$quantity[$sl];



	}



	else



	{



		$fbar .=$barcode_no[$sl].'$'.$quantity[$sl].'@';



	}



		$today=date('Y-m-d');



	    $sl++;

	    

	 



	    }





	



		echo "<script>window.open('barcode/html/BCGcode39.php?text=$fbar','_blank')</script>";



		echo "<script>window.location.href='product_list.php'</script>";



	







	}







	?>







