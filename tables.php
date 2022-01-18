<?php

session_start();

if(isset($_SESSION['ID']) && isset($_SESSION['name']) && isset($_SESSION['email']) && isset($_SESSION['admin'])) // Make sure user is on committee
    {
    }
else {
    header('Location: memberform.php'); // if user not on committee, revert back to member form to sign up
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tables</title>
</head>
<style>  /* Navigation bar + text formatting */
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
                text-align: center;
                color: cadetblue;
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
                            <li><a href="queries.php">Queries</a></li>';
                        }
                        
                        ?>
                        
                    </ul>


            <h2 style = "color: black;">DU Statistics Society</h2>
        <h2>Member Table</h2>
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
                $q = "select * from member";
                $result = $db->query($q);
                
                $num_results = mysqli_num_rows($result);
                
                for($i=0; $i < $num_results; $i++)
                {
                    $row = mysqli_fetch_assoc($result);
                    echo "<tr>";
                                   echo "<td>".$row[member_id]."</td>";
                                   echo "<td>".$row[member_name]."</td>";
                                   echo "<td>".$row[date_of_birth]."</td>";
                                   echo "<td>".$row[email]."</td>";
                                   echo "<td>".$row[phone_number]."</td>";
                                   echo "<td>".$row[student_number]."</td>";
                                   echo "<td>".$row[member_course]."</td>";
                                   echo "<td>".$row[academic_year]."</td>";
                                   echo "<td>".$row[student_gender]."</td>";
                                   echo "<td>".$row[member_role]."</td>";
                                   echo "<td>".$row[start_date]."</td>";
                                   echo "</tr>";
                }
                mysqli_close($db);
        
            ?>
        </table>
        
        <h2>Events Table</h2>
        
        
        <table style="width: 90%" id="table">
            <tr>
                <th><strong>Event ID&nbsp;</strong></th>
                <th><strong>Event Name</strong></th>
                <th><strong>Event Location</strong></th>
                <th><strong>Event Date</strong></th>
                <th><strong>Start Time</strong></th>
                <th><strong>End Time</strong></th>
                <th><strong>Capacity</strong></th>
                <th><strong>Description</strong></th>
                <th><strong>Organiser ID</strong></th>

            </tr>
            <?php
            include("detail.php");
                $q = "select * from events";
                $result = $db->query($q);
                
                $num_results = mysqli_num_rows($result);
                
                for($i=0; $i < $num_results; $i++)
                {
                    $row = mysqli_fetch_assoc($result);
                    echo "<tr>";
                                   echo "<td>".$row[event_id]."</td>";
                                   echo "<td>".$row[event_name]."</td>";
                                   echo "<td>".$row[event_location]."</td>";
                                   echo "<td>".$row[event_date]."</td>";
                                   echo "<td>".$row[event_start_time]."</td>";
                                   echo "<td>".$row[event_end_time]."</td>";
                                   echo "<td>".$row[event_capacity]."</td>";
                                   echo "<td>".$row[event_description]."</td>";
                                   echo "<td>".$row[member_id]."</td>";
                    echo "</tr>";
                }
                mysqli_close($db);
        
            ?>
        
        </table>

        
        
        <h2>Event Registration Table</h2>  
        
        
        <table style="width: 90%" id="table">
            <tr>
                <th><strong>Registration ID</strong></th>
                <th><strong>Member ID</strong></th>
                <th><strong>Event ID</strong></th>
            </tr>
            <?php
            include("detail.php");
                $q = "select * from event_registration";
                $result = $db->query($q);
                
                $num_results = mysqli_num_rows($result);
                for($i=0; $i < $num_results; $i++)
                {
                    $row = mysqli_fetch_assoc($result);
                    echo "<tr>";
                                   echo "<td>".$row[registration_id]."</td>";
                                   echo "<td>".$row[member_id]."</td>";
                                   echo "<td>".$row[event_id]."</td>";
                                   echo "</tr>";
                }
                mysqli_close($db);
        
            ?>
</body>
</html>