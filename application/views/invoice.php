<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
<title>Invoice - ModernAgent</title>
<style>
@page {background:rgb(255,255,255);}
body {background:rgb(255,255,255); margin: 0; padding: 0; font-family: Arial, sans-serif;}
</style>
</head>
<body>
<table width="100%" border="0" cellpadding="0" cellspacing="0" align="center" bgcolor="#ecf0f1"style="background-color: rgb(255,255,255);">
	<tr>
		<td bgcolor="#ecf0f1"align="center" style="background-color: rgb(255,255,255); padding-top:140px;">
			<table width="600" border="0" cellpadding="0" cellspacing="0" align="center" style="padding:35px; border:1px solid black;">
				<tr>
					<td width="600" align="center">
                                            
<!--						<img src="<?php echo base_url("assets/images-2/logo.png"); ?>"/>-->
					</td>
				</tr>
				<tr>
					<td valign="middle" align="center" width="600"style=" padding-top:2px; " >
						<span style=" text-align:center; font-size:30px;     font-family: Montserrat; color: rgb(0,0,0); font-weight: bold; line-height: 36px; ">Thank you for your order!</span>
					</td>
				</tr>
				<tr>
					<td valign="middle" align="center" width="600"style="padding-top:1px; " >
						<br/>
						<span style="text-align: center; font-size: 12px;     font-family: Montserrat; color: rgb(0,0,0); font-weight: normal; text-transform: uppercase; line-height: 18px; margin-bottom:25px;">Your Report Has Been Created.</span>
						<br/><br/><br/>
					</td>
				</tr>
				<tr>
					<td valign="top" width="600" align="center">
						<table width="600">
							<tr>
								<td valign="top" width="420" align="center">
									<table width="420" border="0" cellpadding="0" cellspacing="0" align="center" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;">
										<tr>
											<td valign="middle" width="100%" style="text-align: left;     font-family: Montserrat; font-size: 14px; color: rgb(34, 34, 34); line-height: 24px; font-weight: normal;">
												<span style="font-family: Montserrat font-weight: normal;">Thank you for your order. Below you can find the details of your order. We wish you luck on your real estate appointment.
												<br><br></span>
											</td>
										</tr>
										<tr>
											<td width="100%" height="10"></td>
										</tr>
									</table>
								</td>
								<td valign="top" width="150" align="center" style="padding-left:20px" >
									<table width="150" border="0" cellpadding="0" cellspacing="0" align="center" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;">
										<tr>
											<td width="150" bgcolor="#f15d3e"align="center" style="border-top-left-radius: 3px; border-top-right-radius: 3px; border-bottom-right-radius: 3px; border-bottom-left-radius: 3px; background:none; border: 1px solid #fff;">												
												<table width="150" border="0" cellpadding="0" cellspacing="0" align="center" style="color: rgb(255, 255, 255);background-color: rgb(204,153,100);">
													<tr>
														<td width="100%" height="10" style="font-size: 1px; line-height: 1px;">&nbsp;</td>
													</tr>
													<tr>
														<td valign="top" width="100%" align="center" style="text-align: center; font-size: 14px; font-family: Montserrat; color: rgb(255, 255, 255); font-weight: bold; line-height: 18px; text-transform: uppercase;" >
															<span style="font-family: Montserrat; font-weight: normal;"><a href="<?php echo site_url(); ?>" style="text-decoration: none; color: rgb(255, 255, 255);">ACCOUNT LOGIN</a></span>
														</td>
													</tr>
													<tr>
														<td width="100%" height="10" style="font-size: 1px; line-height: 1px; -webkit-border-radius: 3px; -moz-border-radius: 3px; border-radius: 3px;">&nbsp;</td>
													</tr>
												</table>												
											</td>
										</tr>
									</table>
								</td>
							</tr>							
						</table>						
					</td>
				</tr>
				<tr>
					<td style="line-height:10px;">&nbsp;</td>
				</tr>
				<tr>
					<td width="600" bgcolor="#cc9964" height="60" valign="middle" align="center" style="text-align:left; border-top-right-radius: 3px; border-top-left-radius: 3px; background-color: rgb(204,153,100);">
							<span style="padding-left:25px; font-weight: normal; font-size: 14px; font-weight:800;     font-family: Montserrat; color: rgb(255, 255, 255); line-height: 24px; text-transform: uppercase;">Order & Payment Details</span>														
					</td>
				</tr>
				<tr>
					<td width="600" bgcolor="#ffffff" style="padding:15px; border-bottom-right-radius: 3px; border-bottom-left-radius: 3px; background-color: rgb(255, 255, 255);">
						<table width="600">
							<tr>
								<td valign="top" width="300" style="text-align: left;     font-family: Montserrat; font-size: 14px; color: rgb(34, 34, 34); line-height: 24px; font-weight: normal;">
									<span style="font-family: Montserrat font-weight: normal;">
										<span style="font-family: 'proxima_nova_rgbold', Helvetica; font-weight: normal;">
											<a href="#" style="text-decoration: none; color: rgb(34, 34, 34);">Presentation Address:</a>
										</span>
										<br>
										<span style="font-family: Montserrat font-weight: normal;">
											<span style="color: rgb(163,109,52);"><?php echo $lp_details['property_address']; ?></span>
										</span>
									</span>
								</td>
								<td width="250">
									<table width="250" border="0" cellpadding="0" cellspacing="0" align="center"  style="font-size: 14px;     font-family: Montserrat; color: rgb(34, 34, 34); font-weight: normal;">
										<tr><td colspan="2" height="10" style="font-size:1px;">&nbsp;</td></tr>
										<tr>
											<td width="150" style="text-align: left; line-height: 24px;">
												<span style="font-family: Montserrat">Subtotal</span>
											</td>
											<td width="100" style="text-align: right; line-height: 24px;">
												<span style="font-family: Montserrat">$ <?php echo number_format($total_amount, 2); ?></span>
											</td>
										</tr>
										<tr><td colspan="2" height="10" style="font-size:1px;">&nbsp;</td></tr>
										<tr>
											<td width="150" style="text-align: left; line-height: 24px;">
												<span style="font-family: Montserrat">Discount</span>
											</td>
											<td width="100" style="text-align: right; line-height: 24px;">
												<span style="font-family: Montserrat">- $ <?php echo number_format($discount_amount, 2); ?></span>
											</td>
										</tr>
										
										<tr><td colspan="2" height="5" style="font-size:1px;">&nbsp;</td></tr>
										<tr><td colspan="2" height="10" style="font-size:1px;"><hr></td></tr>
										<tr><td colspan="2" height="5" style="font-size:1px;">&nbsp;</td></tr>
										<tr>
											<td width="150" style="text-align: left; line-height: 24px;">
												<span style="font-family: Montserrat">Total</span>
											</td>
											<td width="100" style="text-align: right; line-height: 24px;">
												<span style="font-family: Montserrat">$ <?php echo number_format($total, 2); ?></span>
											</td>
										</tr>
										<tr><td colspan="2" height="10" style="font-size:1px;">&nbsp;</td></tr>
									</table>															
								</td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td height="30" style="line-height:20px;">&nbsp;</td>
				</tr>
				<tr>
					<td valign="middle" width="600" style="text-align: left;     font-family: Montserrat; font-size: 14px; color: rgb(34, 34, 34); line-height: 24px; font-weight: normal;">
						<span style="font-family: Montserrat font-weight: normal;">If you have any questions please email us @ info@modernagent.io</span>
					</td>
				</tr>
				<tr>
					<td height="5" style="line-height:5px;">&nbsp;</td>
				</tr>
				<tr>
					<td width="600" border="0" height="60" cellpadding="0" cellspacing="0" align="center" bgcolor="#cc9964"style="border-top-left-radius: 3px; border-top-right-radius: 3px; border-bottom-right-radius: 3px; border-bottom-left-radius: 3px; background-color: rgb(204,153,100);     font-family: Montserrat; font-size: 13px; color: rgb(255, 255, 255);">
						<span style="font-family: Montserrat font-weight: normal;">
							<span style="color:#FFFFFF !important;" >&copy; <?php echo date("Y") ?> Modern Agent All rights Reserved</span>
						</span>
					</td>
				</tr>
				<tr>
					<td height="30" style="line-height:35px;">&nbsp;</td>
				</tr>
			</table>	
		</td>
	</tr>
</table>
</body>
</html>
