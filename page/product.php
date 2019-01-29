<?php


class page_product extends Page {

	function init(){
		parent::init();

		$crud = $this->add('CRUD');
		$crud->setModel('Product');

		if($p= $crud->addFrame('HAHAH')){
			
		}
		// $crud->grid->addQuickSearch(['name']);

	}
	
}