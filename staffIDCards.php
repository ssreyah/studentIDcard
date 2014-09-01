<html>
<head>
<meta charset="UTF-8" />
<style style="text/css">
<!--
@page { size:54mm 86mm;}
@media screen{
#container{
    position: absolute;
    left: 0;
    top: 0;
    margin:0;
    padding:0;
    width: 54mm;
}
.card{
    width: 100%;
    height: 81mm;
    padding-top: 5mm;
    position: relative;
    font-family: "Futura Medium" sans-serif;
    text-align: center;
    page-break-after: always;
    background-image:url('img/watermark.png');
    background-size: 200%;
    background-repeat: no-repeat;
    background-position: center;
    border:solid 3px lightgrey;
    margin: 5px;

}
.photo{
    text-align: center;
    height: 4.5cm;
    
}
.logo{
    position: relative;
    padding: 1mm;
}

.name{
    font-weight: bold;
}
.title{
font-size:small;
    
}
.expires{
    font-size: small;
}
.barcode{
    width: 90%;
    margin: auto;
    font-size:x-small;
}
}
@media print{
#container{
    position: absolute;
    left: 0;
    top: 0;
    margin:0;
    padding:0;
    width: 54mm;
}
.card{
    width: 100%;
    height: 81mm;
    padding-top: 5mm;
    position: relative;
    font-family: "Futura Medium" sans-serif;
    text-align: center;
    page-break-after: always;
    background-image:url('img/watermark.png');
    background-size: 200%;
    background-repeat: no-repeat;
    background-position: center;

}

.photo{
    text-align: center;
    height: 4.5cm;
    
}
.logo{
    position: relative;
    padding: 1mm;
}

.name{
    font-weight: bold;
}
.title{
font-size:small;
    
}
.expires{
    font-size: small;
}
.barcode{
    width: 90%;
    margin: auto;
    background-color: white;
    font-size:x-small;
}
}
-->

</style>
</head>
<body>
<div id="container">
<?php
include "connectdb.php";
include "staffcard.php";
$syear = 2014;
$school_id = 1;
$dbh = connectDB();
$query = $dbh->prepare("
SELECT * FROM staff where current_school_id = $school_id AND profile='teacher' AND is_disable IS NULL and last_name='Bawden'
");
$query->execute();
$teachers = $query->fetchAll(PDO::FETCH_ASSOC) or die('eek!');
//load data set
$c=0;
$cardarray = array();

//Set initial card to be junk data - background don't display otherwise.

foreach($teachers as $teacher){
	$sid = $teacher['staff_id'];
	$fname = $teacher['first_name'];
	$sname = $teacher['last_name'];
	$ahid = $teacher['CUSTOM_2'];

	$cardarray[$c] = new Card($fname, $sname, $sid, $ahid);
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

