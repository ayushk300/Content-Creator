<?php
//check if form is submitted

ob_start();
if(isset($_POST['user']) && isset($_POST['password']) && isset($_POST['topic']))
{
	if(!empty($_POST['user']) && !empty($_POST['password']) && !empty($_POST['topic']))
	{
		$conn_error = 'could not connect, try to login again';

			$mysql_host = 'localhost';
			$mysql_user = 'quizgjpy';
			$mysql_db = 'quizgjpy_Users';
			$Mail = $_POST['user'];
			$pass = $_POST['password'];
			$topic = $_POST['topic'];
			if( !@mysql_connect($mysql_host,$mysql_user,'Zanskar123') || !@mysql_select_db($mysql_db)) 
			{
				die($conn_error);
				
			}
			
			//check if the data given is correct (user authentication) (if correct start the session and load database in the session)
			//														   (else redirect the home page --exit)
			
			$query = "select * from `User` where `MailID` = '$Mail' AND `Password` = '$pass' AND `Topic` = '$topic'";
			if($query_run = @mysql_query($query))
			{
				$number=mysql_num_rows($query_run);
				if($number==0)
				{
					// redirect to the login page again
					$redirect_page = 'index.html';
					header('Location: index.html');
					
				}
				else
				{
					//start the session and load database in the session
					session_start();
					$_SESSION['Database']='quizgjpy_'.$_POST['topic'];
					$_SESSION['UserName'] = $_POST['user'];
					
				}
			
			}
	}
}
//display the home page
	function logIn()
	{
	if($_SESSION['UID']=="" )
		{
			$_SESSION=array();
			session_start();
			session_destroy();
			header('Location: index.html');	
		}
	}
	logIn();

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<link rel="shortcut icon" href="css/images/favicon.ico" type="image/x-icon">
	<link href ="css/home.css" type="text/css" rel="stylesheet"></link>
	
	
	</head>
<body>
	<div id = "nav">
		<div id= "nav_wrapper">
			<ul>
				<li><a href = "home.php" >Home</a></li><li>
				<a href="myquestion.php">My Questions</a></li><li>
				<a href= "createquestion.php">Create Questions</a></li><li>
				<a href= "">Sample Questions<img src="css/images/arrow1.png"/></a>
					<ul>
						<div id="p1_tag">
						<li><a href = "" download = "">Bollywood Movies</a></li><li>
						<a href = "sample/Hollywood Sample.xlsx" download = "Hollywood Sample.xlsx">Hollywood</a></li><li>
						<a href = "" >Geography</a></li><li>
						<a href = "" >Indian Constitution</a></li><li>
						<a href = "" >Famous personalities</a></li><li>
						<a href = "sample/Current Affairs Sample.xlsx" download = "Current Affairs Sample.xlsx">Current Affairs</a></li><li>
						<a href = "" >Chemistry</a></li><li>
						<a href = "" >English Grammmar</a></li><li>
						<a href = "" >Mythology</a></li><li>
						<a href = "sample/English literature Sample.xlsx" download = "English literature Sample.xlsx">English Literature</a></li><li>
						<a href = "" >Indian Politics</a></li><li>
						<a href = "" >Cricket</a></li><li>
						<a href = "sample/Human Body Sample.xlsx" download = "Human Body Sample.xlsx">Human Body</a></li><li>
						<a href = "sample/Physics Sample.xlsx" download = "Physics Sample.xlsx">Physics</a></li><li>
						<a href = "" >History</a></li><li>
						<a href = "" >Football</a></li><li>
						<a href = "" >Computer</a></li><li>
						<a href = "sample/Tennis Sample.xlsx" download = "Tennis Sample.xlsx">Tennis</a></li>
						</div>
					</ul>
				</li><li>
				
				<a href = "home.php">Instructions</a></li><li>
				<a href="logout.php">Logout</a></li>
				
				
			</ul>
		</div>
	</div>
	
	
			<div id = "instructions">
		<h2>Content Instructions</h2>
		
			<ul>
				<li>Question length should be such that it can be read in 3 seconds, at least the gist of the question should be readable in 3 seconds, if not the complete question.</li>
				<li>The Questions should not contain complicated words. For example, the words like Propensity or Penchant should be replaced by Tendency or Inclination.</li>
				<li>The Questions should be written in the most simplified form possible which means omission of all unnecessary words.</li>
				<li>Every Question has 4 options out of which only one option will be correct. Questions with None of These or All of these as responses can be used but it is recommended to not have more than 10% questions with such options.The Difficulty Tag needs to be defined and be uniform. Therefore, first a certain number of questions of varying difficulty need to be created and the rating 1 to 5 needs to be defined with 1 being the easiest and 5 being the toughest. Then, the indexed difficulty should be assigned accordingly to the next questions.</li>
				<li>Provide the reference either as the name of a famous webpage link.</li>
				<li>The topic "Current Affairs" means "Recent Affairs - The events and stuffs related to those events." Therefore, the content creator should select a time-frame for recent events and that time frame should not exceed 4 years, i.e. no older than 2011. However, it can be related to a past event which is currently in the news. For instance, Salman Khan's conviction for the event 2002 or the recent judgement over Hashimpura case.</li>
				<li>Professional Level should be assigned according to the topic with an index of the difficulty levels used. For example, if the topic is related to academic subjects like Physics or Mathematics, then we can use tags like Elementary School, Middle School, High School, College, Research etc. For something like Football, we can use different levels of knowledge like Basic World Cup Fan, Follower of the Premier League, Die Hard fan of a certain club, Experienced Fan of the Club. You can generate titles like Club Manager or Club Owner for very difficult questions related to a certain club. Similarly, for something like Indian Governance, you can use professional tag levels like Aspiring Candidate, 2 time MLA, 3 time MP Etc. Whenever, professional difficulty seems invalid, the tag 'General' can be used, for example in most of the current affairs questions.</li>
				<li>Tags need to be defined subsequently for questions based on topic. Whatever tag is defined needs to be added in the tag index table with a serial number and those serial numbers should be used in the after the questions. Please try to create as many tags as possible. The tags can vary according to questions like a question in Football might have tags like Club Football or International Football, Premier League or any other league, all the teams involved, a certain competition of a country or continent or global. Or in the case of academics, it might be like Physics, Mechanics, Solid Mechanics, Friction, Rotation and all the other necessary concepts. Then the tags can be multidisciplinary. For example, there is a question in Cricket which is relevant in India, famous personalities as well as history, then you have to add the tags 'India', 'Famous Personalities' and 'History' in the tag index table if not already added with a serial number and those serial numbers should be written in subsequent columns after the professional difficulty tag. Finally, all the cells in the third row above the professional level numbers and tag numbers will be merged together to form a cell with the title Professional Level Tags and Tag Numbers respectively. An example of use of tags has been shown in the diagrams below.</li>
				<li>The Validator field needs to be left blank by the content creator. It will be filled by the validator.</li>
			</ul>
		</div>
	
</body>
</html>