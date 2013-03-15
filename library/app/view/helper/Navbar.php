<?php
class App_View_Helper_Navbar extends Zend_View_Helper_Abstract {
	public function navbar() {
		$this->ident = Zend_Auth::getInstance()->getIdentity();
		
		$request = Zend_Controller_Front::getInstance()->getRequest();
		$controller = $request->getParam('controller');
		
		$navbar = array();
		
		if ($this->ident) {
			$navbar = array('Home' => array('controller'=>'index', 'Path'=>'/'),
							'Files' => array('controller'=>'files', 'Path'=>'/files/'),
							'Clients' => array('controller'=>'clients', 'Path'=>'/clients/'),
							'Logout' => array('controller'=>'auth', 'Path'=>'/auth/logout'),
			);
			foreach ($navbar as $key => $nav){
				
				if ($nav['controller'] == $controller)
				{
					$navbar[$key]['class'] = 'class="active"';
				} else {
					$navbar[$key]['class'] = '';
				}
			}
		} else {
			$navbar = array('Login' => array('controller'=>'auth', 'Path'=>'/auth/logout', 'class' => 'class="active"'));
		}
		return $navbar;
	}
}