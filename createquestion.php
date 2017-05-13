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
	$QID = $_SESSION['QID_EDIT'];
	
	if(!empty($QID))
	{
			$conn_error = 'could not connect.';
			$mysql_host = 'localhost';
			$mysql_user = 'quizgjpy';
			$mysql_db = $_SESSION['Database'];
			if(!@mysql_connect($mysql_host,$mysql_user,'Zanskar123') || !@mysql_select_db($mysql_db)) 
			{
				die($conn_error.'1');
				
			}
			$table = 'Question';
			$query = "Select * from Question where `QID`='$QID'";
		
		
		if($query_run = mysql_query($query))
		{
			$number = mysql_num_rows($query_run);
			if($number!=0)
			{
				$row = mysql_fetch_assoc($query_run);
			//	unset($_SESSION['QID_EDIT']);
				//$_SESSION['TagsAll'] = $row; 
				$i=1;
				while($i<=10)
				{
					$_SESSION['Tag'.$i] = $row['Tag'.$i];
					$i++;
				}
				//check the above statement, if it is correct
				$i=1;
				while($i<=5)
				{
					$_SESSION['ProfessionalTag'.$i] = $row['ProfessionalTag'.$i];
					$i++;
				}
			}	
			
		}
	}
?>	
<?php
session_start();
$database = $_SESSION['Database'];

//this can also be added to the session file;
$query1 = 'select * from `ProfessionalTag`';
$query2 = 'select * from `Tag`';
$empty_tag = '';
$conn_error = 'could not connect 2.';

$mysql_host = 'localhost';
$mysql_user = 'quizgjpy';
$mysql_db = $database;
if(mysql_connect($mysql_host,$mysql_user,'Zanskar123') && mysql_select_db($mysql_db)) 
{	
	
		if($query_run1 = mysql_query($query1))
		{
			if( $query_run2 = mysql_query($query2))
			{
				$tag = array();
				$professional_tag = array();
				$i = 0;
				$number1=mysql_num_rows($query_run1);
				$number2=mysql_num_rows($query_run2);
				if($number1==0 || $number2==0)
				{
					die('no tags yet!');
				}
				else
				{
					
					while($query_row1 = mysql_fetch_assoc($query_run1))
					{
						
						$professional_tag[$i] = $query_row1['ProfessionalTag'];
						$i++;
						
					}
					$i = 0;
					while($query_row2 = mysql_fetch_assoc($query_run2))
					{
						
						
						$tag[$i] = $query_row2['Tag'];
						$i++;
						
					}
					//print_r ($professional_tag);
				}
			}	
			
		}
}
else
{
	die($conn_error);
} ?>
<?php
	function checkboxvalue($name,$type)
	{
		if($type == 'ProfessionalTag')
		{
			$i=1;
			while($i<=5)
			{
				if($name == $_SESSION['ProfessionalTag'.$i])
				{
					
					return "checked";
				}
				$i++;
			}
			return "unchecked";
		}
		else
		{
			$i=1;
			while($i<=10)
			{
				if($name == $_SESSION['Tag'.$i])
				{
					return "checked";
				}
				$i++;
			}
			return "unchecked";
		}	
		
		
	}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
    <link rel="shortcut icon" href="css/images/favicon.ico" type="image/x-icon">
	<title>
		Create Questions
	</title>
	<script>	
		function validation(question,a,b,c,d,difficulty,answer,url)
		{
			if(question.length == 0 || a.length == 0 || b.length == 0 ||c.length == 0 || d.length == 0 || difficulty.length == 0 || answer.length == 0 || url.length == 0)
			{
					alert('All the field are required');
					document.getElementById("error").innerHTML = '<span style="color:red">All the fields are required*</span>';
					return false;
			}
			else
			{
				if(question.length >= 200 || a.length >= 50 || b.length >=50 || c.length >=50 || d.length >=50)
				{
					alert('No. of char in question & options should not exceed 200 & 50 resp.');
					document.getElementById("error").innerHTML = '<span style="color:red">No. of char in question & options should not exceed 200 & 50 resp.</span>';
					return false;
				}
				else
				{
					//create xmlhttp object
	
	
					var xmlhttp = new XMLHttpRequest();
					xmlhttp.onreadystatechange = function() {
						if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
							alert(xmlhttp.responseText);
							document.getElementById("error").innerHTML = '<span style="color:blue">' + xmlhttp.responseText +'</span>';
						}
						if(xmlhttp.responseText === "Question added successfully")
						{
							document.getElementById("question").value = "";
							document.getElementById("option_a").value = "";
							document.getElementById("option_b").value = "";
							document.getElementById("option_c").value = "";
							document.getElementById("option_d").value = "";
							document.getElementById("url").value = "";
							document.getElementById("difficulty").value = "";
							document.getElementById("answer").value = "";
						}
					}
					
					xmlhttp.open("POST","addquestion.php",true);
					xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
					xmlhttp.send("question="+question+"&option_a="+a+"&option_b="+b+"&option_c="+c+"&option_d="+d+"&difficulty="+difficulty+"&answer="+answer+"&url="+url);

				}		
			}
				
		}
