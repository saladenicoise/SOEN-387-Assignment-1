<?PHP

header_remove();
session_start();
session_destroy();
require_once('../../config/config.php');
header("Location: ".PATH_INDEX);
