<?php
	session_start();
	
	
	
	$t = array();
	$p = array();
	function manageTags()
	{
				$i=1;
				$n=0;
				while($i<=10)
				{
					
					
					
					
					if(!empty($_SESSION['Tag'.$i]))
					{
						$t[$n] = $_SESSION['Tag'.$i];
						$n++;
					}
					$i++;
				}
				$i=1;
				$n=0;
				while($i<=5)
				{
					if(!empty($_SESSION['ProfessionalTag'.$i]))
					{
						$p[$n] = $_SESSION['ProfessionalTag'.$i];
						$n++;
					}
					$i++;
				}
				
	}

	manageTags();
	
	if( $p[0] == '' || $t[0] == '')
	{
		echo 'Question not added, You must add tags properly read instructions for detail';
	}
	else
	{
		if(isset($_POST['question']) && isset($_POST['option_a']) && isset($_POST['option_b']) && isset($_POST['option_c']) && isset($_POST['option_d'] ) && isset($_POST['answer']) && isset($_POST['url']) && isset($_POST['difficulty']))
		{
			$conn_error = 'could not connect.';
			$mysql_host = 'localhost';
			$mysql_user = 'quizgjpy';
			$mysql_db = $_SESSION['Database'];
			if( !@mysql_connect($mysql_host,$mysql_user,'Zanskar123') || !@mysql_select_db($mysql_db)) 
			{
				die($conn_error);
			}
			else
			{
				
				$post = array();
				foreach($_POST as $k=>$v)
				{
				  $post[] = $v;
				}
				
				$query='';
				if(!empty($_SESSION['QID_EDIT']))
				{
					$qid = $_SESSION['QID_EDIT'];
					$query = "update `Question` set `Question`='$post[0]' , `A`='$post[1]' , `B`='$post[2]' , `C`='$post[3]' , `D`='$post[4]' , `Answer`='$post[5]', `Reference`='$post[6]',`Difficulty`='$post[7]' ,`Professional1`='$p[0]' , `Professional2`='$p[1]' , `Professional3`='$p[2]' , `Professional4`='$p[3]' , `Professional5`='$p[4]'  , `Tag1`='$t[0]' , `Tag2`='$t[1]' , `Tag3`='$t[2]' , `Tag4`='$t[3]' , `Tag5`='$t[4]' , `Tag6`='$t[5]' , `Tag7`='$t[6]' , `Tag8`='$t[7]' , `Tag9`='$t[8]' ,`Tag10`='$t[9]' where `QID`='$qid' ";	
				}
				else
				{
					$query = "insert into `Question`(Question,A,B,C,D,Answer,Reference,Difficulty,Professional1,Professional2,Professional3,Professional4,Professional5,Tag1,Tag2,Tag3,Tag4,Tag5,Tag6,Tag7,Tag8,Tag9,Tag10) values('$post[0]','$post[1]','$post[2]','$post[3]','$post[4]','$post[5]','$_post[6]','$post[7]','$p[0]','$p[1]','$p[2]','$p[3]','$p[4]','$t[0]','$t[1]','$t[2]','$t[3]','$t[4]','$t[5]','$t[6]','$t[7]','$t[8]','$t[9]')";
				}
				if($query_run = mysql_query($query))
				{
					$a = mysql_affected_rows($query_run);
					echo 'Question added successfully';
					//unset tags from session
					//unset QID if exist
					$i=0;
					while($i<=10)
					{
						unset($_SESSION['Tag'.$i]);
						if(i<=5)
						{
							unset($_SESSION['ProfessionalTag'.$i]);
						}
						
					}
					unset($_SESSION['QID_EDIT']);
				}
			}
		}	
	}
?>