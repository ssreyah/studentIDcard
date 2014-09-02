<?php
	class Card{
		function __construct($firstname="Renoire", $lastname="McStudentsen",
								$sid = "123", $ahid="123"
								){

			$this->firstname = trim($firstname);
			$this->lastname = trim($lastname);
			$this->sid = $sid;
			$this->ahid = $ahid;
                        $this->syear = 2014;

		}

		function toRawHTML(){
                        if(file_exists("UserPhotos/$this->sid.JPG")) $photo = "UserPhotos/$this->sid.JPG";
			else $photo = "img/nophoto.jpg";


			return("
                            <div class=\"card\">
                                <div class=\"logo\"><img src = \"img\logoslogo.png\" style=\"width: 100%\"></div>
                                <div class=\"photo\"><img src = \"".$photo."\" style=\"height:97%; border: 3px solid lightgrey;\"></div>
                                <div class=\"name\">".$this->lastname.", ".$this->firstname."</div>
                                <div class=\"title\">Staff</div>
				<div class=\"barcode\"><img src = \"barcode.php?text=$this->ahid&size=30\" alt=\"blah\"><br/>$this->ahid</div>
                                <div class=\"footer\"><img src = \"img\logosfooter.png\" style=\"width:100%\"></div>
                            </div>
                         

					");

		}

	}

?>