</script>
<script type="text/javascript">

			function toggle_visibility(id)
			{
			   var e = document.getElementById(id);
			   if(e.style.display == 'block')
				  e.style.display = 'none';
			   else
				  e.style.display = 'block';
			}

</script>
		<script type = "text/javascript"  />
			
			function addnewtag(str)
			{
				if (str.length == 0) 
				{ 
					alert('Nothing to add');
					return;
				} 
				else 
				{
					var xmlhttp = new XMLHttpRequest();
					xmlhttp.onreadystatechange = function()
					{
						if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
						{
							alert( xmlhttp.responseText);
						}
					}
					xmlhttp.open("GET", "ajaxfiles/addnew.php?q=" + str +"&t=Tag", true);
					xmlhttp.send();
				}
			}
				
			 
			function checkt()
			{
					var xmlhttp = new XMLHttpRequest();
					xmlhttp.onreadystatechange = function()
					{
						if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
						{
							document.getElementsByID('enddiv2') = xmlhttp.responseText;
						}
					}
					xmlhttp.open("GET", "ajaxfiles/checkpt.php?t=Tag", true);
					xmlhttp.send();
				 
			}
			function addt(strin)
			{
				str = strin.value;
				if (str.length == 0) 
				{ 
					alert('Something when wrong your request cannot be completed');
					return;
				} 
				else 
				{
					var xmlhttp = new XMLHttpRequest();
					xmlhttp.onreadystatechange = function()
					{
						if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
						{
							var	x = xmlhttp.responseText;
							if(x.length != 0)
							{
								alert(x);
							}
						}
					}
					if(strin.checked)
					{
						xmlhttp.open("GET", "ajaxfiles/addtp.php?q=" + str +"&t=Tag&check=cheched", true);
						xmlhttp.send();
					}
					if(!strin.checked)
					{
						xmlhttp.open("GET", "ajaxfiles/addtp.php?q=" + str +"&t=Tag&check=unchecked", true);
						xmlhttp.send();
					}
					
					
				}
			}
			function addp(strin)
			{
				str = strin.value;
				if (str.length == 0) 
				{ 
					alert('Something when wrong your request cannot be completed');
					return;
				} 
				else 
				{
					var xmlhttp = new XMLHttpRequest();
					xmlhttp.onreadystatechange = function()
					{
						if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
						{
							var	x = xmlhttp.responseText;
							if(x.length != 0)
							{
								alert(x);
							}
						}
					}
					if(strin.checked)
					{
						xmlhttp.open("GET", "ajaxfiles/addtp.php?q=" + str +"&t=ProfessionalTag&check=checked", true);
						xmlhttp.send();
					}
					if(!strin.checked)
					{
						xmlhttp.open("GET", "ajaxfiles/addtp.php?q=" + str +"&t=ProfessionalTag&check=unchecked", true);
						xmlhttp.send();
					}
					
				}
				
			}
			function checkp()
			{
				var xmlhttp = new XMLHttpRequest();
					xmlhttp.onreadystatechange = function()
					{
						if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
						{
							document.getElementsByID('enddiv1') = xmlhttp.responseText;
						}
					}
					xmlhttp.open("GET", "ajaxfiles/checkpt.php?t=ProfessionalTag", true);
					xmlhttp.send();
			}
			function addnewprofessionaltag(str)
			{
				if (str.length == 0) 
				{ 
					alert('Nothing to add');
					return;
				} 
				else 
				{
					var xmlhttp = new XMLHttpRequest();
					xmlhttp.onreadystatechange = function()
					{
						if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
						{
							alert( xmlhttp.responseText);
						}
					}
					xmlhttp.open("GET", "ajaxfiles/addnew.php?q=" + str +"&t=ProfessionalTag", true);
					xmlhttp.send();
				}
			}
		</script>
<style>
	
