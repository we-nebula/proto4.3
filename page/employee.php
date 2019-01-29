<?php


class page_employee extends Page {

	function init(){
		parent::init();

		$crud = $this->add('CRUD');
		$crud->setModel('Employee');

		// $crud->grid->addQuickSearch(['name']);

	}
	
}