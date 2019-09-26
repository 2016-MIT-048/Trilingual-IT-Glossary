$(function(){
$('#name').keyup(function(){
	var name=$('#name').val();
	$('#feedback').html(name);
	//alert(name);
	$.post('processname.php',{phpname:name},function(data){
		$('#feedback').html(data);
	});
	});
	});