<?php

session_start();

if(isset($_SESSION['ID']) && isset($_SESSION['name']) && isset($_SESSION['email']) && isset($_SESSION['admin']))
    {
    }
else {
    header('Location: index.html');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Registration</title>

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
                        <li><a href="memberhomepage.php">Home</a></li>
                        <li><a href="memberform.php">Register New Member</a></li>
                        <?php if($_SESSION['admin'] == 1) {

                            echo '<li><a href="eventform.php">Create Event</a></li>
                            <li><a href="tables.php">Tables</a></li>
                            <li><a href="queries.php">Queries</a></li>';
                        }
                        
                        ?>
                        
                    </ul>

            <h2>DU Statistics Society</h2>

            <p><strong>Fill out the form below to register for an event: </strong></p>
            <p>Note: your Member ID is <?php echo $_SESSION['ID']?>

        <form  name="eventregistration", id="eventregistration", method="POST", action = 'registerevent.php'>
            <table>
                <caption>DU Statistics Event Registration Form</caption>

                <tr>
                    <td>
                       <label for="member_id">Member ID:</label>
                    </td>
                    <td style="padding-top: 10px;">
                        <input type="text" name="member_id" id="member_id" size = 5><br><br>
                    </td>
                </tr>

                <tr>
                    <td>
                        <label for="event_name">Event Name:</label>
                    </td>
                    <td style="padding-top: 10px;">
                        <select name="event_name" id="event_name">

                        <?php

                            include ("detail.php"); 
                                        $query = "select event_name from events";
                                        $result = $db->query($query);
                                        $num_results = mysqli_num_rows($result);

                            for($j = 0; $j<$num_results; $j++)
                            {
                                $row = mysqli_fetch_assoc($result);
                                echo '<option value = "'.$row['event_name'].'">';
                                echo $row['event_name'];
                                echo '</option>';
                            }
                            ?>
                        </select>
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