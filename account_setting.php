<?php
session_start();
$email = $_SESSION['email'];
include('header2.php');
//ChangeAccountSetting.php -> changes are saved
if (isset($_GET['msgsa'])) {
    echo $_GET['msgsa'];
}
$result = mysqli_query($con, "SELECT * FROM user WHERE email='" . $email . "'");
echo "<table width='100%' height='82' border='1' class='table' align='centre' style='border-collapse:collapse'>
<tr bgcolor='#FFFFFF'>
</tr>";
echo "<tr><td><a href='change_password.php'>Change Password</a></td></tr>";
while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
    if (isset($_GET['errr1'])) {
        echo $_GET['errr1'];
    }
    echo "<form action='ChangeAccountSetting.php' method='POST'>";
    echo "<tr>";
    $first = $row['first_name'];
    echo "<td>First name:</td><td><input type='text' name='first' size='40' value='$first'></td></tr>";
    $last = $row['last_name'];
    echo "<tr><td>Last name:</td><td><input type='text' name='last' size='40' value='$last'></td></tr>";
    $email = $row['email'];
    echo "<tr><td>email:</td><td><input type='email' name='email' size='40' value='$email'></td></tr>";
    $gender = $row['gender'];
    echo "<tr><td>Gender:</td><td>  <select name ='gender' value=''>
<option>$gender</option>
      <option value='Male'>Male</option>
    <option value='Female' >Female</option>
    </select></td></tr>";
    $language = $row['language'];
    echo "<tr><td>Language:</td><td>  <select name ='language' value=''>
<option>$language</option>
      <option value='Tamil'>Tamil</option>
    <option value='English' >English</option>
    <option value='Sinhala' >Sinhala</option>
    <option value='Tamil & Sinhala' >Tamil & Sinhala</option>
    <option value='Tamil & English' >Tamil & English</option>
	<option value='Tamil & Sinhala' >Tamil & Sinhala</option>
    <option value='Sinhala & English' >Sinhala & English</option>
    <option value='Sinhala & Tamil & English' >Sinhala & Tamil & English</option>
   </select></td></tr>";
    $country = $row['country'];
    echo "<tr><td>Country:</td><td>
<select name='country' value=''><option>$country</option>

 <option value='Afghanistan' >Afghanistan</option><option value='Albania' >Albania</option><option value='Algeri >Algeria</option><option value='American Samoa' >American Samoa</option><option value='Andorra'>Andorra</option><option value='Angola' >Angola</option><option value='Anguilla' >Anguilla</option><option value='Antarctica' >Antarctica</option><option value='Antigua and Barbuda' >Antigua and Barbuda</option>
 <option value='Argentina' >Argentina</option><option value='Armenia' >Armenia</option><option value='Aruba'>Aruba</option>
 <option value='Australia' >Australia</option><option value='Austria' >Austria</option><option value='Azerbaijan' >Azerbaijan</option>
 <option value='Bahamas' >Bahamas</option><option value='Bahrain' >Bahrain</option><option value='Bangladesh' >Bangladesh</option>
 <option value='Barbados' >Barbados</option><option value='Belarus' >Belarus</option>
 <option value='Belgium' >Belgium</option><option value='Belize' >Belize</option><option value='Benin' >Benin</option>
 <option value=Bermuda' >Bermuda</option>
 <option value='Bhutan'>Bhutan</option><option value='Bolivia' >Bolivia</option><option value='Bosnia and Herzegovina'>Bosnia and Herzegovina</option>
 <option value='Botswana' >Botswana</option><option value='Bouvet Island' >Bouvet Island</option><option value='Brazil'>Brazil</option>
 <option value='British Indian Ocean Territory' >British Indian Ocean Territory</option><option value='Brunei' >Brunei</option>
 <option value='Bulgaria' >Bulgaria</option><option value='Burkina Faso' >Burkina Faso</option><option value='Burundi' >Burundi</option>
 <option value='Cambodia' >Cambodia</option><option value='Cameroon' >Cameroon</option>
 <option value='Canada' >Canada</option><option value='Cape Verde' >Cape Verde</option><option value='Cayman Islands'>Cayman Islands</option>
 <option value='Central African Republic'>Central African Republic</option><option value='Chad' >Chad</option><option value='Chil' >Chile</option>
 <option value='China' >China</option><option value='Christmas Island'>Christmas Island</option><option value='Cocos (Keeling) Islands' >Cocos (Keeling) Islands</option>
 <option value='Colombia' >Colombia</option><option value='Comoros' >Comoros</option><option value='Congo' >Congo</option><option value='Congo (DRC)'>Congo (DRC)</option>
 <option value='Cook Islands' >Cook Islands</option><option value='Costa Rica' >Costa Rica</option><option value='Croatia (Hrvatska)' >Croatia (Hrvatska)</option>
 <option value='Cuba' >Cuba</option><option value='Cyprus' >Cyprus</option><option value='Czech Republic' >Czech Republic</option>
 <option value='Denmark' >Denmark</option><option value='Djibouti' >Djibouti</option><option value='Dominica' >Dominica</option>
 <option value='Dominican Republic' >Dominican Republic</option><option value='East Timor' >East Timor</option><option value='Ecuador' >Ecuador</option>
 <option value='Egypt' >Egypt</option><option value='El Salvador' >El Salvador</option><option value='Equatorial Guinea' >Equatorial Guinea</option>
 <option value='Eritrea' >Eritrea</option><option value='Estonia' >Estonia</option><option value='Ethiopia' >Ethiopia</option>
 <option value='Falkland Islands (Islas Malvinas)' >Falkland Islands (Islas Malvinas)</option><option value='Faroe Islands' >Faroe Islands</option>
 <option value='Fiji Islands' >Fiji Islands</option><option value='Finland'>Finland</option><option value='France' >France</option>
 <option value='French Guiana' >French Guiana</option><option value='French Polynesia' >French Polynesia</option><option value='French Southern and Antarctic Lands' >French Southern and Antarctic Lands</option>
 <option value='Gabon' >Gabon</option><option value='Gambia' >Gambia</option><option value='Georgia' >Georgia</option><option value='Germany' >Germany</option>
 <option value='Ghana' >Ghana</option><option value='Gibraltar' >Gibraltar</option><option value='Greece' >Greece</option><option value='Greenland' >Greenland</option>
 <option value='Grenada' >Grenada</option><option value='Guadeloupe' >Guadeloupe</option><option value='Guam' >Guam</option><option value='Guatemala'>Guatemala</option>
