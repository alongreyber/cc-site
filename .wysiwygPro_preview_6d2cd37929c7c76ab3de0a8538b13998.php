<?php
if ($_GET['randomId'] != "p_QyYNdIr9wuDNdYGJohSXgsZgfArWfC6D3LBmOqUGezpjzXYdC_3YFzJJ24omK_") {
    echo "Access Denied";
    exit();
}

// display the HTML code:
echo stripslashes($_POST['wproPreviewHTML']);

?>  
