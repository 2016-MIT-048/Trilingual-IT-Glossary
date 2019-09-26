<?php
session_start();
$email = $_SESSION['email'];
include('header2.php');
if (isset($_GET['li'])) {
    $word = $_GET['li'];
}
if (isset($_POST['Comment'])) {
    $term            = $_POST['butt'];
    $tamil_meaning   = $_POST['butt1'];
    $sinhala_meaning = $_POST['butt2'];
    $term_id         = $_POST['term_un_id'];
    $votes           = $_POST['votes'];
    $com             = $_POST['message'];
    $status          = "Pending Review";
    $resTerms        = mysqli_query($con, "SELECT * FROM terms WHERE id='" . $term_id . "'");
    while ($rowTerm = mysqli_fetch_assoc($resTerms)) {
        $votes = $rowTerm['votes'];
    }
    echo "<table width='100%' bgcolor='#FFFFFF' align='left'>";
    echo "<td width='6%' align='right'> <a href='votes.php?err=$term.$tamil_meaning.$sinhala_meaning'>" . $votes . "</a> <font color='green'>votes</font></td>";
    $resultlike = mysqli_query($con, "SELECT * FROM liketable where email='" . $email . "' AND term_id='" . $term_id . "'  ");
    if (mysqli_num_rows($resultlike) >= 1) {
        $like = 'Unlike';
        echo "<td width='30%'><font color='green'> and You like this,  </font><a href='like.php?li=$term.$tamil_meaning.$sinhala_meaning.$like.$term_id'> Unlike</a></td>";
    } else {
        $like = 'like';
        echo "<td width='30%'><input type='image' name='image' src='bullet.gif'/ height='20' width='20'><a href='like.php?li=$term.$tamil_meaning.$sinhala_meaning.$like.$term_id'> like</a></td>";
    }
    echo "</table>";
    $result2 = mysqli_query($con, "SELECT * FROM user WHERE email='" . $email . "' ");
    while ($row = mysqli_fetch_assoc($result2))
        $username = $row['first_name'];
    if ($com == "") {
        echo "<table border='0' bgcolor='#FFFFFF' cellspacing='1' cellpadding='2'  align='left' width='100%'>
<tr><td><font color='red'><b>please enter the comment and then click the button......</b></font></td></tr></TABLE>";
    } else {
        $com    = str_replace("<p>", "", $com);
        $com    = str_replace("</p>", "", $com);
        $result = mysqli_query($con, "SELECT * FROM terms WHERE id='" . $term_id . "'");
        while ($row = mysqli_fetch_assoc($result)) {
            $oldcomm = $row['comments'];
        }
        $c = $com . " ......by " . $username;
        if ($oldcomm == "") {
            $co = $c;
        } else {
            $co = $oldcomm . "</br>" . $c;
        }
        mysqli_query($con, "UPDATE terms SET comments = '" . $co . "'
WHERE id='" . $term_id . "'");
        echo "<table border='0' bgcolor='#FFFFFF' cellspacing='1' cellpadding='2'  align='left' width='100%'>
<tr><td><font color='green'><b>Your comment is added......</b></font></td></tr></table>";
        $term_id         = $term_id;
        $sinhala_meaning = $_POST['butt2'];
        $votes           = $_POST['votes'];
        $com             = $_POST['message'];
    }
} else {
    $arrr            = explode('.', $word);
    $term            = $arrr[0];
    $tamil_meaning   = $arrr[1];
    $sinhala_meaning = $arrr[2];
    $votes           = $arrr[3];
    $term_id         = $arrr[4];
}
if (isset($_POST['delete'])) {
    $resultut = mysqli_query($con, "SELECT * FROM system_user WHERE email='" . $email . "'");
    if ($resultut) {
        if ($rowut = mysqli_fetch_array($resultut, MYSQLI_ASSOC)) {
            $user_type = $rowut['user_type'];
        }
    }
    $current_comm = $_POST['current_comm'];
    $res          = mysqli_query($con, "SELECT * FROM terms WHERE id='" . $term_id . "'");
    if ($rw = mysqli_fetch_array($res)) {
        $s_id     = $rw['id'];
        $comments = $rw['comments'];
        echo $comments;
        $a_comments = explode("</br>", $comments);
        echo $current_comm;
        $delcom = $a_comments[$current_comm - 1];
        $del1   = explode("by", $delcom);
        $ues    = $del1[1];
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
    if ($user_type == "Admin") {
        $upp = mysqli_query($con, "UPDATE terms SET comments='" . $comme . "' WHERE id='" . $s_id . "'");
        if ($upp) {
            $upp_alert = "<font color='green'>Successfully removed</font>";
        }
    } else {
        $result22 = mysqli_query("SELECT * FROM user WHERE email='" . $email . "' ");
        while ($row = mysqli_fetch_array($result22)) {
            $username = $row['first_name'];
        }
        $c   = trim($ues);
        $str = trim($username);
        if ($c == $str) {
            $upp = mysqli_query("UPDATE terms SET comments='$comme' WHERE id='$s_id'");
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
if (!isset($_POST['Comment'])) {
    echo "<td width='50%' align='right'> <a href='votes.php?err=$term.$tamil_meaning.$sinhala_meaning'>" . $votes . "</a> <font color='green'>votes</font></td>";
    $resultlike = mysqli_query($con, "SELECT * FROM liketable where email='" . $email . "' AND term_id='" . $term_id . "'");
    if (mysqli_num_rows($resultlike) >= 1) {
        $like = 'Unlike';
        echo "<td width='30%'><font color='green'> and You like this,  </font><a href='like.php?li=$term.$tamil_meaning.$sinhala_meaning.$like.$term_id'> Unlike</a></td>";
    } else {
        $like = 'like';
        echo "<td width='30%'><input type='image' name='image' src='bullet.gif'/ height='20' width='20'><a href='like.php?li=$term.$tamil_meaning.$sinhala_meaning.$like.$term_id'> likes</a></td>";
    }
}
echo "</table>";
//update & delete the term
$result = mysqli_query($con, "SELECT * FROM terms WHERE id='" . $term_id . "'");
while ($row = mysqli_fetch_assoc($result)) {
    echo "<form action='updateTerms.php' method='POST' name='form'>";
    if (strcmp($user_type, "Admin") == 0) {
        echo '<a style="margin-left:50%;color:white" href="removeTerms.php?Id=' . $term_id . '"  class="btn btn-danger">Remove Term</a>';
        echo '<span>';
        echo '<button style="margin-left:5px" name="save_button" type="submit" class="btn btn-info">Update</button>';
        echo '</span>';
        echo '<br/>';
        echo '<br/>';
    }
    echo "<table width='100%' bgcolor='#FFFFFF' height='82' border='1' style='border-collapse:collapse' class='table' align='left'>";
    echo "<tr>";
	// if admin can edit the terms
    if (strcmp($user_type, "Admin") == 0) {
        echo "<input type='hidden' name='term_id' value='$term_id'>";
        echo "<input type='hidden' name='votes' value='$votes'>";
        echo "<td width='25%'>Term:</td><td width='75%'><input type='text' name='butt' value='$term'></td></tr>";
        echo "<tr><td>Tamil Meaning:</td><td><input type='text' name='butt1' value='$tamil_meaning'></td></tr>";
        echo "<tr><td>Sinhala Meaning:</td><td><input type='text' name='buts1' value='$sinhala_meaning'></td></tr>";
    } else {
        echo "<td width='25%'>Term:</td><td width='75%'>" . $row['term'] . "<input type='hidden' name='butt' value='$term'></td></tr>";
        echo "<tr><td>Tamil Meaning:</td><td>" . $row['tamil_meaning'] . "  <input type='hidden' name='butt1' value='$tamil_meaning'></td></tr>";
        echo "<tr><td>Sinhala Meaning:</td><td>" . $row['sinhala_meaning'] . " <input type='hidden' name='butt1' value='$sinhala_meaning'></td></tr>";
    }
    echo '</form>';
    echo "<form action='moredetails.php' method='POST' name='form'>";
    echo "<tr><td>Suggested by:</td><td>" . $row['suggested_by'] . "</td></tr>";
    echo "<tr><td>Suggested Date:</td><td>" . $row['suggested_date'] . "</td></tr>";
    echo "<tr><td>Checked by:</td><td>" . $row['checked_by'] . "</td></tr>";
    echo "<tr><td>Accepted Date:</td><td>" . $row['accepted_date'] . "</td></tr></table>";
    $votes = $row['votes'];
    $id    = $row['id'] . ",terms";
    echo "<table width='100%' bgcolor='#FFFFFF' height='82' border='1' style='border-collapse:collapse' class='table' align='left'>
    <tr>
    <td width='25%'>Comments:</td>
    <td width='75%' colspan='2'>";
    if ($row['comments'] != "") {
        $a_comments = explode("</br>", $row['comments']);
        echo "<div id='comments'>
        <input type='hidden' name='current_comm' id='current_comm' value='1'/>
        <table width='100%' bgcolor='#FFFFFF'>
        <tr>
            <td>";
        if (count($a_comments) > 1) {
            $j = 0;
            while ($j <= 10 && $j < count($a_comments)) {
                echo "<tr>
                   <td colspan='2'>" . $a_comments[$j] . "</td>
                </tr>";
                $j++;
            }
        } else if (count($a_comments) == 1) {
            echo "<tr>
                   <td colspan='2'>" . $a_comments[0] . "</td>
                </tr>";
        }
        echo "</td>
        </tr>
    </table>";
    }
    echo "</div></td></tr></table>";
    echo "<table width='100%' bgcolor='#FFFFFF' height='82' border='1' style='border-collapse:collapse' class='table' align='left'><tr><td width='25%'>Add Comments:</td><td width='75%' colspan='2'><textarea class='ckeditor' name='message' cols='45' rows='5'></textarea>
<input type='hidden' name='votes' value='$votes'><input type='submit' name='Comment' value='Comment'/>";
    echo "<input type='hidden' name='butt' value='$term'>";
    echo "<input type='hidden' name='butt1' value='$tamil_meaning'>";
    echo "<input type='hidden' name='butt2' value='$sinhala_meaning'>";
    echo " <input type='hidden' name='votes' value='$votes'>";
    echo " <input type='hidden' name='term_un_id' value='$term_id'>";
    echo "</td></tr>";
    echo "</tr>";
}
echo "</table>";
echo "</form>";
include('footer.php');
?>