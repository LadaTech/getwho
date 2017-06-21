<?PHP
if ($_SERVER['SERVER_NAME'] != '') {
    switch ($_SERVER['SERVER_NAME']) {
        case "localhost": {
                $dbname = "getwhois";
                $dbusername = "root";
                $dbpass = "";
                $dbhost = "localhost";
                break;
            }
        case "getwhois.in": {
                $dbname = "getwhois_data";
                $dbusername = "getwhois_data";
                $dbpass = "SPT0T;b3gPqg";
                $dbhost = "localhost";
                break;
            }
    }
} else {
    $dbname = "apnabe5_products";
    $dbusername = "apnabe5_pusers";
    $dbpass = "OyhGpEI;3@DV";
    $dbhost = "localhost";
}

if($conn = mysql_connect($dbhost,$dbusername, $dbpass))
{
    mysql_select_db($dbname,$conn);
}else{
    echo "Not connected";exit;
}

?>
