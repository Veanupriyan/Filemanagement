<html>
<head>
<title>
Personal Files Management System
</title>
<?php
	require_once('auth.php');
?>
 <link href="css/bootstrap.css" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="css/DT_bootstrap.css">
  
  <link rel="stylesheet" href="css/font-awesome.min.css">
    <style type="text/css">
      body {
        padding-top: 60px;
        padding-bottom: 40px;
      }
      .sidebar-nav {
        padding: 9px 0;
      }
    </style>
    <link href="css/bootstrap-responsive.css" rel="stylesheet">


<link href="../style.css" media="screen" rel="stylesheet" type="text/css" />
<!--sa poip up-->
<script src="jeffartagame.js" type="text/javascript" charset="utf-8"></script>
<script src="js/application.js" type="text/javascript" charset="utf-8"></script>
<link href="src/facebox.css" media="screen" rel="stylesheet" type="text/css" />
<script src="lib/jquery.js" type="text/javascript"></script>
<script src="src/facebox.js" type="text/javascript"></script>
<script type="text/javascript">
  jQuery(document).ready(function($) {
    $('a[rel*=facebox]').facebox({
      loadingImage : 'src/loading.gif',
      closeImage   : 'src/closelabel.png'
    })
  })
</script>
</head>
<?php
function createRandomPassword() {
	$chars = "003232303232023232023456789";
	srand((double)microtime()*1000000);
	$i = 0;
	$pass = '' ;
	while ($i <= 7) {

		$num = rand() % 33;

		$tmp = substr($chars, $num, 1);

		$pass = $pass . $tmp;

		$i++;

	}
	return $pass;
}
$finalcode='RS-'.createRandomPassword();
?>



 <script language="javascript" type="text/javascript">
/* Visit http://www.yaldex.com/ for full source code
and get more free JavaScript, CSS and DHTML scripts! */
<!-- Begin
var timerID = null;
var timerRunning = false;
function stopclock (){
if(timerRunning)
clearTimeout(timerID);
timerRunning = false;
}
function showtime () {
var now = new Date();
var hours = now.getHours();
var minutes = now.getMinutes();
var seconds = now.getSeconds()
var timeValue = "" + ((hours >12) ? hours -12 :hours)
if (timeValue == "0") timeValue = 12;
timeValue += ((minutes < 10) ? ":0" : ":") + minutes
timeValue += ((seconds < 10) ? ":0" : ":") + seconds
timeValue += (hours >= 12) ? " P.M." : " A.M."
document.clock.face.value = timeValue;
timerID = setTimeout("showtime()",1000);
timerRunning = true;
}
function startclock() {
stopclock();
showtime();
}
window.onload=startclock;
// End -->
</SCRIPT>
<body>
<?php include('navfixed.php');?>
<div class="container-fluid">
      <div class="row-fluid">
	<div class="span2">
          <div class="well sidebar-nav">
		  <ul class="nav nav-list">
			  <li ><a href="#"><i class="icon-dashboard icon-2x"></i> Dashboard </a></li> 
			    
				<li><a href="old.php"><i class="icon-list-alt icon-2x"></i> Old Files</a>  <br>                                   </li>
				<li><a href="new.php"><i class="icon-list-alt icon-2x""></i> New Files</a> <br>                                   </li>
				<li class="active"><a href="type.php"><i class="icon-group icon-2x"></i> Staff Details (New typing Files)</a>    
				
					<br><br><br><br><br><br>		
			<li>
			 <div class="hero-unit-clock">
		
			<form name="clock">
			<font color="white">Time: <br></font>&nbsp;<input style="width:150px;" type="submit" class="trans" name="face" value="">
			</form>
			  </div>
			</li>
				
				</ul>     
          </div><!--/.well -->
        </div><!--/span-->
	<div class="span10">
	<div class="contentheader">
			<i class="icon-group"></i>Staff Details (New typing Files)
			</div>
			<ul class="breadcrumb">
			<li><a href="index.php">Dashboard</a></li> /
			<li class="active">Staff Details (New typing Files)</li>
			</ul>


<div style="margin-top: -19px; margin-bottom: 21px;">

