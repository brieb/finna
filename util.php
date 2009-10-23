<?php

function print_array($arr)
{
    echo str_replace(' ','&nbsp;',str_replace("\n","\n<br>",print_r($arr,true)));
}

function check_date($date,$allowEmpty){
	if($allowEmpty && empty($date)) return false;
	$array = explode('-',$date);
	if(count($array)!=3) return true;
	if(!is_numeric($array[0]) || !is_numeric($array[1]) || !is_numeric($array[2])) 
		return true;
	return !checkdate($array[1],$array[2],$array[0]);
}

function format_timestamp($stamp)
{
   if (date("Yz") == date("Yz",$stamp)){
      return "Today at ".date("g:ia",$stamp);
   } else if (date("Yz") == date("Yz",$stamp+60*60*24) ){
      return 'Yesterday at '.date("g:ia",$stamp);
   } else if ((time() - $stamp)<60*60*24*6){
      return date("l",$stamp).' at '.date("g:ia",$stamp);
   } else if (date("Y")==date("Y",$stamp)){
      return date("F j",$stamp).' at '.date("g:ia",$stamp);
   } else {
      return date("F j, Y",$stamp).' at '.date("g:ia",$stamp);
   }   
}

function set($name, $val)
{
     $GLOBALS[$name] = $val;
}

function stripSlashesDeep($value) 
{
    $value = is_array($value) ? array_map('stripSlashesDeep', $value) : stripslashes($value);
    return $value;
}

function removeMagicQuotes() 
{
    if (get_magic_quotes_gpc() ) {
        $_GET    = stripSlashesDeep($_GET   );
        $_POST   = stripSlashesDeep($_POST  );
        $_COOKIE = stripSlashesDeep($_COOKIE);
    }
}

?>