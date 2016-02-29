<?php
 
 /**
 * Description of Read TS files
 *
 * @author Daniel Naval
 */


echo '<h3>Generate report</h3><br/>';
//Read directory
if ($handle = opendir('./ReportBuild/')) {
    while (false !== ($entry = readdir($handle))) {
	
		if ($entry != "." && $entry != "..") {
			//Name of the file
			echo '<a href="./index.php?report='.$entry.'">'.$entry.'</a>';
        } 
    }
closedir($handle);

}

if(isset($_GET['report'])) {

//Read directory
if ($handl = opendir('./reports/')) {
    while (false !== ($entre = readdir($handl))) {
	
		if ($entre != "." && $entre != "..") {
			//Name of the file
			echo '  |  <a href="./reports/'.$entre.'">Download file here</a><br/>';
        } 
    }
closedir($handl);

}

echo '<br/><br/><br/>';
  $report = $_GET['report'];
  include("./ReportBuild/".$report."");
} 



?>