<option value='Guinea' >Guinea</option><option value='Guinea-Bissau' >Guinea-Bissau</option><option value='Guyana' >Guyana</option><option value='Haiti' >Haiti</option>
 <option value='Heard Island and McDonald Islands' >Heard Island and McDonald Islands</option><option value='Honduras' >Honduras</option>
 <option value='Hong Kong SAR' >Hong Kong SAR</option><option value='Hungary' >Hungary</option><option value='Iceland' >Iceland</option>
<option value='India' >India</option><option value='Indonesia' >Indonesia</option><option value='Iran' >Iran</option><option value='Iraq' >Iraq</option>
 <option value='Ireland' >Ireland</option><option value='Israel' >Israel</option><option value='Italy' >Italy</option><option value='Jamaica' >Jamaica</option>
<option value='Japan' >Japan</option><option value='Jordan' >Jordan</option><option value='Kazakhstan' >Kazakhstan</option><option value='Kenya' >Kenya</option>
 <option value='Kiribati' >Kiribati</option><option value='Korea' >Korea</option><option value='Kuwait' >Kuwait</option><option value='Kyrgyzstan' >Kyrgyzstan</option>
 <option value='Laos' >Laos</option><option value='Latvia' >Latvia</option><option value='Lebanon' >Lebanon</option><option value='Lesotho' >Lesotho</option>
 <option value='Liberia' >Liberia</option><option value='Libya' >Libya</option><option value='Liechtenstein' >Liechtenstein</option>
 <option value='Lithuania' >Lithuania</option><option value='Luxembourg' >Luxembourg</option><option value='Macao SAR' >Macao SAR</option>
 <option value='Macedonia' >Macedonia</option><option value='Madagascar' >Madagascar</option><option value='Malawi' >Malawi</option>
 <option value='Malaysia'>Malaysia</option><option value='Maldives' >Maldives</option><option value='Mali' >Mali</option>
 <option value='Malta' >Malta</option><option value='Marshall Islands' >Marshall Islands</option><option value='Martinique' >Martinique</option>
 <option value='Mauritania' >Mauritania</option><option value='Mauritius' >Mauritius</option><option value='Mayotte' >Mayotte</option>
 <option value='Mexico' >Mexico</option><option value='Micronesia' >Micronesia</option><option value='Moldova' >Moldova</option><option value='Monaco' >Monaco</option>
 <option value='Mongolia' >Mongolia</option><option value='Montserrat' >Montserrat</option><option value='Morocco' >Morocco</option><option value='Mozambique' >Mozambique</option>
 <option value='Myanmar' >Myanmar</option><option value='Namibia' >Namibia</option><option value='Nauru' >Nauru</option><option value='Nepal' >Nepal</option>
 <option value='Netherlands' >Netherlands</option><option value='Netherlands Antilles' >Netherlands Antilles</option><option value='New Caledonia' >New Caledonia</option>
 <option value='New Zealand' >New Zealand</option><option value='Nicaragua' >Nicaragua</option><option value='Niger' >Niger</option><option value='Nigeria' >Nigeria</option>
 <option value='Niue' >Niue</option><option value='Norfolk Island' >Norfolk Island</option><option value='North Korea' >North Korea</option>
 <option value='Northern Mariana Islands' >Northern Mariana Islands</option><option value='Norway' >Norway</option><option value='Oman' >Oman</option>
 <option value='Pakistan' >Pakistan</option><option value='Palau' >Palau</option><option value='Panama' >Panama</option><option value='Papua New Guinea' >Papua New Guinea</option>
 <option value='Paraguay' >Paraguay</option><option value='Peru' >Peru</option><option value='Philippines' >Philippines</option><option value='Pitcairn Islands' >Pitcairn Islands</option>
 <option value='Poland' >Poland</option><option value='Portugal' >Portugal</option><option value='Puerto Rico' >Puerto Rico</option><option value='Qatar' >Qatar</option>
  <option value='Reunion' >Reunion</option><option value='Romania'>Romania</option><option value='Russia' >Russia</option><option value='Rwanda' >Rwanda</option><option value='Samoa' >Samoa</option><option value='San Marino' >San Marino</option>
