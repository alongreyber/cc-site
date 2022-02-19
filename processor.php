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
														
																	
									
						Business Name: 
														$bizname<br />
														
																	Tax ID#: 
														$taxid<br />
														
																	State Resale License #: 
														$statelic<br />
														
																	
										
									
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
														
																	
										
									
						Fax Number: 
														$fax<br>
														
																	
										
									
						Email Address: 
														$email_addr<br>
														
																	
										
									
						Comments: 
														$comments<br>
														
																	
										
										


									
									Average Annual sales Volume: 
														$Volume
														<br>
														
																	
										 Number of years in business: 
														
																	
										$numberyears
														<br>
														
																	
										How did you find out about us? 
														$Found
														<br>
														
																	
										
										
									
									Do you do business on the internet? 
														$Internet
									</td></tr></table>";
  
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
$headers .= "From: $email_addr";
  if(mail( $email, "Catalog Requested", $message, $headers )) {
  header( "Location: $redirect" );
  }
  }
  else {
  echo 'No form submitted.';
  }
?>
