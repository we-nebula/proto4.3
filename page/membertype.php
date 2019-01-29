<?php


class page_membertype extends Page {

	function init(){
		parent::init();

		$crud = $this->add('CRUD');
		$crud->setModel('MemberType');

		// $crud->grid->addQuickSearch(['name']);

	}
	
}