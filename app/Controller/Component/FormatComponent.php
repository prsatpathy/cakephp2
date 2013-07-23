<?php
class FormatComponent extends Component
{
	public $components = array('Session','Email', 'Cookie');
	
	function sendEmail($from,$to,$subject,$message,$type)
	{
		App::import('helper', 'Format');
		$frmtHlpr = new FormatHelper(new View(null));
		
		$to = $frmtHlpr->emailText($to);
		$subject = $frmtHlpr->emailText($subject);
		$message = $frmtHlpr->emailText($message);
		
		$message = str_replace("<script>","&lt;script&gt;",$message);
		$message = str_replace("</script>","&lt;/script&gt;",$message);
		$message = str_replace("<SCRIPT>","&lt;script&gt;",$message);
		$message = str_replace("</SCRIPT>","&lt;/script&gt;",$message);
		$message = preg_replace('/[^(\x20-\x7F)\x0A]*/','', $message);
		
		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers.= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		$headers.= 'From:' .$from."\r\n";

		if(mail($to,$subject,$message,$headers)) {
			return true;
		}
	}
	function getUserEmail($uid) {
		$User = ClassRegistry::init('User');
		$User->recursive = -1;
		$usrDtls = $User->find('first', array('conditions' => array('User.id' => $uid),'fields' => array('User.email')));
		return $usrDtls['User']['email'];
	}
	function generateUniqNumber() {
		$uniq = uniqid(rand());
		return md5($uniq.time());
	}
	function getRealIpAddr()
	{
		if(!empty($_SERVER['HTTP_CLIENT_IP']))
		{
			$ip=$_SERVER['HTTP_CLIENT_IP'];
		}
		elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR']))   
		{
			$ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
		}
		else
		{
			$ip=$_SERVER['REMOTE_ADDR'];
		}
		return $ip;
	}
}
?>
