<?php 

session_start();
include ("detail.php"); 

if (isset($_SESSION['ID']) && isset($_SESSION['name']) && isset($_SESSION['email']) && isset($_SESSION['admin'])) {

unset($_SESSION['ID']);
unset($_SESSION['name']);
unset($_SESSION['email']);
unset($_SESSION['admin']);
}

$emailcheck = $_POST['emailcheck'];
$q  = "SELECT email FROM member WHERE";
$q .= "(email = '$emailcheck')";

$result = $db->query($q);

$row = mysqli_fetch_assoc($result);
$email = $row['email'];



    if (empty($emailcheck) == FALSE)
    {
         if($emailcheck == $email){
            $memberidquery = "SELECT member_id FROM member WHERE";
            $memberidquery .= "(email  = '$email')";
            $idresult = $db->query($memberidquery);
            $idrow = mysqli_fetch_assoc($idresult);
            $member_id = $idrow['member_id'];


            $fullnamequery = "SELECT member_name FROM member WHERE ";
            $fullnamequery .= "email  = '$email'";
            $fullnameresult = $db->query($fullnamequery);
            $fullnamerow = mysqli_fetch_assoc($fullnameresult);
            $fullname = $fullnamerow['member_name'];

            $firstnamequery = "SELECT SUBSTRING_INDEX('$fullname', ' ', 1) AS 'firstname'";
            $firstnameresult = $db->query($firstnamequery);
            $firstnamerow = mysqli_fetch_assoc($firstnameresult);
            $firstname = $firstnamerow['firstname'];

            $adminquery = "SELECT member_role FROM member WHERE email = '$email'";
            $adminresult = $db->query($adminquery);
            $adminrow =  mysqli_fetch_assoc($adminresult);
            $admin = $adminrow['member_role'];

            $_SESSION['ID'] = $member_id;
            $_SESSION['name'] = $firstname;
            $_SESSION['email'] = $email;

            if ($admin == 'Member') {
                $_SESSION['admin'] = 0;
            }
            else {
                $_SESSION['admin'] = 1;
            }
         }
    }	

    if (isset($_SESSION['ID']) && isset($_SESSION['name']) && isset($_SESSION['email']) && isset($_SESSION['admin'])) 
    {
        header('location: memberhomepage.php');
    }
    else
    {
        header('location: memberform.php');
    }

?>