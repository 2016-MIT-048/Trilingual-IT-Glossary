<?php
include("header1.php");
$language = "";
$email2   = "";
//isset is a function on any variable to determine if it has been set or not.
if (isset($_POST['create'])) {
    $email           = $_POST['email'];
    $firstname       = $_POST['firstname'];
    $cap             = $_POST['6_letters_code'];
    $lastname        = $_POST['lastname'];
    $gender          = $_POST['gender'];
    $date            = $_POST['day'];
    $month           = $_POST['month'];
    $year            = $_POST['year'];
    $dob             = $year . "-" . $month . "-" . $date;
    $country         = $_POST['country'];
    $language        = $_POST['language'];
    $qualification   = $_POST['qualification'];
    $linked_in       = $_POST['Linked_in'];
    $short_bio       = $_POST['short_bio'];
    $pass            = $_POST['password'];
    $confirmpa1      = $_POST['conformpassword'];
    $password        = md5($_POST['password']);
    $conformpassword = md5($_POST['conformpassword']);
    $result0         = mysqli_query($con, "SELECT * FROM user WHERE email='" . $email . "'");
    $total0          = mysqli_num_rows($result0);
    $k               = 0;
	//check the already available email in the full row ($email2)
    while ($k < $total0) {
        $row0   = mysqli_fetch_array($result0, MYSQLI_ASSOC);
        $email2 = $row0["email"];
        $k++;
    }
    if ($firstname == "") {
        echo "<font color='red'>Name is blank</font>";
    } else if (strpos($email, "@") < 1) {
        echo "<font color='red'>Wrong email!</font>";
    } else if ($gender == "") {
        echo "<font color='red'>Gender is not selected!</font>";
    } else if ($date == "") {
        echo "<font color='red'>Date of Birth is not selected!</font>";
    } else if ($month == "") {
        echo "<font color='red'>Date of Birth is not selected!</font>";
    } else if ($year == "") {
        echo "<font color='red'>Date of Birth is not selected!</font>";
    } else if ($email == "") {
        echo "<font color='red'>email is blank!</font>";
    } else if ($lastname == "") {
        echo "<font color='red'>Lastname  is blank!</font>";
    } else if ($email == $email2) {
        echo "<font color='red'>Email Already Taken!</font>";
    } else if ($country == "") {
        echo "<font color='red'>Country is blank!</font>";
    } else if ($pass == "") {
        echo "<font color='red'>Password is blank!</font>";
    } else if ($qualification == "") {
        echo "<font color='red'>qualification  is blank!</font>";
    } else {
        if (strlen($pass) <= 5) {
            echo "<font color='red'>Password must be in six characters..</font>";
        } else {
            if ($pass == $confirmpa1) {
                if ($cap == "") {
                    $_SESSION['errors'] = "\n Please type the captcha code!";
                } else {
					//strcmp() - is used to compare two strings. capital, small also can compare
                    if (empty($_SESSION['6_letters_code']) || strcmp($_SESSION['6_letters_code'], $_POST['6_letters_code']) != 0) {
                        $errors .= "\n The captcha code does not match!";
                    } else {
                        $query = "INSERT INTO user (email, first_name, last_name, gender, date_of_birth, country, language,qualification,linked_in,short_bio,password) VALUES ('" . $email . "', '" . $firstname . "', '" . $lastname . "', '" . $gender . "', '" . $dob . "', '" . $country . "','" . $language . "','" . $qualification . "','" . $linked_in . "','" . $short_bio . "','" . $password . "')";
                        $rez   = mysqli_query($con, $query);
                        if ($rez) {
                            echo "<font color='green'>Account Successfully Created. Please Login!</font>";
                        }
                    }
                }
            } else {
                echo "<font color='red'>Check/Confirm Passwords!</font>";
            }
        }
    }
}
?>
<table width='300'>
<tr><td><?php
//concatinate the errors- if error not empty
if (!empty($errors)) {
	// nl2br- go to the next line
    echo "<font color='red'><p class='err'>" . nl2br($errors) . "</p></font>";
}
?></td>
</tr>
</table>
<table border="0"  cellspacing="3" cellpadding="2" class="content" width="100%" align="left">
 <tr>
<td colspan="3" align="center" bgcolor="#CCCCCC" class="font_size" class="font">
<h2>Welcome to Trilingual IT Glossary Management System </h2><br>
</td>
</tr>
<form id="register"   action="#" method="post">
<tr>
 <td align="right" bgcolor="#D3DDFF" class="font">First Name :</td>
   <td  bgcolor="#B9C7C8"><input type="text" name="firstname" maxlength=30 size="30"  value=''></td> </tr>
 <tr>
  <td  align="right" bgcolor="#D3DDFF" class="font">Last Name :</td>
  <td  bgcolor="#B9C7C8"><input type="text" name="lastname" maxlength="20" size="30" value=''></td>
 </tr>
