<?php
session_start();
$database = $_SESSION['Database'];
if(isset($_GET['t']) && isset($_GET['q']))
{
		$query = '';
		if($_GET['t'] == 'ProfessionalTag')
		{
			$table = 'ProfessionalTag';
	
		}
		else
		{
			$table = 'Tag';
		}
	//Connection Establish 
	$conn_error = 'could not connect.';

	$mysql_host = 'localhost';
	$mysql_user = 'quizgjpy_Content';
	$mysql_db = $database;
	if(!@mysql_connect($mysql_host,$mysql_user,'Zanskar123') || !@mysql_select_db($mysql_db)) 
	{
		die($conn_error);
	}
	else
	{
		$query = "insert into $table ($table) values('$_GET[q]')" ;
		
		if($query_run = mysql_query($query))
		{
			echo 'tag added to the list, refresh your page to see the effects';
		}
	}
}
?>