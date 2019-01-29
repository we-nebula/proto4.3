<?php


class page_department extends Page {

	function init(){
		parent::init();

		$crud = $this->add('CRUD');
		$crud->setModel('Department');

		// $crud->grid->addQuickSearch(['name']);

	}
	
}