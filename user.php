<?php
session_start();
include("header2.php");
echo "<table border='1'  cellspacing='1' cellpadding='2'  align='left' width='100%' style='border-collapse:collapse'>";
echo "<tr bgcolor='#FFFFFF'>
<th>FirstName</th>
<th>LastName</th>
<th>Email</th>
<th>Country</th>
<th>Language</th>
<th>Qualification</th>
<th>Add User_Type</th>
</tr>";
$result = mysqli_query($con, "SELECT * FROM user");
if (!$result)
    echo "invalid";
while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
    echo "<tr>";
    echo "<td width='15%'>" . $row['first_name'] . "</td>";
    $uemail = $row['email'];
    echo "<td width='15%'>" . $row['last_name'] . "</td>";
    echo "<td width='15%'>" . $row['email'] . "</td>";
    echo "<td width='12%'>" . $row['country'] . "</td>";
    echo "<td width='13%'>" . $row['language'] . "</td>";
    echo "<td width='20%'>" . $row['qualification'] . "</td>";
    echo "<td width='3%'><a href='Add_user_role.php?lis=$uemail'>More</a></td>";
    echo "</tr>";
}
echo "</table>";
include('footer.php');
?>
