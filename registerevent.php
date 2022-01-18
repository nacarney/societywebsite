<?PHP
session_start();
include ("detail.php"); 

$event_name = $_POST['event_name'];
$_SESSION['event_name'] = $event_name;

$query = "SELECT event_id FROM events WHERE";
$query .= "(event_name = '$event_name')";
$queryresult = $db->query($query);
$row = mysqli_fetch_assoc($queryresult);
$event_id = $row['event_id'];

$member_id = $_POST['member_id'];
$_SESSION['memberRegID'] = $member_id;

$q  = "INSERT INTO event_registration (";
$q .= "member_id, event_id";
$q .= ") VALUES (";
$q .= "'$member_id', '$event_id')";

$result = $db->query($q);

$idquery = "SELECT registration_id, member_id FROM event_registration WHERE member_id = '$member_id' LIMIT 1";
$idresult = $db->query($idquery);
$idrow = mysqli_fetch_assoc($idresult);
$regid = $idrow['registration_id'];

$_SESSION['registration_id'] = $regid;



header('Location: eventregsummary.php')

?>
<