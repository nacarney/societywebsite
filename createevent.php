<?PHP

session_start();

include ("detail.php"); 

$event_name = $_POST['event_name'];
$event_location = $_POST['event_location'];
$event_date = $_POST['event_date'];
$event_start_time = $_POST['event_start_time'];
$event_end_time = $_POST['event_end_time'];
$event_capacity = $_POST['event_capacity'];
$event_description = $_POST['event_description'];
$member_id = $_POST['member_id'];

$_SESSION['create_event_name'] = $event_name;
$_SESSION['event_description'] = $event_description;
$_SESSION['memID'] = $member_id;

$q  = "INSERT INTO events (";
$q .= "event_name, event_location, event_date, event_start_time, event_end_time, event_capacity, event_description, member_id";
$q .= ") VALUES (";
$q .= "'$event_name', '$event_location', '$event_date', '$event_start_time', '$event_end_time', '$event_capacity', 
'$event_description', '$member_id')";

$result = $db->query($q);


header('Location: createeventsummary.php')
?>
