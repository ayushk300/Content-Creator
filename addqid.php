 <?php
	ob_start();
	session_start();
	if(isset($_GET['QID']) && !empty($_GET['QID']))
	{
		$_SESSION['QID_EDIT']=$_GET['QID'];
		echo 'SESSION';
	}
 ?>