<?php
$host=php_uname('n');
echo $host;
if( $cn=mysql_connect($host, "mysqlmgmt", "sws312mgmt") ) {
	echo "connect success!";
} else {
	echo "cannot connect";
}
?>
