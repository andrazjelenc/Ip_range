<?php

function inRange($ip, $range)
{
	$range = explode('-',$range);
	$startRange = ip2long($range[0]);
	$stopRange = ip2long($range[1]);
	
	$ip = ip2long($ip);
	
	if($ip >= $startRange-1 && $ip <= $stopRange+1)
	{
		return true;
	}
	else
	{
		return false;
	}
	
}

function repairRange($rangeA, $rangeB)
{
	$razbitRangeB = explode('-', $rangeB);
	$startIpB = $razbitRangeB[0];
	$stopIpB = $razbitRangeB[1];

	
	if(inRange($startIpB, $rangeA) && inRange($stopIpB, $rangeA))
	{
		return $rangeA; // a je znotraj b-ja
	}
	elseif(inRange($startIpB, $rangeA))
	{
		//A-D
		$razbitRangeA = explode('-', $rangeA);
		$startIpA = $razbitRangeA[0];
		$stopIpA = $razbitRangeA[1];
		return $startIpA.'-'.$stopIpB;
	}
	elseif(inRange($stopIpB, $rangeA))
	{
		//C-B
		$razbitRangeA = explode('-', $rangeA);
		$startIpA = $razbitRangeA[0];
		$stopIpA = $razbitRangeA[1];
		return $startIpB.'-'.$stopIpA;
	}
	else
	{
		return 'new';
	}
}

$output = array();

$content = file_get_contents('list.txt');
$content = explode("\n",$content);

foreach($content as $line)
{
	$range = trim($line);
	if(empty($range))
	{
		continue;
	}

	if(count($output) == 0)
	{
		$output[] = $range;
		continue;
	}
		
	//echo $range."\r\n";
	$inserted = false;
	
	$startIndex = count($output) - 100;
	if($startIndex < 0)
	{
		$startIndex = 0;
	}
	
	for($i = $startIndex; $i < count($output); $i++)
	{
		$rangeB = $output[$i];
		//echo '--->'.$rangeB;
		$result = repairRange($range,$rangeB);
		if(!($result == 'new'))
		{
			$output[$i] = $result;
			$inserted = true;
			//echo " [INSERTED]\r\n";
			break;
		}
		//echo "\r\n";
		
	}
	if(!$inserted)
	{
		$output[] = $range;
	}
}

foreach($output as $range)
{
	echo $range."\n";
}
?>
