<?php
	ob_start();
	session_start();
		function logIn()
	{
		if(!isset($_SESSION['UID']) || empty($_SESSION['UID']))
		{
			$_SESSION=array();
			session_destroy();
			header('Location: index.html');	
		}
	}
	logIn();
?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset="UTF-8">
<link rel="shortcut icon" href="css/images/favicon.ico" type="image/x-icon">
<title>My Questions-QuizProQue </title>
<script type = "text/javascript" src = "javascript/jquery.js"  ></script>
<script>
	function redirect (x)
	{
		
		if(x.length == 0)
		{
			
		}
		else
		{
					var xmlhttp = new XMLHttpRequest();
					xmlhttp.onreadystatechange = function() {
						if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
							
							var response = xmlhttp.responseText;
						//	alert(response);
							if(response != "")
							{
								 window.location="http://content.quizproquo.net/createquestion.php";
							}
						}
					}
					
					xmlhttp.open("GET","addqid.php?QID="+x,true);
					//xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
					xmlhttp.send();
		
		
		}
	}
</script>
<script type = "text/javascript">
function moveScroll(){
    var scroll = $(window).scrollTop();
    var anchor_top = $("#maintable").offset().top;
    var anchor_bottom = $("#bottom_anchor").offset().top;
    if (scroll>anchor_top && scroll<anchor_bottom) {
    clone_table = $("#clone");
    if(clone_table.length == 0){
        clone_table = $("#maintable").clone();
        clone_table.attr('id', 'clone');
        clone_table.css({position:'fixed',
                 'pointer-events': 'none',
                 top:0});
        clone_table.width($("#maintable").width());
        $("#table-container").append(clone_table);
        $("#clone").css({visibility:'hidden'});
        $("#clone thead").css({visibility:'visible'});
    }
    } else {
    $("#clone").remove();
    }
}
$(window).scroll(moveScroll);

</script>
<style>
	body
	{	 padding :0;
		margin:0;
		overflow:scroll;
		 background-color:#dfdfde;
		 height:1000px;
	 }
 #nav
{
	margin:0;
	padding:0;
	background-color:black;
	font-size:20px;
}
#nav_wrapper
 {
	width: 960px;
	margin: 0 auto;
	text-align: left;

}
#nav ul
{
	list-style-type:none;
	margin:0;
	padding:0;
	position:relative;
}
#nav ul li
{
	display: inline-block;
	
}
#nav ul li:hover{
	background-color:#333;
}
#nav ul li img{
	vertical-align:middle;
	padding-left:5px;
}

#nav ul li a,visited{
	color: #ccc;
	display : block;
	padding: 15px;
	text-decoration: none;
}
#nav ul li a:hover{
	color: #ccc;
	text-decoration: none;
}
#nav ul li:hover ul
{
	display:block;
}
#nav ul ul
{
	display:none;
	position:absolute;
	background-color:#333;
	border: 5px solid #222;
	border-top: 0;
	margin-left : -5px;
	min-width: 200px;
	height:300px;
	overflow:hidden;
	overflow-y:scroll;
}
#nav ul ul li
{
	display:block;	 
	height:10px;
	
}
#nav ul ul li a,visited{
	color:#ccc;
}
#nav ul ul li a:hover{
 color : #099;
}
#p1_tag li{
	color:#ccc;
	padding:15px;
}
#p1_tag li:hover{
	padding:15px;
	color : #099;
	
}
#p2_tag li{
	color:#ccc;
	padding:15px;
}
#p2_tag li:hover{
	padding:15px;
	color : #099;
	
}
.header
{
	width:100%;
	text-align:center;
}
table
{
	background-color:#F1F1F1;
}
thead{
    background-color:#333;
	color:white;
}
.wid
{
	width:200px;
}

</style>

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



<div id="table-container">
<div class = "header"><h2>My Questions<h2></div>
<div class = "line" ></div>
<table id="maintable" border = "1px">
    <thead>
        <tr>
		<th><div class="wid" >Question</div></th>
		<th>A</th>
		<th>B</th>
		<th>C</th>
		<th>D</th>
		<th>Answer</th>
		<th>Reference</th>
		<th>Difficulty</th>
		<th>Professional1</th>
		<th>Professional2</th>
		<th>Professional3</th>
		<th>Professional4</th>
		<th>Professional5</th>
		<th>Tag1</th>
		<th>Tag2</th>
		<th>Tag3</th>
		<th>Tag4</th>
		<th>Tag5</th>
		<th>Tag6</th>
		<th>Tag7</th>
		<th>Tag8</th>
		<th>Tag9</th>
		<th>Tag10</th>
	</tr>	
    </thead>
    <tbody>
       <?php
	
	
	
	
	$conn_error = 'could not connect.';
			$mysql_host = 'localhost';
			$mysql_user = 'quizgjpy';
			$mysql_db = $_SESSION['Database'];
			$user = $_SESSION['UserName'];
			if(!@mysql_connect($mysql_host,$mysql_user,'Zanskar123') || !@mysql_select_db($mysql_db)) 
			{
				die($conn_error);
				
			}
			$table = 'Question';
			$query = "select * from Question where `UserName` = '$user'"; 
	$question_id  = Array();
	if($query_run = mysql_query($query))
	{
	
		if(mysql_num_rows($query_run)!=0)
		{
			
			$i = 0;
			while($query_row = mysql_fetch_assoc($query_run))
			{
				echo '<tr>' ;
				echo '<td><div class="wid" >'.$query_row['Question'].'</div></td>';
				echo '<td>'.$query_row['A'].'</td>';
				echo '<td>'.$query_row['B'].'</td>';
				echo '<td>'.$query_row['C'].'</td>';
				echo '<td>'.$query_row['D'].'</td>';
				echo '<td>'.$query_row['Answer'].'</td>';
				echo '<td>'.$query_row['Reference'].'</td>';
				echo '<td>'.$query_row['Difficulty'].'</td>';
				echo '<td>'.$query_row['Professional1'].'</td>';echo '<td>'.$query_row['Professional2'].'</td>';echo '<td>'.$query_row['Professional3'].'</td>';echo '<td>'.$query_row['Professional4'].'</td>';echo '<td>'.$query_row['Professional5'].'</td>';
				echo '<td>'.$query_row['Tag1'].'</td>';echo '<td>'.$query_row['Tag2'].'</td>';echo '<td>'.$query_row['Tag3'].'</td>';echo '<td>'.$query_row['Tag4'].'</td>';echo '<td>'.$query_row['Tag5'].'</td>';
				echo '<td>'.$query_row['Tag6'].'</td>';echo '<td>'.$query_row['Tag7'].'</td>';echo '<td>'.$query_row['Tag8'].'</td>';echo '<td>'.$query_row['Tag9'].'</td>';echo '<td>'.$query_row['Tag10'].'</td>';
				$QID = $query_row['QID'];
			?>	
				<td><input type = 'button' name = 'edit' value = 'Edit' onclick = "redirect('<?php echo $QID; ?>')" /></td>
				</tr>	
			<?php	

			}
			
		}
		
	}
	
?>
    </tbody>
</table>
<div id="bottom_anchor"></div>
</div>

</body>
</html>