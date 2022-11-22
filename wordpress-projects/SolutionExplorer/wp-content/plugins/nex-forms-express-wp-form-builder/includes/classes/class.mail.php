<?php
if(!class_exists('NEXForms_mail'))
	{
	class NEXForms_mail{
		
		public 	$nex_forms_id,
				$entry_id,
				$resent;
		
		public function __construct($nex_forms_id='', $entry_id='', $resent=0){
			$this->nex_forms_id = $nex_forms_id;
			$this->entry_id = $entry_id;
			$this->resent = $resent;
		}
		
		public function send_mail(){
		
			global $wpdb;
			$get_form = $wpdb->prepare('SELECT * FROM '.$wpdb->prefix.'wap_nex_forms WHERE Id = %d',$this->nex_forms_id);
			$form_attr = $wpdb->get_row($get_form);
			if($this->resent)
				{
				$get_entry = $wpdb->prepare('SELECT * FROM '.$wpdb->prefix.'wap_nex_forms_entries WHERE Id = %d',$this->entry_id);
				$entry_attr = $wpdb->get_row($get_entry);
				}
			
			$nf_functions = new NEXForms_Functions();
			$nf7_functions = new NEXForms_Functions();
			$database_actions = new NEXForms_Database_Actions();
		/*******************************************************************************************************/
		/************************************* SETUP ATTACHMENTS ***********************************************/
		/*******************************************************************************************************/
			if ( ! function_exists( 'wp_handle_upload' ) ) 
				require_once( ABSPATH . 'wp-admin/includes/file.php' );
			
			if(!function_exists('wp_get_current_user')) {
				include(ABSPATH . "wp-includes/pluggable.php"); 
			}
			$time = md5(time());
			$boundary = "==Multipart_Boundary_x{$time}x";
			
			$insert_file_array = array();
			
			foreach($_FILES as $key=>$file)
				{
				$multi_file_array = array();
				if(is_array($_FILES[$key]['name']))
					{
					foreach($_FILES[$key]['name'] as $mkey => $mval)
						{
						$multi_file_array[$key.'_'.$mkey] = array(
							'name'=>$_FILES[$key]['name'][$mkey],
							'type'=>$_FILES[$key]['type'][$mkey],
							'tmp_name'=>$_FILES[$key]['tmp_name'][$mkey],
							'error'=>$_FILES[$key]['error'][$mkey],
							'size'=>$_FILES[$key]['size'][$mkey]
							);
						}
						$file_names = '';
						foreach($multi_file_array as $ukey=>$ufile)
							{
							$uploadedfile = $multi_file_array[$ukey];
							$upload_overrides = array( 'test_form' => false );
							$movefile = wp_handle_upload( $uploadedfile, $upload_overrides );
							
							if ( $movefile )
								{
								if($movefile['file'])
									{
									$insert_file_array[$uploadedfile['name']] = array(
										'name' 		=> $uploadedfile['name'],
										'type' 		=> $uploadedfile['type'],
										'size' 		=> $uploadedfile['size'],
										'location' 	=> $movefile['file'],
										'url' 		=> $movefile['url'],
										);		
									$set_file_name = str_replace(ABSPATH,'',$movefile['file']);
									$file_names .= get_option('siteurl').'/'.$set_file_name. ',';
									$files[] = $movefile['file'];
									$filenames[] = get_option('siteurl').'/'.$set_file_name;
									}
								}
							else
								{
								echo "Possible file upload attack!\n".$movefile['error'];
								}
							}	
					$_POST[$key] = $file_names;
					}
				else
					{
					$uploadedfile = $_FILES[$key];
					$upload_overrides = array( 'test_form' => false );
					$movefile = wp_handle_upload( $uploadedfile, $upload_overrides );
					
					if ( $movefile )
						{
						if($movefile['file'])
							{
							$insert_file_array[$uploadedfile['name']] = array(
								'name' 		=> $uploadedfile['name'],
								'type' 		=> $uploadedfile['type'],
								'size' 		=> $uploadedfile['size'],
								'location' 	=> $movefile['file'],
								'url' 		=> $movefile['url'],
								);	
							$set_file_name = str_replace(ABSPATH,'',$movefile['file']);
							$set_file_name = str_replace(ABSPATH,'',$movefile['file']);
							$_POST[$key] = get_option('siteurl').'/'.$set_file_name;
							$files[] = $movefile['file'];
							$filenames[] = get_option('siteurl').'/'.$set_file_name;
							}
						}
					else
						{
						echo "Possible file upload attack!\n".$movefile['error'];
						}
					}
				}
				
			
	/*******************************************************************************************************/
	/*********************************** SETUP FORM POST DATA **********************************************/
	/*******************************************************************************************************/
	
			$user_fields 	= '<table width="100%" cellpadding="3" cellspacing="0" style="border:1px solid #ddd;">';
			$i				= 1;
	
			foreach($_POST as $key=>$val)
				{
				if(
				$key!='paypal_invoice' &&
				$key!='paypal_return_url' &&
				$key!='math_result' &&
				$key!='set_file_ext' &&
				$key!='format_date' &&
				$key!='action' &&
				$key!='set_radio_items' &&
				$key!='change_button_layout' &&
				$key!='set_check_items' &&
				$key!='set_autocomplete_items' &&
				$key!='required' &&
				$key!='xform_submit' &&
				$key!='current_page' &&
				$key!='ajaxurl' &&
				$key!='page_id' &&
				$key!='page' &&
				$key!='ip' &&
				$key!='nex_forms_Id' &&
				$key!='company_url' &&
				$key!='submit' &&
				!strstr($key,'real_val')
				)
					{
					$admin_val = '';
					if($val!='NaN')
						{ 
						if(is_array($val))
							{
							foreach($val as $thekey=>$value)
								{
								$admin_val .='- '. $value.' ';
								}
							
							if(array_key_exists('real_val__'.$key.'',$_POST))
									{
									$admin_val = $_POST['real_val__'.$key.''][0];	
									$val = $_POST['real_val__'.$key.''][0];
									}
							
							$user_fields .= '<tr>
												<td width="15%" valign="top" style="border-bottom:1px solid #ddd;border-right:1px solid #ddd; background-color:#f9f9f9;"><strong>'.$nf_functions->unformat_name($key).'</strong></td>
												<td width="85%" style="border-bottom:1px solid #ddd;" valign="top">'.$admin_val.'</td>
											<tr>
											';
							}
						else
							{
							$val = $val;
							$admin_val = $val;
							
							if($admin_val)
								{
								if(array_key_exists('real_val__'.$key,$_POST))
									{
									$admin_val = $_POST['real_val__'.$key];	
									$val = $_POST['real_val__'.$key];
									}
								if(strstr($admin_val,'data:image'))
									$admin_val = '<img src="'.$admin_val.'" />';
								
								$user_fields .= '<tr>
													<td width="30%" valign="top" style="border-bottom:1px solid #ddd;border-right:1px solid #ddd; background-color:#f9f9f9;"><strong>'.$nf_functions->unformat_name($key).'</strong></td>
													<td width="70%" style="border-bottom:1px solid #ddd;" valign="top">'.$admin_val.'</td>
												<tr>
												';
								$pt_user_fields .= ''.$nf_functions->unformat_name($key).':'.$admin_val.'
		';
								}	
							}
						}
					$i++;
					}
				}		
			$user_fields .= '</table>';
		
	/*******************************************************************************************************/
	/***************************************** SETUP EMAILS ************************************************/
	/*******************************************************************************************************/
		$from_address 						= ($form_attr->from_address) 						? $form_attr->from_address												: $default_values['from_address'];
		$from_name 							= ($form_attr->from_name) 							? $form_attr->from_name													: $default_values['from_name'];
		$mail_to 							= ($form_attr->mail_to) 							? $form_attr->mail_to													: $default_values['mail_to'];
		$bcc	 							= ($form_attr->bcc) 								? $form_attr->bcc														: '';
		$bcc_user_mail	 					= ($form_attr->bcc_user_mail) 						? $form_attr->bcc_user_mail	 											: '';
		$subject 							= ($form_attr->confirmation_mail_subject) 			? str_replace('\\','',$form_attr->confirmation_mail_subject) 			:  str_replace('\\','',$default_values['confirmation_mail_subject']);
		$user_subject 						= ($form_attr->user_confirmation_mail_subject) 		? str_replace('\\','',$form_attr->user_confirmation_mail_subject) 		:  $subject;
		$body 								= ($form_attr->confirmation_mail_body) 				? str_replace('\\','',$form_attr->confirmation_mail_body) 				:  str_replace('\\','',$default_values['confirmation_mail_body']);
		$admin_body 						= ($form_attr->admin_email_body) 					? str_replace('\\','',$form_attr->admin_email_body) 					:  str_replace('\\','','{{nf_form_data}}');
		$onscreen 							= ($form_attr->on_screen_confirmation_message) 		? str_replace('\\','',$form_attr->on_screen_confirmation_message) 		:  str_replace('\\','',$default_values['on_screen_confirmation_message']);
		$google_analytics_conversion_code 	= ($form_attr->google_analytics_conversion_code) 	? str_replace('\\','',$form_attr->google_analytics_conversion_code) 	:  str_replace('\\','',$default_values['google_analytics_conversion_code']);
			
		
		if(class_exists('NEXForms_Conditional_Content'))
			{
			$conditional_blocks = new NEXForms_Conditional_Content();
			
			$from_address 	= $conditional_blocks->run_content_logic_blocks($from_address);
			$from_name 		= $conditional_blocks->run_content_logic_blocks($from_name);
			$mail_to 		= $conditional_blocks->run_content_logic_blocks($mail_to); 
			$bcc 			= $conditional_blocks->run_content_logic_blocks($bcc); 
			$bcc_user_mail 	= $conditional_blocks->run_content_logic_blocks($bcc_user_mail);
			$subject 		= $conditional_blocks->run_content_logic_blocks($subject);
			$user_subject 	= $conditional_blocks->run_content_logic_blocks($user_subject);
			$admin_body 	= $conditional_blocks->run_content_logic_blocks($admin_body);
			$body 			= $conditional_blocks->run_content_logic_blocks($body);
			}
	
		//GET GLOBAL EMAIL CONFIGURATION
		$email_config = get_option('nex-forms-email-config');
		if($email_config['email_content']!='pt')
			{
			$body = str_replace(array( "\r"), "<br />", $body);
			$admin_body = str_replace(array( "\r"), "<br />", $admin_body); 
			}
			
		$_REQUEST['nf_form_data']	= ($email_config['email_content']!='pt') ? $user_fields : $pt_user_fields;
		$_REQUEST['nf_from_page'] 	= filter_var($_POST['page'],FILTER_SANITIZE_STRING);
		$_REQUEST['nf_form_id'] 	= filter_var($_POST['nex_forms_Id'],FILTER_SANITIZE_NUMBER_INT);
		$_REQUEST['nf_entry_id']	= $this->entry_id;
		$_REQUEST['nf_entry_date'] 	= date('Y-m-d H:i:s');
		$_REQUEST['nf_user_ip'] 	= $_SERVER['REMOTE_ADDR'];
		$_REQUEST['nf_form_title'] 	= $form_attr->title;
		$_REQUEST['nf_user_name'] 	= $database_actions->get_username(get_current_user_id());
		$pattern = '({{+([A-Za-z 0-9_-])+}})';		
		
		//$body = str_replace('[]','',$body);
		//$admin_body = str_replace('[]','',$body);
		
		//SETUP VALUEPLACEHOLDER - USER EMAIL
		preg_match_all($pattern, $body, $matches);
			foreach($matches[0] as $match)
				{
				$the_val = '';
				if(is_array($_REQUEST[$nf_functions->format_name($match)]))
					{
					foreach($_REQUEST[$nf_functions->format_name($match)] as $thekey=>$value)
						{
						$the_val .='<span class="fa fa-check"></span> '. $value.' ';	
						}
					$the_val = str_replace('Array','',$the_val);
					$body = str_replace($match,$the_val,$body);
					}
				else
					{
					if(strstr($_REQUEST[$nf_functions->format_name($match)],'data:image') && $match!='{{nf_form_data}}')
						{
						$body = str_replace($match,'<img src="'.$_REQUEST[$nf_functions->format_name($match)].'">',$body);	
						}
					else
						{
						$body = str_replace($match,$_REQUEST[$nf_functions->format_name($match)],$body);	
						}
					}
				}
				
		//SETUP VALUEPLACEHOLDER - ADMIN EMAIL
		preg_match_all($pattern, $admin_body, $matches2);
			foreach($matches2[0] as $match)
				{
				$the_val = '';
				if(is_array($_REQUEST[$nf_functions->format_name($match)]))
					{
					foreach($_REQUEST[$nf_functions->format_name($match)] as $thekey=>$value)
						{
						$the_val .='- '. $value.' ';	
						}
					$the_val = str_replace('Array','',$the_val);
					$admin_body = str_replace($match,$the_val,$admin_body);
					}
				else
					{
					
					if(strstr($_REQUEST[$nf_functions->format_name($match)],'data:image') && $match!='{{nf_form_data}}')
						{
						$admin_body = str_replace($match,'<img src="'.$_REQUEST[$nf_functions->format_name($match)].'">',$admin_body);	
						}
					else
						{
						$admin_body = str_replace($match,$_REQUEST[$nf_functions->format_name($match)],$admin_body);	
						}	
					}
				}
		//EMAIL ATTR TAGS
		preg_match_all($pattern, $from_address, $matches3);
		foreach($matches3[0] as $match)
			{
			$from_address = str_replace($match,$_REQUEST[$nf_functions->format_name($match)],$from_address);
			}
		preg_match_all($pattern, $from_name, $matches4);
		foreach($matches4[0] as $match)
			{
			$from_name = str_replace($match,$_REQUEST[$nf_functions->format_name($match)],$from_name);
			}
		preg_match_all($pattern, $subject, $matches5);
		foreach($matches5[0] as $match)
			{
			$subject = str_replace($match,$_REQUEST[$nf_functions->format_name($match)],$subject);
			}
		preg_match_all($pattern, $user_subject, $matches6);
		foreach($matches6[0] as $match)
			{
			$user_subject = str_replace($match,$_REQUEST[$nf_functions->format_name($match)],$user_subject);
			}
	
		//SETUP CC
		if(strstr($mail_to,','))
			$mail_to = explode(',',$mail_to);
		
		//SETUP BCC
		if(strstr($bcc,','))
			$bcc = explode(',',$bcc);
		
		//SETUP USERMAIL BCC
		if(strstr($bcc_user_mail,','))
			$bcc_user_mail 	= explode(',',$bcc_user_mail);
			
		//SETUP FROM ADRRESS	
		//$from_address = ($_REQUEST[$form_attr->user_email_field]) ? $_REQUEST[$form_attr->user_email_field] : $from_address;  
		
		//SETUP EMAIL FORMAT
		$message = $admin_body;
		
		if($this->resent)
			{
			$admin_body = $entry_attr->saved_admin_email;
			$body = $entry_attr->saved_user_email;
			}
		if(!$this->resent)
			$update = $wpdb->update ( $wpdb->prefix . 'wap_nex_forms_entries', array('saved_admin_email'=>$admin_body,'saved_user_email'=>$body), array(	'Id' => $this->entry_id ));
		
		if ( (is_plugin_active( 'nex-forms-export-to-pdf/main.php' ) || is_plugin_active( 'nex-forms-export-to-pdf7/main.php' )) &&  $form_attr->attach_pdf_to_email!='' )
			$pdf_attached_path = NEXForms_export_to_PDF($this->entry_id, true, false, true);
			
			
		if($form_attr->attach_pdf_to_email!='')
			{
			$set_emails = explode(',',$form_attr->attach_pdf_to_email);
			}
	
		if($email_config['email_method']=='api')
			{
			$api_params = array( 
				'from_address' => $from_address,
				'from_name' => $from_name,
				'subject' => $subject,
				'user_subject' => $user_subject,
				'mail_to' => $form_attr->mail_to,
				'bcc' => $form_attr->bcc,
				'bcc_user_mail' => $form_attr->bcc_user_mail,
				'admin_message' => $message,
				'user_message' => $body,
				'user_email' => ($_REQUEST[$form_attr->user_email_field]) ? $_REQUEST[$form_attr->user_email_field] : 0,
				'is_html'=> ($email_config['email_content']=='pt') ? 0 : 1
			);
			$response = wp_remote_post( 'http://basixonline.net/mail-api/', array('timeout'   => 30,'sslverify' => false,'body'  => $api_params) );
			echo $response['body'];
		}
	else if($email_config['email_method']=='smtp' || $email_config['email_method']=='php_mailer')
		{
		
		$send_user_email = $_REQUEST[$form_attr->user_email_field];	
		
		date_default_timezone_set('Etc/UTC');
		include_once(ABSPATH . WPINC . '/class-phpmailer.php'); 
		
		/** USER CONFIRMATION EMAIL ************************************************/
		if($send_user_email)
			{			
			$confirmation_mail = new PHPMailer;
			//$confirmation_mail->SMTPDebug = 2;
			//$confirmation_mail->Debugoutput = 'html';
			$confirmation_mail->CharSet = "UTF-8";
			$confirmation_mail->Encoding = "base64";
			if($email_config['email_content']=='pt')
				$confirmation_mail->IsHTML(false);
				
			//Tell PHPMailer to use SMTP
			if($email_config['email_method']!='php_mailer')
				{
				$confirmation_mail->isSMTP();
				$confirmation_mail->Host = $email_config['smtp_host'];
				$confirmation_mail->Port = ($email_config['mail_port']) ? $email_config['mail_port'] : 587;
	
				//Whether to use SMTP authentication
				if($email_config['smtp_auth']=='1')
					{
					$confirmation_mail->SMTPAuth = true;
					if($email_config['email_smtp_secure']!='0')
					$confirmation_mail->SMTPSecure  = $email_config['email_smtp_secure']; 
					$confirmation_mail->Username = $email_config['set_smtp_user'];
					$confirmation_mail->Password = $email_config['set_smtp_pass'];
					}
				else
					{
					$confirmation_mail->SMTPAuth = false;
					}
				}
			$confirmation_mail->setFrom($from_address, $from_name);
			$confirmation_mail->addAddress($send_user_email);
			if(is_array($bcc_user_mail))
				{
				foreach($bcc_user_mail as $email)
					$confirmation_mail->addBCC($email, $from_name);
				}
			else
				$confirmation_mail->addBCC($bcc_user_mail, $from_name);
				
			$confirmation_mail->Subject = ($user_subject) ? $user_subject : $subject;
			if($email_config['email_content']!='pt')	
				$confirmation_mail->msgHTML($body, dirname(__FILE__));
			else
				$confirmation_mail->Body = strip_tags($body);
			//send the message, check for errors
			if ( (is_plugin_active( 'nex-forms-export-to-pdf/main.php') || is_plugin_active( 'nex-forms-export-to-pdf7/main.php' )) &&  in_array('user',$set_emails) )
				$confirmation_mail->addAttachment($pdf_attached_path);
			
			if (!$confirmation_mail->send())
				{
				echo '<div class="alert alert-danger"><strong>Confirmation Mailer Error:</strong> ' . $confirmation_mail->ErrorInfo.'</div>';
				} 
			}
		
		/** ADMIN EMAIL ************************************************/
		
		$mail = new PHPMailer;
		//$mail->SMTPDebug = 2;
		$mail->CharSet = "UTF-8";
		$mail->Encoding = "base64";
		//$mail->Debugoutput = 'html';
		if($email_config['email_content']=='pt')
			$mail->IsHTML(false);
		
		//Tell PHPMailer to use SMTP
		if($email_config['email_method']=='smtp')
			{
			$mail->isSMTP();
			$mail->Host = $email_config['smtp_host'];
			$mail->Port = ($email_config['mail_port']) ? $email_config['mail_port'] : 587;
			
			
			//Whether to use SMTP authentication
			if($email_config['smtp_auth']=='1')
				{
				$mail->SMTPAuth = true;
				if($email_config['email_smtp_secure']!='0')
					$mail->SMTPSecure  = $email_config['email_smtp_secure']; //Secure conection
				$mail->Username = $email_config['set_smtp_user'];
				$mail->Password = $email_config['set_smtp_pass'];
				}
			else
				{
				$mail->SMTPAuth = false;
				}
			}
		$mail->setFrom($from_address, $from_name);
		//BCC
		if(is_array($bcc))
			{
			foreach($bcc as $email)
				$mail->addBCC($email, $from_name);
			}
		else
			$mail->addBCC($bcc, $from_name);	
		//CC	
		if(is_array($mail_to))
			{
			foreach($mail_to as $email)
				$mail->addCC($email, $from_name);
			}
		else
			$mail->AddAddress($mail_to, $from_name);
	
		$mail->Subject = $subject;
		
		if($email_config['email_content']!='pt')	
			$mail->msgHTML($admin_body, dirname(__FILE__));
		else
			$mail->Body = strip_tags($admin_body);
	
		for($x = 0; $x < count($files); $x++){  
			$file = fopen($files[$x],"r");  
			$content = fread($file,filesize($files[$x]));  
			fclose($file);  
			$content = chunk_split(base64_encode($content));  
			$mail->addAttachment($files[$x]);
		} 
			if ( (is_plugin_active( 'nex-forms-export-to-pdf/main.php') || is_plugin_active( 'nex-forms-export-to-pdf7/main.php' )) &&  in_array('admin',$set_emails) )
			$mail->addAttachment($pdf_attached_path);
			
			if(!$mail->send())	
				{
				echo '<div class="alert alert-danger"><strong>Admin Mailer Error:</strong> ' . $mail->ErrorInfo.'</div>';
				} 
		}
	
		/**************************************************/
		/** NORMAL PHP ************************************/
		/**************************************************/
		else if($email_config['email_method']=='php')
			{
			
			$headers = 'From: '.$from_address;   
			$time = md5(time());  
			$boundary = "==Multipart_Boundary_x{$time}x";  
			$headers .= "\nMIME-Version: 1.0\n" . "Content-Type: multipart/mixed;\n" . " boundary=\"{$boundary}\"";
			$message = "--{$boundary}\n" . "Content-type: ".((($email_config['email_content']=='html')) ? 'text/html' : 'text/plain')."; charset=UTF-8\n" . "Content-Transfer-Encoding: 7bit\n\n" . $message . "\n\n";
			$message .= "--{$boundary}\n";  
			  
			// attach the attachments to the message  
			for($x = 0; $x < count($files); $x++){  
				$file = fopen($files[$x],"r");  
				$content = fread($file,filesize($files[$x]));  
				fclose($file);  
				$content = chunk_split(base64_encode($content));  
				$message .= "Content-Type: {\"application/octet-stream\"};\n" . " name=\"$files[$x]\"\n" . "Content-Disposition: attachment;\n" . " filename=\"$filenames[$x]\"\n" . "Content-Transfer-Encoding: base64\n\n" . $content . "\n\n";  
				$message .= "--{$boundary}\n";  
			} 
		
		if(is_array($mail_to))
			{
			foreach($mail_to as $email)
				mail($email,$subject,$message,$headers);
			}
		else
			mail($mail_to,$subject,$message,$headers);
	
		$headers2  = 'MIME-Version: 1.0' . "\r\n";
		$headers2 .= 'Content-Type: '.(($email_config['email_content']=='html') ? 'text/html' : 'text/plain').'; charset=UTF-8\n\n'. "\r\n";
		$headers2 .= 'From: '.$from_name.' <'.$from_address.'>' . "\r\n";
		if($_REQUEST[$form_attr->user_email_field])
			mail($_REQUEST[$form_attr->user_email_field],$subject,$body,$headers2);
		}
	
		/**************************************************/
		/** WORDPRESS MAIL ********************************/
		/**************************************************/	
		else if($email_config['email_method']=='wp_mailer')
			{
		
			$headers[] = 'Content-Type: text/html; charset=UTF-8';
			$headers[] = 'From: '.$from_name.' <'.$from_address.'>';
			
			if(is_array($mail_to))
				{
				foreach($mail_to as $email)
					wp_mail($email,$subject,$admin_body,$headers, $files);
				}
			else
				wp_mail($mail_to,$subject,$admin_body,$headers, $files);
		
			$headers2  = 'MIME-Version: 1.0' . "\r\n";
			$headers2 .= 'Content-Type: '.(($email_config['email_content']=='html') ? 'text/html' : 'text/plain').'; charset=UTF-8\n\n'. "\r\n";
			$headers2 .= 'From: '.$from_name.' <'.$from_address.'>' . "\r\n";
			if($_REQUEST[$form_attr->user_email_field])
				wp_mail($_REQUEST[$form_attr->user_email_field],$form_attr->user_confirmation_mail_subject,$body,$headers2);
			
			}
		/**************************************************/
		/** NO MAIL ***************************************/
		/**************************************************/
		else
			{
			echo 'ERROR: No Mail Method Config Setup->'.$email_config['email_method'];
			}	
		}
	}
}
?>