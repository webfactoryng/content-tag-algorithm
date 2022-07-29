<?php
$servername = "localhost";
$username = "****";
$password = "****";
$database = "****";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $database);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
// Select all algorithm statments
    $msql = sprintf("SELECT * FROM algorithm_statements LIMIT 1000");
    $reso = mysqli_query($conn, $msql) or die('Error: ' . mysqli_error($conn));
    //$rown = mysqli_fetch_assoc($reso);

$collection = $_GET['content'];
$collection = str_replace(",", " ",$collection);
if($collection==""){
    echo '{"response":"Invalid parameter"}';
    exit();
} 

function relate($value, $compare){
$percent = "";    
similar_text($value,$compare,$percent);
return number_format((float)$percent, 2, '.', '');
}
$tagObj = "";
while($r = mysqli_fetch_assoc($reso)) { 
$tagObj =  $r['category'] .":". $r['word_collection'] .",". $tagObj;
//$tagObj =  $r['category'] .",". $tagObj;
//$age = array("Peter"=>"35", "Ben"=>"37", "Joe"=>"43");

$tagObjx =  rtrim($tagObj,", ");
$resultant = $tagObjx;

}
$result_break = explode(",", $resultant);
$count = count($result_break);
$split = array();
for ($i = 0; $i < $count; $i++) {
        //similar_text($result_break[$i],$collection,$percent); echo $percent ."<br>";
        $result_break_part = explode(":", $result_break[$i]);
        $split[$result_break_part[0]] = relate($result_break_part[1], $collection);
        $netJSON = json_encode($split);
}
echo $netJSON;
?>

