<?php

$lastStartIp = '';
$lastStopIp = '';

$content = file_get_contents('list.txt');
$content = explode("\n",$content);

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
		
	$lastStopIp2long = ip2long($lastStopIp);
	
	$newRange = explode('-',$range);
	
	$newStartIp = $newRange[0];
	$newStartIp2long = ip2long($newStartIp);
	
	$newStopIp = $newRange[1];
	
	if($newStartIp2long <= $lastStopIp2long + 1) //prekrivane ali dotikanje
	{
		$lastStopIp = $newStopIp;
	}
	else
	{
		echo $lastStartIp.'-'.$lastStopIp."\n";
		$lastStartIp = $newStartIp;
		$lastStopIp = $newStopIp;
	}
}
echo $lastStartIp.'-'.$lastStopIp;

?>
