<?php	session_start(); 
// dynamic lists
	$con=pg_connect("host=localhost port=5432 dbname=dev10 user=postgres password=sankar");
	if(!$con)
	{
		die('Connection error:'.pg_last_error());
	}
	else{
		$sql="select id,name from placement_course";
		$rs=pg_query($con,$sql) or die("Cannot execute query: $sql\n");
		$opt="<select name='course'>";
		while($row=pg_fetch_row($rs)){
			$opt .= "<option required value='{$row[0]}'>{$row[1]}</option>\n";
		}
		$opt .=	"</select>";
		
		// for  dept
		$sql1="select id,name from placement_department";
		$rs1=pg_query($con,$sql1) or die("Cannot execute query: $sql1\n");
		$opt1="<select name='dept'>";
		while($row1=pg_fetch_row($rs1)){
			$opt1 .= "<option required value='{$row1[0]}'>{$row1[1]}</option>\n";
		}
		$opt1 .= "</select>";
	
	// for  regulation
		$sql_reg="select id,name from placement_regulation";
		$rs11=pg_query($con,$sql_reg) or die("Cannot execute query: $sql_reg\n");
		$opt11="<select name='regulation' id='regulation'>";
		while($row11=pg_fetch_row($rs11)){
			$opt11 .= "<option required value='{$row11[0]}'>{$row11[1]}</option>\n";
		}
		$opt11 .= "</select>";
	}
?>

<!DOCTYPE html>
<html>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
		<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
		<link href="https://fonts.googleapis.com/css?family=Slabo+27px&display=swap" rel="stylesheet">
		<script src="validations.js"></script>
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
			input[type=text],input[type=date],input[type=number],textarea {
				width: 100%;
				padding: 5px;
				border: 1px solid #ccc;
				border-radius: 4px;
				resize: vertical;
				margin-top: 10px;
				height:30px;
			}
			input[type=file]{
				margin-top: 10px;
			}
			select{
				width: 100%;
				border: 1px solid #ccc;
				border-radius: 4px;
				resize: vertical;
				height :30px;
				margin-top: 10px;

			}
			label {
 				width:100%;
 				padding: 12px 12px 12px 0;
				display: inline-block;
			}
			input[type=submit],input[type=reset] {
				background-color: #303F93;
				color: white;
				padding: 10px 20px;
				border: none;
				border-radius: 5px;
				cursor: pointer;
				float: right;
				margin: 20px 0px;
			}
			input[type=submit]:hover {
				background-color: #303F93;
			}
			input[type=reset]:hover {
				background-color: #303F93;
			}
			body{
				line-height: 1.0em;
			}
			.container {
				border-radius: 5px;
				background-color: #f2f2f2;
				padding: 5px 20px 0px 20px;
				width: 70%;
				margin: auto;
			}

			.container:hover {
				box-shadow: 0 12px 25px 0 rgba(0,0,0,0.6);
			}

			.col-25 {
				float: left;
				width: 30%;
				margin-top: 6px;
			}

			.col-75 {
				float: left;
				width: 70%;
				margin-top: 6px;
			}

			/* Clear floats after the columns */
			.row:after {
				content: "";
				display: table;
				clear: both;
			}
			#heading,h5{
				font-family: 'Slabo 27px', serif;
			}
			table{
				border-color:#c2c4a9;
				/*border-radius: 20px;*/
			}

			/* Responsive layout - when the screen is less than 600px wide, make the two columns stack on top of each other instead of next to each other */
			@media (max-width: 600px) {
				.col-25, .col-75, input[type=submit] {
					width: 100%;
					margin-top: 0;
				}
			}
		</style>
		<script type="text/javascript">
		$(document).ready(function(){
	    $("#course_type").change(function(){
	        var courseType = $(this).children("option:selected").val();
	        // alert("You have selected the country - " + selectedCountry);
	    	if (courseType == "diploma"){
	    		// alert("this diploma tab");
	    		$("#intertab").hide();
	    		$("#diplomtab").show();
	    		$("#dpercentagetab").show();
	    		$("#ipercentagetab").hide();
	    	}
	    	else if (courseType == "inter"){
	    		// alert("this is inter tab");
	    		$("#intertab").show();
	    		$("#diplomtab").hide();
	    		$("#ipercentagetab").show();
	    		$("#dpercentagetab").hide();
	    	}
			});
		});

			var i=0;
