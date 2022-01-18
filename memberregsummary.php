<?php

session_start();

if(isset($_SESSION['ID']) && isset($_SESSION['name']) && isset($_SESSION['email']) && isset($_SESSION['admin']))
    {
    }
else {
    header('Location: memberform.php');
}
?>
       <!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Member Registration Summary</title>
            </head>
            <style>
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

            p, h2, h3 {
                text-align: center;
            }
            table {
        font-family: Arial, Helvetica, sans-serif;
        border: 1px solid black;
        text-align: center;
        align-content: center;
        margin-left: auto;
        margin-right: auto;
    }

    th, td {
        font-family: Arial, Helvetica, sans-serif;
        border: 1px solid black;
        text-align: center;
        align-content: center;
        padding-left: 10px;
        padding-right: 10px;
    }
</style>
</head>

<body>
<ul>
                        <li><a href="memberhomepage.php">Home</a></li>
                        <li><a href="eventregistrationform.php">Register for Event</a></li>
                        <li><a href="memberform.php">Register New Member</a></li>
                        <?php if($_SESSION['admin'] == 1) {
                            echo '<li><a href="eventform.php">Create Event</a></li>
                            <li><a href="tables.php">Tables</a></li>
                            <li><a href="queries.php">Queries</a></li>';
                        }
                        
                        ?>
                        
                    </ul>

            <h2>DU Statistics Society</h2>

            <h3>Membership confirmed! Below is a summary of your details:</h3>

            <table style="width: 90%" id="table">
            <tr>
                <th><strong>Member ID</strong></th>
                <th><strong>Member Name</strong></th>
                <th><strong>Date of Birth</strong></th>
                <th><strong>Email</strong></th>
                <th><strong>Phone Number</strong></th>
                <th><strong>Student Number</strong></th>
                <th><strong>Member Course</strong></th>
                <th><strong>Academic Year</strong></th>
                <th><strong>Gender</strong></th>
                <th><strong>Role</strong></th>
                <th><strong>Start Date</strong></th>
            </tr>
            <?php
            include("detail.php");
                
                $member_id = $_SESSION['ID'];
                $q = "SELECT * from member WHERE member_id = '$member_id'";
                $result = $db->query($q);
                $row = mysqli_fetch_assoc($result);
                    echo "<tr>";
                                   echo "<td>".$row['member_id']."</td>";
                                   echo "<td>".$row['member_name']."</td>";
                                   echo "<td>".$row['date_of_birth']."</td>";
                                   echo "<td>".$row['email']."</td>";
                                   echo "<td>".$row['phone_number']."</td>";
                                   echo "<td>".$row['student_number']."</td>";
                                   echo "<td>".$row['member_course']."</td>";
                                   echo "<td>".$row['academic_year']."</td>";
                                   echo "<td>".$row['student_gender']."</td>";
                                   echo "<td>".$row['member_role']."</td>";
                                   echo "<td>".$row['start_date']."</td>";
                                   echo "</tr>";
                
                mysqli_close($db);
            ?>
        </table>




            <p> <a href="memberhomepage.php">
                    <button>Confirm</button> </a> </p>


</body>

</html>