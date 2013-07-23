<?php

echo $this->html->link('Back',array('action'=>'index'));

echo $this->form->create('Category');
echo $this->form->input('name',array('label'=>'Name'));
echo $this->form->input('parent_id',array('label'=>'Parent'));
echo $this->form->end('Add');

?>