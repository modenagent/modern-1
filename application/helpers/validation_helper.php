<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * validate all parameters
 * Avtr Gour <developer.avtargaur@gmail.com
 * Jan 26, 2019
 */
function validate_my_params($params = array(), $is_post = 2){
	$CI = &get_instance();
	$errors 	=	array();
	if(count($params) > 0) {
		$return_vars = array();

		foreach($params as $param => $options) {
			$i = trim($CI->input->get_post($param, TRUE));			
			
			if($is_post == 1) {
				if($CI->input->post($param, TRUE) !='') {
					$i = trim($CI->input->post($param, TRUE));
				}

			} elseif($is_post == 0) {
				if($CI->input->get($param, TRUE) != '') {
					$i = trim($CI->input->get($param, TRUE));
				}

			}
			elseif($is_post == 2)
			{
				if($CI->input->get_post($param, TRUE) !=''){
					$i = trim($CI->input->get_post($param, TRUE));
				}
			}

			if($param == 'body')
				$i = trim($CI->input->get_post($param));


			if($param == 'svgPreview')
			{
				if($CI->input->get_post($param) !=''){

					$i = trim($CI->input->get_post($param));
				}

			}

			$options = explode('|',$options);

			$content_flag = 0;
			$valid_content_fields = array('content','comment','description','name','title','message', );

			if(in_array($param, $valid_content_fields) && $is_post == 1)
			{
				$content_flag = 1;

				//replacing % with html code (Kenrick Vaz, 16 April 2013)
				$i = str_replace('%', '&#37;', $i);
			}

			foreach($options as $option) {

				if($i == '') {
					$i = NULL;
				}

				if($option != "" && $option != NULL) {

					if (($i === FALSE || $i == "" || $i == NULL) && $option == "required") {
						$errors['status'] 	=	'failure';
						$errors['errors'] 	=	'Missing or empty parameter `'. $param .'`';

						return $errors;
					} elseif($i != NULL && $i !== FALSE && $i != NULL) {

						if($option == 'valid_email')
						{
							$i = strtolower($i);
						}

						if($CI->form_validation->valid_email($i) == 0 && $option == 'valid_email')
						{

							$errors['status'] 	=	'failure';
							$errors['errors'] 	=	'Invalid Email Address passed';

							return $errors;

						}
						elseif($option == 'valid_date' && valid_datetime($i) == FALSE )
						{

							$errors['status'] 	=	'failure';
							$errors['errors'] 	=	'Invalid Date format passed';

							return $errors;

						}
						elseif($option == 'valid_datetime' && valid_datetime($i,1) == FALSE )
						{
							$errors['status'] 	=	'failure';
							$errors['errors'] 	=	'Invalid Date format passed';

							return $errors;

						}
						elseif($option == 'valid_phone' && my_valid_phone($i) == 0)
						{

							$errors['status'] 	=	'failure';
							$errors['errors'] 	=	'Invalid phone number passed';

							return $errors;

						}
						elseif( sb_color_hex($i) == 0 && sb_color_rgb($i) == 0 && $option == 'valid_color')
						{

							$errors['status'] 	=	'failure';
							$errors['errors'] 	=	'Invalid color';

							return $errors;
						}
						elseif($CI->form_validation->valid_ip($i) == 0 && $option == 'valid_ip')
						{


							$errors['status'] 	=	'failure';
							$errors['errors'] 	=	'Invalid IP';

							return $errors;

						}
						elseif($CI->form_validation->integer($i) == FALSE && $option == 'integer')
						{

							$errors['status'] 	=	'failure';
							$errors['errors'] 	=	'Only integers allowed for `'. $param .'`';

							return $errors;

						}
						elseif($CI->form_validation->is_natural_no_zero($i) == FALSE && $option == 'is_natural_no_zero')
						{

							$errors['status'] 	=	'failure';
							$errors['errors'] 	=	'The `Number of persons` field must contain a number greater than zero.' ;

							return $errors;

						}
						elseif($CI->form_validation->numeric($i) == FALSE && $option == 'numeric')
						{

							$errors['status'] 	=	'failure';
							$errors['errors'] 	=	'Only numbers allowed for `'. $param .'`';

							return $errors;

						}
						elseif($CI->form_validation->alpha($i) == FALSE && $option == 'alpha')
						{
							$errors['status'] 	=	'failure';
							$errors['errors'] 	=	'Only alphabets allowed for `'. $param .'`';

							return $errors;

						}
						elseif(strstr($option,'matches'))
						{

							$option = explode('[',$option);
							$option = explode(']',$option[1]);


							if($i !== $CI->input->get_post($option[0]))
							{

								$errors['status'] 	=	'failure';
								$errors['errors'] 	=	'`'. $param .'` does not match `'. $option[0] .'`';

							return $errors;

							}

						}
						elseif($CI->form_validation->numeric_dash($i) == FALSE && $option == 'numeric_dash')
						{

							$errors['status'] 	=	'failure';
							$errors['errors'] 	=	'Underscore separated numeric ';

							return $errors;

						}
						elseif($CI->form_validation->alpha_numeric($i) == FALSE && $option == 'alpha_numeric')
						{

							$errors['status'] 	=	'failure';
							
                                                    if($param=='hashtag'):    
                                                     
                                                        $errors['errors'] 	=	'You can only use letters and numbers in your username.';
                                                    
                                                    else:
                                                        
                                                         $errors['errors'] 	=	'Only alphabets and numbers allowed for `'. $param .'`';
                                                    
                                                    endif;
                                                        
                                                        

							return $errors;

						}
						elseif(strstr($option,'maxLength'))
						{
							$option = explode('[',$option);
							$option = explode(']',$option[1]);
							if($CI->form_validation->max_length($i, $option[0]) == FALSE)
							{

								$errors['status'] 	=	'failure';
								$errors['errors'] 	=	'Max length for `'. $param .'` is '. $option[0];

								return $errors;

							}
						}
						elseif(strstr($option,'minLength'))
						{
							$option = explode('[',$option);
							$option = explode(']',$option[1]);
							if($CI->form_validation->min_length($i, $option[0]) == FALSE)
							{

								$errors['status'] 	=	'failure';
								$errors['errors'] 	=	'Minimum length for `'. $param .'` is '. $option[0];

								return $errors;

							}
						}
						elseif(strstr($option,'exactLength'))
						{
							$option = explode('[',$option);
							$option = explode(']',$option[1]);
							if($CI->form_validation->exact_length($i, $option[0]) == FALSE)
							{

								$errors['status'] 	=	'failure';
								$errors['errors'] 	=	'Exact length for `'. $param .'` is '. $option[0];

								return $errors;

							}
						}
						else
						{

							if(strstr($option,'valid_opts'))
							{
								$option = explode('[',$option);
								$option = explode(']',$option[1]);

								$valid_opts = explode(',',$option[0]);


								if(!in_array($i,$valid_opts))
								{
									$errors['status'] 	=	'failure';
									//$errors['errors'] 	=	'Match required `'. $option[0] .'` `'. $param .'`';
									//$errors['errors'] 	=	'For `'. $param .'` value need to be in `'. $option[0] .'`';
									$errors['errors'] = 'Invalid option passed for '. $param;

									return $errors;
								}

							}

						}
					}

				}


				if($option == 'valid_date')
				{
					$i = valid_datetime($i);
				}
				elseif($option == 'valid_datetime')
				{
					$i = valid_datetime($i,1);
				}

			}

			if($param == 'body'){
				$return_vars[$param] = $i;
			}else{
				$return_vars[$param] = $CI->form_validation->xss_clean($i);
			}
		}

		$return_array 	=	array();

		$return_array['status'] 	=	'success';

		$return_array['data'] 		=	$return_vars;

		return $return_array;
	}
}