<a  href="index.php"><button class="btn btn-default btn-large" style="float: left;"><i class="icon icon-circle-arrow-left icon-large"></i> Back</button></a>
<input type="text" name="filter" style="height:35px; margin-top: 1px;" value="" id="filter" placeholder="Search the files here ..." autocomplete="off" />

<?php 
			include('../connect.php');
				$result = $db->prepare("SELECT * FROM type  ");
				$result->execute();
				$rowcount = $result->rowcount();
			?>
			<div style="text-align:center;">
			<b>Total Number of Staffs: </b><font color="green" style="font:bold 22px 'Aleo';"><?php echo $rowcount;?></font>
			</div>
			
</div>

<?php
    
	include('../connect.php');
	$db = mysqli_connect( 'localhost', 'root', '', 'pension');
?>

<?php
  $No="";
  $Name="";
  $Designation="";
  $DateofFirstAppointment="";
  $DateofRetirement="";
  $LastSchool="";

function getData()
{
  $data = array();
  $data[0]=$_POST['No'];
  $data[1]=$_POST['Name'];
  $data[2]=$_POST['Designation'];
  $data[3]=$_POST['DateofFirstAppointment'];
  $data[4]=$_POST['DateofRetirement'];
  $data[5]=$_POST['LastSchool'];
  return $data;
}

if(isset($_POST['search']))
{
  $info = getData();
  
  $search_query="SELECT * FROM type WHERE No = '$info[0]'";
  
  $search_result=mysqli_query($db, $search_query);
  
	  if($search_result)
	  {
		  if(mysqli_num_rows($search_result))
		  {
			  while($rows = mysqli_fetch_array($search_result))
			  {
				  $No = $rows['No'];
				  $Name = $rows['Name'];
				  $Designation = $rows['Designation'];
				  $DateofFirstAppointment = $rows['DateofFirstAppointment'];
				  $DateofRetirement = $rows['DateofRetirement'];
				  $LastSchool = $rows['LastSchool'];

			  echo '<script language="javascript">';
			  echo 'alert("Data Found")';
			  echo '</script>';
			  
				  
				  
			  }
		  }else{
			  //echo(" no data are available");
			  echo '<script language="javascript">';
			  echo 'alert("Fill the All Feilds")';
			  echo '</script>';
			  
		  }
	  } else{
		  echo("result error");
	  }
  
}

//insert
if(isset($_POST['insert'])){
	$info = getData();
      
	$insert_query="INSERT INTO type(No,Name,Designation,DateofFirstAppointment,DateofRetirement,LastSchool )
     VALUES ('$info[0]','$info[1]','$info[2]','$info[3]','$info[4]','$info[5]')";
	try{
		$insert_result=mysqli_query($db, $insert_query);
		if($insert_result)
		{
			if(mysqli_affected_rows($db)>0)
			{
				echo '<script language="javascript">';
				echo 'alert("data inserted successfully")';
				echo '</script>';
				
			}else{
				echo("data are not inserted");
				echo '<script language="javascript">';
				echo 'alert("Fill the All Feilds")';
				echo '</script>';
			}
                             
		}
	}catch(Exception $ex){
		echo("error inserted".$ex->getMessage());
	}
}
if(isset($_POST['delete'])){
	$info = getData();
	$delete_query = "DELETE FROM type WHERE No= '$info[0]'";
	try{
		$delete_result = mysqli_query($db, $delete_query);
		if($delete_result){
			if(mysqli_affected_rows($db)>0)
			{
				echo '<script language="javascript">';
				echo 'alert("Data Deleted successfully")';
				echo '</script>';
				?>
				<script type="text/javascript">
				window.location.href=window.location.href;
				</script>
				<?php
				
			}else{
				//echo("data not deleted");
				echo '<script language="javascript">';
				echo 'alert("Fill the All Feilds")';
				echo '</script>';				

			}
		}
	}catch(Exception $ex){
		echo("error in delete".$ex->getMessage());
	}
}
//edit
if(isset($_POST['update'])){
  $info = getData();
  $update_query="UPDATE type SET Name='$info[1]',Designation='$info[2]',DateofFirstAppointment='$info[3]',DateofRetirement='$info[4]',LastSchool='$info[5]'  WHERE No = '$info[0]'";
  try{
	  $update_result=mysqli_query($db, $update_query);
	  if($update_result){
		  if(mysqli_affected_rows($db)>0){
			  //echo 'alert("data updated")';
			  echo '<script language="javascript">';
			  echo 'alert("Data updated successfully")';
			  echo '</script>';
			  ?>
			  <script type="text/javascript">
			  window.location.href=window.location.href;
			  </script>
			  <?php
			  
		  
		  }else{
			  //echo("data not updated");
			  echo '<script language="javascript">';
			  echo 'alert("Fill the All Feilds")';
			  echo '</script>';
		  }
	  }
  }catch(Exception $ex){
	  echo("error in update".$ex->getMessage());
  }
}
/*if(isset($_POST['view'])){
  $info = getData();
  $view_query="CREATE VIEW tournament as select Teamname='$info[1]',Venue='$info[2]',Date='$info[3]',Time='$info[4]'  WHERE Tid = '$info[0]'";
  try{
	  $view_result=mysqli_query($db, $view_query);
	  if($view_result){
		  if(mysqli_affected_rows($db)>0){
			  //echo 'alert("data viewed")';
			  echo '<script language="javascript">';
			  echo 'alert("Data viewed successfully")';
			  echo '</script>';
			  
		  
		  }else{
			  //echo("data not viewed");
			  echo '<script language="javascript">';
			  echo 'alert("Fill the All Feilds")';
			  echo '</script>';
		  }
	  }
  }catch(Exception $ex){
	  echo("error in view".$ex->getMessage());
  }
}*/

