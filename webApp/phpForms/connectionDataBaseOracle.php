<?php

$dbHost = "144.21.67.201";
$dbHostPort="1521";
$dbServiceName = "pdbest21.631174089.oraclecloud.internal";
$usr = 'AZALBERT2B20';
$pswd = 'AZALBERT2B2001';
$dbConnStr = "(DESCRIPTION=(ADDRESS=(PROTOCOL=TCP)
        (HOST=".$dbHost.")(PORT=".$dbHostPort."))
        (CONNECT_DATA=(SERVICE_NAME=".$dbServiceName.")))";

if(!$dbConn = oci_connect($usr,$pswd,$dbConnStr)){
$err = oci_error();
trigger_error('Could not establish a connection: ' . $err['message'], E_USER_ERROR);
}

?>
