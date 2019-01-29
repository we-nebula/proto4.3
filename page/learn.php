<?php


class page_learn extends Page {

	function init(){
		parent::init();

		$crud = $this->add('CRUD');
		$crud->setModel('Learn');

		$crud->grid->addQuickSearch( [ 'name' ,'monile_no' ] );
		$crud->grid->addPaginator(20);

		// $crud->grid->addQuickSearch(['name']);

		$this->add('Text')->set('World! ');
		$o2 = $this->add('Text')->set('Hello, ');

		$this->add('Order')->move($o2, 'first')->now();

	}
	
}