<?php
class Project extends AppModel{
	public $name = 'Project';
	var $actsAs = array('Containable');
	
	var $hasAndBelongsToMany = array(
        'User' =>
            array(
                'className'              => 'User',
                'joinTable'              => 'project_users',
                'foreignKey'             => 'project_id',
                'associationForeignKey'  => 'user_id'
            )
    );
}
?>