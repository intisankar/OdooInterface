<?php
	session_start();
	$expireafter=700;
	// echo "here the data>>>>",$expireafter;
	if(isset($_SESSION['last_action'])){
		$secondsInactive=time()-$_SESSION['last_action']; 
		if($expireafter < $secondsInactive){
			echo '<script language="javascript">';
			echo 'alert("Session expired: Please Refresh the page to continue");';
			echo 'window.history.back();';
			echo '</script>';
			session_destroy();
			return;
		}
		$con=pg_connect("host=localhost port=5432 dbname=dev10 user=postgres password=sankar");
		if(!$con){ die('Connection error:'.pg_last_error()); }
		else{
			$i=0;
			$query1="select max(id) from placement_registration";
			$rs=pg_query($con,$query1) or die("Cannot execute query: $query1\n");
			while($row=pg_fetch_row($rs)){
				$i=$row[0];
			}
			// for achievments
			$e=0;
			$achv="select max(id) from placement_achievements";
			$rs_acv=pg_query($con,$achv) or die("Cannot execute query: $acv\n");
			while($row=pg_fetch_row($rs_acv)){
				$e=$row[0];
				// echo "here e achev value",$e;
			}
			// for technical tab
			$r=0;
			$tec="select max(id) from placement_technical";
			$rs_tec=pg_query($con,$achv) or die("Cannot execute query: $tec\n");
			while($row=pg_fetch_row($rs_tec)){
				$r=$row[0];
				// echo "here r technical value",$r;
			}
			// for placements tab
			$t=0;
			$per="select max(id) from placement_personal";
			$rs_per=pg_query($con,$achv) or die("Cannot execute query: $per\n");
			while($row=pg_fetch_row($rs_per)){
				$t=$row[0];
				// echo "here t personal value",$t;
			}
			// for project tab
			$y=0;
			$prj="select max(id) from placement_project";
			$rs_prj=pg_query($con,$achv) or die("Cannot execute query: $prj\n");
			while($row=pg_fetch_row($rs_prj)){
				$y=$row[0];
				// echo "here y projegct value",$y;
			}
			// for one2many 
			$u=0;
			$sem="select max(id) from btech_marks";
			$rs_sem=pg_query($con,$achv) or die("Cannot execute query: $sem\n");
			while($row=pg_fetch_row($rs_sem)){
				$u=$row[0];
				// echo "here u projegct value",$u;
			}
			// **********************************
			// for Photo
			if (!empty($_FILES["photo"]["name"]))
			{
				$fileName = $_FILES['photo']['name'];
				$target = $_SERVER['DOCUMENT_ROOT'].'/custom/placements/files/photo/';	
				$fileTarget = $target.$fileName;	
				$tempFileName = $_FILES["photo"]["tmp_name"];
				$path = move_uploaded_file($tempFileName,$fileTarget);
				$data = file_get_contents($fileTarget);
				$base64 = base64_encode($data);
			}
			else{echo 'You are not upload Photo..!';}
			// for tenth 
			if (!empty($_FILES["tenth"]["name"]))
			{
				$fileName = $_FILES['tenth']['name'];
				$target = $_SERVER['DOCUMENT_ROOT'].'/custom/placements/files/ssc/';	
				$fileTarget = $target.$fileName;	
				$tempFileName = $_FILES["tenth"]["tmp_name"];
				$path = move_uploaded_file($tempFileName,$fileTarget);
				$data = file_get_contents($fileTarget);
				$ten=base64_encode($data);
			}
			else{echo 'You are not upload 10 th marks sheet..!';}
			// for inter/diploma
			if (!empty($_FILES["mark_list"]["name"]))
			{
				$fileName = $_FILES['mark_list']['name'];
				$target = $_SERVER['DOCUMENT_ROOT'].'/custom/placements/files/inter_diploma/';	
				$fileTarget = $target.$fileName;	
				$tempFileName = $_FILES["mark_list"]["tmp_name"];
				$path = move_uploaded_file($tempFileName,$fileTarget);
				$data = file_get_contents($fileTarget);
				$inter_diploma = base64_encode($data);
			}
			else{echo 'You are not upload inter/ diploma marksheet file..!';}
			// for btech
			if (!empty($_FILES["pc_upload"]["name"]))
			{
				$fileName = $_FILES['pc_upload']['name'];
				$target = $_SERVER['DOCUMENT_ROOT'].'/custom/placements/files/Btech/';	
				$fileTarget = $target.$fileName;	
				$tempFileName = $_FILES["pc_upload"]["tmp_name"];
				$path = move_uploaded_file($tempFileName,$fileTarget);
				$data = file_get_contents($fileTarget);
				$btechfile = base64_encode($data);
			}
			else{echo 'You are not upload B.Tech marks sheet file..!';}
			
			// for b.tech sem-wise
			if (!empty($_FILES["marks_sem"]["name"]))
			{
				$fileName = $_FILES['marks_sem']['name'];
				$target = $_SERVER['DOCUMENT_ROOT'].'/custom/placements/files/BTech_semwise/';	
				$fileTarget = $target.$fileName;	
				$tempFileName = $_FILES["marks_sem"]["tmp_name"];
				$path = move_uploaded_file($tempFileName,$fileTarget);
				$data = file_get_contents($fileTarget);
				$sems_conv = base64_encode($data);
			}
			else{echo 'You are not upload file..!';}
			$query="INSERT INTO placement_registration(id,create_date,name,photo,stuname,email,phone,course,regulation,department,father,mother,father_contact,gender,dob,blood_group,address,write_date,school_name,board,duration,tduration,tmarks,obtain,percentage,marklist,course_type,university_name,college_name,branch_type,cboard,c_duration,create_uid,imarks,iobtain,ipercentage,mark_list,write_uid,university,branch,b_duration,bduration,bmarks,bobtain,bpercentage,pc_upload,marks_sem) VALUES ($i+1, current_timestamp,'$_POST[name]' ,'$base64','$_POST[stuname]' ,'$_POST[email]' ,'$_POST[phone]' ,'$_POST[course]' ,'$_POST[regulation]' ,'$_POST[dept]' ,'$_POST[father]' ,'$_POST[mother]' ,'$_POST[father_contact]' ,'$_POST[gender]' ,'$_POST[dob]' ,'$_POST[blood_group]' ,'$_POST[address]' ,current_timestamp,'$_POST[school_name]' ,'$_POST[board]' ,'$_POST[duration]' ,'$_POST[tduration]' ,'$_POST[tmarks]' ,'$_POST[obtain]' ,'$_POST[percentage]','$ten', '$_POST[course_type]', '$_POST[university_name]' ,'$_POST[college_name]' ,'$_POST[branch_type]' ,'$_POST[cboard]' ,'$_POST[c_duration]' ,1,'$_POST[imarks]' ,'$_POST[iobtain]' ,'$_POST[ipercentage]', '$inter_diploma', 1,'$_POST[university]' ,'$_POST[branch]' ,'$_POST[b_duration]' ,'$_POST[bduration]' ,'$_POST[bmarks]' ,'$_POST[bobtain]' ,'$_POST[bpercentage]', '$btechfile','$sems_conv')";
			// for tabs
			$query_acv="INSERT INTO placement_achievements(id,create_uid,create_date,write_uid,stu_achievements,write_date,achieve) VALUES ($e+1, 1, current_timestamp, 1, $i+1, current_timestamp, '$_POST[achieve]')";
			$query_tec="INSERT INTO placement_technical(id,create_uid,technic,rate,write_date,stu_technical,create_date,write_uid) VALUES ($r+1, 1,'$_POST[technic]','$_POST[rate]', current_timestamp, $i+1, current_timestamp, 1)";
			$query_per="INSERT INTO placement_personal(id,create_uid,create_date,stu_personal,personal_skils,write_uid,write_date) VALUES ($t+1, 1,current_timestamp, $i+1,'$_POST[personal_skils]', 1, current_timestamp)";
			$query_prj="INSERT INTO placement_project(id,create_uid,project_academic,create_date,write_uid,stu_project,write_date) VALUES ($y+1, 1,'$_POST[project_academic]',current_timestamp, 1, $i+1, current_timestamp)";

			// for diploma - course types
			$query_ex="INSERT INTO placement_registration(id,create_date,name,photo,stuname,email,phone,course,regulation,department,father,mother,father_contact,gender,dob,blood_group,address,write_date,school_name,board,duration,tduration,tmarks,obtain,percentage,marklist,course_type,university_name,college_name,branch_type,cboard,c_duration,create_uid,dmarks,dobtain,dpercentage,mark_list,write_uid,university,branch,b_duration,bduration,bmarks,bobtain,bpercentage,pc_upload,marks_sem) VALUES ($i+1, current_timestamp,'$_POST[name]' ,'$base64','$_POST[stuname]' ,'$_POST[email]' ,'$_POST[phone]' ,'$_POST[course]' ,'$_POST[regulation]' ,'$_POST[dept]' ,'$_POST[father]' ,'$_POST[mother]' ,'$_POST[father_contact]' ,'$_POST[gender]' ,'$_POST[dob]' ,'$_POST[blood_group]' ,'$_POST[address]' ,current_timestamp,'$_POST[school_name]' ,'$_POST[board]' ,'$_POST[duration]' ,'$_POST[tduration]' ,'$_POST[tmarks]' ,'$_POST[obtain]' ,'$_POST[percentage]','$ten', '$_POST[course_type]', '$_POST[university_name]' ,'$_POST[college_name]' ,'$_POST[branch_type]' ,'$_POST[cboard]' ,'$_POST[c_duration]' ,1,'$_POST[dmarks]' ,'$_POST[dobtain]' ,'$_POST[dpercentage]', '$inter_diploma', 1,'$_POST[university]' ,'$_POST[branch]' ,'$_POST[b_duration]' ,'$_POST[bduration]' ,'$_POST[bmarks]' ,'$_POST[bobtain]' ,'$_POST[bpercentage]', '$btechfile','$sems_conv')";
			
			if($_POST['course_type']=='inter')
			{
			$result = pg_query($query) or die("Your Details are already registered with us Contact admin for Updates!."); 
			}
			else if ($_POST['course_type']=='diploma'){
			$result = pg_query($query_ex);
			}
			if($result>0){
				$year = $_POST['year'];
				$sem = $_POST['sem'];
				$tot = $_POST['tot'];
				$semobtain = $_POST['semobtain'];
				$per = $_POST['per'];
				$j=$i+1;
				foreach($year as $key => $value){
					$query_sem="INSERT INTO btech_marks(id,create_uid,total_marks,btech,year,obtain,write_uid,semistor,write_date,create_date,percentage)VALUES ($u+1,1,$tot[$key],$j,$year[$key],$semobtain[$key],1,$sem[$key],current_timestamp,current_timestamp,$per[$key])";
					$q1=pg_query($query_sem);
					$u=$u+1;
				}
				$q1=pg_query($query_acv);
				$q2=pg_query($query_tec);
				$q3=pg_query($query_per);
				$q4=pg_query($query_prj);
	?>
<!DOCTYPE html>
<html>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link href="https://fonts.googleapis.com/css?family=Slabo+27px&display=swap" rel="stylesheet">
		<style>
			* {
				box-sizing: border-box;
			}
			body  {
				background-color: #cccccc;
			}
			.responsive {
				width: 100%;
				max-width: 150px;
				height: auto;
			}
			.container {
				border-radius: 5px;
				background-color: #f2f2f2;
				padding: 5px 20px 10px 20px;
				width: 60%;
				margin: auto;
			}
			.container:hover {
				box-shadow: 0 12px 25px 0 rgba(0,0,0,0.6);
			}
			#heading,h5{
				font-family: 'Slabo 27px', serif;
			}
		</style>
	</head>
	<body>
		<div class="container">
			<p align="middle"><img src="icon.png" width="100" height="10s0" align="middle" class="responsive" alt="JNTUK Logo"></p>
			<h3 align="middle" id="heading">Student Registration</h3>
			<p align="middle">Thank you!.. Your Details are Registered With Us.</p>
			<p align="center"><a href="index.php">Home</a></p>
		</div>
	</body>
</html>
<?php
	}
	else{
		echo '<script language="javascript">';
		echo 'alert("Connection Problem: Please try again");';
		echo 'window.history.back()';
		echo '</script>';
		}
	}
		pg_close($con);
		}
?>
