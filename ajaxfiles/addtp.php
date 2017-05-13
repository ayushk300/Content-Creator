<?php
session_start();
if(isset($_GET['t']) && isset($_GET['q']))
{   $flag = true;
	$i=1;
	if($_GET['t'] == 'Tag')
	{
		
		if($_GET['check'] == 'check')
		{
			
			while($i<=10)
			{
				if(!empty($_SESSION['Tag'.$i]) )
				{
					$i++;
				}
				else
				{
					$flag = false;
					$_SESSION['Tag'.$i]= $_GET['q'];
					break;
				}
				
			}
			if($flag)
			{
				echo 'You cannot add more than 10 tags,' ;
			}
			else
			{
				echo 'tag setted successfully';  
			}
		}
		else
		{
			$t = $_GET['q'];
			$i=1;
			while($i<=10)
			{
				if($_SESSION['Tag'.$i] == $t)
				{
					unset($_SESSION['Tag'.$i]);
					break;
				}
				$i++;
			}
			echo 'tag unsetted successfully';  
		}
		
	}
	else
	{
		if($_GET['check'] == 'check')
		{
			$i=1;		
			while($i<=5)
			{
				if(!empty($_SESSION['ProfessionalTag'.$i]))
				{
					$i++;
				}
				else
				{
					$flag = false;
					$_SESSION['Tag'.$i]= $_GET['q'];
					break;
				}
				
			}
			if($flag)
			{
				echo 'You cannot add more than 5 Professional tags';
			}
			else
			{
				echo 'ProfessionalTag added successfully';
				
			}
		}
		else
		{
			
			$t = $_GET['q'];
			$i=1;
			while($i<=5)
			{
				if($_SESSION['Tag'.$i] == $t)
				{
					unset($_SESSION['ProfessionalTag'.$i]);
				}
				$i++;
			}
			
			echo ' tag unsetted successfully' ;
		}
		
	}
	
}
?>