#nav
{
	margin:0px;
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
	height: 160px;
	overflow-y:scroll;
	font-size:16px;
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
	padding:12px;
	
}
#p1_tag li:hover{
	padding:12px;
	color : #099;
	
	
}
#p2_tag li{
	color:#ccc;
	padding:12px;
	
}
#p2_tag li:hover{
	padding:12px;
	color : #099;
	
	
}
#nav_wrapper1 
	{
		
		margin : 2% auto 0 auto;
		padding:7px;
		color: #00acef;
		font-size:40px ;
		font-family:Arial ;
		font-weight:bold;
		
	}
	#header
	{
		margin: 0 auto 0 auto; 
		text-align : center;
		padding: 5px;
		background-color:#00acef;
		color:white;
	}
	label
	{
		display:inline;
		font-family:futura;
		font-size:20px;
		position:relative;
		line-height:2;
		margin:30px 20px; 
	}
	textarea,textfield
	{
		
		margin:15px auto 0 20px;
	}
	#formwrapper{}
	fieldset
	{
			
		background:#F1F1F1; 
		margin:auto 10% auto 10%;
		border:none;
		padding:0 0 2em 0;
	}
	.btn
	{
		border-radius:10px;
		position : relative;
		left:5%;
		right:25%;
		bottom:10%;
		background-color:#00acef;
		padding:20px;
		margin:0 auto 20px 40px;
		text-align:center;
		font-size:30px;
		width:350px;
		
	}
	fieldset a
	{
		color:black;
		text-decoration:none;
		display:inline-block;
		width:100px;
		
	}
	#ans_choice label
	{
		margin-top: 30px;
		font-size: 20px;
		font-family: futura;
		
	}
	
	fieldset label
	{
		padding-right:5px;
	}
	#error
	{
		color:red;
		display:block;
		font-family:Arial;
		width:100%;
		text-align:center;
		padding-top:10px;
	}
	
	
	body
	{
		overflow-y:scroll; padding:0; margin:0; color:#555;
	}
	.popup-position
	{
		display:none;
		position:fixed; top:0; left:0; background:rgba(0,0,0,0.7); width:100%;height:100% ;
		
	}
	#popup-wrapper
	{
		padding-top:20px;
		padding-bottom:20px;
		width:65%;
		height:450px;
		margin:70px auto;
		overflow-y:scroll;
		border-radius:5px;
		background-color:white;
		
	}
	#popup-container
	{
		height:auto;
		padding:20px ;
		background-color:white;
		
	}
	#popup-container img
	{
		position:absolute;
		top:70px;
		left:79%;
		
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
				<a href= "">Sample Questions<img src="css/images/arrow.png"/></a>
					<ul>
						<div id="p1_tag">
						<li><a href = "" >Bollywood Movies</a></li><li>
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
		
		<div id = "nav_wrapper1">Add your Questions
</div>
<div id = "header"><h2>Create A Question</h2></div>

		<div id= "formwrapper">
		<form>
		<fieldset>
			<label >Question<textarea name="question" id="question" rows="4" cols="100" placeholder="Enter your Question here" /><?php echo htmlspecialchars($row['Question']);?></textarea></label><br/>
			<label >A:<textarea name="option_a" id="option_a" rows="3" cols="50" placeholder="OptionA" /><?php echo htmlspecialchars($row['A']);?></textarea></label>
			<label >B:<textarea name="option_b" id="option_b" rows="3" cols="50" placeholder="Option B" /><?php echo htmlspecialchars($row['B']);?></textarea></label><br/>
			<label >C:<textarea name="option_c" id="option_c" rows="3" cols="50" placeholder="Option C" /><?php echo htmlspecialchars($row['C']);?></textarea></label>
			<label >D:<textarea name="option_d" id="option_d" rows="3" cols="50" placeholder="Option D" /><?php echo htmlspecialchars($row['D']);?></textarea></label><br/>
		</fieldset>
		<fieldset><label for "answer">Answer</label><select name="answer" id="answer">
			<option value="" >Select your Answer</option> 
			<option value="A" <?php if (!empty($row['Answer']) && $row['Answer'] == 'A') echo 'selected="selected"';?>>A</option>
			<option value="B" <?php if (!empty($row['Answer']) && $row['Answer'] == 'B') echo 'selected="selected"';?>>B</option>
			<option value="C" <?php if (!empty($row['Answer']) && $row['Answer'] == 'C') echo 'selected="selected"';?>>C</option>
			<option value="D" <?php if (!empty($row['Answer']) && $row['Answer'] == 'D') echo 'selected="selected"';?>>D</option></div>
		</select>
		<label for "difficulty">Difficulty</label><select name="difficulty" id="difficulty">
			<option value="" >Select Difficulty</option> 
			<option value="1" <?php if (!empty($row['Answer']) && $row['Difficulty'] == '1') echo 'selected="selected"';?>>1 (Easiest)</option>
			<option value="2" <?php if (!empty($row['Answer']) && $row['Difficulty'] == '2') echo 'selected="selected"';?>>2</option>
			<option value="3" <?php if (!empty($row['Answer']) && $row['Difficulty'] == '3') echo 'selected="selected"';?>>3</option>
			<option value="4" <?php if (!empty($row['Answer']) && $row['Difficulty'] == '4') echo 'selected="selected"';?>>4</option>
			<option value="5" <?php if (!empty($row['Answer']) && $row['Difficulty'] == '5') echo 'selected="selected"';?>>5 (Toughest) </option>
		</select>
		<label for "url">URL</label><input type ="text" name = "url" id = "url" placeholder="Paste URL Here" value ="<?php if(!empty($row['Reference'])) echo $row['Reference'];?>" >
		</fieldset>	
		
		<fieldset>	
			
			<a href="javascript:void(0)" onclick="toggle_visibility('popup-box1')"  class="btn" />Add Tags</a>
			<input class="btn" type="button" value="Submit" name="add question" onclick=" validation(question.value,option_a.value,option_b.value,option_c.value,option_d.value,difficulty.value,answer.value,url.value)" />	
			<div id = "error"></div>
		</fieldset>	
		
		</form>
	
</div>
		<div id="popup-box1" class="popup-position">
			<div id="popup-wrapper">
				<div id = "popup-container">
				<a href="javascript:void(0)" onclick="toggle_visibility('popup-box1')"><img src="css/images/cross.png"/></a>
				
		<fieldset>
		<table border = "2px">
			<thead>
				<tr>
					<th colspan="2"><h3>Professional Tags (Scroll down for Tags)</h3></th>
				</tr>
			</thead>
			<tbody>
				<?php
					$i= 1;
					
					foreach($professional_tag as $professional_tag)
					{ 
						$n= $i-1;
				?>
					<tr>
						<td><label for "<?php echo 'chp'.$i ;?>" ><?php echo $professional_tag; ?></label></td>	
						<td><input type = "checkbox" name = "<?php echo 'chp'.$i; ?>" value="<?php echo 'chp'.$i; ?>" id ="<?php echo 'chp'.$i; ?>" <?php echo checkboxvalue($professional_tag,"ProfessionalTag"); ?> onclick="addp('<?php echo 'chp'.$i ; ?>')" /></td>
					</tr>
						
			<?php 
				$i++;
				} 
			?>
			<tr>
				<td colspan ="2"><input type = "button" name = "addprofessionaltags" value = "Add ProfessionalTags" onclick="checkp()" /><div id = "enddiv1"></div></td>
			</tr>	
			</fieldset>
			<fieldset>
			<tr>
				<td><input type = "text" name = "addProfessional" placeholder = "Enter New ProfessionalTag" /></td>
				<td><input type = "button" name = "addnewtag" value = "Add new tag" onclick="addnewprofessionaltag(addProfessional.value)" > </td>
			</tr><div id = "enddiv1"></div>
			 
			</fieldset>
			</tbody>
		</table>
		
		
		
		
			<fieldset>
				<table>
				<thead>
					<tr>
					<th colspan="2"><h3>Tags</h3></th>
				</tr>
				</thead>
				</tbody>
				<?php
					$i=1;
					foreach ($tag as $tags)
					{
						$n=$i-1;
				?>		
						
					<tr>
						<td><label for "<?php echo 'cht'.$i ; ?>" ><?php echo $tags; ?></label></td>	
						<td><input type = "checkbox" name = "<?php echo 'cht'.$i ; ?>" value="<?php echo 'cht'.$i ; ?>" id ="<?php echo 'cht'.$i ; ?>"  <?php echo checkboxvalue($tag,"Tag"); ?> onclick="addt('<?php echo 'cht'.$i ; ?>')" /></td>
					</tr>
					
					
				<?php 
					$i++;
				}
				?>
				<tr>
					<td colspan="2"><input type = "button" name = "addtags" value = "Add Tags" onclick="checkt()" /></td>
				</tr>	
			</fieldset>
			<fieldset>
			<tr>
				<td><input type = "text" name = "addTag" placeholder = "Enter New Tag" /></td>
				<td><input type = "button" name = "addnewtag" value = "Add New Tag" onclick="addnewtag(addTag.value)"></td>
			</tr><div id = "enddiv2"></div>
			</fieldset>
			</tbody>
		</table>
					
				</div>
			</div>
		</div>
		</body>
		</html>