<tr>
  <td  align="right" bgcolor="#D3DDFF" class="font" >Gender:</td>
<td  bgcolor="#B9C7C8">
<select name="gender" style="width:100px;" value='' >
<option> </option>
 <option value="Male" >Male</option>
 <option value="Female" >Female</option>
 </select>
 </td>
 </tr>
  <tr>
  <td  align="right" bgcolor="#D3DDFF" class="font">Birth of date:</td>
<td  bgcolor="#B9C7C8">
<select name="day"style="width:50px;" value=''>
                                         
                                                                        <option></option>
                                                                       <option value="01" >01</option><option value="02" >02</option><option value="03" >03</option><option value="04" >04</option><option value="05" >05</option><option value="06" >06</option><option value="07" >07</option><option value="08" >08</option><option value="09" >09</option><option value="10" >10</option><option value="11" >11</option><option value="12" >12</option><option value="13" >13</option><option value="14" >14</option><option value="15" >15</option><option value="16" >16</option><option value="17" >17</option><option value="18" >18</option><option value="19" >19</option><option value="20" >20</option><option value="21" >21</option><option value="22" >22</option><option value="23" >23</option><option value="24" >24</option><option value="25" >25</option><option value="26" >26</option><option value="27" >27</option><option value="28" >28</option><option value="29" >29</option><option value="30" >30</option><option value="31" >31</option></select>.

                                                                        <select name="month" style="width:100px;">

                                                                        
                                                                        <option></option>
                                                                        <option value="1" >1</option><option value="2" >2</option><option value="3" >3</option><option value="4" >4</option><option value="5" >5</option><option value="6" >6</option><option value="7" >7</option><option value="8" >8</option><option value="9" >9</option><option value="10" >10</option><option value="11" >11</option><option value="12" >12</option>                                                                       
                                                                        </select>
                                                                        <select name="year" style="width:100px;">

                                                                      
                        <option></option>
                        <option value="2014" >2014</option><option value="2013" >2013</option><option value="2012" >2012</option>
                        <option value="2011" >2011</option><option value="2010" >2010</option><option value="2009" >2009</option><option value="2008" >2008</option><option value="2007" >2007</option><option value="2006" >2006</option><option value="2005" >2005</option><option value="2004" >2004</option><option value="2003" >2003</option><option value="2002" >2002</option><option value="2001" >2001</option><option value="2000" >2000</option><option value="1999" >1999</option><option value="1998" >1998</option><option value="1997" >1997</option><option value="1996" >1996</option><option value="1995" >1995</option><option value="1994" >1994</option><option value="1993" >1993</option><option value="1992" >1992</option><option value="1991" >1991</option><option value="1990" >1990</option><option value="1989" >1989</option><option value="1988" >1988</option><option value="1987" >1987</option><option value="1986" >1986</option><option value="1985" >1985</option><option value="1984" >1984</option><option value="1983" >1983</option><option value="1982" >1982</option><option value="1981" >1981</option><option value="1980" >1980</option><option value="1979" >1979</option><option value="1978" >1978</option><option value="1977" >1977</option><option value="1976" >1976</option><option value="1975" >1975</option><option value="1974" >1974</option><option value="1973" >1973</option><option value="1972" >1972</option><option value="1971" >1971</option><option value="1970" >1970</option><option value="1969" >1969</option><option value="1968" >1968</option><option value="1967" >1967</option><option value="1966" >1966</option><option value="1965" >1965</option><option value="1964" >1964</option><option value="1963" >1963</option><option value="1962" >1962</option><option value="1961" >1961</option><option value="1960" >1960</option><option value="1959" >1959</option><option value="1958" >1958</option><option value="1957" >1957</option><option value="1956" >1956</option><option value="1955" >1955</option><option value="1954" >1954</option></select></nobr>
