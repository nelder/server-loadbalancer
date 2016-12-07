<?php 

//////////////////////////////////////////////////////////////////////////////
// System Load
// Returns the system load average of this node to decide where to send user
//
// Author: Nick Elder (github.com/nelder)
//		   Udara Jay (github.com/github.com/udarajay)
// Date: Created: December 6 2016
//       Modified: December 6 2016
//////////////////////////////////////////////////////////////////////////////

//Require config for key value
require_once("config.php");

//Check if GET Key set
if($_GET['k'] == $key){
	$load = sys_getloadavg();
	$core = intval(trim(shell_exec("cat /proc/cpuinfo | grep processor | wc -l")));
	$out = array("1" => $load[0]);
	$out = array("one" => $load[0], "five" => $load[1], "fifteen" => $load[2], "threads" => $core, "deci_load" => $load[0]/$core);
	echo json_encode($out);
}

?>