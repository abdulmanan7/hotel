<?php
function https_php_self()
{
$resource = $_SERVER[ 'PHP_SELF' ];
$domain = $_SERVER[ 'HTTP_HOST' ];
$protocol = "https";
return $protocol . "://" . $domain . $resource;
}