?>

<form method ="post" action="Type.php" onsubmit="return getData()" name="ScheduleInput">
<p align="center" class="SInput">

	<input type="text" name="No" value="<?php echo($No);?>" placeholder=" No" size="50"><br><br>
	<input type="text" name="Name" value="<?php echo($Name);?>" placeholder=" Name" size="50"><br><br>
	<input type="text" name="Designation" value="<?php echo($Designation);?>" placeholder=" Designation" size="50"><br><br>
	<input type="text" name="DateofFirstAppointment" value="<?php echo($DateofFirstAppointment);?>" placeholder=" Date of First Appointment" size="50"><br><br>
	<input type="text" name="DateofRetirement" value="<?php echo($DateofRetirement);?>" placeholder=" Date of Retirement" size="50"><br><br>
	<input type="text" name="LastSchool" value="<?php echo($LastSchool);?>" placeholder=" Last School" size="50"><br><br>
</p>	  
  <div>
	<p align="center" class="Sbtn">
	 
	<input type="submit" name="insert" value="Add" size="50" align="middle">
	  <input type="submit" name="update" value="Update" size="50" align="middle">
	  <input type="submit" name="search" value="Search" size="50" align="middle" >
	 
	  <input type="submit" name="delete" value="Delete" size="50" align="middle">
	</p>
</div>
</div>
</form>
   


 
  <?php
  
	include('../connect.php');
	$db = mysqli_connect( 'localhost', 'root', '', 'pension');
	

$result = mysqli_query($db,"SELECT * FROM type") ;

echo "<table border='1' align='center'>

<th width='125'>No</th>
<th width='150'>Name</th>
<th width='50'>Designation</th>
<th width='100'>Date of First Appointment</th>
<th width='100'>Date of Retirement</th>
<th width='250'>Last School</th>
</tr>";


while($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
{
  
  echo "<td width='10' align='center'>". $row['No']. "</td>";
  echo "<td width='10' align='center'>". $row['Name']. "</td>";
  echo "<td width='25' align='center'>". $row['Designation']. "</td>";
  echo "<td width='10' align='center'>". $row['DateofFirstAppointment']. "</td>";
  echo "<td width='10' align='center'>". $row['DateofRetirement']. "</td>";
  echo "<td width='10' align='center'>". $row['LastSchool']. "</td>";
  echo "</tr>";
  
}

echo "</table>";
//mysqli_close($conn);

?>


</body>	
<script src = "js/jquery-3.1.1.js"></script>
<script src = "js/bootstrap.js"></script>
<script src = "js/script.js"></script>
<script src = "js/jquery.dataTables.min.js"></script>
<script type = "text/javascript">
	$(document).ready(function(){
		$('#table').DataTable();
	})
</script>
</body>
<?php include('footer.php');?>

</html>