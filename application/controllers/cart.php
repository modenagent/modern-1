<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
ob_start();
// cart class
class Cart extends CI_Controller {
	// constructor
	public function __construct()
	{
		parent::__construct();		
	}
	// default function
	public function index()
	{	
		// blank
	}
	// add cart Path A
	public function cart_add()
	{
		$userId = $data['user_id'] = $this->session->userdata('userid');
		if($userId){
			if($_POST["type"] == 'cart_add'){
				$productId = $_POST['product_id'];
				$projectId = $_POST['project_id'];
				// flyer content
				$flyer_content =  $_POST['content'];
				/* get the image data */
		     	$data = $_POST['content_svg'];
		     	/* remove the prefix */
		      	$uri =  substr($_POST['image'],strpos($_POST['image'],",") + 1);
		      	$file = 'assets/uploads/user_flyer_img/'.uniqid().time().'.png'; 
		      	file_put_contents($file, base64_decode($uri));
				// flyer svg file
				$svgFileName = 'assets/uploads/user_flyer_svg/'.uniqid().time().'.svg';
		      	file_put_contents($svgFileName, $data);
		      	// flyer pdf
				$this->load->library('mpdf');
				$mpdf=new mPDF('','Letter','','',0,-5,0,-5); 
				$html = '<img src="'.$svgFileName.'" width="100%" />';
				$mpdf->WriteHTML($html);
				$pdfFileName = 'assets/uploads/user_flyer_pdf/'.uniqid().time().'.pdf';
				$mpdf->Output($pdfFileName,'F'); 
		    	// update flyer image and pdf file into myflyer table
		    	$updateData = array(
		    		'flyer_content' => $flyer_content,
		    		'flyer_image' => $file,
		    		'flyer_pdf' => $pdfFileName,
		    		'product_id_fk' => $productId,
		    		'is_draft' => 'Y'
		    		);
		    	// print_r($updateData)
		    	$updateFlyerTable = $this->base_model->update_record_by_id('lp_my_flyers', $updateData,array('project_id_pk' => $projectId)); 
				// get image from product id
				$myProductImg = $this->base_model->get_record_result_array( 'lp_product_mst', array('product_id_pk' => $productId) );
				// $project_image = $myProductImg[0]['product_image'];
				// get project name from project id
				$myProject = $this->base_model->get_record_result_array( 'lp_my_flyers', array('project_id_pk' => $projectId) );
				$project_name = $myProject[0]['project_name'];
				$project_image = $myProject[0]['flyer_image'];
				// set cart data
				$data = array(
					'id' => $productId,
					'name' => $project_name,
					'price' => 2,
					'qty' => 1,
					'image' => $project_image,
					'options' => array(
						'project_id' => $projectId
						)
				);
				// $data_items = array(
			 //       'id'      => $tickedID,
			 //       'qty'     => 1,
			 //       'price'   => $ticketPrice,
			 //       'name'    => $someName,
			 //       'options' => array('category'=>$ticketCategory)
			 //    );
				// print_r($data);
				// cart destroy
				// print_r($this->cart->contents());
				if($this->cart->contents()){
		            $this->cart->destroy();
	          	}
	          	// insert into cart
				$result = $this->cart->insert($data);
				// print_r($this->cart->contents());
				// die();
				if($result){
					
					$resp = array(
						'status' => 'success',
						'msg' => 'Flyer is added to cart.'
					);
					echo json_encode($resp);
				}else{
					
					$resp = array(
						'status' => 'failed',
						'msg' => 'Flyer is adding failed into cart.'
					);
					echo json_encode($resp);
				}
			}	
		}else{
			redirect('frontend/index');
		}		
	}
	// add cart Path B
	public function cart_add_2()
	{
		$userId = $data['user_id'] = $this->session->userdata('userid');
		if($userId){
			if($_POST["type"] == 'cart_add'){
				$productId = $_POST['product_id'];
				$projectId = $_POST['project_id'];
				// flyer content
				$flyer_content =  $_POST['content'];
				/* get the image data */
		     	$data = $_POST['content_svg'];
		     	/* remove the prefix */
		      	$uri =  substr($_POST['image'],strpos($_POST['image'],",") + 1);
		      	$file = 'assets/uploads/user_flyer_img/'.uniqid().time().'.png'; 
		      	file_put_contents($file, base64_decode($uri));
				// flyer svg file
				$svgFileName = 'assets/uploads/user_flyer_svg/'.uniqid().time().'.svg';
		      	file_put_contents($svgFileName, $data);
		      	// flyer pdf
				$this->load->library('mpdf');
				$mpdf=new mPDF('','Letter','','',0,-5,0,-5); 
				$html = '<img src="'.$svgFileName.'" width="100%" />';
				$mpdf->WriteHTML($html);
				$pdfFileName = 'assets/uploads/user_flyer_pdf/'.uniqid().time().'.pdf';
				$mpdf->Output($pdfFileName,'F'); 
		    	// update flyer image and pdf file into myflyer table
		    	$updateData = array(
		    		'flyer_content' => $flyer_content,
		    		'flyer_image' => $file,
		    		'flyer_pdf' => $pdfFileName,
		    		'product_id_fk' => $productId,
		    		'is_draft' => 'Y'
		    		);
		    	// print_r($updateData)
		    	$updateFlyerTable = $this->base_model->update_record_by_id('lp_my_flyers', $updateData,array('project_id_pk' => $projectId)); 
				// get image from product id
				$myProductImg = $this->base_model->get_record_result_array( 'lp_product_mst', array('product_id_pk' => $productId) );
				// $project_image = $myProductImg[0]['product_image'];
				// get project name from project id
				$myProject = $this->base_model->get_record_result_array( 'lp_my_flyers', array('project_id_pk' => $projectId) );
				$project_name = $myProject[0]['project_name'];
				$project_image = $myProject[0]['flyer_image'];
				// set cart data
				$data = array(
					// pdf price array
					array(
						'id'      => 'pdf_price_id',
                       	'qty'     => 1,
                       	'price'   => 2,
                       	'name'    => 'PDF Flyer',
                       	'options' => array(
                       		'is_flag' => 'product_detail'
                       		)
						),
					// cart item array
					array(
						'id' => $productId,
						'name' => $project_name,
						'price' => 12,
						'qty' => 1,
						'image' => $project_image,
						'options' => array(
								'project_id' => $projectId,
								'is_flag' => 'cart_item',
								'flyer_qnt' => 25
							)
						),					
					// shipping array
					array(

						'id'      => 'shipping_price_id',
                       	'qty'     => 1,
                       	'price'   => 6,
                       	'name'    => 'Flat Fee Shipping',
                       	'options' => array(
                       		'is_flag' => 'product_detail'
                       		)
						)
				);
				
				// cart destroy
				if($this->cart->contents()){
		            $this->cart->destroy();
	          	}
				// insert into cart
				$result = $this->cart->insert($data);
				
				// $this->session->set_flashdata('message', 'Product Has been added to cart.');
				if($result){
					$resp = array(
						'status' => 'success',
						'msg' => 'Flyer is added to cart.'
					);
					echo json_encode($resp);
				}else{
					$resp = array(
						'status' => 'failed',
						'msg' => 'Flyer is adding failed into cart.'
					);
					echo json_encode($resp);
				}
			}	
		}else{
			redirect('frontend/index');
		}		
	}
	// cart item count show Path A
	public function cart_item_count()
	{
		$userId = $data['user_id'] = $this->session->userdata('userid');
		if($userId){
			if($_POST["type"] == 'cart_item'){
				// $count = $this->cart->total_items();
				$item_show = "";
				$item_show .= '<div>';
							foreach($this->cart->contents() as $items){
								if($items['name'] != "coupon"){
									$count = $count + 1;
				$item_show .= '<div class="row">
                                    <div class="col-xs-3">
                                        <img class="img-responsive" src="'.site_url().$items['image'].'">
                                    </div>
                                    <div class="col-xs-7">
                                        <h4 class="panel-title"><strong>'.$items['name'].'</strong></h4>
                                        <p> $ '.$items['price'].'</p>
                                    </div>
                                    <div class="col-xs-2 col-md-2">
                                    	<a href="javascript:;" class="btn btn-danger btn-xs" onclick="item_remove(\''.$items['rowid'].'\');"><i class="fa fa-times"></i></a>
                                	</div>
                                  
                                </div> <hr>';  
                                }                          
                            }
                $item_show .= '</div>
                			<a href="'.site_url().'user/checkout_order" class="btn-primary btn btn-block">Checkout Now</a>
							<a href="'.site_url().'user/dashboard" class="btn-info btn btn-block">Countinue Shopping</a>';
				if($count){
					$resp = array(
						'status' => 'success',
						'data' => $count,
						'details' => $item_show
					);
					echo json_encode($resp);
				}else{
					$item_show = '<div align="center"><h4>No Data</h4></div>';
					$resp = array(
						'status' => 'success',
						'msg' => 'Cart Empty',
						'data' => 0,
						'details' => $item_show
					);
					echo json_encode($resp);
				}

			}
		}
	}
	// cart item count show Path B
	public function cart_item_count_2()
	{
		$userId = $data['user_id'] = $this->session->userdata('userid');
		if($userId){
			if($_POST["type"] == 'cart_item'){
				// $count = $this->cart->total_items();
				$item_show = "";
				$item_show .= '<div>';
				foreach($this->cart->contents() as $items){
								if($items['options']['is_flag'] == "cart_item"){
									if($items['name'] != "coupon"){
										$count = $count + 1;
										$item_show .= '<div class="row">
						                                    <div class="col-xs-3">
						                                        <img class="img-responsive" src="'.site_url().$items['image'].'">
						                                    </div>
						                                    <div class="col-xs-7">
						                                        <h4 class="panel-title"><strong>'.$items['name'].'</strong></h4>
						                                        <p> $ '.$items['price'].'</p>
						                                    </div>
						                                    <div class="col-xs-2 col-md-2">
						                                    	<a href="javascript:;" class="btn btn-danger btn-xs" onclick="item_remove_2(\''.$items['rowid'].'\');"><i class="fa fa-times"></i></a>
						                                	</div>
						                                  
						                                </div> <hr>';  
	                                } 
	                            }                         
                }
                $item_show .= '</div>
                			<a href="'.site_url().'user/checkout_order_2" class="btn-primary btn btn-block">Checkout Now</a>
							<a href="'.site_url().'user/dashboard" class="btn-info btn btn-block">Countinue Shopping</a>';
				if($count){
					$resp = array(
						'status' => 'success',
						'data' => $count,
						'details' => $item_show
					);
					echo json_encode($resp);
				}else{
					$item_show = '<div align="center"><h4>No Data</h4></div>';
					$resp = array(
						'status' => 'success',
						'msg' => 'Cart Empty',
						'data' => 0,
						'details' => $item_show
					);
					echo json_encode($resp);
				}

			}
		}
	}
	// remove cart Path A
	public function cart_remove()
	{
		$userId = $data['user_id'] = $this->session->userdata('userid');
		if($userId){
			if($_POST["type"] == 'cart_remove'){
				$row_id = $_POST['product_id'];
				$data = array(
					'rowid'   => $row_id,
					'qty'     => 0
				);
				$result = $this->cart->update($data);
				if($result){
					$resp = array(
						'status' => 'success',
						'msg' => 'Flyer removed from cart.'
					);
					echo json_encode($resp);
				}

			}
		}
	}
	// remove cart Path B
	public function cart_remove_2()
	{
		$userId = $data['user_id'] = $this->session->userdata('userid');
		if($userId){
			if($_POST["type"] == 'cart_remove'){
				$row_id = $_POST['product_id'];
				$data = array(
					'rowid'   => $row_id,
					'qty'     => 0
				);
				$result = $this->cart->update($data);
				if($result){
					$resp = array(
						'status' => 'success',
						'msg' => 'Flyer removed from cart.'
					);
					echo json_encode($resp);
				}

			}
		}
	}
	// cart item list Path A
	public function cart_item_list()
	{
		$userId = $data['user_id'] = $this->session->userdata('userid');
		if($userId){
			if($_POST["type"] == 'cart_item_list'){
				// $count = $this->cart->total_items();
				$item_show = "";	
				$item_show .= '<table class="table table-cart table-responsive">
		                        <thead>
		                            <tr>
		                                <th>Item</th>
		                                <th>Project name</th>
		                                <th>PDF Price</th>
		                                <th>Print Quantity</th>
		                                <th>Total</th>
		                                <th>Action</th>
		                            </tr>
		                        </thead>
		                        <tbody>';	
		                        $count = 0;		
								foreach($this->cart->contents() as $items){
									if($items['name'] != "coupon"){
										$count = $count + 1;
		                				$item_show .='<tr>
			                                <td><img alt="" class="img-center" src="'.site_url().$items["image"].'"></td>
			                                <td>'.$items["name"].'</td>
			                                <td>'.$items["price"].'</td>
			                                <td>'.$items["qty"].'</td>
			                                <td>'.$items["subtotal"].'</td>
			                                <td><a href="#" class="btn btn-danger" onclick="item_remove(\''.$items['rowid'].'\');"><i class="fa fa-times"></i></td>
			                            </tr>';
			                        }
	                        }
	                $item_show .= '</tbody>
                    </table>';
                    $amount_show = '';
                    $amount_show .= '<table class="table table-cart-subtotal">                                            
                                            <thead>
                                                <th><b>Product Details</b></th>
                                                <th class="text-right"> <span class="amount"><b>Price</b></span></th>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <th>Total</th>';
                                                    $subtotal = 0; $discount=0;
                                                    foreach($this->cart->contents() as $items){
														if($items['name'] == "coupon"){
										                    $discount+=$items['subtotal'];
									                  	}else{
									                    	$subtotal += $items['subtotal'];  
									                  	}
													}
													$grandtotal = $subtotal-$discount;
                                                    $amount_show .= '<td class="text-right"><b>$ '.$grandtotal.'</b></td>
                                                </tr>
                                            </tbody>
                                        </table>';
                    if($count){
						$resp = array(
							'status' => 'success',							
							'details' => $item_show,
							'cart_amt' => $amount_show
						);
						echo json_encode($resp);
					}else{
						$item_show = '<div align="center"><h4>No Data</h4></div>';
						$resp = array(
							'status' => 'success',
							'msg' => 'Cart Empty',							
							'details' => $item_show,
							'cart_amt' => $amount_show
						);
						echo json_encode($resp);
					}
			}
		}
	}
	// cart item list 2 Path B
	public function cart_item_list_2()
	{
		$userId = $data['user_id'] = $this->session->userdata('userid');
		if($userId){
			if($_POST["type"] == 'cart_item_list'){
				// $count = $this->cart->total_items();
				$item_show = "";	
				$item_show .= '
								<table class="table table-cart table-responsive">
		                        <thead>
		                            <tr>
		                                <th>Item</th>
		                                <th>Product name</th>
		                                <th>Price</th>
		                                <th>Quantity</th>
		                                <!--<th>Total</th>-->
		                                <th>Action</th>
		                            </tr>
		                        </thead>
		                        <tbody>';	

		                       
		                        $count = 0;		
		                        foreach ($this->cart->contents() as $item) {
		                        	
		                        	if($item['options']['is_flag'] == "cart_item"){
		                        		$count++;
		                        	}
		                        }		                        
		                        if($count==0){
		                        	foreach ($this->cart->contents() as $item) {
		                        		$data = array(
											'rowid'   => $item['rowid'],
											'qty'     => 0
										);
										$result = $this->cart->update($data);
		                        	}
		                        }
		                        $count=0;
								foreach($this->cart->contents() as $items){
									// print_r($items);
									if($items['options']['is_flag'] == "cart_item"){																		
										if($items['name'] != "coupon"){
											$count = $count + 1;
											switch ($items['price']){									          
									          case '12':
									          $qnt_25 = "selected=selected";
									          break;  
									          case '22':
									          $qnt_75 = "selected=selected";
									          break;  									         
									          case '28':
									          $qnt_100 = "selected=selected";
									          break;    
									          case '49':
									          $qnt_200 = "selected=selected";
									          break; 									          
									        }
						                	$item_show .='<tr>
							                                <td><img alt="" class="img-center" src="'.site_url().$items["image"].'"></td>
							                                <td>'.$items["name"].'</td>
							                                <!--<td>'.$items["price"].'</td>-->
							                                <td> 2 </td>
							                                <td>
							                                   	<select id="'.$items['rowid'].'" onchange="flyer_qnty(this);" >																 
																  <option value="12" '.$qnt_25.'>25</option>																 
																  <option value="22" '.$qnt_75.'>75</option>
																  <option value="28" '.$qnt_100.'>100</option>																  
																  <option value="49" '.$qnt_200.'>200</option>
																</select> 	                                
							                                </td>
							                                <!--<td>'.$items["subtotal"].'</td>-->
							                                <td><a href="#" class="btn btn-danger" onclick="item_remove_2(\''.$items['rowid'].'\');"><i class="fa fa-times"></i></td>
							                            </tr>';
			                        }
	                    		}
	                        }
	                $item_show .= '</tbody>
                    </table>';
                    $amount_show = '';
                    $amount_show .= '<table class="table table-cart-subtotal">                                            
                                            <thead>
                                                <th><b>Product Details</b></th>
                                                <th class="text-right"> <span class="amount"><b>Price</b></span></th>
                                            </thead>
                                            <tbody>';
                                            foreach($this->cart->contents() as $items){
                                            	// echo $items['option']['is_flag'];
                                            	if($items['options']['is_flag'] == "product_detail"){	
                                            	$amount_show .= '<tr>
                                                    <th>'.$items["name"].'</th>
                                                    <td class="text-right"><span class="amount">$ '.$items["price"].'</span></td>
                                                </tr>';
                                            	}elseif($items['options']['is_flag'] == "cart_item"){	
                                            		switch ($items['price']){									          
											          case '12':
											          $qnt = 25;
											          break;  
											          case '22':
											          $qnt = 75;
											          break;  									         
											          case '28':
											          $qnt = 100;
											          break;    
											          case '49':
											          $qnt = 200;
											          break; 									          
											        }
                                                $amount_show .= '<tr>
                                                    <th>Printing Qty ('.$qnt.')</th>
                                                    <td class="text-right"><span class="amount">$ '.$items['subtotal'].'</span></td>
                                                </tr>';
                                            	}elseif($items['options']['is_flag'] == "product_detail"){
                                                $amount_show .= '<tr>
                                                    <th>'.$items["name"].'</th>
                                                    <td class="text-right"><span class="amount">$ '.$items["price"].'</span></td>
                                                </tr>
                                                <tr>';
                                            	}
                                            }
                                                    $amount_show .= '<th>Total</th>';
                                                    $subtotal = 0; $discount=0;
                                                    foreach($this->cart->contents() as $items){
														if($items['name'] == "coupon"){
										                    $discount+=$items['subtotal'];
									                  	}else{
									                    	$subtotal += $items['subtotal'];  
									                  	}
													}
													$grandtotal = $subtotal-$discount;
                                                    $amount_show .= '<td class="text-right"><b>$ '.$grandtotal.'</b></td>
                                                </tr>
                                            </tbody>
                                        </table>';
                    if($count){
						$resp = array(
							'status' => 'success',							
							'details' => $item_show,
							'cart_amt' => $amount_show
						);
						echo json_encode($resp);
					}else{
						$item_show = '<div align="center"><h4>No Data</h4></div>';
						$resp = array(
							'status' => 'success',
							'msg' => 'Cart Empty',							
							'details' => $item_show,
							'cart_amt' => $amount_show
						);
						echo json_encode($resp);
					}
			}
		}
	}
	// invoice number generate
	private function generateInvoice() {
         //return substr(str_shuffle("0123456789"), 0, 3); commented by vijay
		
		$invoice_no = $this->session->userdata('userid').'-'.mt_rand(100101,9999999);
		return $invoice_no;
    }
	// use my credits
	public function usemycredits()
	{
		$userId = $data['user_id'] = $this->session->userdata('userid');
		if($userId){
			if($_POST["type"] == 'my_credits'){
				$amt = $_POST['amt'];
				$table = "lp_user_mst";
				$where = array(
					'user_id_pk' => $userId
					);
				$getCredits = $this->base_model->get_record_by_id($table,$where); 
				$credits = $getCredits->user_credits;
				if($credits > 0 && $credits >= $amt ){
					$balCredits = $credits - $amt;
					$data = array(
						'user_credits' => $balCredits
						);
					$result = $this->base_model->update_record_by_id($table,$data,$where); 
					if($result){
						// generate invoice and send mail with flyers
						// get coupon id
	                    foreach ($this->cart->contents() as $items) {                  
	                      if($items['name'] == "coupon"){
	                        $couponId = $items['id'];
	                        $proj_id = $items['options']['project_id'];
	                      }else{
	                        $couponId = NULL; 
	                        $proj_id = $items['options']['project_id']; 
	                      }
	                    } 
	                    // insert into my cart table
	                    $data = array(
	                      'user_id_fk' => $userId,
	                      'paid_on' => date('Y-m-d'),
	                      'txn_id' => $response->id,
	                      'is_success' => 'Y',
	                      'total_amount' => $amt,
	                      'coupon_id_fk' => $couponId,
	                      'project_id_fk' => $proj_id

	                      );
	                    $result2 = $this->base_model->insert_one_row('lp_my_cart',$data); 
	                    if($result2){	                    	
					    	// insert invoice data
	                      $lastId2 = $this->base_model->get_last_insert_id();
	                      // update mycart table
	                    	$updateData = array(
					    		'is_draft' => 'N'
					    		);
					    	// print_r($updateData)
					    	$updateFlyerTable = $this->base_model->update_record_by_id('lp_my_flyers', $updateData,array('project_id_pk' => $proj_id)); 
	                      $data2 = array(
	                        'invoice_num' => 'INV'.$this->generateInvoice(),
	                        'cart_id_fk' => $lastId2,
	                        'user_id_fk' => $userId,
	                        'invoice_amount' => $amt,
	                        'invoice_date' => date('Y-m-d'),
	                        'invoice_to' => $users[0]['first_name'],
	                        'invoice_addr' => $users[0]['city']
	                        );
	                      $result3 = $this->base_model->insert_one_row('lp_invoices',$data2);
	                      if($result3){
	                        $lastId3 = $this->base_model->get_last_insert_id();
	                        // redirect('user/checkout_deliver/'.$lastId3);
	                        $resp = array(
								'status' => 'success',
								'msg' => 'Payment successfully done.',
								'last_invoice_id' => $lastId3					
							);
							echo json_encode($resp);
	                      }
	                    }						
					}else{
						$resp = array(
							'status' => 'error',
							'msg' => 'Credit could not be detucted.'					
						);
						echo json_encode($resp);
					}
				}else{
					$resp = array(
						'status' => 'error',
						'msg' => 'Credit is insufficient.'					
					);
					echo json_encode($resp);
				}
			}
		}
	}		
	public function usemycredits_2()
	{
		$userId = $data['user_id'] = $this->session->userdata('userid');
		if($userId){
			if($_POST["type"] == 'my_credits'){
				$amt = $_POST['amt'];
				$table = "lp_user_mst";
				$where = array(
					'user_id_pk' => $userId
					);
				$getCredits = $this->base_model->get_record_by_id($table,$where); 
				$credits = $getCredits->user_credits;
				if($credits > 0 && $credits >= $amt ){
					$balCredits = $credits - $amt;
					$data = array(
						'user_credits' => $balCredits
						);
					$result = $this->base_model->update_record_by_id($table,$data,$where); 
					if($result){
						// generate invoice and send mail with flyers
						// get coupon id
	                    foreach ($this->cart->contents() as $items) {  
		                    if($items['options']['is_flag'] == "cart_item"){
		                    	if($items['name'] == "coupon"){
			                        $couponId = $items['id'];
			                        $proj_id = $items['options']['project_id']; 
			                      }else{
			                        $couponId = NULL;  
			                        $proj_id = $items['options']['project_id']; 
			                      }
		                    }                
	                      
	                    } 
	                    // insert into my cart table
	                    $data = array(
	                      'user_id_fk' => $userId,
	                      'paid_on' => date('Y-m-d'),
	                      'txn_id' => $response->id,
	                      'is_success' => 'Y',
	                      'total_amount' => $amt,
	                      'coupon_id_fk' => $couponId,
	                      'project_id_fk' => $proj_id

	                      );
	                    $result2 = $this->base_model->insert_one_row('lp_my_cart',$data); 
	                    if($result2){
	                      $lastId2 = $this->base_model->get_last_insert_id();
	                      $data2 = array(
	                        'invoice_num' => 'INV'.$this->generateInvoice(),
	                        'cart_id_fk' => $lastId2,
	                        'user_id_fk' => $userId,
	                        'invoice_amount' => $amt,
	                        'invoice_date' => date('Y-m-d'),
	                        'invoice_to' => $users[0]['first_name'],
	                        'invoice_addr' => $users[0]['city']
	                        );
	                      $result3 = $this->base_model->insert_one_row('lp_invoices',$data2);
	                      if($result3){
	                      	$lastId3 = $this->base_model->get_last_insert_id();
	                      	// update mycart table
	                    	$updateData = array(
					    		'is_draft' => 'N'
					    		);
					    	// print_r($updateData)
					    	$updateFlyerTable = $this->base_model->update_record_by_id('lp_my_flyers', $updateData,array('project_id_pk' => $proj_id)); 
	                        
	                        // redirect('user/checkout_deliver/'.$lastId3);
	                        $resp = array(
								'status' => 'success',
								'msg' => 'Payment successfully done.',
								'last_invoice_id' => $lastId3					
							);
							echo json_encode($resp);
	                      }
	                    }						
					}else{
						$resp = array(
							'status' => 'error',
							'msg' => 'Credit could not be detucted.'					
						);
						echo json_encode($resp);
					}
				}else{
					$resp = array(
						'status' => 'error',
						'msg' => 'Credit is insufficient.'					
					);
					echo json_encode($resp);
				}
			}
		}
	}	
	// update cart
	function update_cart()
	{
		$userId = $data['user_id'] = $this->session->userdata('userid');
		if($userId){
			if($_POST){
				$row_id = $_POST['product_id'];
				$quantity = $_POST['fqnt'];
				$price = $_POST['famt'];
				$amount = $price * 1 ;
				// $amount = $price + 2 ;

				$data = array(					
					'rowid'   => $row_id,
					'qty'     => 1,
					'price'   => $price,
					'amount'  => $amount,
					'options' => array(							
							'flyer_qnt' => $quantity
						)
				);
				
				$result = $this->cart->update($data);				
				if($result){
					$resp = array(
						'status' => 'success',
						'msg' => 'Flyer quantity updated for your cart.'
					);
					echo json_encode($resp);
				}

			}
		}
		
	}
// cart class ends here 
}