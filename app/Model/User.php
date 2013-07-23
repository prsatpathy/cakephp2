<?php
class User extends AppModel{
	public $name = 'User';
	
	var $hasAndBelongsToMany = array(
        'Project' =>
            array(
                'className'              => 'Project',
                'joinTable'              => 'project_users',
                'foreignKey'             => 'user_id',
                'associationForeignKey'  => 'project_id'
            )
    );
	// in CakePHP 2.0 auth automatically hashes the pass on login but not on save, so hash the password before save user data
	public function beforeSave($options = array()) {
        $this->data['User']['password'] = AuthComponent::password($this->data['User']['password']);
        return true;
    }
	public function getUserList() {
		
		$users = $this->find('all',array('order'=>'User.name ASC'));
		$userdata = array();
		foreach($users as $ukey=>$data) {
			$userdata[$ukey]['id'] = $data['User']['id'];
			$userdata[$ukey]['email'] = $data['User']['email'];
			$userdata[$ukey]['name'] = $data['User']['name'];
			foreach($data['Project'] as $pkey=>$proj) {
				$userdata[$ukey]['Project'][$pkey] = array('id'=>$proj['id'],'name'=>$proj['name'],'link'=>$proj['link'],'created'=>date('M d, Y',strtotime($proj['created'])));
			}
		}
		return $userdata;
    }
	public function generatePassword($length)
	{
		$vowels = 'aeuy';
		$consonants = '3@Z6!29G7#$QW4';
		$password = '';
		$alt = time() % 2;
		for ($i = 0; $i < $length; $i++) {
			if ($alt == 1) {
				$password .= $consonants[(rand() % strlen($consonants))];
				$alt = 0;
			} else {
				$password .= $vowels[(rand() % strlen($vowels))];
				$alt = 1;
			}
		}
		return $password;
	}
	public function validateEmail($email) 
	{
		$at = strrpos($email, "@");
		if ($at && ($at < 1 || ($at + 1) == strlen($email)))
			return false;
		if (preg_match("/(\.{2,})/", $email))
			return false;
		$local = substr($email, 0, $at);
		$domain = substr($email, $at + 1);
		$locLen = strlen($local);
		$domLen = strlen($domain);
		if ($locLen < 1 || $locLen > 64 || $domLen < 4 || $domLen > 255)
			return false;
		if (preg_match("/(^\.|\.$)/", $local) || preg_match("/(^\.|\.$)/", $domain))
			return false;
		if (!preg_match('/^"(.+)"$/', $local)) {
			if (!preg_match('/^[-a-zA-Z0-9!#$%*\/?|^{}`~&\'+=_\.]*$/', $local))
				return false;
		}
		if (!preg_match("/^[-a-zA-Z0-9\.]*$/", $domain) || !strpos($domain, "."))
			return false;
		return true;
	}
	public function getCategories()
	{
		$Category = ClassRegistry::init('Category');
		$Category->recursive = -1;
		$categories = $Category->find('all', array('order'=>'Category.name ASC'));
		$allcat = array();
		foreach($categories as $cat) {
			$allcat[] = $cat['Category']['name'];
		}
		return implode(", ",$allcat);
	}
	public function checkTwitterData() {
		
	}
}
?>