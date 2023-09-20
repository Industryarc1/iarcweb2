<?php

class forclasses{
	
	function forClasses(){
	}
	
	function forDbConnect($host, $user, $passwd, $db){
		global $link;
		
		$link=mysql_connect($host,$user,$passwd);
		if(!$link){die("Could not connect to MySQL");}
		
		mysql_select_db($db,$link) or die ("could not open db".mysql_error());
	}
	function forQuery($query){
		return $result = mysql_query($query);
	}
	
	function forRedirect($url){
		echo "<script language='javascript'>";
		echo "window.location = '$url';";
		echo "</script>";
	}
	function alertMsg($msg=""){
		echo "<script language='javascript'>";
		echo "alert(\"$msg\");";
		echo "</script>";
	}
	
	function forFileUpload($dirPath="", $txtName=""){//normal fileupload with out rename.
			$uploadDirImgImg = $dirPath;
	
			$fileName = $_FILES[$txtFileName]['name'];
			$tmpName  = $_FILES[$txtFileName]['tmp_name'];
			$fileSize = $_FILES[$txtFileName]['size'];
			$fileType = $_FILES[$txtFileName]['type'];
			
			$ext      = substr(strrchr($fileName, "."), 1); 
			$filePath = $uploadDirImgImg . $fileName;

			$str = $fileName;
			$fileThumb = $fileName;
			$result    = move_uploaded_file($tmpName, $filePath);
			
			$this->fileName = $fileName;
			if($result){
				return $fileName;
			}else{
				return $result;
			}
			//return $result;
	}
	
	function forFileUpload_ren($dirPath="", $txtFileName="", $newName=""){//fileupload with rename
			$uploadDirImg = $dirPath;
	
			$fileName = $_FILES[$txtFileName]['name'];
			$tmpName  = $_FILES[$txtFileName]['tmp_name'];
			$fileSize = $_FILES[$txtFileName]['size'];
			$fileType = $_FILES[$txtFileName]['type'];
			
			
			$ext      = substr(strrchr($fileName, "."), 1); 
			$pre      = explode(".", $fileName);
			if($newName==""){
    			$randName = $pre[0]."_".date("mdy")."_".date("his");
			}else{
				$randName = $pre[0]."_".date("mdy")."_".date("his");
			}
			
			$newFilename=$randName.'.'.$ext;
    	
    		$filePath = $uploadDirImg . $newFilename;
	
			$filename2=$fileName;
			$result    = move_uploaded_file($tmpName, $filePath);
			
			$this->fileName = $newFilename;
			if($result){
				return $newFilename;
			}else{
				return $result;
			}
			//return $result;
			
	}
	
	
	
