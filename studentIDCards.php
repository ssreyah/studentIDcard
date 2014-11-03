<html>
<head>
<meta charset="UTF-8" />
<style style="text/css">
<!--
@page { size:86mm 54mm; margin: 0cm }
table{

	padding: 0cm;
	#border:solid black 1px;
	border-collapse: collapse;

}

tr,td{
	font-size: 8pt;
	#border:solid black 1px;
	padding-right: 3mm;
}

.schoolname{
	font-family: serif;
	font-size: 12pt;
	font-weight: bold;

}

.tagline{
	font-family: serif;
	font-size: 6pt;
	margin-bottom: 2mm;

}
.studentname{

	font-size: 14pt;
	font-weight: bold;
}
.sid{
	font-size: 10pt;
	margin-bottom: 5mm;
}
.expires{
	color: darkred;
	font-size: 6pt;
	margin: 1mm;
	text-align: center;
}
.card{
	font-family: sans;
	width: 86mm;
	height: 54mm;

}
.studentpic{
	float:right;
	position: relative;
	top: -2mm;
}
.barcode{

}
.bcimg{
	width: 40mm;
	position: relative;
	top: -17mm;
}
.biographic{
	margin-bottom: 5mm;
}

.watermark{
	z-index:-1;
	position: absolute;
}
.watermarkimg{
	height: 54mm;
}
.studentimg{
	width: 2.5cm;
}
-->
</style>
</head>
<body>
<?php
include "connectdb.php";
include "card.php";
$syear = 2014;
$school_id = 1;
$grade = "Grade 6";
$dbh = connectDB();
$query = $dbh->prepare("
SELECT 
enrolled_students.sid,
enrolled_students.dob,
enrolled_students.fname,
enrolled_students.sname,
enrolled_students.cname,
student_addresses.e1,
student_addresses.e2,
Grade.title

FROM    
        
(SELECT students.first_name as fname, students.last_name as sname, students.common_name as cname, students.student_id as sid, students.birthdate as dob, student_enrollment.grade_id as grade_id from students, student_enrollment
WHERE   
student_enrollment.student_id = students.student_id AND student_enrollment.syear = $syear AND student_enrollment.school_id=$school_id and end_date IS NULL)
as enrolled_students,

(SELECT students_join_address.student_id as sid, address.email as Email, address.mobile_phone as e1, address.sec_mobile_phone as e2 FROM address, students_join_address where address.address_id = students_join_address.address_id) as student_addresses,

(SELECT school_gradelevels.title as title, school_gradelevels.id as grade_id from school_gradelevels) as Grade

WHERE
student_addresses.sid = enrolled_students.sid AND
enrolled_students.grade_id = Grade.grade_id
AND Grade.title = '$grade'

ORDER BY enrolled_students.sname ASC
");
$query->execute();
$students = $query->fetchAll(PDO::FETCH_ASSOC);
//load data set
$c=0;
$cardarray = array();

//Set initial card to be junk data - background don't display otherwise.
$cardarray[$c] = new Card($grade, $grade, $grade, $grade, $grade, $grade);
$c++;

foreach($students as $student){
        $name = null;

	$sid = $student['sid'];
	$dob = $student['dob'];
	$fname = $student['fname'];
	$sname = $student['sname'];
        $cname = $student['cname'];

        //use their common names if available
        if($cname) $name = $cname;
        else $name = $fname;

	$e1 = $student['e1'];
	$e2 = $student['e2'];

	$cardarray[$c] = new Card($name, $sname, $sid, $dob, $e1, $e2);
	$c++;
}

foreach($cardarray as $testcard){

	print($testcard->toRawHTML());
	/*print("
		<img style =\"width: 86mm\" src = \"img/cardback.png\">
        ");*/
}
?>
</body>
</html>

