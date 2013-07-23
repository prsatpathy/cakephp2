<?php
class Category extends AppModel {
	var $name = 'Category';
	var $actsAs = array('Tree');
	//The variable $actsAs tells Cake to attach 'Tree' behavior to this model, i.e.,  Cake will generate a Tree data structure for category model. 
	//CakePHP has built-in behaviors, like - behaviors for tree structures, translated content, access control list interaction etc., which you can attach with any model. As you might know - 'add', 'edit', 'delete' options for these type of data structures need special care. Cake takes care of it once you have specified the applicable 'behavior' in the model. Behaviors are attached with models using $actsAs variable. In this case, I have specified $actsAs = array('Tree'). This will enforce 'Tree' behavior on Category model. Simple.
	 
	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array(
		'ParentCategory' => array(
			'className' => 'Category',
			'foreignKey' => 'parent_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

	var $hasMany = array(
		'ChildCategory' => array(
			'className' => 'Category',
			'foreignKey' => 'parent_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);

}