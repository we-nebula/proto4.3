<?php


class page_appusers extends Page {

	function init(){
		parent::init();

		$crud = $this->add('CRUD');
		$crud->setModel('AppUser');

		// $crud->grid->addQuickSearch(['name']);

	}
	
}