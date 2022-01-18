
<?php 

session_start();
include('detail.php');

if(isset($_SESSION['ID']) && isset($_SESSION['name']) && isset($_SESSION['email'])) // if user is already a member and logged in, they are logged out
{
    unset($_SESSION['ID']);
    unset($_SESSION['name']);
    unset($_SESSION['email']);
}
        // define variables and set to empty values

        $nameErr = $dobErr = $emailErr = $phonenumberErr = $studentnumberErr = $courseErr
        = $genderErr = $phoneErr = $roleErr = $startdateErr = "";

        $member_name = $date_of_birth = $email = $phone_number = $student_number = $member_course
         = $academic_year = $student_gender = $member_role = $start_date = "";

        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            $nameErr = $dobErr = $emailErr = $phoneErr = $studentnumberErr = $courseErr = $genderErr = $roleErr = "";

            if (empty($_POST["member_name"])) {
                $nameErr = "Name is required";
              } else {
                $member_name = test_input($_POST["member_name"]);
                // check if name only contains letters and whitespace
                if (!preg_match("/^[a-zA-Z-' ]*$/",$name)) {
                $nameErr = "Only letters and white space allowed";
                }
              }

              if (empty($_POST["date_of_birth"])) {
                $dobErr = "Date of Birth is required";
              } else {
                $date_of_birth = test_input($_POST["date_of_birth"]);
              }

            
              if (empty($_POST["email"])) {
                $emailErr = "Email is required";
              } else {
                $email = test_input($_POST["email"]); //check for correct email format
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $emailErr = "Invalid email format";
                  }
                else {
                    $duplicatequery = "SELECT email FROM member WHERE email = '$email'";
                    $duplicateresult = $db->query($duplicatequery);
                    $duplicaterow = mysqli_fetch_assoc($duplicateresult);

                    if ($email == $duplicaterow['email'])
                    {
                        $emailErr = "This email has been taken. Please enter a different email.";
                    }   
                }
              }
            
              if (empty($_POST["phone_number"])) {
                $phone_number = "";
              } else {
                    $phone_number = test_input($_POST["phone_number"]);

                    $duplicatequery = "SELECT phone_number FROM member WHERE phone_number = '$phone_number'";
                    $duplicateresult = $db->query($duplicatequery);
                    $duplicaterow = mysqli_fetch_assoc($duplicateresult);

                    if ($phone_number == $duplicaterow['phone_number'])
                    {
                        $phoneErr = "This phone number has been taken. Please enter a different number or leave this field blank.";
                    }
              }
            
              if (empty($_POST["student_number"])) {
                $studentnumberErr = "Student Number is required";
              } else {
                $student_number = test_input($_POST["student_number"]);

                $duplicatequery = "SELECT student_number FROM member WHERE student_number = '$student_number'";
                $duplicateresult = $db->query($duplicatequery);
                $duplicaterow = mysqli_fetch_assoc($duplicateresult);

                    if ($student_number == $duplicaterow['student_number'])
                    {
                        $studentnumberErr = "This student number has been taken. Please enter a valid student number.";
                    }
              }

              if (empty($_POST["member_course"])) {
                $courseErr = "Course is required";
              } else {
                $member_course = test_input($_POST["member_course"]);
                // check if name only contains letters and whitespace
                if (!preg_match("/^[a-zA-Z-' ]*$/",$member_course)) {
                $courseErr = "Only letters and white space allowed";
                }
              }

              if (empty($_POST["academic_year"])) {
                $academic_year = "";
              } else {
                $academic_year = test_input($_POST["academic_year"]);
              }

              if (empty($_POST["student_gender"])) {
                $genderErr = "A value for gender is required. If it is not something you wish to share select 'Prefer Not to Say'";
              } else {
                $student_gender = test_input($_POST["student_gender"]);
              }

              if (empty($_POST["member_role"])) {
                $member_role = "";
              } else {
                $member_role = test_input($_POST["member_role"]);
              }

              if (empty($_POST["start_date"])) {
                $start_date = "";
              } else {
                $start_date = test_input($_POST["start_date"]);
              }

            if($nameErr == "" && $emailErr == "" && $studentnumberErr == "" && $dobErr == "" && $courseErr == "" && $genderErr == ""
                        && $phoneErr == "" && $studentnumberErr == "") {

                $member_name = $_POST['member_name'];
                $date_of_birth = $_POST['date_of_birth'];
                $email = $_POST['email'];
                $phone_number = $_POST['phone_number'];
                $student_number = $_POST['student_number'];
                $member_course = $_POST['member_course'];
                $academic_year = $_POST['academic_year'];
                $student_gender = $_POST['student_gender'];
                $member_role = $_POST['member_role'];
                $start_date = $_POST['start_date'];
            
            
            $q  = "INSERT INTO member (";
            $q .= "member_name, date_of_birth, email, phone_number, student_number, member_course, academic_year, student_gender,
             member_role, start_date";
            $q .= ") VALUES (";
            $q .= "'$member_name', '$date_of_birth', '$email', '$phone_number', '$student_number', '$member_course', '$academic_year', '$student_gender', 
            '$member_role', '$start_date')";
            
            $result = $db->query($q);
            
                        $firstnamequery = "SELECT SUBSTRING_INDEX('$member_name', ' ', 1) AS 'firstname'";
                        $firstnameresult = $db->query($firstnamequery);
                        $firstnamerow = mysqli_fetch_assoc($firstnameresult);
                        $firstname = $firstnamerow['firstname'];
                        
                        $memberidquery = "SELECT member_id FROM member WHERE";
                        $memberidquery .= "(email  = '$email')";
                        $idresult = $db->query($memberidquery);
                        $idrow = mysqli_fetch_assoc($idresult);
                        $member_id = $idrow['member_id'];

                        $_SESSION['ID'] = $member_id;
                        $_SESSION['name'] = $firstname;
                        $_SESSION['email'] = $email;

                        if ($member_role == 'Member') {
                            $_SESSION['admin'] = 0;
                        }
                        else {
                            $_SESSION['admin'] = 1;
                        }

                        header('Location: memberregsummary.php');

            }
   
    }
    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
        }
        
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Member Form</title>
<style>
    form{
        
        caption-side: top;
        display: block;
        width: 60%;
        padding-left: 30%;
        
    }
    caption{
        margin-left: auto;
        margin-right: auto;
        text-align: left;
        background-color: cadetblue;
        color: black; 
        border-style: solid;
        border: black;
    }
    table{
        background-color: aliceblue;
        border: black;
        border-style: solid;
        width: 60%;
    }
            ul {
        list-style-type: none;
        margin: 0;
        padding: 0;
        overflow: hidden;
        background-color: #333;
        }

        li {
        float: left;
        }

        li a {
        display: block;
        color: white;
        text-align: center;
        padding: 14px 16px;
        text-decoration: none;
        }

        /* Change the link color to #111 (black) on hover */
        li a:hover {
        background-color: #111;
        }
            p {
                padding-left: 30%;
            }
            h2 {
                padding-left: 30%;
            }
