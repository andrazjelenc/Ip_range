<?php

$output = array();

$files = scandir("./txt");

foreach ($files as $filename) 
{
	if($filename == '.' || $filename == '..')
	{
		continue;
	}
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
		if($line[0] == '#')
		{
			continue;
		}
		$range = explode(':',$line)[1];
		echo $range."\n";
	}
}
?>
