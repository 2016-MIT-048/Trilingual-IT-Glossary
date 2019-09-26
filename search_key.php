<?php
    $key=$_GET['key'];
    $array = array();
	include_once 'config.php';
    $con=mysqli_connect($host, $user,$password,"2016mit048");
    $query=mysqli_query($con, "SELECT * FROM terms WHERE term LIKE '%{$key}%' OR tamil_meaning LIKE '%{$key}%' OR sinhala_meaning LIKE '%{$key}%'");
    while($row=mysqli_fetch_assoc($query))
    {
      $array[] = $row['term'];
	  $array1[] = $row['tamil_meaning'];
	  $array2[] = $row['sinhala_meaning'];
    }
	
	$result = array_merge($array,$array1);
	$result2 = array_merge($result,$array2);
    echo json_encode($result2);
    mysqli_close($con);
?>