<?php
App::uses('AppController', 'Controller');
class ProjectsController extends AppController {
	
	public $name = 'Projects';
	
	public function index() {
		//$this->Project->Behaviors->attach('Containable'); // You can also set Containable behavious on the fly without doing it on the Model
		//$this->Project->contain('User.name'); // OR array('contain' => false) on the find() function
		
		$contain = array('User'=>array(
								'fields'=>array('name','email')
								)
							);
							
		$conditions = array('Project.is_active'=>1);
		if(isset($_GET['search']) && trim($_GET['search'])) {
			$search = urldecode(trim($_GET['search']));
		}
		if(@$search) { $conditions['Project.name LIKE'] = '%'.$search.'%'; }
		
		$this->paginate = array(
				'contain' => $contain,
				'conditions' => $conditions,
				'fields' => array('name','link','created','description'),
				'limit' => 2,
				'order' => array('Project.name'=>'asc','Project.created' => 'desc'),
			);
		$projects = $this->paginate('Project');
		$this->set('projects', $projects);
	}
}
