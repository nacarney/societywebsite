<?php

session_start();

if(isset($_SESSION['ID']) && isset($_SESSION['name']) && isset($_SESSION['email']) && isset($_SESSION['admin']))
    {
        if(isset($_SESSION['registration_id']) && isset($_SESSION['event_name'])) {

            unset($_SESSION['registration_id']);
            unset($_SESSION['event_name']);
        }
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
    <title>Event Form</title>
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
                <li><a href="eventregistrationform.php">Register for Event</a></li>
                <li><a href="memberform.php">Register New Member</a></li>
                <li><a href="tables.php">Tables</a></li>
                <li><a href="queries.php">Queries</a></li>
            </ul>

            <h2>DU Statistics Society</h2>

            <p><strong>Fill out the form below to create an event: </strong></p>
            <p>Note: your Member ID is <?php echo $_SESSION['ID']?>
    <form  name="eventform", id="eventform", method="POST", action = "createevent.php">

        <table>
            <caption>DU Statistics Create Event Form</caption>

            <tr>
                <td>
                    <label for="event_name">Event Name:</label>
                </td>
                <td style="padding-top: 10px;">
                    <input type ="text" name="event_name" id="event_name" size = "30"></input>
                </td>
            </tr>

            <tr>
                <td>
                    <label for="event_location">Location:</label>
                </td>
                <td style="padding-top: 10px;">
                    <textarea name="event_location" id="event_location" rows="5" cols="40"></textarea>
                </td>
            </tr>

            <tr>
                <td>
                   <label for="event_date">Event Date (YYYY/MM/DD):</label>
                </td>
                <td style="padding-top: 10px;">
                    <input type="date" id="event_date" name="event_date"
                    value="<?php echo date("Y/m/d");?>">                
                </td>
            </tr>

            <tr>
                <td>
                   <label for="event_start_time">Start Time:</label>
                </td>
                <td style="padding-top: 10px;">
                    <input type="time" id="event_start_time" name="event_start_time">                </td>
            </tr>

            <tr>
                <td>
                   <label for="event_end_time">End Time:</label>
                </td>
                <td style="padding-top: 10px;">
                    <input type="time" id="event_end_time" name="event_end_time">                
                </td>
            </tr>

            <tr>
                <td>
                    <label for="event_capacity">Capacity:</label>
                </td>
                <td style="padding-top: 10px;">
                    <input type="number" id="event_capacity" name="event_capacity" min="2" max="10000">
                </td>
            </tr>

            <tr>
                <td>
                   <label for="event_description">Description:</label>
                </td>
                <td style="padding-top: 10px;">
                    <textarea name="event_description" id="event_description" rows="5" cols="40" > </textarea>    
                </td>
            </tr>

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
                    <p>   
                        <input type="submit" value="Submit" style="padding-left: 15px; padding-right: 15px;"> 
                        
                        <input type="reset" value="Reset" style="padding-left: 15px; padding-right: 15px;">
                    </p>  
                </td>
            </tr>

            
        </table>
</body>
</form>
</html>