function addRow()
{
          var tbl = document.getElementById('table1');
          var lastRow = tbl.rows.length;
          var iteration = lastRow - 1;
          var row = tbl.insertRow(lastRow);

          var firstCell = row.insertCell(0);
          var el = document.createElement('input');
          el.type = 'text';
          el.name = 'year[]';
          el.id = 'year' + i;
          firstCell.appendChild(el);

          var secondCell = row.insertCell(1);
          var el2 = document.createElement('input');
          el2.type = 'text';
          el2.name = 'sem[]';
          el2.id = 'sem' + i;
          secondCell.appendChild(el2);

          var thirdCell = row.insertCell(2);
          var el3 = document.createElement('input');
          el3.type = 'text';
          el3.name = 'tot[]';
          el3.id = 'tot' + i;
          thirdCell.appendChild(el3);
          // alert(i);

          var fourthCell = row.insertCell(3);
          var el4= document.createElement('input');
          el4.type = 'text';
          el4.name = 'semobtain[]';
          el4.id = 'semobtain' + i;
          fourthCell.appendChild(el4);

          var fifthCell = row.insertCell(4);
          var el5 = document.createElement('input');
          el5.type = 'text';
          el5.name = 'per[]';
          el5.id = 'per' + i;
          fifthCell.appendChild(el5);

          // var sixthCell = row.insertCell(5);
          // var el6 = document.createElement('input');
          // el6.type = 'file';
          // el6.name = 'marks[]';
          // el6.id = 'marks' + i;
          // sixthCell.appendChild(el6);
          // // alert(i);
          
          i++;
          frm.h.value=i;
}

