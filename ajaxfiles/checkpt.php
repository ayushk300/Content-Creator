<?php 
	session_start();
	$i=1;
	$t = false;
	$p=false;
	if($_GET['t'] == 'tag')
	{
		$p = true;
		while($i<=10)
		{
			if(!empty($_SESSION['Tag'.$i]))
			{
				
				$t = true;
				break;
			}
			$i++;
		}
	}	
	else
	{	
		$t = true;
		$i=1;
		while($i<=5)
		{
			if(!empty($_SESSION['ProfessionalTag'.$i]))
			{
				
				$p = true;
				break;
				
			}
			$i++;
		}
	}	
	if($t == true && $p == true)
	{
		echo 'tags added successfully';
	}
	else
	{
		echo 'tags not added,make sure you have selected one tag of both types respectively';
	}
?>