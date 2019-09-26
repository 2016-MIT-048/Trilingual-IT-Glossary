<table width='100%' border='0'  align='left' cellpadding='2'  cellspacing='1' bgcolor="#FFFFFF">
 <tr>
 <tr><td></td></tr>
 <tr>
<font size='3' color='blue' ><marquee direction="left">Please Sign Up to add commence/suggestions..... </marquee></font></td>

</tr>
 <tr>
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
    url: "/addcomment.php",
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