</style>
</head>

<body>
            <ul>
                <li><a href="index.html">Home</a></li>
            </ul>

            <h2>DU Statistics Society</h2>

    <p>You have not yet registered! Please fill out the form below: </p> <br> 

    <form  name="memberform", id="memberform", method="POST", action="<?php echo htmlspecialchars($_SERVER[PHP_SELF]);?>">

        <table style = "width: 90%">
            <caption>DU Statistics Registration Form</caption>
            <tr>
                <td>
                   <label for="member_name">Name:</label>
                </td>
                <td style="padding-top: 10px;">
                    <input type="text" name="member_name" id="member_name" size = 30 value = "<?php echo $member_name;?>">
                    <span class="error">* <?php echo $nameErr;?></span><br><br>
                </td>
            </tr>

            <tr>
                <td>
                   <label for="date_of_birth">Date of Birth (YYYY/MM/DD):</label>
                </td>
                <td style="padding-top: 10px;">
                    <input type="date" id="date_of_birth" name="date_of_birth" value = "<?php echo $date_of_birth;?>">
                    <span class="error">* <?php echo $dobErr;?></span>
                </td>
            </tr>

            <tr>
                <td>
                   <label for="email">Email Address:</label>
                </td>
                <td style="padding-top: 10px;">
                    <input type="text" name="email" id="email" size = 30 value = "<?php echo $email;?>">
                    <span class="error">* <?php echo $emailErr;?></span><br><br>
                </td>
            </tr>

            <tr>
                <td>
                   <label for="phone_number">Phone Number:</label>
                </td>
                <td style="padding-top: 10px;">
                    <input type="text" name="phone_number" id="phone_number" size = 14 value = "<?php echo $phone_number;?>">
                    <span class="error"> <?php echo $phoneErr;?></span><br><br>
                    <br>
                </td>
            </tr>

            <tr>
                <td>
                    <label for="student_number">Student Number:</label>
                </td>
                <td style="padding-top: 10px;">
                    <input type="text" name="student_number" id="student_number" size = 8 value = "<?php echo $student_number;?>">
                    <span class="error">* <?php echo $studentnumberErr;?></span><br><br>
                </td>
            </tr>

            <tr>
                <td>
                   <label for="member_course">Course:</label>
                </td>
                <td style="padding-top: 10px;">
                    <input type="text" name="member_course" id="member_course" size = 30 value = "<?php echo $member_course;?>">
                    <span class="error">* <?php echo $courseErr;?></span><br><br>
                </td>
            </tr>

            <tr>
                <td>
                    <label for="academic_year">Academic Year:</label>
                </td>
                <td style="padding-top: 10px;">
                    <select name="academic_year" id="academic_year">
                    
                        <option value="Junior Fresh" <?php if (isset($academic_year) && $academic_year=="Junior Fresh") echo 'selected';?>>
                        Junior Fresh</option>

                        <option value="Senior Fresh"  <?php if (isset($academic_year) && $academic_year=="Senior Fresh") echo 'selected';?>>
                        Senior Fresh</option>

                        <option value="Junior Sophister" <?php if (isset($academic_year) && $academic_year=="Junior Sophister") echo 'selected';?>>
                        Junior Sophister</option>

                        <option value="Senior Sophister"  <?php if (isset($academic_year) && $academic_year=="Senior Sophister") echo 'selected';?>>
                            Senior Sophister</option>

                        <option value="Other" <?php if (isset($academic_year) && $academic_year=="Other") echo 'selected';?>>
                            Other</option>

                    </select>
                </td>
            </tr>

            <tr>
                <td>
                    <label for="student_gender">Gender:</label>
                </td>

              <td style="padding-top: 10px;">
                    <input type="radio"  <?php if (isset($student_gender) && $student_gender=="Male") echo 'checked';?> 
                    value="Male" name="student_gender" id="student_gender"> Male 

                    <input type="radio" <?php if (isset($student_gender) && $student_gender=="Female") echo 'checked';?>
                    value="Female" name="student_gender" id="student_gender"> Female

                    <input type="radio" <?php if (isset($student_gender) && $student_gender=="Other") echo 'checked';?>
                    value="Other" name="student_gender" id="student_gender"> Other

                    <input type="radio" <?php if (isset($student_gender) && $student_gender=="PNTS") echo 'checked';?>
                    value="PNTS" name="student_gender" id="student_gender"> Prefer Not To Say

                    <span class="error">* <?php echo $genderErr;?></span>

                </td>
            </tr>

            <tr>
                <td>
                    <label for="member_role">Role:</label>
                </td>

                <td style="padding-top: 10px;">
                    <select name="member_role" id="member_role">
                        <option value="Member" <?php if (isset($member_role) && $member_role=="Member") echo 'selected';?>>
                        Member</option>

                        <option value="OCM" <?php if (isset($member_role) && $member_role=="OCM") echo 'selected';?> >
                            OCM</option>

                        <option value="Treasurer" <?php if (isset($member_role) && $member_role=="Treasurer") echo 'selected';?> > 
                            Treasurer</option>

                        <option value="PRO" <?php if (isset($member_role) && $member_role=="PRO") echo 'selected';?> >
                            PRO</option>

                        <option value="Ents Officer" <?php if (isset($member_role) && $member_role=="Ents Officer") echo 'selected';?> >
                            Ents Officer</option>

                        <option value="Secretary" <?php if (isset($member_role) && $member_role=="Secretary") echo 'selected';?> >
                            Secretary</option>

                        <option value="Chairperson" <?php if (isset($member_role) && $member_role=="Chairperson") echo 'selected';?> >
                            Chairperson</option>

                            <span class="error">*<?php echo $roleErr;?></span>
                            
                    </select>
                </td>
            </tr>

            <tr>
                <td>
                   <label for="start_date">Start Date:</label>
                </td>
                <td style="padding-top: 10px;">
                    <input type="date" id="start_date" name="start_date"
                    value="<?php echo $start_date;?>">   
                    <span class="error"> <?php echo $startdateErr;?></span>             
                </td>               
            </tr>

            <tr>
                <td>
                    <p>   
                        <input type="submit" value="Submit" style="padding-left: 15px; padding-right: 15px;"> 
                        
                        <input type="reset" value="Reset" style="padding-left: 15px; padding-right: 15px;">
                    </p>  
                </td>
            </tr>
        </table>


        </form>
</body>

</html>