function myDeleteFunction() {
  document.getElementById("table1").deleteRow(-1);
}
	</script>
	</head>
	<body>
		<div class="container">
			<p align="middle"><img src="icon.png" width="100" height="100" align="middle" class="responsive" alt="JNTUK Logo"></p>
			<h3 align="middle" id="heading">Student Registration</h3>
			<form action="palcements_submit.php" name="frm" id="frm" enctype="multipart/form-data" method="POST" id="uploadForm">
			<div class="row">
				<div class="col-sm-6">
					<div class="col-25">
						<label for="hallticket">HallTicket Number<span style="color:red;">*</span></label>
					</div>
					<div class="col-75">
						<input type="text" id="hallticket" name="name" value="" required>
					</div>
				</div>
				<div class="col-sm-6">
					<div class="col-25">
						<label for="photo">Photo<span style="color:red;">*</span></label>
					</div>
					<div class="col-75">
						<input type="file" placeholder="Attach files" id="photo" name="photo" title="Attach files (JPEG / PNG Only)" accept="image/jpeg, image/png" required>
					</div>
				</div>
			</div>
			<h5><b>Personal Details</b></h5>
			<div class="row">
				<div class="col-sm-6">
					<div class="col-25">
						<label for="stuname">Student Name<span style="color:red;">*</span></label>
					</div>
					<div class="col-75">
						<input type="text" id="stuname" name="stuname" value="" required>
					</div>
				</div>
				<div class="col-sm-6">
					<div class="col-25">
						<label for="gender">Gender<span style="color:red;">*</span></label>
					</div>
					<div class="col-75">
						<select id="gender" name="gender" required>
							<option value="">--- Select ---</option>
							<option value="male">Male</option>
							<option value="female">Female</option>
							<option value="other">Other</option>
						</select>
					</div>
				</div>
			</div>
				<div class="row">
					<div class="col-sm-6">
					<div class="col-25">
						<label for="area">Email<span style="color:red;">*</span></label>
					</div>
					<div class="col-75">
						<input type="text" id="email" name="email" value="" required>
					</div>
					</div>
					<div class="col-sm-6">
					<div class="col-25">
						<label for="dob">Date of Birth<span style="color:red;">*</span></label>
					</div>
					<div class="col-75">
						<input type="date" id="dob" name="dob" value="" required>
					</div>
				</div>
				</div>

				<div class="row">
					<div class="col-sm-6">
					<div class="col-25">
						<label for="phone">Mobile No<span style="color:red;">*</span></label>
					</div>
					<div class="col-75">
						<input type="text" id="phone" name="phone" value="" required>
					</div>
					</div>
					<div class="col-sm-6">
					<div class="col-25">
						<label for="blood_group">Blood Group<span style="color:red;">*</span></label>
					</div>
					<div class="col-75">
						<select id="blood_group" name="blood_group" required>
							<option value="">--- Select ---</option>
							<option value="a+">A+</option>
							<option value="a-">A-</option>
							<option value="b+">B+</option>
							<option value="b-">B-</option>
							<option value="ab+">AB+</option>
							<option value="ab-">AB-</option>
							<option value="o+">O+</option>
							<option value="o-">O-</option>
						</select>
					</div>	
				</div>
				</div>
				<div class="row">
					<div class="col-sm-6">
					<div class="col-25">
						<label for="regulation">Regulation<span style="color:red;">*</span></label>
					</div>
					<div class="col-75">
						<?php echo $opt11; ?>
					</div>
					</div>
					<div class="col-sm-6">
					<div class="col-25">
						<label for="father">Father Name<span style="color:red;">*</span></label>
					</div>
					<div class="col-75">
						<input type="text" id="father" name="father" value="" required>
					</div>
				</div>
				</div>
				<div class="row">
					<div class="col-sm-6">
					<div class="col-25">
						<label for="course">Course<span style="color:red;">*</span></label>
					</div>
					<div class="col-75">
						<?php echo $opt; ?>
					</div>
					</div>
			
					<div class="col-sm-6">
					<div class="col-25">
						<label for="mother">Mother Name<span style="color:red;">*</span></label>
					</div>
					<div class="col-75">
						<input type="text" id="mother" name="mother" value="" required>
					</div>
				</div>
				</div>
				<div class="row">
					<div class="col-sm-6">
					<div class="col-25">
						<label for="dept">Department<span style="color:red;">*</span></label>
					</div>
					<div class="col-75">
						<?php echo $opt1; ?>
					</div>
					</div>
			
					<div class="col-sm-6">
					<div class="col-25">
						<label for="father_contact">Father Moblie No<span style="color:red;">*</span></label>
					</div>
					<div class="col-75">
						<input type="text" id="father_contact" name="father_contact" value="" required>
					</div>
				</div>
				</div>
				<div class="row">
					<div class="col-sm-6">
					<div class="col-25">
						<label for="address">Address</label>
					</div>
					<div class="col-75">
						<textarea id="address" name="address">
						</textarea></br>
					</div>
					</div>
				</div>

				<h5><b>Skills</b></h5>
				<div class="row">
					<div class="col-sm-6">
					<div class="col-25">
						<label for="achievements">Achievements</label>
					</div>
					<div class="col-75">
						<input type="text" id="achievements" name="achieve" value="">
					</div>
				</div>
				</div>
			<div class="row">
					<div class="col-sm-6">
					<div class="col-25">
						<label for="technic">Techinical Skills</label>
					</div>
					<div class="col-75">
						<input type="text" id="technical" name="technic" value="">
					</div>
					</div>

					<div class="col-sm-6">
					<div class="col-25">
						<label for="rate">Rate</label>
					</div>
					<div class="col-75">
						<select id="rate" name="rate">
							<option value="0">0</option>
							<option value="1">1</option>
							<option value="2">2</option>
							<option value="3">3</option>
							<option value="4">4</option>
							<option value="5">5</option>
						</select>
					</div>
				</div>
				</div>
				<div class="row">
					<div class="col-sm-6">
					<div class="col-25">
						<label for="personal">Personal Skills</label>
					</div>
					<div class="col-75">
						<input type="text" id="personal" name="personal_skils" value="">
					</div>
					</div>
					<div class="col-sm-6">
					<div class="col-25">
						<label for="project_academic">Full/Mini-Project</label>
					</div>
					<div class="col-75">
						<input type="text" id="project" name="project_academic" value="">
					</div>
					</div>
				</div>
				<h5><b>Tenth Class Details</b></h5>
				<div class="row">
					<div class="col-sm-6">
					<div class="col-25">
						<label for="school_name">School Name</label>
					</div>
					<div class="col-75">
						<input type="text" id="school_name" name="school_name" value="">
					</div>
					</div>
					<div class="col-sm-6">
					<div class="col-25">
						<label for="board">Board</label>
					</div>
					<div class="col-75">
						<input type="text" id="board" name="board" value="">
					</div>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-6">
					<div class="col-25">
						<label for="duration">Duration From</label>
					</div>
					<div class="col-75">
						<input type="date" id="duration" name="duration" value="">
					</div>
					</div>
					<div class="col-sm-6">
					<div class="col-25">
						<label for="tduration">Duration To</label>
					</div>
					<div class="col-75">
						<input type="date" id="tduration" name="tduration" value="">
					</div>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-6">
					<div class="col-25">
						<label for="obtain">Obtain Marks</label>
					</div>
					<div class="col-75">
						<input type="number" id="obtain" name="obtain" value="0">
					</div>
					</div>
					<div class="col-sm-6">
					<div class="col-25">
						<label for="tmarks">Total Marks</label>
					</div>
					<div class="col-75">
						<input type="number" id="tmarks" name="tmarks" value="0">
					</div>
					</div>
				</div>

				<div class="row">
					<div class="col-sm-6">
					<div class="col-25">
						<label for="percentage">Percentage</label>
					</div>
					<div class="col-75">
						<input type="text" id="percentage" name="percentage" value="0.0">
					</div>
					</div>
					<div class="col-sm-6">
					<div class="col-25">
						<label for="tenth">Marklist Upload</label>
					</div>
					<div class="col-75">
						<input type="file" id="tenth" name="tenth" accept="image/jpeg, image/png, application/pdf">
					</div>
					</div>
				</div>

				<h5><b>Intermediate/Diplamo Details</b></h5>
				<div class="row">
					<div class="col-sm-6">
					<div class="col-25">
						<label for="course_type">Course Type:</label>
					</div>
					<div class="col-75">
						<select id="course_type" name="course_type" required>
							<option value="" selected>--Selected--</option>
							<option value="inter" >Intermediate</option>
							<option value="diploma">Diploma</option>
						</select>
					</div>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-6">
					<div class="col-25">
						<label for="university_name">University Name</label>
					</div>
					<div class="col-75">
						<input type="text" id="university_name" name="university_name" value="">
					</div>
					</div>
				
					<div class="col-sm-6">
					<div class="col-25">
						<label for="college_name">Institution/College Name</label>
					</div>
					<div class="col-75">
						<input type="text" id="college_name" name="college_name" value="">
					</div>
					</div>
				</div>
					<div class="row">
					<div class="col-sm-6">
					<div class="col-25">
						<label for="branch_type">Branch</label>
					</div>
					<div class="col-75">
						<input type="text" id="branch_type" name="branch_type" value="">
					</div>
					</div>
			
					<div class="col-sm-6">
					<div class="col-25">
						<label for="cboard">Board:</label>
					</div>
					<div class="col-75">
						<input type="text" id="cboard" name="cboard" value="">
					</div>
				</div>
				</div>
				<div class="row">
					<div class="col-sm-6">
					<div class="col-25">
						<label for="c_duration">Duration From</label>
					</div>
					<div class="col-75">
						<input type="date" id="c_duration" name="c_duration" value="">
					</div>
					</div>
			
					<div class="col-sm-6">
					<div class="col-25">
						<label for="cduration">Duration To</label>
					</div>
					<div class="col-75">
						<input type="date" id="cduration" name="cduration" value="">
					</div>
				</div>
				</div>
				<div class="row" id="intertab">
					<div class="col-sm-6">
					<div class="col-25">
						<label for="iobtain">Obtain Marks</label>
					</div>
					<div class="col-75">
						<input type="number" id="iobtain" name="iobtain" value="0">
					</div>
					</div>
					<div class="col-sm-6">
					<div class="col-25">
						<label for="imarks">Total Marks</label>
					</div>
					<div class="col-75">
						<input type="number" id="imarks" name="imarks" value="0">
					</div>
				</div>
				</div>
				<div class="row" id="diplomtab">
					<div class="col-sm-6">
					<div class="col-25">
						<label for="dobtain">Obtain Marks</label>
					</div>
					<div class="col-75">
						<input type="number" id="dobtain" name="dobtain" value="0">
					</div>
					</div>
			
					<div class="col-sm-6">
					<div class="col-25">
						<label for="dmarks">Total Marks</label>
					</div>
					<div class="col-75">
						<input type="number" id="dmarks" name="dmarks" value="0">
					</div>
				</div>
				</div>
				<div class="row">
					<div class="col-sm-6" id="dpercentagetab">
					<div class="col-25">
						<label for="dpercentage">Percentage</label>
					</div>
					<div class="col-75">
						<input type="text" id="dpercentage" name="dpercentage" value="0.00">
					</div>
					</div>
					<div class="col-sm-6" id="ipercentagetab">
					<div class="col-25">
						<label for="ipercentage">Percentage</label>
					</div>
					<div class="col-75">
						<input type="text" id="ipercentage" name="ipercentage" value="0.00">
					</div>
				</div>
				</div>
				<div class="row">
				<div class="col-sm-6">
					<div class="col-25">
						<label for="mark_list">MarkList Upload</label>
					</div>
					<div class="col-75">
						<input type="file" id="mark_list" name="mark_list" accept="image/jpeg, image/png, application/pdf">
					</div>
				</div>
			</div>
			<br/>
			<h5><b>B.Tech Details</b></h5>
			<div class="row">
				<div class="col-sm-6">
				<div class="col-25">
					<label for="university">University</label>
				</div>
				<div class="col-75">
					<input type="text" id="university" name="university" value="">
				</div>
				</div>
				<div class="col-sm-6">
				<div class="col-25">
					<label for="branch">Branch</label>
				</div>
				<div class="col-75">
					<input type="text" id="branch" name="branch" value="">
				</div>
			</div>
			</div>
			<div class="row">
				<div class="col-sm-6">
				<div class="col-25">
					<label for="b_duration">Duration From</label>
				</div>
				<div class="col-75">
					<input type="date" id="b_duration" name="b_duration" value="">
				</div>
				</div>
				<div class="col-sm-6">
				<div class="col-25">
					<label for="bduration">Duration To</label>
				</div>
				<div class="col-75">
					<input type="date" id="bduration" name="bduration" value="">
				</div>
			</div>
			</div>
			<div class="row">
				<div class="col-sm-6">
				<div class="col-25">
					<label for="bobtain">Obtain Marks</label>
				</div>
				<div class="col-75">
					<input type="number" id="bobtain" name="bobtain" value="0">
				</div>
				</div>
				<div class="col-sm-6">
				<div class="col-25">
					<label for="bmarks">Total Marks</label>
				</div>
				<div class="col-75">
					<input type="number" id="bmarks" name="bmarks" value="0">
				</div>
			</div>
			</div>
			<div class="row">
				<div class="col-sm-6">
				<div class="col-25">
					<label for="bpercentage">Percentage</label>
				</div>
				<div class="col-75">
					<input type="text" id="bpercentage" name="bpercentage" value="0.00">
				</div>
				</div>
				<div class="col-sm-6">
				<div class="col-25">
					<label for="pc_upload">Pc Upload</label>
				</div>
				<div class="col-75">
					<input type="file" id="pc_upload" name="pc_upload" accept="image/jpeg, image/png, application/pdf">
				</div>
			</div>
			</div>
		<h5><b>B.Tech Sem wise Details</b></h5>
		<input type="button" value="Add" onclick="addRow();" />
		<input type="button" id="bt1" name="btn" value="Remove" onclick="myDeleteFunction()" />
			</br></br>
			<table width="100%" border="1" id="table1">
			  <tr align="center">
			    <td><strong>Year</strong></td>
			    <td><strong>Semister</strong></td>
			    <td><strong>Total Marks</strong> </td>
			    <td><strong>Obtain Marks</strong> </td>
			    <td><strong>Percentage</strong></td>
			    <!-- <td><strong>Marklist</strong></td> -->
			  </tr>
			  <tr align="center">
			    <td><input name="year[]" type="text" id="year"/></td>
			    <td><input name="sem[]" type="text" id="sem" /></td>
			    <td><input name="tot[]" type="text" id="total"/></td>
			    <td><input name="semobtain[]" type="text" id="semobtain"/></td>
			    <td><input name="per[]" type="text" id="per"/></td>
			    <!-- <td><input name="marks[]" type="file" id="marks" size="50" maxlength="10"/></td> -->
			  </tr>
			</table>
			<input name="marks_sem" type="file" id="marks_sem" size="50" maxlength="10"/>
				<div class="row">
					&nbsp;&nbsp;&nbsp;
					<input type="submit" value="Submit" onclick="Validate()">
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="reset" value="Reset">
				</div>
			</form>
		</div>
	</body>
</html>

<?php
	$expireafter=7;
	if(isset($_SESSION['last_action'])){
		$secondsInactive=time()-$_SESSION['last_action']; 
		if($expireafter < $secondsInactive){
			echo '<script language="javascript">';
			echo 'if(alert("Session expired: Please Refresh the page to continue")){';
			echo 'close();}';
			echo '</script>';
			session_destroy();
			return;
		}
	}
	$_SESSION['last_action']=time();
?>
