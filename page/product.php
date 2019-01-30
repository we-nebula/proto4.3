<?php


class page_product extends Page {

	function init(){
		parent::init();

		$crud = $this->add('CRUD');
		$crud->setModel('Product');
		
		// $crud->grid->addQuickSearch(['name']);

	}
	
}