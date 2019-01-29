<?php


class page_post extends Page {

	function init(){
		parent::init();

		$crud = $this->add('CRUD');
		$crud->setModel('Post');

		// $crud->grid->addQuickSearch(['name']);

	}
	
}