	function resizeImage($filename,$max_width,$max_height='',$newfilename="",$withSampling=true){ 
		if($newfilename=="")
			$newfilename=$filename;
		// Get new sizes
		list($width, $height) = getimagesize($filename);
	   //echo $filename; echo $newfilename;
		//-- dont resize if the width of the image is smaller or equal than the new size.
		/*if($width<=$max_width)
			$max_width=$width;
		   
		$percent = $max_width/$width;
	   
		$newwidth = $width * $percent;
		if($max_height=='') {
			$newheight = $height * $percent;
		} else
			$newheight = $max_height;*/
	    $newwidth = $max_width; 	
	    $newheight = $max_height; 
		// Load
		$thumb = imagecreatetruecolor($newwidth, $newheight); 
		$ext = strtolower(substr(strrchr($filename,"."),1));
	   
		if($ext=='jpg' || $ext=='jpeg')
			$source = imagecreatefromjpeg($filename);
		if($ext=='gif')
			$source = imagecreatefromgif($filename);
		if($ext=='png')
			$source = imagecreatefrompng($filename);
	   
		// Resize
		if($withSampling)
			imagecopyresampled($thumb, $source, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
		else   
			imagecopyresized($thumb, $source, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
		   
		// Output
		if($ext=='jpg' || $ext=='jpeg')
			return imagejpeg($thumb,$newfilename);
		if($ext=='gif')
			return imagegif($thumb,$newfilename);
		if($ext=='png')
			return imagepng($thumb,$newfilename);
	}
	
	function resizeImage2($filename,$newfilename="",$max_width=512,$max_height='',$withSampling=true){ 
		if($newfilename=="")
			$newfilename=$filename;
		// Get new sizes
		list($width, $height) = getimagesize($filename);
		
		if($width<=$max_width)
			$max_width=$width;
		   
		$percent = $max_width/$width;
		
		$newwidth = $width * $percent;
		if($max_height=='') {
			$newheight = $height * $percent;
		} else{
			$newheight = $max_height;
		}
		$newwidth = ceil($newwidth);
		$newheight = ceil($newheight);
		
		// Load
		$thumb = imagecreatetruecolor($newwidth, $newheight); 
		$ext = strtolower(substr(strrchr($filename,"."),1));
	   
		if($ext=='jpg' || $ext=='jpeg')
			$source = imagecreatefromjpeg($filename);
		if($ext=='gif')
			$source = imagecreatefromgif($filename);
		if($ext=='png')
			$source = imagecreatefrompng($filename);
	   
		// Resize
		if($withSampling)
			imagecopyresampled($thumb, $source, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
		else   
			imagecopyresized($thumb, $source, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
		   
		// Output
		if($ext=='jpg' || $ext=='jpeg')
			return imagejpeg($thumb,$newfilename);
		if($ext=='gif')
			return imagegif($thumb,$newfilename);
		if($ext=='png')
			return imagepng($thumb,$newfilename);
	}
	
	
	function imgResize($dirPath="", $txtFileName="",$newwidth=100,$newheight=100){
		$uploadedfile = $_FILES[$txtFileName]['tmp_name'];
		$tFile = $_FILES[$txtFileName]['name'];
		$ext      = strtolower(substr(strrchr($tFile, "."), 1)); 
		$randName = md5(rand() * time());
		$filePath = $randName . '.' . $ext;
		//if(($ext=="jpg")||($ext=="gif")||($ext=="png")||($ext=="swf")){	//if(($ext=="jpg")||($ext=="jpeg")||($ext=="gif")||($ext=="png")||($ext=="tiff")||($ext=="jpe")||($ext=="pic")||($ext=="pcx")||($ext=="bmp")){
		
		$src = imagecreatefromjpeg($uploadedfile);
		list($width,$height)=getimagesize($uploadedfile);
		
		$tmp=imagecreatetruecolor($newwidth,$newheight);
		
		echo "<br>\$newwidth: ".$newwidth;
		echo "<br>\$newheight: ".$newheight;
		echo "<br>\$width: ".$width;
		echo "<br>\$height: ".$height;
		
		
		imagecopyresampled($tmp,$src,0,0,0,0,$newwidth,$newheight,$width,$height); 

			//$filename = "$dirPath".$_FILES[$txtFileName]['name'];//$filePath;
		$filename = $dirPath.$filePath;//$_FILES[$txtFileName]['name'];
		imagejpeg($tmp,$filename,100);

		imagedestroy($src);
		imagedestroy($tmp);
		return $filePath;
	}
	
	//----------------------------------------------
	function getRolename($id)
	{
		$q="select txtrolename from tbl_roles where role_id=".$id."";
		$r=mysql_query($q); $row=mysql_fetch_array($r);
		return $row['txtrolename'];
	}
	function getUsers($selectedUsers)
	{
		$query = "select * from tbl_roles where txtStatus='Active'";
		$result = mysql_query($query);
		$rowsFlag = false;
		while($row = mysql_fetch_array($result)){	
			$rowsFlag = true;
			echo '<option value="">--------'.$row['txtrolename'].'--------</option>';
			$query = "select * from tbl_users where txtStatus='Active' and role_id=".$row['role_id'];
			$users_result = mysql_query($query);
			if(mysql_num_rows($users_result)<1){
				echo '<option value="">Users Not Available...</option>';
			}else{
				while($row_users = mysql_fetch_array($users_result)){	
					echo '<option value="'.$row_users['user_id'].'"';
					if(count($selectedUsers)!=0){
						if (in_array($row_users['user_id'], $selectedUsers)) {
							echo ' selected="selected"';
						}
					}
					echo '>'.$row_users['txtEmail'].'</option>';
				}
			}
		}
		if($rowsFlag == false){
			echo '<option value="">Users Not Available...</option>';
		}

	}
	
	function getProjectname($pid)
	{
		$q="select txttitle from tbl_projects where proj_id=".$pid."";
		$r=mysql_query($q); $row=mysql_fetch_array($r);
		return $row['txttitle'];
	}
	
	function getUsername($uid)
	{
		$q="select txtEmail from tbl_users where user_id=".$uid."";
		$r=mysql_query($q); $row=mysql_fetch_array($r);
		return $row['txtEmail'];
	}
	
	function getName($uid)
	{
		$q="select txtFirstname,txtLastname from tbl_users where user_id=".$uid."";
		$r=mysql_query($q); $row=mysql_fetch_array($r);
		$name=$row['txtFirstname']." ".$row['txtLastname'];
		return $name;
	}
	
	function getClientname($cid)
	{
		$q="select firstName,lastName from tbl_clients where client_id=".$cid."";
		$r=mysql_query($q); $row=mysql_fetch_array($r);
		$name=$row['firstName']." ".$row['lastName'];
		return $name;
	}
	
	function getTaskusers()
	{
		if($_SESSION['roleid']==2)
		{
			$q="select user_id FROM tbl_group_values WHERE group_id IN (SELECT group_id FROM tbl_group_values where user_id=".$_SESSION['userid'].") and role_id < ".$_SESSION['roleid']." group by role_id,user_id";
			$r=mysql_query($q);
			if(mysql_num_rows($r)<1){
				echo '<option value="">Users Not Available...</option>';
			}
			else
			{
				while($row = mysql_fetch_array($r)) {	
					$q1="select user_id,txtEmail from tbl_users where user_id=".$row["user_id"]."";
					$r1=mysql_query($q1); $row1=mysql_fetch_array($r1);
				     echo '<option value="'.$row1['user_id'].'">'.$row1['txtEmail'].'</option>';
			    }
			}
		}
		else {
		$query = "select * from tbl_roles where txtStatus='Active' and role_id < ".$_SESSION['roleid']."";
		$result = mysql_query($query);
		$rowsFlag = false;
		while($row = mysql_fetch_array($result)){	
			$rowsFlag = true;
			echo '<option value="">--------'.$row['txtrolename'].'--------</option>';
			$query = "select * from tbl_users where txtStatus='Active' and role_id=".$row['role_id'];
			$users_result = mysql_query($query);
			if(mysql_num_rows($users_result)<1){
				echo '<option value="">Users Not Available...</option>';
			}else{
				while($row_users = mysql_fetch_array($users_result)){	
				   echo '<option value="'.$row_users['user_id'].'">'.$row_users['txtEmail'].'</option>';
				}
			}
		}
		if($rowsFlag == false){
			echo '<option value="">Users Not Available...</option>';
		} }
		
		
	}
	
	function blogCatg($cid)
	{
		$q="select cat_name from tbl_blogs_category where cat_id =".$cid;
		$r=mysql_query($q); if($r)	{	$row=mysql_fetch_array($r);	}
		return $row['cat_name'];
	}
	
	function invName($uid)
	{
		$q="select txt_firstname,txt_lastname from tbl_investor where inv_id ='".$uid."'";
		$r=mysql_query($q); if($r)	{	$row=mysql_fetch_array($r);	}
		$name=$row['txt_firstname']." ".$row['txt_lastname'];
		return $name;
	}
	
	
##########################################################################################
	function getPaging($query="", $recsPerPage=0, $pageId=""){
		
		$result = @mysql_query($query);
		if($pageId == ""){
			$pageId = 1;
		}
		
		$totRecs = @mysql_num_rows($result);
		
		$totIndex = (int)($totRecs/$recsPerPage);
		if( ($totIndex*$recsPerPage) < $totRecs ){
			$totIndex++;
		}
		$startRec = ($pageId * $recsPerPage)-$recsPerPage;
		$result = @mysql_query($query." limit ".$startRec.",".$recsPerPage);
		
		$retArr[0] = $result;
		$retArr[1] = $totIndex;
		$retArr[2] = $totRecs;

		return $retArr;
	} 
	
	function showParingLinks($totIndex=0, $pageId=1, $class=""){
		
		
		
		
        if($totIndex > 1 ){
            $temp_qs = $_SERVER['QUERY_STRING'];
            $temp = explode('&',$temp_qs);
            $qs = "";
            foreach($temp as $params){
                $temp2 = explode('=',$params);
                if($temp2[0] != 'pageId'){
                    $qs.= '&'.$temp2[0]."=".@$temp2[1];
                }
            }
				
	
            echo '<a href="'.$_SERVER['PHP_SELF'].'?pageId=1'.$qs.'" class="'.$class.'">First</a>&nbsp;&nbsp;';
        
            if($pageId > 1){
                echo '<a href="'.$_SERVER['PHP_SELF'].'?pageId='.($pageId-1).$qs.'" class="'.$class.'">Previous</a>&nbsp;&nbsp;';
            }
           
            if($totIndex>15){ $limit = 15; }else{ $limit = $totIndex;}
            
			
            if($pageId >10 && $totIndex>15 ){
				if($totIndex-$pageId > 7){
					$start=$pageId-7;
					$end=$pageId+7;
				}else{
					$start=$pageId-7;
					$end=$pageId+ceil($totIndex-$pageId);
				}	
            }else{
                $start=1;
                $end=$limit;
            }
			
			//echo $start." ".$end;
		
            
            for($i=$start;$i<=ceil($end);$i++){
                if(@$_REQUEST['pageId'] == $i){
                    echo "<span class='activeBar'>".$i."</span>&nbsp;&nbsp;";
                }else{
                    echo '<a href="'.$_SERVER['PHP_SELF'].'?pageId='.$i.$qs.'" class="'.$class.'">'.$i.'</a>&nbsp;&nbsp;';
                }
            }
            if($pageId < $totIndex){
                //echo '<a href="'.$_SERVER['PHP_SELF'].'?pageId='.($pageId+1).$qs.'" class="'.$class.'">Next</a>&nbsp;|&nbsp;';
                echo '<a href="'.$_SERVER['PHP_SELF'].'?pageId='.($pageId+1).$qs.'" class="'.$class.'">Next</a>&nbsp;&nbsp;';
            }
        //if($totIndex > 1 ){
        /*    echo '<a href="'.$_SERVER['PHP_SELF'].'?pageId='.$totIndex.$qs.'" class="'.$class.'">Last</a>&nbsp;&nbsp;';*/
            
        }
    }
	
	function generateBatch($startingYear, $selectedYear){
		echo '<option value="" selected="selected">--Batch--</option>'."\n";
		for($i=$startingYear; $i<=date('Y'); $i++){
			$selected = '';
			if($i == $selectedYear){
				$selected = ' selected="selected"';
			}
			echo '<option value="'.$i.'"'.$selected.'>'.$i.'</option>'."\n";		
		}
	}
##########################################################################################
	
	
	
} // end of class

?>