<?php
session_start();
include('headerforsuggestion.php');
// current login user email
$email = $_SESSION['email'];
if (isset($_GET['lis'])) {
    $word = $_GET['lis'];
}
if (isset($_POST['Changestatus'])) {
    $term            = $_POST['term'];
    $tamil_meaning   = $_POST['tamil_meaning'];
    $sinhala_meaning = $_POST['sinhala_meaning'];
    $votes           = $_POST['votes'];
    $term_id         = $_POST['term_id'];
    $dd              = gmdate(DATE_ATOM, time());
    $d               = explode("T", $dd);
    $date            = $d[0];
    echo "<table width='100%' align='left' bgcolor='#FFFFFF'>";
    echo "<td width='6%' align='right'><a href='votesofsugg.php?err=$term.$tamil_meaning.$sinhala_meaning'>" . $votes . "</a> <font color='green'> votes</font></td>";
    //current login user term only will store in the likesuggestion table
	$resultlike = mysqli_query($con, "SELECT * FROM likesuggestion where email='" . $email . "' AND term='" . $term . "' AND  tamil_meaning='" . $tamil_meaning . "' AND sinhala_meaning='" . $sinhala_meaning . "'");
    if (!$resultlike)
        echo "invalid";
    if (mysqli_num_rows($resultlike) >= 1) {
        $like = 'Unlike';
        echo "<td width='2%' align='left'><font color='green'> and You like this,  <a href='likesuggestion.php?lis=$term.$tamil_meaning.$sinhala_meaning.$votes.$like.$term_id'> Unlike</a></td>";
    } else {
        $like = 'like';
        echo $like;
        echo "<td width='2%' align='left'><input type='image' name='image' src='bullet.gif'/ height='20' width='20'><a href='likesuggestion.php?lis=$term.$tamil_meaning.$sinhala_meaning.$votes.$like.$term_id'> like</a></td>";
    }
    echo "</table>";
    $result2 = mysqli_query($con, "SELECT * FROM user WHERE email='" . $email . "' ");
    while ($row = mysqli_fetch_array($result2, MYSQLI_ASSOC)) {
        $username = $row['first_name'];
    }
    $su = $_POST['addsugg'];
    if ($su == '1') {
        mysqli_query($con, "UPDATE suggestions SET status = 'To Be Discussed'
            WHERE id='" . $term_id . "'");
        echo "<table border='0' bgcolor='#FFFFFF' cellspacing='1' cellpadding='2'  align='left' width='100%'>
            <tr><td><font color='green'>Status is changed as To be Discussed......</font></td></tr></TABLE>";
    } else if ($su == 'null') {
    } else if ($su == '2') {
        $re = mysqli_query($con, "select * from terms where term='" . $term . "' and tamil_meaning='" . $tamil_meaning . "' and sinhala_meaning='" . $sinhala_meaning . "'");
        if (mysqli_num_rows($re) == 1) {
            mysqli_query($con, "DELETE FROM suggestions WHERE term = '" . $term . "' and tamil_meaning='" . $tamil_meaning . "' and sinhala_meaning='" . $sinhala_meaning . "'");
            echo "<table width='100%' bgcolor='#FFFFFF' height='82' border='0'  align='left'>";
            echo "<tr><td><font color='red'><b>Term and meaning are already exist, to <a href='search.php?viaddglo=$term'>View</a></b></font></td></tr>";
            echo "</table>";
        } else {
            $result = mysqli_query($con, "SELECT * FROM suggestions WHERE id='" . $term_id . "'");
            while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                $suggested_by   = $row['suggested_by'];
                $suggested_date = $row['suggested_date'];
                $checked_by     = $username;
                $accepted_date  = $date;
                $votes          = $row['votes'];
                $comments       = "";
            }
            $getMaxId = mysqli_query($con, "SELECT MAX(id) AS Max_Id FROM terms");
            if ($getMaxId) {
                if ($row_Id = mysqli_fetch_array($getMaxId, MYSQLI_ASSOC)) {
                    $Max_Id = $row_Id['Max_Id'];
                    if ($Max_Id == 0) {
                        $Max_Id = 1;
                    } else {
                        $Max_Id = $Max_Id + 1;
                    }
                }
            }
            $suggested_by   = $row['suggested_by'];
            $suggested_date = $row['suggested_date'];
            $checked_by     = $username;
            $accepted_date  = $date;
            $votes          = $row['votes'];
            $comments       = "";
            $query          = "INSERT INTO terms (id,term, tamil_meaning, sinhala_meaning, suggested_by, suggested_date, checked_by, accepted_date,votes,comments) VALUES ('" . $Max_Id . "','" . $term . "', '" . $tamil_meaning . "', '" . $sinhala_meaning . "', '" . $suggested_by . "', '" . $suggested_date . "', '" . $checked_by . "', '" . $accepted_date . "','" . $votes . "','" . $comments . "')";
            $rez            = mysqli_query($con, $query);
            if (!$rez) {
                echo "Invalid" . mysqli_error($con);
            }
            mysqli_query($con, "DELETE FROM suggestions WHERE id='" . $term_id . "'");
            echo "<table bgcolor='#FFFFFF' width='100%' height='82' border='0' align='left'>";
            echo "<tr><td><font color='green'><b>Your Suggestion is added as Glossary, to <a href='search.php?viaddglo=$term'>View</a></b></font></td></tr>";
            echo "</table>";
        }
    }
} else if (isset($_POST['Comment'])) {
    $term            = $_POST['butt'];
    $tamil_meaning   = $_POST['butt1'];
    $sinhala_meaning = $_POST['butt2'];
    $votes           = $_POST['votes'];
    $com             = $_POST['message'];
    $term_id         = $_POST['term_id'];
    echo "<table bgcolor='#FFFFFF' width='100%' align='left'>";
    echo "<td width='6%' align='right'><a href='votesofsugg.php?err=$term.$tamil_meaning.$sinhala_meaning'>" . $votes . "</a> <font color='green'> votes</font></td>";
    //login user (email) like history stored in the likesuggestion table
	$resultlike = mysqli_query($con, "SELECT * FROM likesuggestion where email='" . $email . "' AND term='" . $term . "' AND tamil_meaning='" . $tamil_meaning . "' AND sinhala_meaning='" . $sinhala_meaning . "' ");
    if (!$resultlike)
        echo "invalid";
    if (mysqli_num_rows($resultlike) >= 1) {
        $like = 'Unlike';
        echo "<td width='2%' align='left'><font color='green'> and You like this,  <a href='likesuggestion.php?lis=$term.$tamil_meaning.$sinhala_meaning.$votes.$like.$term_id'> Unlike</a></td>";
    } else {
        $like = 'like';
        echo "<td width='2%' align='left'><input type='image' name='image' src='bullet.gif'/ height='20' width='20'><a href='likesuggestion.php?lis=$term.$tamil_meaning.$sinhala_meaning.$votes.$like.$term_id'> like</a></td>";
    }
    echo "</table>";
    $result2 = mysqli_query($con, "SELECT * FROM user WHERE email='" . $email . "' ");
    while ($row = mysqli_fetch_array($result2, MYSQLI_ASSOC)) {
        $username = $row['first_name'];
    }
    if ($com == "") {
        echo "<table border='0' bgcolor='#FFFFFF' cellspacing='1' cellpadding='2'  align='left' width='100%'>
<tr><td><font color='red'><b>please enter the comment and then click the button......</b></font></td></tr></table>";
    } else {
		//str_replace(find,replace,string,count) => replace some characters with some other characters in a string
        $com     = str_replace("<p>", "", $com);
        $com     = str_replace("</p>", "", $com);
        $result  = mysqli_query($con, "SELECT * FROM suggestions WHERE id='" . $term_id . "'");
        $oldcomm = '';
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $oldcomm = $row['comments'];
        }
        $c = $com . "...... by " . $username;
        if ($oldcomm == "") {
            $co = $c;
        } else {
            $co = $oldcomm . "</br>" . $c;
        }
        mysqli_query($con, "UPDATE suggestions SET comments = '" . $co . "' WHERE id='" . $term_id . "'");
        echo "<table border='0' bgcolor='#FFFFFF' cellspacing='1' cellpadding='2'  align='left' width='100%'>
<tr><td><font color='green'><b>Your comment is added......</b></font></td></tr></TABLE>";
    }
} else {
    $arrr            = explode('.', $word);
    $term            = $arrr[0];
    $tamil_meaning   = $arrr[1];
    $sinhala_meaning = $arrr[2];
    $votes           = $arrr[3];
    $term_id         = $arrr[4];
}
echo "<form action='#' method='POST' name='form'>";
if (isset($_POST['delete'])) {
    $resultut = mysqli_query($con, "SELECT * FROM system_user WHERE email='" . $email . "'");
    if ($resultut) {
        if ($rowut = mysqli_fetch_array($resultut, MYSQLI_ASSOC)) {
            $user_type = $rowut['user_type'];
        }
    }
    $current_comm = $_POST['current_comm'];
    $res          = mysqli_query($con, "SELECT * FROM suggestions WHERE id='" . $term_id . "'");
    if ($rw = mysqli_fetch_array($res, MYSQLI_ASSOC)) {
        $s_id       = $rw['id'];
        $comments   = $rw['comments'];
        $a_comments = explode("</br>", $comments);
        $delcom     = $a_comments[$current_comm - 1];
        $del1       = explode("by", $delcom);
        $ues        = $del1[1];
        $comme      = '';
        for ($c = 0; $c < count($a_comments); $c++) {
            if ($c != $current_comm - 1) {
                if (empty($comme)) {
                    $comme = $a_comments[$c];
                } else {
                    $comme = $comme . "</br>" . $a_comments[$c];
                }
            }
        }
    }
	//admin can remove all comments
    if ($user_type == "Admin") {
        $upp = mysqli_query($con, "UPDATE suggestions SET comments='" . $comme . "' WHERE id='" . $s_id . "'");
        if ($upp) {
            $upp_alert = "<font color='green'>Successfully removed</font>";
        }
    } else {
        $result22 = mysqli_query($con, "SELECT * FROM user WHERE email='" . $email . "' ");
        while ($row = mysqli_fetch_array($result22, MYSQLI_ASSOC)) {
            $username = $row['first_name'];
        }
		//trim()- used to remove the white spaces and other predefined characters from the left & right sides of a string.
        $c   = trim($ues);
        $str = trim($username);
        if ($c == $str) {
            $upp = mysqli_query($con, "UPDATE terms SET comments='" . $comme . "' WHERE id='" . $s_id . "'");
            if ($upp) {
                $upp_alert = "<font color='green'>Successfully removed</font>";
            }
        } else {
            echo "<font color='red'>sorry, you can delete only your comments.....</font>";
        }
    }
}
echo "<table width='100%' bgcolor='#FFFFFF' align='left'>";
if (isset($_POST['delete'])) {
    echo "<td align='left' width='20%'>" . $upp_alert . "</td>";
    $upp_alert = '';
}
if (!isset($_POST['Changestatus']) && !isset($_POST['Comment'])) {
    echo "<td width='50%' align='right'><a href='votesofsugg.php?err=$term.$tamil_meaning.$sinhala_meaning'>" . $votes . "</a> <font color='green'> votes</font></td>";
    $resultlike = mysqli_query($con, "SELECT * FROM likesuggestion where email='" . $email . "' AND term='" . $term . "' AND  tamil_meaning='" . $tamil_meaning . "' AND sinhala_meaning='" . $sinhala_meaning . "' ");
    if (!$resultlike)
        echo "invalid";
    if (mysqli_num_rows($resultlike) >= 1) {
        $like = 'Unlike';
        echo "<td width='30%' align='left'><font color='green'> and You like this,  <a href='likesuggestion.php?lis=$term.$tamil_meaning.$sinhala_meaning.$votes.$like.$term_id'> Unlike</a></td>";
    } else {
        $like = 'like';
        echo "<td width='30%' align='left'><input type='image' name='image' src='bullet.gif'/ height='20' width='20'><a href='likesuggestion.php?lis=$term.$tamil_meaning.$sinhala_meaning.$votes.$like.$term_id'> like</a></td>";
    }
}
echo "</table>";
$result = mysqli_query($con, "SELECT * FROM suggestions WHERE id='" . $term_id . "' ");
echo "<table width='100%' bgcolor='#FFFFFF' height='82' border='1' class='table' align='left' style='border-collapse:collapse'>";
while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
    $term = $row['term'];
    echo "<tr><td width='15%'>Term:</td><td width='85%' colspan='2'><input type='text' size='40' name='term' value='" . $row['term'] . "'/></td></tr>";
    $tamil_meaning = $row['tamil_meaning'];
    echo "<tr><td width='15%'>Tamil Meaning:</td><td width='85%' colspan='2'><input type='text' size='40' name='tamil_meaning' value='" . $row['tamil_meaning'] . "'/></td></tr>";
    $sinhala_meaning = $row['sinhala_meaning'];
    echo "<tr><td width='15%'>Sinhala Meaning:</td><td width='85%' colspan='2'><input type='text' size='40' name='sinhala_meaning' value='" . $row['sinhala_meaning'] . "'/></td></tr>";
    echo "<tr><td>Status:</td><td colspan='2'>" . $row['status'] . "</td></tr>";
    echo "<tr><td>Suggested by:</td><td colspan='2'>" . $row['suggested_by'] . "</td></tr>";
    echo "<tr><td>Suggested Date:</td><td colspan='2'>" . $row['suggested_date'] . "</td></tr></table>";
    $id = $row['id'] . ",suggestions";
    echo "<table width='100%' bgcolor='#FFFFFF' height='82' border='1' style='border-collapse:collapse' class='table' align='left'><tr><td width='15%'>Comments:</td><td width='85%' colspan='2'>";
    if ($row['comments'] != "") {
        $a_comments = explode("</br>", $row['comments']);
        echo "<div id='comments'><input type='hidden' name='current_comm' id='current_comm' value='1'/><table bgcolor='#FFFFFF' width='100%'><tr><td colspan='2'>" . $a_comments[0] . "</td></tr><tr><td>";
        if (count($a_comments) > 1) {
            echo "<input type='button' class='next' name='next' id='$id' onclick='getComments(this.name,this.id)'/>";
            $j = 1;
            while ($j <= 10 && $j <= count($a_comments)) {
                if ($j == 1) {
                    echo "<font color='red'>" . $j . "</font>&nbsp";
                } else {
                    echo "<font color='blue'>" . $j . "</font>&nbsp";
                }
                $j++;
            }
        }
        echo "</td><td>";
        if (count($a_comments) > 0) {
            echo "<input type='submit' name='delete' class='delete' value=''/>";
        }
        echo "</td></tr></table>";
    }
    echo "</div></td></tr></table>";
    echo "<table width='100%' bgcolor='#FFFFFF' height='82' border='1' style='border-collapse:collapse' class='table' align='left'><tr><td>Add Comments:</td><td colspan='2'><textarea class='ckeditor' name='message' cols='45' rows='5'></textarea>
<input type='hidden' name='votes' value='$votes'>";
    echo "<input type='hidden' name='butt' value='$term'>";
    echo "<input type='hidden' name='butt1' value='$tamil_meaning'>";
    echo "<input type='hidden' name='butt2' value='$sinhala_meaning'>";
    echo " <input type='hidden' name='votes' value='$votes'>";
    echo " <input type='hidden' name='term_id' value='$term_id'>";
    echo "<input type='submit' value='Comment' name='Comment'/></td></tr>";
    $result1 = mysqli_query($con, "SELECT * FROM system_user WHERE email='" . $email . "'");
    if (mysqli_num_rows($result1) == 1) {
        echo "<tr><td width='15%'>Change Status:</td><td width='85%' colspan='2'><Select name='addsugg'>
<Option value='null'> </Option>
<Option value='1'>To Be Discussed</Option>
<Option value='2'>accepted</Option>
</Select><input type='submit' name='Changestatus' value='Changestatus'/></td></tr>";
    }
}
echo "</table>";
echo "</form>";
include('footer.php');
?>