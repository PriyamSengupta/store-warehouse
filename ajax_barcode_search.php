<?php
	session_start();

	if(@$_SESSION['valid_admin'] == "" )
	{

		@header("Location:login.php");
	}

	include_once("include/inc.php");
    $barcode_no=$_REQUEST['barcode'];
    $type=$_REQUEST['type'];
    $barcode="";
    
    if(strlen($barcode_no)=='1')
    {
    	$barcode="000000000".$barcode_no;
    }
    if(strlen($barcode_no)=='2')
    {
    	$barcode="00000000".$barcode_no;
    }
    if(strlen($barcode_no)=='3')
    {
    	$barcode="0000000".$barcode_no;
    }
    if(strlen($barcode_no)=='4')
    {
    	$barcode="000000".$barcode_no;
    }
    if(strlen($barcode_no)=='5')
    {
    	$barcode="00000".$barcode_no;
    }
    if(strlen($barcode_no)=='6')
    {
    	$barcode="0000".$barcode_no;
    }if(strlen($barcode_no)=='7')
    {
    	$barcode="000".$barcode_no;
    }
    if(strlen($barcode_no)=='8')
    {
    	$barcode="00".$barcode_no;
    }
    if(strlen($barcode_no)=='9')
    {
    	$barcode="0".$barcode_no;
    }
    if(strlen($barcode_no)=='10')
    {
    	$barcode="".$barcode_no;
    }
    
    // echo json_encode($barcode);
    
        // $counter=$_REQUEST['counter'];
     
     //$arr=array("barcode"=>$barcode);
     
        if($type=='1')
        {
            // echo json_encode($barcode);
            $sql_ss=mysqli_query($db_handle,"SELECT r.id,r.barcode_no,r.name AS rack,w.name AS warehouse,r.status,r.creation_date FROM tbl_rack r LEFT JOIN tbl_warehouse w ON r.warehouse_id=w.id WHERE r.barcode_no='".mysqli_real_escape_string($db_handle,$barcode)."'");
            if(mysqli_num_rows($sql_ss)>0)
            {
                $sql_bar=mysqli_fetch_object($sql_ss);
                // echo json_encode($barcode);
                
                     $data =array(
                         
                         'id'=>$sql_bar->id,
                         'rack'=>$sql_bar->rack,
                         'barcode'=>$sql_bar->barcode_no,
                         'warehouse'=>$sql_bar->warehouse,
                         'st'=>($sql_bar->status=='0') ? 'Disabled' : 'Enabled',
                         'creation_date'=>date('d F Y',strtotime($sql_bar->creation_date))
                         );
                     header('Content-Type: application/json');
                     echo json_encode($data);
            }
            else
            {
            	 $wrong['wrong'] = "Barcode does not Exist";
            	 header('Content-Type: application/json');
                 echo json_encode($wrong);
            }
        }
        elseif($type=='2')
        {
            $sqlss = mysqli_query($db_handle,"SELECT p.barcode_no,p.quantity,p.total_price,p.id,p.creation_date,s.name FROM tbl_products p LEFT JOIN tbl_sku s ON p.sku=s.id WHERE p.barcode_no='".mysqli_real_escape_string($db_handle,$barcode)."'");
            
            if(mysqli_num_rows($sqlss)>0)
            {
                // $count=mysqli_num_rows($sqlss);
                // header('Content-Type: application/json');
                // echo json_encode($count);
                $sql_bar=mysqli_fetch_object($sqlss);
                // echo json_encode($count);
                
                     $data =array(
                         
                         'id'=>$sql_bar->id,
                         'barcode_no'=>$sql_bar->barcode_no,
                         'quantity'=>$sql_bar->quantity,
                         'total_price'=>$sql_bar->total_price,
                         'sku'=>$sql_bar->name,
                         'creation_date'=>date('d F Y',strtotime($sql_bar->creation_date))
                         );
                     header('Content-Type: application/json');
                     echo json_encode($data);
            }
            else
            {
            	 $wrong['wrong'] = "Barcode does not Exist";
            	 header('Content-Type: application/json');
                 echo json_encode($wrong);
            }
        }
        elseif($type=='3')
        {
            $sqlss = mysqli_query($db_handle,"SELECT cp.barcode_no,cp.quantity,cp.total_price,cp.id,cp.creation_date,s.name FROM tbl_combo_product cp LEFT JOIN tbl_sku s ON cp.sku=s.id WHERE cp.barcode_no='".mysqli_real_escape_string($db_handle,$barcode)."'");
            
            if(mysqli_num_rows($sqlss)>0)
            {
                // $count=mysqli_num_rows($sqlss);
                // header('Content-Type: application/json');
                // echo json_encode($count);
                $sql_bar=mysqli_fetch_object($sqlss);
                // echo json_encode($count);
                
                     $data =array(
                         
                         'id'=>$sql_bar->id,
                         'barcode_no'=>$sql_bar->barcode_no,
                         'quantity'=>$sql_bar->quantity,
                         'total_price'=>$sql_bar->total_price,
                         'sku'=>$sql_bar->name,
                         'creation_date'=>date('d F Y',strtotime($sql_bar->creation_date))
                         );
                     header('Content-Type: application/json');
                     echo json_encode($data);
            }
            else
            {
            	 $wrong['wrong'] = "Barcode does not Exist";
            	 header('Content-Type: application/json');
                 echo json_encode($wrong);
            }
        }
        
?>