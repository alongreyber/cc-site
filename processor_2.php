<?php
  function get_queries($input) {
		if(!isset($input)) {
			return false;
		}
		foreach($input as $key => $val) {
			global ${$key};
			${$key} = $val;
		}
	}
	get_queries($_REQUEST);
	if($send == "SEND") {
	$message = "<table width=\"571\" border=\"0\" cellspacing=\"2\" cellpadding=\"0\">
												<tr>
													<td valign=\"top\">
								
						Contact Name: 
														$realname<br />
														
																	
														
																	
										
									
						Mailing Address: 
														$mailadd<br />
														
																	
									
						City: 
														$city<br />
														
																	
									
						State: 
														$state<br />
														
																	
									
						Zip Code: 
														$zip<br />
														
																	
										Country: 
														$country
														<br>
														
																	
										
									
						Phone Number: 
														$phone<br>
														
														
																	
										
									
						Email Address: 
														$email_addr<br>
														
																	
						Product Description: 
														$prod<br>	
									
						Comments: 
														$comments<br>
														

									</td></tr></table>";
  
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
$headers .= "From: $email_addr";
  if(mail( $email, "Customer Contact", $message, $headers )) {
  header( "Location: $redirect" );
  }
  }
  else {
  echo 'No form submitted.';
  }
?>
