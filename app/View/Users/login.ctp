<?php
if  ($this->session->check('Message.auth')) $this->session->flash('auth');
echo $this->form->create('User', array('action' => 'login'));
echo $this->form->input('email');
echo $this->form->input('password');
echo $this->form->end('Login');
?>
<h4>Email: <b>test@andolasoft.com</b></h4>
<h4>Password: <b>test123</b></h4>