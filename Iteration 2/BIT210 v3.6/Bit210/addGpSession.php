<?php
	session_start();

	$traineID = $_SESSION['user_ID'];
	//echo $traineID;

	$title = $_POST['title'];
	$date = $_POST['date'];
	$time = $_POST['time'];
	$fee = $_POST['fee'];
	$maxParticipants = $_POST['maxParticipant'];
	$type = $_POST['classType'];

	//echo $title,$date,$time,$fee;

	$notes = "null";
	$sessionType = "Group Training Session";

	$conn = mysqli_connect("localhost","root","","helpfit");

	if ($conn->connect_error){
		die("Connection failed: ".$conn->connect_error);
	}

	if (isset($_POST['submit'])) {

		if (!empty($title)&&!empty($date)&&!empty($time)&&!empty($fee)&&!empty($maxParticipants)&&!empty($type)&&!empty($traineID)) {
			if(is_numeric($fee)){
				$sql = "INSERT INTO trainingsession (titel, date, time, feee, notes,sessionType ,classType, maxParticipants, trainerID)	VALUES ('$title','$date','$time','$fee','$notes','$sessionType', '$type','$maxParticipants','$traineID')";

						if ($conn->query($sql) == TRUE && mysqli_affected_rows($conn) >0){

							echo '<script language = "javascript">';
							echo 'alert("Record Added successfully")';
							echo '</script>';
							echo  "<script> window.location.assign('trainer_session_group.php'); </script>";
						}
						else
						{
							echo " Error Adding record: ".$conn->error;
							$_SESSION['title'] = $title;
							$_SESSION['date'] = $date;
							$_SESSION['time'] = $time;
							$_SESSION['fee'] = $fee;
							$_SESSION['max'] = $maxParticipants;
							
						}
					}else{
							$_SESSION['title'] = $title;
							$_SESSION['date'] = $date;
							$_SESSION['time'] = $time;
							$_SESSION['fee'] = $fee;
							$_SESSION['max'] = $maxParticipants;
						echo '<script language = "javascript">';
						echo 'alert("Fee must be in numeric format!")';
						echo '</script>';
						echo  "<script> window.location.assign('trainer_session_personal.php'); </script>";
					}
		}else{

				$_SESSION['title'] = $title;
				$_SESSION['date'] = $date;
				$_SESSION['time'] = $time;
				$_SESSION['fee'] = $fee;
				$_SESSION['max'] = $maxParticipants;
				echo '<script language = "javascript">';
				echo 'alert("All the field must be completed")';
				echo '</script>';
				echo  "<script> window.location.assign('trainer_session_group.php'); </script>";
			}
	}



	$conn->close();
?>
