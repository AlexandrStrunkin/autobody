<?
define("DBPersistent", false);
$DBType = "mysql";
$DBHost = "localhost";

$DBLogin = "3502114563";  

$DBPassword = "6p1fl8H0";

$DBName = "4rd_de_osg_ru";

$DBDebug = true;
$DBDebugToFile = false;
define("MYSQL_TABLE_TYPE", "INNODB");

@set_time_limit(60);

define("DELAY_DB_CONNECT", true);




define("CACHED_b_file", 3600);
define("CACHED_b_file_bucket_size", 10);
define("CACHED_b_lang", 3600);
define("CACHED_b_option", 3600);
define("CACHED_b_lang_domain", 3600);
define("CACHED_b_site_template", 3600);
define("CACHED_b_event", 3600);
define("CACHED_b_agent", 3660);
define("CACHED_menu", 3600);
#define("BX_CACHE_TYPE", "APC");

define("BX_UTF", true);
define("BX_FILE_PERMISSIONS", 0644);
define("BX_DIR_PERMISSIONS", 0755);
@umask(~BX_DIR_PERMISSIONS);
?>
