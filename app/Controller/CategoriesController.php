<?php
App::uses('AppController', 'Controller');
class CategoriesController extends AppController {

	var $name = 'Categories';

	function index() {
		$Categorylist = $this->Category->generateTreeList(null,null,null," - ");
		//generateTreeList() generates a tree-type views for our Categories
		
		$this->set(compact('Categorylist'));
		//compact() function is used to pass variables to your views in CakePHP. Compact() method detects the variables having the same name (in this case 'Categorylist') in the Controller and splits them as an array() of $key => value pairs. Now $this->set() is used to set those values for using them in your view file.
	}

    function add() {
        if (!empty($this->data)) {
            $this->Category->save($this->data);
            $this->redirect(array('action'=>'index'));
        } else {
            $parents[0] = "[ No Parent ]";
            $Categorylist = $this->Category->generateTreeList(null,null,null," - ");
            if($Categorylist){
                foreach ($Categorylist as $key=>$value){
                    $parents[$key] = $value;
		    }
			$this->set(compact('parents'));
	    }
        }
    }

    function edit($id=null) {
        if (!empty($this->data)) {
            if($this->Category->save($this->data)==false)
                $this->Session->setFlash('Error saving Category.');
            $this->redirect(array('action'=>'index'));
        } else {
            if($id==null) die("No ID received");
            $this->data = $this->Category->read(null, $id);
            $parents[0] = "[ No Parent ]";
            $Categorylist = $this->Category->generateTreeList(null,null,null," - ");
            if($Categorylist) 
                foreach ($Categorylist as $key=>$value)
                    $parents[$key] = $value;
            $this->set(compact('parents'));
        }
    }

    function delete($id=null) {
        if($id==null)
            die("No ID received");
        $this->Category->id=$id;
        if($this->Category->delete()==false)
            $this->Session->setFlash('The Category could not be deleted.');
        $this->redirect(array('action'=>'index'));
    }

    function moveUp($id=null) {
        if($id==null)
            die("No ID received");
        $this->Category->id=$id;
        if($this->Category->moveUp()==false)
            $this->Session->setFlash('The Category could not be moved up.');
        $this->redirect(array('action'=>'index'));
    }

    function moveDown($id=null) {
        if($id==null)
            die("No ID received");
        $this->Category->id=$id;
        if($this->Category->moveDown()==false)
            $this->Session->setFlash('The Category could not be moved down.');
        $this->redirect(array('action'=>'index'));
    }
    function removeNode($id=null){
		if($id==null)
			die("Nothing to Remove");
		if($this->Category->removeFromTree($id)==false)
			$this->Session->setFlash('The Category can\'t be removed.');
			$this->redirect(array('action'=>'index'));	
    }
    
}
?>