<option value='Saudi Arabia' >Saudi Arabia</option>
 <option value='Senegal' >Senegal</option><option value='Serbia and Montenegro' >Serbia and Montenegro</option><option value='Seychelles' >Seychelles</option><option value='Sierra Leone' >Sierra Leone</option><option value='Singapore' >Singapore</option>
 <option value='Slovakia' >Slovakia</option><option value='Slovenia' >Slovenia</option><option value='Solomon Islands' >Solomon Islands</option><option value='Somalia' >Somalia</option><option value='South Africa' >South Africa</option><option value='South Georgia' >South Georgia</option><option value='Spain' >Spain</option><option value='Sri Lanka' >Sri Lanka</option><option value='St. Helena' >St. Helena</option>
 <option value='St. Kitts and Nevis' >St. Kitts and Nevis</option><option value='St. Lucia' >St. Lucia</option><option value='St. Pierre and Miquelon' >St. Pierre and Miquelon</option><option value='St. Vincent and the Grenadines' >St. Vincent and the Grenadines</option><option value='Sudan' >Sudan</option><option value='Suriname' >Suriname</option><option value='Svalbard and Jan Mayen' >Svalbard and Jan Mayen</option>
 <option value='Swaziland' >Swaziland</option><option value='Sweden' >Sweden</option><option value='Switzerland' >Switzerland</option><option value='Syria' >Syria</option><option value='Taiwan' >Taiwan</option><option value='Tajikistan' >Tajikistan</option><option value='Tanzania' >Tanzania</option><option value='Thailand' >Thailand</option>
 <option value='Togo' >Togo</option><option value='Tokelau' >Tokelau</option><option value='Tonga' >Tonga</option><option value='Trinidad and Tobago' >Trinidad and Tobago</option><option value='Tunisia' >Tunisia</option>
 <option value='Turkey'>Turkey</option><option value='Turkmenistan' >Turkmenistan</option><option value='Turks and Caicos Islands' >Turks and Caicos Islands</option><option value='Tuvalu' >Tuvalu</option><option value='Uganda' >Uganda</option>
 <option value='Ukraine' >Ukraine</option><option value='United Arab Emirates' >United Arab Emirates</option><option value='United Kingdom' >United Kingdom</option><option value='United States' >United States</option><option value='United States Minor Outlying Islands' >United States Minor Outlying Islands</option><option value='Uruguay' >Uruguay</option>
 <option value='Uzbekistan' >Uzbekistan</option><option value='Vanuatu' >Vanuatu</option>
 <option value='Vatican City' >Vatican City</option><option value='Venezuela' >Venezuela</option><option value='Viet Nam' >Viet Nam</option>
 <option value='Virgin Islands' >Virgin Islands</option><option value='Virgin Islands (British)'>Virgin Islands (British)</option><option value='Wallis and Futuna' >Wallis and Futuna</option><option value='Yemen' >Yemen</option><option value='Zambia'>Zambia</option><option value='Zimbabwe' >Zimbabwe</option>    

 </select>

      </td>

     </tr>";
    $dob = $row['date_of_birth'];
    echo "<tr><td>Date of Birth:</td><td><input type='text' name='dob' size='40' value='$dob'></td></tr>";
    $qualification = $row['qualification'];
    echo "<tr><td>Qualification:</td><td><textarea cols='50' rows='3' name='qualification' >$qualification</textarea></td></tr>";
    $linked_in = $row['linked_in'];
    echo "<tr><td>Linked_In:</td><td><input type='url' name='linked_in' size='40' value='$linked_in'</td></tr>";
    $short_bio = $row['short_bio'];
    echo "<tr><td>Short_bio:</td><td><textarea class='ckeditor' name='short_bio' cols='45' rows='5'>$short_bio</textarea></td></tr>";
    echo "<tr><td></td><td><input name='submit' type='submit' value='Save Changes'  /></td></tr>";
    echo "</form>";
}
echo "</table>";
include("footer.php");
?>