</td>
 </tr>
 <tr>
  <td  align="right" bgcolor="#D3DDFF" class="font">EMail :</td>
  <td  bgcolor="#B9C7C8"><input type="email" name="email" size="30" value=''></td>
 </tr>
 <tr>
  <td  align="right" bgcolor="#D3DDFF" valign="top" class="font">Password:</td> 
 <td  bgcolor="#B9C7C8" colspan="2">
  <input type="password" name="password" size="30" value=''>   <font size="2" color="green"><I>Six or more characters</I></font></td></tr>
 <tr><td  align="right" bgcolor="#D3DDFF" valign="top" class="font"> Confirm Password: </td><td bgcolor="#B9C7C8">
 <input type="password" name="conformpassword" size="30" value=''></td>
 </tr>
   <tr>
      <td align="right" bgcolor="#D3DDFF" valign="top" class="font">Country :</td>
      <td  bgcolor="#B9C7C8">
   <select name="country" style="width:250px;" value=''><option></option>
 <option value="Afghanistan" >Afghanistan</option><option value="Albania" >Albania</option><option value="Algeria" >Algeria</option><option value="American Samoa" >American Samoa</option><option value="Andorra" >Andorra</option><option value="Angola" >Angola</option><option value="Anguilla" >Anguilla</option><option value="Antarctica" >Antarctica</option><option value="Antigua and Barbuda" >Antigua and Barbuda</option>   
  <option value="Argentina" >Argentina</option><option value="Armenia" >Armenia</option><option value="Aruba" >Aruba</option><option value="Australia" >Australia</option><option value="Austria" >Austria</option><option value="Azerbaijan" >Azerbaijan</option>
 <option value="Bahamas" >Bahamas</option><option value="Bahrain" >Bahrain</option><option value="Bangladesh" >Bangladesh</option><option value="Barbados" >Barbados</option><option value="Belarus" >Belarus</option>
 <option value="Belgium" >Belgium</option><option value="Belize" >Belize</option><option value="Benin" >Benin</option><option value="Bermuda" >Bermuda</option>
 <option value="Bhutan" >Bhutan</option><option value="Bolivia" >Bolivia</option><option value="Bosnia and Herzegovina" >Bosnia and Herzegovina</option>
 <option value="Botswana" >Botswana</option><option value="Bouvet Island" >Bouvet Island</option><option value="Brazil" >Brazil</option>
 <option value="British Indian Ocean Territory" >British Indian Ocean Territory</option><option value="Brunei" >Brunei</option>
 <option value="Bulgaria" >Bulgaria</option><option value="Burkina Faso" >Burkina Faso</option><option value="Burundi" >Burundi</option>
 <option value="C?te d'Ivoire" >C?te d'Ivoire</option><option value="Cambodia" >Cambodia</option><option value="Cameroon" >Cameroon</option>
 <option value="Canada" >Canada</option><option value="Cape Verde" >Cape Verde</option><option value="Cayman Islands" >Cayman Islands</option>
 <option value="Central African Republic" >Central African Republic</option><option value="Chad" >Chad</option><option value="Chile" >Chile</option>
 <option value="China" >China</option><option value="Christmas Island" >Christmas Island</option><option value="Cocos (Keeling) Islands" >Cocos (Keeling) Islands</option>
 <option value="Colombia" >Colombia</option><option value="Comoros" >Comoros</option><option value="Congo" >Congo</option><option value="Congo (DRC)" >Congo (DRC)</option>
 <option value="Cook Islands" >Cook Islands</option><option value="Costa Rica" >Costa Rica</option><option value="Croatia (Hrvatska)" >Croatia (Hrvatska)</option>
 <option value="Cuba" >Cuba</option><option value="Cyprus" >Cyprus</option><option value="Czech Republic" >Czech Republic</option>
 <option value="Denmark" >Denmark</option><option value="Djibouti" >Djibouti</option><option value="Dominica" >Dominica</option>
 <option value="Dominican Republic" >Dominican Republic</option><option value="East Timor" >East Timor</option><option value="Ecuador" >Ecuador</option>
 <option value="Egypt" >Egypt</option><option value="El Salvador" >El Salvador</option><option value="Equatorial Guinea" >Equatorial Guinea</option>
 <option value="Eritrea" >Eritrea</option><option value="Estonia" >Estonia</option><option value="Ethiopia" >Ethiopia</option>
 <option value="Falkland Islands (Islas Malvinas)" >Falkland Islands (Islas Malvinas)</option><option value="Faroe Islands" >Faroe Islands</option>
 <option value="Fiji Islands" >Fiji Islands</option><option value="Finland" >Finland</option><option value="France" >France</option>
 <option value="French Guiana" >French Guiana</option><option value="French Polynesia" >French Polynesia</option><option value="French Southern and Antarctic Lands" >French Southern and Antarctic Lands</option>
 <option value="Gabon" >Gabon</option><option value="Gambia" >Gambia</option><option value="Georgia" >Georgia</option><option value="Germany" >Germany</option>
 <option value="Ghana" >Ghana</option><option value="Gibraltar" >Gibraltar</option><option value="Greece" >Greece</option><option value="Greenland" >Greenland</option>
 <option value="Grenada" >Grenada</option><option value="Guadeloupe" >Guadeloupe</option><option value="Guam" >Guam</option><option value="Guatemala" >Guatemala</option>
 <option value="Guinea" >Guinea</option><option value="Guinea-Bissau" >Guinea-Bissau</option><option value="Guyana" >Guyana</option><option value="Haiti" >Haiti</option>
 <option value="Heard Island and McDonald Islands" >Heard Island and McDonald Islands</option><option value="Honduras" >Honduras</option>
 <option value="Hong Kong SAR" >Hong Kong SAR</option><option value="Hungary" >Hungary</option><option value="Iceland" >Iceland</option>
 <option value="India" >India</option><option value="Indonesia" >Indonesia</option><option value="Iran" >Iran</option><option value="Iraq" >Iraq</option>
 <option value="Ireland" >Ireland</option><option value="Israel" >Israel</option><option value="Italy" >Italy</option><option value="Jamaica" >Jamaica</option>
 <option value="Japan" >Japan</option><option value="Jordan" >Jordan</option><option value="Kazakhstan" >Kazakhstan</option><option value="Kenya" >Kenya</option>
 <option value="Kiribati" >Kiribati</option><option value="Korea" >Korea</option><option value="Kuwait" >Kuwait</option><option value="Kyrgyzstan" >Kyrgyzstan</option>
 <option value="Laos" >Laos</option><option value="Latvia" >Latvia</option><option value="Lebanon" >Lebanon</option><option value="Lesotho" >Lesotho</option>
 <option value="Liberia" >Liberia</option><option value="Libya" >Libya</option><option value="Liechtenstein" >Liechtenstein</option>
 <option value="Lithuania" >Lithuania</option><option value="Luxembourg" >Luxembourg</option><option value="Macao SAR" >Macao SAR</option>
 <option value="Macedonia" >Macedonia</option><option value="Madagascar" >Madagascar</option><option value="Malawi" >Malawi</option>
 <option value="Malaysia" >Malaysia</option><option value="Maldives" >Maldives</option><option value="Mali" >Mali</option>
 <option value="Malta" >Malta</option><option value="Marshall Islands" >Marshall Islands</option><option value="Martinique" >Martinique</option>
 <option value="Mauritania" >Mauritania</option><option value="Mauritius" >Mauritius</option><option value="Mayotte" >Mayotte</option>
 <option value="Mexico" >Mexico</option><option value="Micronesia" >Micronesia</option><option value="Moldova" >Moldova</option><option value="Monaco" >Monaco</option>
 <option value="Mongolia" >Mongolia</option><option value="Montserrat" >Montserrat</option><option value="Morocco" >Morocco</option><option value="Mozambique" >Mozambique</option>
 <option value="Myanmar" >Myanmar</option><option value="Namibia" >Namibia</option><option value="Nauru" >Nauru</option><option value="Nepal" >Nepal</option>
 <option value="Netherlands" >Netherlands</option><option value="Netherlands Antilles" >Netherlands Antilles</option><option value="New Caledonia" >New Caledonia</option>
 <option value="New Zealand" >New Zealand</option><option value="Nicaragua" >Nicaragua</option><option value="Niger" >Niger</option><option value="Nigeria" >Nigeria</option>
 <option value="Niue" >Niue</option><option value="Norfolk Island" >Norfolk Island</option><option value="North Korea" >North Korea</option>
 <option value="Northern Mariana Islands" >Northern Mariana Islands</option><option value="Norway" >Norway</option><option value="Oman" >Oman</option>
 <option value="Pakistan" >Pakistan</option><option value="Palau" >Palau</option><option value="Panama" >Panama</option><option value="Papua New Guinea" >Papua New Guinea</option>
 <option value="Paraguay" >Paraguay</option><option value="Peru" >Peru</option><option value="Philippines" >Philippines</option><option value="Pitcairn Islands" >Pitcairn Islands</option>
 <option value="Poland" >Poland</option><option value="Portugal" >Portugal</option><option value="Puerto Rico" >Puerto Rico</option><option value="Qatar" >Qatar</option>
