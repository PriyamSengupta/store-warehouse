<?php
include_once("config.php");
                        
                    $sqlview = mysqli_query($db_handle,"SELECT * FROM tbl_combo_product ORDER BY id DESC");
				    if(mysqli_num_rows($sqlview)>0)
                    {
						while($record=mysqli_fetch_object($sqlview))
						{ 
						        $warehouse_id=$record->warehouse_id;
                                $sqlWh=mysqli_query($db_handle,"SELECT name FROM tbl_warehouse WHERE id='".$warehouse_id."'");
                                $result=mysqli_fetch_object($sqlWh);
                                $warehouse_name=$result->name;
                                
                                $rack_id=$record->rack_id;
                                $sqlrc=mysqli_query($db_handle,"SELECT name FROM tbl_rack WHERE id='".$rack_id."'");
                                $result1=mysqli_fetch_object($sqlrc);
                                $rack_name=$result1->name;
                                
                                $sku_id=$record->sku;
                                $sqlsku=mysqli_query($db_handle,"SELECT name FROM tbl_sku WHERE id='".$sku_id."'");
                                $result2=mysqli_fetch_object($sqlsku);
                                $sku_name= $result2->name;
                                
                                $data['combo_list'][]=array(
                                    'id'=>$record->id,
                                    'warehouse'=>$warehouse_name,
                                    'rack'=>$rack_name,
                                    'sku'=>$sku_name,
                                    'quantity'=>$record->quantity,
                                    'unit_price'=>$record->price,
                                    'total_price'=>$record->total_price
                                    );
						}        
                    }
                    else
                    {
                        $data['combo_list']=[];
                    }
                    print(json_encode($data));
                    mysqli_close($db_handle);
?>