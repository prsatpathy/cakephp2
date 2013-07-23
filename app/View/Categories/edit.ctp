<?php

echo $this->html->link('Back',array('action'=>'index'));

echo $this->form->create('Category');
echo $this->form->hidden('id');
echo $this->form->input('name');
echo $this->form->input('parent_id', array('selected'=>$this->data['Category']['parent_id']));
echo $this->form->end('Update');

?>