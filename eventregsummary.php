<?php

session_start();

if(isset($_SESSION['ID']) && isset($_SESSION['name']) && isset($_SESSION['email']) && isset($_SESSION['admin']) && 
isset($_SESSION['memberRegID']) && isset($_SESSION['event_name']) && isset($_SESSION['registration_id']))
    {
    }
else {
    header('Location: eventregistrationform.php');
}
?>
       <!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Event Registration Summary</title>
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

                    <h2>Registration confirmed!</h2>
                    <p>Thank you for registering for <?php echo $_SESSION['event_name']?>.</p>

                    <p>Below are your registration details:</p>

                    <table>

            <tr>
                <th><strong>Registration ID</strong></th>
                <th><strong>Event</strong></th>
                <th><strong>Name</strong></th>

                        <?php

                            include ("detail.php"); 

                            $id = $_SESSION['memberRegID'];
                                        $query = "SELECT member_name FROM member WHERE member_id = '$id' LIMIT 1";
                                        $result = $db->query($query);
                                        $row = mysqli_fetch_assoc($result);

                                        echo "<tr>";
                                        
                                            echo "<td>".$_SESSION['registration_id']."</td>";
                                            echo "<td>".$_SESSION['event_name']."</td>";
                                            echo "<td>".$row['member_name']."</td>";
                                                
                                        echo "</tr>";
                                        
                                        mysqli_close($db);
                            ?>

                        </table>

                        <p> <a href="memberhomepage.php">
                    <button>Confirm</button> </a> </p>




        </body>

        </html>