<option value="Reunion" >Reunion</option><option value="Romania" >Romania</option><option value="Russia" >Russia</option><option value="Rwanda" >Rwanda</option><option value="Samoa" >Samoa</option><option value="San Marino" >San Marino</option>
 <option value="Saudi Arabia" >Saudi Arabia</option>
 <option value="Senegal" >Senegal</option><option value="Serbia and Montenegro" >Serbia and Montenegro</option><option value="Seychelles" >Seychelles</option><option value="Sierra Leone" >Sierra Leone</option><option value="Singapore" >Singapore</option>
 <option value="Slovakia" >Slovakia</option><option value="Slovenia" >Slovenia</option><option value="Solomon Islands" >Solomon Islands</option><option value="Somalia" >Somalia</option><option value="South Africa" >South Africa</option><option value="South Georgia" >South Georgia</option><option value="Spain" >Spain</option><option value="Sri Lanka" >Sri Lanka</option><option value="St. Helena" >St. Helena</option>
 <option value="St. Kitts and Nevis" >St. Kitts and Nevis</option><option value="St. Lucia" >St. Lucia</option><option value="St. Pierre and Miquelon" >St. Pierre and Miquelon</option><option value="St. Vincent and the Grenadines" >St. Vincent and the Grenadines</option><option value="Sudan" >Sudan</option><option value="Suriname" >Suriname</option><option value="Svalbard and Jan Mayen" >Svalbard and Jan Mayen</option>
 <option value="Swaziland" >Swaziland</option><option value="Sweden" >Sweden</option><option value="Switzerland" >Switzerland</option><option value="Syria" >Syria</option><option value="Taiwan" >Taiwan</option><option value="Tajikistan" >Tajikistan</option><option value="Tanzania" >Tanzania</option><option value="Thailand" >Thailand</option>
 <option value="Togo" >Togo</option><option value="Tokelau" >Tokelau</option><option value="Tonga" >Tonga</option><option value="Trinidad and Tobago" >Trinidad and Tobago</option><option value="Tunisia" >Tunisia</option>
 <option value="Turkey" >Turkey</option><option value="Turkmenistan" >Turkmenistan</option><option value="Turks and Caicos Islands" >Turks and Caicos Islands</option><option value="Tuvalu" >Tuvalu</option><option value="Uganda" >Uganda</option>
 <option value="Ukraine" >Ukraine</option><option value="United Arab Emirates" >United Arab Emirates</option><option value="United Kingdom" >United Kingdom</option><option value=">United States" >United States</option><option value="United States Minor Outlying Islands" >United States Minor Outlying Islands</option><option value="Uruguay" >Uruguay</option><option value="Uzbekistan" >Uzbekistan</option><option value="Vanuatu" >Vanuatu</option>
 <option value="Vatican City" >Vatican City</option><option value="Venezuela" >Venezuela</option><option value="Viet Nam" >Viet Nam</option>
 <option value="Virgin Islands" >Virgin Islands</option><option value="Virgin Islands (British)" >Virgin Islands (British)</option><option value="Wallis and Futuna" >Wallis and Futuna</option><option value="Yemen" >Yemen</option><option value="Zambia" >Zambia</option><option value="Zimbabwe" >Zimbabwe</option>         
 </select>
      </td>
     </tr>
