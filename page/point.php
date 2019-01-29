<?php


class page_point extends Page {

	function init(){
		parent::init();

		$crud = $this->add('CRUD');
		$crud->setModel('Point');

		// $crud->grid->addQuickSearch(['name']);

	}
	
}