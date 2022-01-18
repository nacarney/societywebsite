<?php

session_start();

if(isset($_SESSION['ID']) && isset($_SESSION['name']) && isset($_SESSION['email']) && isset($_SESSION['admin']) && 
isset($_SESSION['create_event_name']) && isset($_SESSION['event_description']) && isset($_SESSION['memID']))
    {
    }
else {
    header('Location: eventform.php');
}
?>
       <!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Create Event Summary</title>
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
               
            h2 {
                text-align: center;
               
            }

            p {
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

                    <h2>Event Created!</h2>
                    <p>Your event, <?php echo $_SESSION['create_event_name']?>, has been created.</p>

                    <p>Below are your event details:</p>

                    <table>

            <tr>
                <th><strong>Event ID</strong></th>
                <th><strong>Event Name</strong></th>
                <th><strong>Location</strong></th>
                <th><strong>Date</strong></th>
                <th><strong>Start Time</strong></th>
                <th><strong>End Time</strong></th>
                <th><strong>Capacity</strong></th>
                <th><strong>Description</strong></th>
                <th><strong>Member ID</strong></th>
            
            </tr>


                <?php

                            include ("detail.php"); 

                            $event_name = $_SESSION['create_event_name'];
                            $event_description = $_SESSION['event_description'];
                            $member_ID = $_SESSION['memID'];

                            
                                $query = "SELECT * FROM events WHERE event_name = '$event_name' AND event_description = '$event_description'";
                                $query .= " AND member_id = '$member_ID' LIMIT 1";
                                $result = $db->query($query);
                                $row = mysqli_fetch_assoc($result);

                    echo "<tr>";
                                   echo "<td>".$row['event_id']."</td>";
                                   echo "<td>".$row['event_name']."</td>";
                                   echo "<td>".$row['event_location']."</td>";
                                   echo "<td>".$row['event_date']."</td>";
                                   echo "<td>".$row['event_start_time']."</td>";
                                   echo "<td>".$row['event_end_time']."</td>";
                                   echo "<td>".$row['event_capacity']."</td>";
                                   echo "<td>".$row['event_description']."</td>";
                                   echo "<td>".$row['member_id']."</td>";
                    
                    echo "</tr>";
                
                    mysqli_close($db);

                ?>
        </table>

                        </table>

                        <p> <a href="memberhomepage.php">
                    <button>Confirm</button> </a> </p>

        </body>

        </html>