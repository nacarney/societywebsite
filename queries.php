<?php

session_start();

if(isset($_SESSION['ID']) && isset($_SESSION['name']) && isset($_SESSION['email']) && isset($_SESSION['admin']))
    {
    }
else {
    header('Location: member.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Queries</title>
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
            p {
                font-family: Arial, Helvetica, sans-serif;
                text-align: center;
            }
            h2 {
                text-align: center;
                color: cadetblue;
            }
            h3 {
                font-family: Arial, Helvetica, sans-serif;
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
                            <li><a href="tables.php">Tables</a></li>';
                        }
                        
                        ?>
                        
                    </ul>

            <h2 style = "color: black;">DU Statistics Society</h2>

            <h3>1. Event Organisers:</h3>

            <table>

            <tr>
                <th><strong>Event</strong></th>
                <th><strong>Organiser</strong></th>

                        <?php

                            include ("detail.php"); 
                                        $query = "SELECT event_name, member_name FROM events, member WHERE events.member_id = member.member_id";
                                        $result = $db->query($query);
                                        $num_results = mysqli_num_rows($result);
                                        
                                        for($i=0; $i < $num_results; $i++)
                                        {
                                            $row = mysqli_fetch_assoc($result);
                                            echo "<tr>";
                                                echo "<td>".$row['event_name']."</td>";
                                                echo "<td>".$row['member_name']."</td>";
                                                
                                            echo "</tr>";
                                        }
                                        mysqli_close($db);
                            ?>

                        </table>

                        <?php

                            include ("detail.php"); 
                                        $query = "SELECT COUNT(*) AS 'members' FROM member";
                                        $result = $db->query($query);
                                        $num_results = mysqli_num_rows($result);
                                        $row = mysqli_fetch_assoc($result);
                                        $member_count = $row['members'];
                                            
                            ?>

                        <br>
                        
                        <h3>2. There are <?php echo $member_count; ?> members in the DU Statistics Society</h3>

                        <h3>3. Members Sorted by Year:</h3>

                        <table>

                            <tr>
                                <th><strong>Member Name</strong></th>
                                <th><strong>Academic Year</strong></th>

                                        <?php

                                            include ("detail.php"); 
                                            $query = "SELECT member_name, academic_year FROM member ORDER BY FIELD(academic_year, 'Junior Fresh', 'Senior Fresh', 'Junior Sophister', 'Senior Sophister', 'Other')";
                                            $result = $db->query($query);
                                            $num_results = mysqli_num_rows($result);
                                            
                                            for($i=0; $i < $num_results; $i++)
                                            {
                                                $row = mysqli_fetch_assoc($result);
                                                echo "<tr>";
                                                    echo "<td>".$row['member_name']."</td>";
                                                    echo "<td>".$row['academic_year']."</td>";
                                                    
                                                echo "</tr>";
                                            }
                                            mysqli_close($db);
                                        ?>

            </table>





              


</body>
</html>