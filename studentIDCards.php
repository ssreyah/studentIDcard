<html>
<head>
<meta charset="UTF-8" />
<link rel="stylesheet" type="text/css" href="css/studentcard.css">
</head>
<body>
<div id="container" style="display:block;">
<?php
include "connectdb.php";
include "card.php";
$syear = 2014;
$school_id = 1;
$grade = $_GET['grade'];
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
</div>
</body>
</html>
