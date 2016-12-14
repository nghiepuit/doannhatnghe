<?php

define ("DS",DIRECTORY_SEPARATOR);
define ("ROOT_PATH", dirname(__FILE__));
define ("LIBRARY_PATH",ROOT_PATH.DS."libs".DS);
define ("APPLICATION_PATH",ROOT_PATH.DS."application".DS);
define ("MODULE_PATH",APPLICATION_PATH."module".DS);
define ("PUBLIC_PATH",ROOT_PATH.DS."public");
define ("TEMPLATE_PATH",PUBLIC_PATH.DS."template".DS);
define ("BLOCK_PATH",APPLICATION_PATH."block".DS);

define ("ROOT_URL",DS."WebBanHang");
define ("PUBLIC_URL",ROOT_URL.DS."public".DS);
define ("TEMPLATE_URL", PUBLIC_URL."template".DS);
define ("APPLICATION_URL", ROOT_URL.DS."application".DS);

define ("DEFAULT_MODULE","default");
define ("DEFAULT_CONTROLLER","index");
define ("DEFAULT_ACTION","index");

define("DB_HOST","localhost");
define("DB_USER","root");
define("DB_PASS","");
define("DB_NAME","banhang");
//define("DB_HOST","mysql.hostinger.vn");
//define("DB_USER","u602310324_test");
//define("DB_PASS","Nghiep2014");
//define("DB_NAME","u602310324_test");

define("DB_TABLE","group");

define("TBL_GROUP","group");
define("TBL_USER","user");
define("TBL_PARENT","parent");
define("TBL_CATEGORY","category");
define("TBL_PRODUCT","product");
define("TBL_ORDER","order");
define("TBL_ORDER_DETAIL","order_detail");

define("TIME_LOGIN",3600);

define	('UPLOAD_URL', PUBLIC_URL . 'files' . DS);

?>