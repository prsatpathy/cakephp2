<?php
class FormatHelper extends AppHelper {

	function getUserEmail($uid) {
		$User = ClassRegistry::init('User');
		$User->recursive = -1;
		$usrDtls = $User->find('first', array('conditions' => array('User.id' => $uid),'fields' => array('User.email')));
		return $usrDtls['User']['email'];
	}
	function dateFormat($datetime)
	{
		return date("M jS Y, g:i a", strtotime($datetime));
	}
	function emailText($value)
	{
		$value = stripslashes(trim($value));
		$value = str_replace("â€œ","\"",$value);
        $value = str_replace("â€","\"",$value);
		$value = str_replace("“","\"",$value);
		$value = str_replace("”","\"",$value);
		//$value = preg_replace('/[^(\x20-\x7F)\x0A]*/','', $value);
		$value = $this->fixtags($value);
		$value = html_entity_decode($value, ENT_QUOTES);
		return stripslashes($value);
	}
	function getBrowser(){
		$browser = $_SERVER['HTTP_USER_AGENT'];
		if(stristr($browser,"Safari") && !strstr($browser,"Chrome")){
			$agent = "Safari";
		}
		elseif(stristr($browser,"Firefox")){
			$agent = "Firefox";
		}
		elseif(stristr($browser,"Chrome")){
			$agent = "Chrome";
		}
		elseif(stristr($browser,"MSIE")){
			$agent = "IE";
		}
		return $agent;
	}
	function formatText($value)
	{
		$value = str_replace("â€œ","\"",$value);
		$value = str_replace("â€","\"",$value);
		$value = str_replace("“","\"",$value);
		$value = str_replace("”","\"",$value);
		$value = stripslashes($value);
		$value = html_entity_decode($value, ENT_QUOTES,'UTF-8');
		$value = stripslashes(trim($value));
		return $value;
	}
	function shortLength($value, $len)
	{
		$value_format = $this->formatText($value);
		$value_raw = html_entity_decode($value_format, ENT_QUOTES);
		if(strlen($value_raw) > $len) {
			$value_strip = substr($value_raw,0,$len);
			$value_strip = $this->formatText($value_strip);
			$lengthvalue = "<font title='".$value_format."' >".$value_strip."...</font>";
		}
		else {
			$lengthvalue = $value_format;
		}
		return $lengthvalue;
	}
}
?>
