<?php
function getPaging($mysqli,$query="", $recsPerPage=0, $pageId=""){
		
	$result = mysqli_query($mysqli,$query);
	if($pageId == ""){
		$pageId = 1;
	}
	
	$totRecs = mysqli_num_rows($result);
	
	
	$totIndex = (int)($totRecs/$recsPerPage);
	if( ($totIndex*$recsPerPage) < $totRecs ){
		$totIndex++;
	}
	
	$startRec = ($pageId * $recsPerPage)-$recsPerPage;
	$result = mysqli_query($mysqli,$query." limit ".$startRec.",".$recsPerPage);
	
	$retArr[0] = $result;
	$retArr[1] = $totIndex;
	$retArr[2] = $totRecs;

	return $retArr;
} 
?>