<?php
$n    = $_GET["q"];
$hint = "";
$all  = explode("_", $n);
$q    = $all[0];
if ($all[1] == "back") {
    $q = $q - 1;
}
if ($all[1] == "next") {
    $q = $q + 1;
}
include_once 'databaseconnection.php';
if ($n != "") {
    $ida     = $all[2];
    $ids     = explode(",", $ida);
    $id      = $ids[0];
    $table   = $ids[1];
    $getComm = mysqli_query($con, "SELECT * FROM " . $table . " WHERE id='" . $id . "'");
    if ($rowComm = mysqli_fetch_array($getComm, MYSQLI_ASSOC)) {
        $all_comments = 0;
        $comments     = $rowComm['comments'];
        $a_comments   = explode("</br>", $comments);
        $all_comm     = explode(",", $all_comments);
        $hint         = $hint . "<input type='hidden' name='current_comm' id='current_comm' value='$q'/><table width='100%'><tr><td colspan='2'>" . $a_comments[$q - 1] . "</td></tr><tr><td>";
        if ($q > 1) {
            $hint = $hint . "<input type='button' class='back' name='back' id='$ida' onclick='getComments(this.name,this.id)'/>";
        }
        $j = (($q - 1) - ($q - 1) % 10) + 1;
        $n = $j;
        while ($j < $n + 10 && $j <= count($a_comments)) {
            if ($j == $q) {
                $hint = $hint . "<font color='red'>" . $j . "</font>&nbsp";
            } else {
                $hint = $hint . "<font color='blue'>" . $j . "</font>&nbsp";
            }
            $j++;
        }
        if ($q < count($a_comments)) {
            $hint = $hint . "<input type='button' class='next' name='next' id='$ida' onclick='getComments(this.name,this.id)'/>";
        }
        $hint = $hint . "</td><td><input type='submit' name='delete' class='delete' value=''/></td></tr></table>";
    }
}
if ($hint == "") {
    $response = "<font color='red'>No results for your search!</font>";
} else {
    $response = $hint;
}
echo $response;
?>