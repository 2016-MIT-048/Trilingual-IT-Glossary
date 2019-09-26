<?php
include("header2.php");
$uemail = $_POST['butt6'];
$userty = $_POST['addtype'];
if ($userty == '0') {
} else {
	//user type=user(if change), system_user-> delete
    if ($userty == 'user') {
        mysqli_query($con, "DELETE from system_user WHERE email = '" . $uemail . "'");
    } else {
        mysqli_query($con, "INSERT INTO system_user (email,user_type) values('" . $uemail . "','" . $userty . "')");
    }
    mysqli_query($con, "UPDATE system_user SET user_type = '$userty'
WHERE email = '$uemail'");
    echo "<table width='100%' height='40' border='0' class='table' align='left' style='border-collapse:collapse'>";
    echo "<tr><td><font color='green'>User type is changed....</font></td></tr>";
    echo "</table>";
}
$resu = $result = mysqli_query($con, "SELECT * FROM system_user WHERE email='" . $uemail . "'");
if (mysqli_num_rows($resu) == 1) {
    while ($row = mysqli_fetch_array($resu, MYSQLI_ASSOC)) {
        $ust = $row['user_type'];
    }
} else {
    $ust = 'user';
}
$result = mysqli_query($con, "SELECT * FROM user WHERE email='" . $uemail . "'");
echo "<table width='100%' height='82' border='1' class='table' align='left' style='border-collapse:collapse'>
<tr bgcolor='#FFFFFF'>
<th></th>
<th></th>
</tr>";
while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
    echo "<form action='#' method='POST'>";
    echo "<tr>";
    echo "<td width='20%'>First name:</td><td width='80%'>" . $row['first_name'] . "</td></tr>";
    echo "<tr><td>Last name:</td><td>" . $row['last_name'] . "</td></tr>";
    $ue = $row['email'];
    echo "<tr><td>email:</td><td>" . $row['email'] . "</td></tr>";
    echo "<tr><td>Gender:</td><td>" . $row['gender'] . "</td></tr>";
    echo "<tr><td>Language:</td><td>" . $row['language'] . "</td></tr>";
    echo "<tr><td>Country:</td><td>" . $row['country'] . "</td></tr>";
    echo "<tr><td>Date of Birth:</td><td>" . $row['date_of_birth'] . "</td></tr>";
    echo "<tr><td>Qualification:</td><td>" . $row['qualification'] . "</td></tr>";
    echo "<tr><td>Linked_In:</td><td>" . $row['linked_in'] . "</td></tr>";
    echo "<tr><td>Short_bio:</td><td>" . $row['short_bio'] . "</td></tr>";
    echo "<tr><td>User Type:</td><td>" . $ust . "</td></tr>";
    echo "<input type='hidden' name='butt6' value='$ue'>";
    echo "<tr><td>Change User_Type:</td><td><Select name='addtype'>
<Option value='0'> </Option>
                                        <Option value='Secondary Admin'>Secondary Admin</Option>
                                        
                                        <Option value='user'>User</Option>
                                        </Select><input type='submit' name='$email' value='Change type'/><input type='hidden' name='butt' value='$email'</td></tr>";
    echo "</form>";
}
echo "</table>";
include("footer.php");
?>








	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	

