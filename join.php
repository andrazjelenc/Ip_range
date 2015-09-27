<?php

//array where all the ranges will be saved
$output = array();

//lists are in the txt folder
$files = scandir("./txt");

foreach ($files as $filename) 
{
	if($filename == '.' || $filename == '..')
	{
		continue;
	}
	//get content of one list
	$filename = './txt/'.$filename;
	$content = file_get_contents($filename);
	$content = explode("\n",$content);
	
	foreach($content as $line)
	{
		$line = trim($line);
		if(empty($line))
		{
			continue;
		}
		
		//skip first line 
		if($line[0] == '#')
		{
			continue;
		}
		$range = explode(':',$line)[1];
		$output[]  = $range;
	}
}

//sort array like human
natsort($output);

//echo everything but last two line
$n = count($output);
foreach($output as $range)
{
	$n--;
	if($n == 2)
	{
		echo $range;
		break;
	}
	echo $range."\n";
	
}
?>
