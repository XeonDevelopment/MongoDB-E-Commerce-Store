<?php 
function escape($string){
	if(is_array($string)){
		return htmlentities($string[0], ENT_QUOTES, 'UTF-8');
	}else{
		return htmlentities($string, ENT_QUOTES, 'UTF-8');
	}
}





 ?>