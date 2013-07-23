<?php
class ProjectUser extends AppModel{
	public $name = 'ProjectUser';

	public $belongsTo = array('Project' =>
					array('className'     => 'Project',
					'foreignKey'    => 'project_id'
					),
					'User' =>
					array('className'     => 'User',
					'foreignKey'    => 'user_id'
					)
				);
}
?>