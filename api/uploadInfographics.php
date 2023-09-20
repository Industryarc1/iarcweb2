<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");

if(isset($_POST['token']) && $_POST['token']=="infoGraphup"){

//$target_dir = "uploads/";
$target_dir = $_SERVER["DOCUMENT_ROOT"]."/frontend/web/assets/report-images/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);

echo $target_dir;

$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
  $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
  if($check !== false) {
    echo "File is an image - " . $check["mime"] . ".";
    $uploadOk = 1;
  } else {
    echo "File is not an image.";
    $uploadOk = 0;
  }
}

// Check if file already exists
if (file_exists($target_file)) {
  $filenamenew = str_replace(" ","-",$_POST["title"]." ".$_POST["report_code"]).".webp";
  unlink($filenamenew);
  //echo "Sorry, file already exists.";
  $uploadOk = 1;


}

// Check file size
if ($_FILES["fileToUpload"]["size"] > 500000) {
  echo "Sorry, your file is too large.";
  $uploadOk = 0;
}

/*
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
  echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
  $uploadOk = 0;
}*/

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
  echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
  
  if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
    echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";

$con=mysqli_connect("localhost","iarcdbmain","vpfjeVCuRqm4#5c9AhPeDdG6mGWX!jY6","iarcdb-live");
  if (mysqli_connect_errno()){
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

  $title = $_POST['title'];
  $report_code = $_POST['report_code'];
  $query = "SELECT * FROM zsp_posts WHERE code='".$report_code."' and title LIKE '%".$title."%'";
  $reportData = mysqli_query($con,$query);
  $reportData = mysqli_fetch_assoc($reportData);
  if(!empty($reportData)){
    echo "<br>Exist".$reportData["title"]."<br>";

$nstr = $reportData["description"];
$str = base64_decode($nstr);
$str = "<p>".$str;
$str = str_replace('\n\n','</p><p>','<p>'.$str);
$str = str_replace('\n','</p>',$str);

$filenamenew = str_replace(" ","-",$_POST["title"]." ".$_POST["report_code"]).".webp";

$ad = '<br><infograph><p style="text-align:center"><img src="https://www.industryarc.com/assets/report-images/'.$filenamenew.'" style="width:55%;"></p></infograph>';



$replaceWith = $ad;

$findStr = '<br>';
$pos = strpos($str, $findStr);


if($pos !== false){
$text = substr_replace($str, $replaceWith, $pos, strlen($findStr));
}else{

$explode = explode('</p>', $str);
array_splice( $explode, 1, 0, array($ad) );
$text = implode(" ",$explode);
}




$textencode = base64_encode($text);

//echo $textencode;

if(isset($_POST["updatenow"]) == false) { 
$iquery = "UPDATE zsp_posts SET description = '".$textencode."' WHERE code = '".$report_code."' and inc_id =".$reportData["inc_id"]; 

mysqli_query($con,$iquery);

}

echo "<br>Done!";

  }else{
    echo "Not Exist - ".$query;
  }

  } 

  else {
    echo "Sorry, there was an error uploading your file.";
  }
}

}
else{
echo "Invalid Token!...";
}
?>