<?php

session_start();

if(isset($_SESSION['ID']) && isset($_SESSION['name']) && isset($_SESSION['email']) && isset($_SESSION['admin'])) // checking for signed in member
    {
        if(isset($_SESSION['registration_id']) && isset($_SESSION['event_name']) && isset($_SESSION['memberRegID'])) { // unsetting session variables after coming back from event registration

            unset($_SESSION['registration_id']);
            unset($_SESSION['event_name']);
            unset($_SESSION['memberRegID']);
        }
        if(isset($_SESSION['create_event_name']) && isset($_SESSION['event_description']) && isset($_SESSION['memID'])) // unsetting session variables after user has created event
        {
            unset($_SESSION['create_event_name']);
            unset($_SESSION['event_description']);
            unset($_SESSION['memID']);
        }
    }
else {
    header('Location: index.html'); // if user is not logged in, they are required to go back to the log in page

    // I wanted to note that my member form button in the navigation bar is essentially a log out button. If you click on it and then click on 'Home'
    // Then you are brought back to the log in (index.html) page
    // In each page, navigation bar's links depend on the user's status as admin or non admin. (Admin is a committee member, non admin is a regular 'Member')
    // If a user is not admin then the session variable is 0 and 1 otherwise. Users can only see the create event, queries and tables links if they are
    // a committee member. 
}
?>
       <!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Member Home Page</title>
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


                /* Navigation Bar style from w3 schools at https://www.w3schools.com/css/css_navbar_horizontal.asp */


                    h2 {
                        text-align: center;
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

            
            
            <p style="text-align: center;"> Welcome <?php echo $_SESSION['name']?>! </p>
            <?php if ($_SESSION['admin']  == 1) {
                echo '<p style="text-align: center;">Please click on one of the options below to register for an event, or create one yourself!</p>';
                echo '<p style="text-align: center;"> <a style = "width: 50%;", href="eventform.php">';
                echo '<button>Create Event</button> </a> </p>';
                echo '<p style="text-align: center;"> <a style = "width: 50%;", href="eventregistrationform.php">';
                echo '<button>Register for Event</button> </a> </p>';
                }
                else if ($_SESSION['admin'] == 0) {
                    echo '<p style="text-align: center;">Please click below to register for an upcoming event</p>';
                    echo ' <p style="text-align: center;"> <a style = "width: 50%;", href="eventregistrationform.php">
                    <button>Register for Event</button> </a> </p>';
                }
                
            ?>
            

           
    
        </body>
        </html>
    






