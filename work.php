<?php

//read sorted ip ranges from file
$content = file_get_contents('list.txt');
$content = explode("\n",$content);

//fields where last start and stop ip are saved
$lastStartIp = '';
$lastStopIp = '';

//move first range from array to fields
$firstIp = explode('-', $content[0]);
$lastStartIp = $firstIp[0];
$lastStopIp = $firstIp[1];
unset($content[0]);

foreach($content as $range)
{
	if(empty($range))
	{
		continue;
	}
	
	//convert last stop ip to long
	$lastStopIp2long = ip2long($lastStopIp);
	
	//split new range to start and stop ip
	$newRange = explode('-',$range);
	
	$newStartIp = $newRange[0];
	
	//we need start ip in long to compare it with last stop ip
	$newStartIp2long = ip2long($newStartIp);
	
	$newStopIp = $newRange[1];
	
	/* check if the last end ip and the new start ip are overlapping each other or if they are one next to other
	 * For example:
	 *
	 * 192.168.1.1-192.168.1.10
	 * 192.168.1.8-192.168.1.15
	 * The result would be: 192.168.1.1-192.168.1.15
	 *
	 * 192.168.1.1-192.168.1.255
	 * 192.168.2.0-192.168.2.15
	 * The result would be: 192.168.1.1-192.168.2.15
	 *
	 */
	 
	if($newStartIp2long <= $lastStopIp2long + 1) //prekrivane ali dotikanje
	{
		//move last end ip to new last end ip;
		$lastStopIp = $newStopIp;
	}
	else
	{
		//we echo last known range and replace it with new range
		echo $lastStartIp.'-'.$lastStopIp."\n";
		$lastStartIp = $newStartIp;
		$lastStopIp = $newStopIp;
	}
}
echo $lastStartIp.'-'.$lastStopIp;

?>
