<h2>Use of Component</h2>
<b>Email: </b> <?php echo $email; ?>
<br/><br/>
<b>Unique Number: </b> <?php echo $uniq_no; ?>
<br/><br/>
<b>IP Address: </b> <?php echo $ip; ?>
<br/>
<hr/><br/>
<h2>Use of Helper</h2>
<?php
echo $this->Form->month('mob');

$text = "In general, the more behavior you find in the services, the more likely you are to be robbing yourself of the benefits of a domain model. If all your logic is in services, you've robbed yourself blind";
?>
<b>Email: </b> <?php echo $this->Format->getUserEmail($this->session->read('Auth.User.id')); ?>
<br/><br/>
<b>Shorten text Length: </b> <?php echo $this->Format->shortLength($text,20); ?>
<br/><br/>
<b>Browser: </b> <?php echo $this->Format->getBrowser(); ?>
<br/><br/>
<b>Due Date: </b> <?php echo $this->Format->dateFormat('2014-12-12 15:30:00'); ?>
<br/>
<hr/>
<br/><br/>
<b>Download: </b> <a href="../users/downloadFile/myfile.txt" target="_blank">myfile.txt</a> <i>Common function in App Controler</i>
<br/><br/>
<h3>You are in Users controller Dashboard view >> (config/routes.php)</h3>