<?php
$resultl = mysqli_query($con, "SELECT * FROM language");
echo "<tr><td  align='right' bgcolor='#D3DDFF' class='font'>Language: </td>";
echo "<td  bgcolor='#B9C7C8'>";
echo "<select name='language' value=''>";
if ($language == "") {
    echo "<option value=''>Select language</option>";
} else {
    echo "<option value='$language'>$language</option>";
}
while ($row = mysqli_fetch_array($resultl, MYSQLI_ASSOC)) {
    $value = $row['language'];
    echo "<option value='$value'>$value</option>";
}
echo "</select>";
?>
  <tr>
  <td  align="right" bgcolor="#D3DDFF"  class="font">Qualification:</td>
  <td   bgcolor="#B9C7C8"><input type="text" name="qualification" size="40" value='' maxlength="50"></td>
 </tr>
<td  align="right" bgcolor="#D3DDFF" class="font">linked In :</td>
  <td  bgcolor="#B9C7C8"><input type="url" name="Linked_in" size="40" value=''></td>
 </tr>
 <tr>
  <td  align="right" bgcolor="#D3DDFF" valign="top" class="font">Sort Bio:</td>
  <td  bgcolor="#B9C7C8" colspan="2" ><textarea cols="50" rows="10" name="short_bio" class='ckeditor' ></textarea></td>
 </tr>
<tr><td align="center">
<img src="captcha_code_file.php?rand=<?php
echo rand();
?>" id='captchaimg' ><br>
  <label for='message'>Enter the code above here :</label><br>
  <input id="6_letters_code" name="6_letters_code" type="text"><br>
  <small>Can't read the image? click <a href='javascript: refreshCaptcha();'>here</a> to refresh</small>
    <br/>
    <input type="submit" value="submit" name="create"/>
   </td></tr>
 </form>
</table>
<?php
include("footer1.php");
?>
</body>
</html>