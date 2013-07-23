<?php
/**
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       Cake.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

$cakeDescription = __d('cake_dev', 'cakePHP 2.2.3 example');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $cakeDescription ?>: <?php echo $title_for_layout; ?>
	</title>
	<?php
		echo $this->Html->meta('icon');
		echo $this->Html->css('style');
		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>
</head>
<body>
	<div id="container">
		<div id="header">
			<div style="float:left">
				<h1 style="float:left"><?php echo $this->Html->link($this->Html->image('logo.png', array('alt' => 'Andolasoft', 'border' => '0')),array('controller'=>'users', 'action'=>'dashboard'),array('escape' => false)); ?></h1>
				<?php if(!$this->session->read('Auth.User.name')) { ?>
				<?php echo $this->Html->link('Auth Login',array('controller'=>'users', 'action'=>'login')); ?>
				&nbsp;&nbsp;
				<?php echo $this->Html->link('FB Login',array('controller'=>'users', 'action'=>'facebook')); ?>
				&nbsp;&nbsp;
				<?php echo $this->Html->link('Twitter Login',array('controller'=>'users', 'action'=>'twitter')); ?>
				<?php } ?>
			</div>
			<div style="float:right">
				<h3 style="float:right"><?php echo $this->Html->link('Categories',array('controller'=>'categories', 'action'=>'index')); ?></h3>
				<h3 style="float:right;margin:0 5px">|</h3>
				<h3 style="float:right"><?php echo $this->Html->link('Users',array('controller'=>'Users', 'action'=>'index')); ?></h3>
				<h3 style="float:right;margin:0 5px">|</h3>
				<h3 style="float:right"><?php echo $this->Html->link('Projects',array('controller'=>'projects', 'action'=>'index')); ?></h3>
				<h3 style="float:right;margin:0 5px">|</h3>
				<h3 style="float:right"><?php echo $this->Html->link('Dashboard',array('controller'=>'', 'action'=>'dashboard')); ?></h3>
				<?php if($this->session->read('Auth.User.name')) { ?>
				<br/>
				<span style="color:#993300">Welcome <b><?php echo $this->session->read('Auth.User.name'); ?></b></span> | 
				<?php echo $this->Html->link('Logout',array('controller'=>'users', 'action'=>'logout')); 
				}
				?>
			</div>
		</div>
		<div id="content">
			<?php echo $this->Session->flash(); ?>
			<?php echo $this->fetch('content'); ?>
		</div>
		<div id="footer">
			Copyright &copy; 2009-2013 Andolasoft. All rights reserved.
		</div>
	</div>
	<?php //echo $this->element('sql_dump'); ?>
</body>
</html>
