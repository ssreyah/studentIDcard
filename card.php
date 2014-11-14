<?php
	class Card{
		function __construct($firstname="Renoire", $lastname="McStudentsen",
								$sid = "123",$dob="12-Jan-1999",
								$econtact1="017-922-088",$econtact2="092-094-843"){

			$this->firstname = trim($firstname);
			$this->lastname = trim($lastname);
			$this->sid = $sid;
			$this->dob = $dob;
			$this->econtact1 = $econtact1;
			$this->econtact2 = $econtact2;
                        $this->syear = 2013;

		}
		function getID(){
			return $this->sid;
		}

		function toString(){
			return("Firstname:\t\t".$this->firstname."\n"."Lastname:\t\t".$this->lastname."\n".
			"SID:\t\t\t".$this->sid."\n".
			"Bloodtype:\t\t".$this->bloodtype."\n".
			"DOB:\t\t\t".$this->dob."\n".
			"Emergency Contacts:\t".$this->econtact1."\n\t\t\t".$this->econtact2."\n");

		}
		function toHTML(){
			if(file_exists("StudentPhotos/$this->sid.JPG")) $photo="StudentPhotos/$this->sid.JPG";
			else $photo = "StudentPhotos/nophoto.JPG";
			return("
					<table style=\"width: 13.0cm;\"  >
					 <tr><td><img src = \"logo.jpg\"></td><td rowspan=\"2\" align = \"right\" style=\"width:2.2cm;\"><img src = \"$photo\" width=\"2cm\"></td></tr>
					 <tr><td><b style=\"font-size: x-large;\">$this->lastname, $this->firstname</b></td></tr>
					<tr><td><b>Student ID: $this->sid</b><br>
							<i style=\"font-size:x-small\">expires: 10-10-10</i></td></tr>
					 <tr><td>DOB:</td> <td>$this->dob</td></tr>
					 <tr><td>Emergency Contacts/ទំនាក់ទំនងលេខ:</td><td>$this->econtact1</td></tr>
					 <tr><td rowspan=\"2\"></td><td>$this->econtact2</td></tr>
					 <tr></tr>

					 </table>

					");

		}

		function toRawHTML(){
                        if(file_exists("StudentPhotos/$this->sid.JPG"))
                        $photo="StudentPhotos/$this->sid.JPG";
			else if(file_exists("StudentPhotos/$this->syear/$this->sid.JPG"))
                        $photo="StudentPhotos/$this->syear/$this->sid.JPG";
			else if(file_exists("StudentPhotos/$this->syear-1/$this->sid.JPG"))
                        $photo="StudentPhotos/$this->syear-1/$this->sid.JPG";
			else if(file_exists("StudentPhotos/$syear-2/$this->sid.JPG"))
                        $photo="StudentPhotos/$syear-2/$this->sid.JPG";
			else if(file_exists("StudentPhotos/$syear-3/$this->sid.JPG"))
                        $photo="StudentPhotos/$syear-3/$this->sid.JPG";

			else $photo = "img/nophoto.jpg";


			return("

					<div class=\"card\">
							<div class=\"logo\"><img src = \"img\logoslogo.png\" class = \"logoimg\" style=\"width: 100%\"></div>
							<div class=\"photo\" style=\"background-image:url('$photo');\"></div>
							<div class=\"name\">$this->lastname, $this->firstname</div>
							<div class=\"title\">Student</div>
							<div class=\"barcode\"><img src = \"barcode.php?text=$this->sid&size=30\" id = \"barcodeimg\" alt=\"blah\"></div>
							<div class=\"barcodenumber\">Student ID: <strong>$this->sid</strong></div>
							<div class=\"cardbody\">
								<ul>
									<li id=\"dob\">DOB: $this->dob</li>
									<li>Emergency Contact:</li>
									<li id=\"econtact1\">$this->econtact1</li>
									<li id=\"econtact2\"> $this->econtact2</li>
								</ul>
							</div>
							<div class=\"footer\"><img class=\"footerimg\" src = \"img\logoslibraryfooter.png\" style=\"width: 100%\"/> </div>
					</div>

					");

		}

	}

?>