/**
 * Color Hex
 *
 * #ffffff
 *
 * @access    public
 * @param    string
 * @return    bool
 */
function sb_color_hex($hex) {
	return (bool)preg_match("/#[a-fA-F0-9]{3,6}/i", $hex);
}

// --------------------------------------------------------------------

/**
 * Color RGB
 *
 * RGB(255, 255, 255)
 *
 * @access    public
 * @param    string
 * @return    bool
 */
function sb_color_rgb($rgb) {
	return (bool)preg_match("/rgb\([0-255]{1,3},\s?[0-255]{1,3},\s?[0-255]{1,3}\)/i", $rgb);
}

/**
 * valid phone
 */
function my_valid_phone($param){
	//echo $param;
	$param	=	trim($param , '+');

	if(is_numeric($param)){
		return 1;
	}else{
		return 0;
	}
	//return ( ! preg_match("/^\+?\(?[0-9]{0,2}\)?\-?[0-9]{10}$/i", $param)) ? 0 : 1;
}

//date validation
function valid_datetime( $str, $is_time = 0 ){
	if($str == null){
		return FALSE;
	}else{
		if(is_numeric($str) == 1 || strlen($str) == 0){
			return FALSE;
		}

		$stamp = strtotime( $str );

		if($stamp	==	 NULL){
			return FALSE;
		}

		$month = date( 'm', $stamp );
		$day   = date( 'd', $stamp );
		$year  = date( 'Y', $stamp );

		if(checkdate($month, $day, $year)){
			if($is_time == 0){
				return $year.'-'.$month.'-'.$day;
			}elseif($is_time == 1){
				return date('Y-m-d H:i:s', $stamp);
			}
		}

		return FALSE;
	}
}

function show_common_success($data){
	$CI= &get_instance();
	$CI->output->set_output(json_encode($return_array));
}

function show_common_error($message , $code, $response_code = 200,$field_name = ''){
	$CI= &get_instance();

	$return_array = array();

	$return_array['status']		=	'failure';
	$return_array['error']		=	$message;

	if($field_name != ''){
		$return_array['field_name'] = 	$field_name;
	}

	$return_array['error_code'] = 	$code;

	$CI->output->set_output(json_encode($return_array));
}

function show_custom_error($message , $code, $response_code = 403,$field_name = ''){
	$CI= &get_instance();

	if($response_code == 401 && $CI->input->get_post('gdiz_strike_web') == '1'){
		//set_access_ip_error();
	}

	$return_array = array();

	$return_array['status']		=	'failure';
	$return_array['error']		=	$message;

	if($field_name != ''){
		$return_array['field_name'] = 	$field_name;
	}

	$return_array['error_code'] = 	$code;

	$CI->output->set_output(json_encode($return_array));
	
}
?>
