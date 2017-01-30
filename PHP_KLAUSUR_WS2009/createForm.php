<?php
/**
array $beschriftung contains the name and last name of user in indices 0 and 1

 */
function createForm($postTarget, $position, array $beschriftung){
	
	if($position == 1){
		$align = "left";
	}elseif ($position == 2){
		$align = "center";
	}else 
		$align = "right";
	echo "<html><body><br>
			<form action=./" . $postTarget . "method=\"POST\"><br>
			<table align=\"" . $align . "\"><br>";
					
	for($i=0; $i <= array_count_values($beschriftung); $i++){
		
		echo "<td><input type=\"text\" name=" . $beschriftung[$i] . "\"> </td>";
	}
		
	echo "<td><input type=\"submit\" value=\"Anfrage Abschicken\"> </td>
				</tr>
			</table>			
		</form>
		</body>
	</html>";
			
}

$customer=array("Thomas", "Anson");
createForm("./target", 1, $customer);