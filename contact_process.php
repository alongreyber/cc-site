<?php

// ------- three variables you MUST change below  -------------------------------------------------------
$replyemail="info@crocodilecreek.com"; //change to your email address
$valid_ref1="http://crocodilecreek.com/contact.html"; //chamge to your domain name
$valid_ref2="http://www.crocodilecreek.com/contact.html"; //chamge to your domain name
$valid_ref3="https://crocodilecreek.com/contact.html"; //chamge to your domain name
$valid_ref4="https://www.crocodilecreek.com/contact.html"; //chamge to your domain name
// -------- No changes required below here -------------------------------------------------------------
//
// email variable not set - load $valid_ref1 page
if (!isset($_POST['email']))
{
 echo "<script language=\"JavaScript\"><!--\n ";
 echo "top.location.href = \"$valid_ref1\"; \n// --></script>";
 exit;
}
$ref_page=$_SERVER["HTTP_REFERER"];
$valid_referrer=0;
if($ref_page==$valid_ref1) $valid_referrer=1;
elseif($ref_page==$valid_ref2) $valid_referrer=1;
elseif($ref_page==$valid_ref3) $valid_referrer=1;
elseif($ref_page==$valid_ref4) $valid_referrer=1;
if((!$valid_referrer) OR ($_POST["block_spam_bots"]!=12))//you can change this but remember to change it in the contact form too
{
 echo '<h2>ERROR - not sent.';
 if (file_exists("debug.flag")) echo '<hr>"$valid_ref1" and "$valid_ref2" are incorrect within the file:<br>
                                      contact_process.php <br><br>On your system these should be set to: <blockquote>
                                                                          $valid_ref1="'.str_replace("www.","",$ref_page).'"; <br>
                                                                          $valid_ref2="'.$ref_page.'";
                                                                          </blockquote></h2>Copy and paste the two lines above
                                                                          into the file: contact_process.php <br> (replacing the existing variables and settings)';
 exit;
}

//check user input for possible header injection attempts!
function is_forbidden($str,$check_all_patterns = true)
{
 $patterns[0] = '/content-type:/';
 $patterns[1] = '/mime-version/';
 $patterns[2] = '/multipart/';
 $patterns[3] = '/Content-Transfer-Encoding/';
 $patterns[4] = '/to:/';
 $patterns[5] = '/cc:/';
 $patterns[6] = '/bcc:/';
 $forbidden = 0;
 for ($i=0; $i<count($patterns); $i++)
  {
   $forbidden = preg_match($patterns[$i], strtolower($str));
   if ($forbidden) break;
  }
 //check for line breaks if checking all patterns
 if ($check_all_patterns AND !$forbidden) $forbidden = preg_match("/(%0a|%0d|\\n+|\\r+)/i", $str);
 if ($forbidden)
 {
  echo "<font color=red><center><h3>STOP! Message not sent.</font></h3><br><b>
        The text you entered is forbidden, it includes one or more of the following:
        <br><textarea rows=9 cols=25>";
  foreach ($patterns as $key => $value) echo trim($value,"/")."\n";
  echo "\\n\n\\r</textarea><br>Click back on your browser, remove the above characters and try again.
        </b>";
  exit();
 }
}

foreach ($_REQUEST as $key => $value) //check all input
{
 if ($key == "themessage") is_forbidden($value, false); //check input except for line breaks
 else is_forbidden($value);//check all
}
$thesubject = $_POST["thesubject"];
$name = $_POST["name"];
$name2 = $_POST["name2"];
$email = $_POST["email"];
$mailadd = $_POST["mailadd"];
$city = $_POST["city"];
$state = $_POST["state"];
$zip = $_POST["zip"];
$country = $_POST["country"];
$phone = $_POST["phone"];
$prod = $_POST["prod"];
$upc = $_POST["upc"];
$lotnum1 = $_POST["lotnum1"];
$lotnum2 = $_POST["lotnum2"];
$lotnum3 = $_POST["lotnum3"];
$themessage = $_POST["themessage"];

$success_sent_msg = header( 'Location: http://www.crocodilecreek.com/contact_thanks.html');
  
  



$themessage = "name: $name \nLast Name: $name2 \nEmail: $email \nMailing Address: $mailadd \nCity: $city \nState: $state \nZip: $zip \nCountry: $country \nPhone: $phone \nProduct Description: $prod \nUPC: $upc\nLot number: $lotnum1- $lotnum2- $lotnum3\nComments: $themessage";
	 
mail("$replyemail",
     "Receipt: $thesubject",
     "$themessage",
     "From: ccreek@web01.netfriends.com\nReply-To: $email");
echo $success_sent_msg;

?>