<?php 

namespace Application\Controller\Plugin;

use Zend\Mvc\Controller\Plugin\AbstractPlugin;

class CustomPlugin extends AbstractPlugin{
	
	public function doSomthing($a=6,$b=10){
		$c=$a+$b;
		return $c;
	}
}
?>