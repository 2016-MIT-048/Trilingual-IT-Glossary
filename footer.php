<table width='100%' border='0'  align='left' cellpadding='2'  cellspacing='1' bgcolor="#FFFFFF">
 <tr>
 <font size='3' color='blue' ><marquee direction="left">
 <?php
$email   = $_SESSION['email'];
$result2 = mysqli_query($con, "SELECT * FROM user WHERE email='" . $email . "' ");
while ($row = mysqli_fetch_assoc($result2)) {
    $username = $row['first_name'];
    $lastname = $row['last_name'];
}
echo "Logged in as " . $username . " " . $lastname;
?> </marquee></font></td>
<td align="center"  ><font size="-1">
Copyright 2016 MIT Student, University of Colombo. Sri Lanka</font></td>
</tr>
</table>
<script>
$("#save").click(function(){
var postid = $("#postid").val();
var userid = $("#userid").val();
var comment = $("#commenttxt").val();
var datastring = 'postid=' + postid + '&userid=' + userid + '&comment=' + comment;
if(!comment){
  alert("Please enter some text comment");
}
else{
  $.ajax({
    type:"POST",
    url: "addcomment.php",
    data: datastring,
    cache: false,
    success: function(result){
      document.getElementById("commenttxt").value=' ';
      $("#comments").append(result);
    }
  });
}
return false;
})

</script>
</body>
</html>