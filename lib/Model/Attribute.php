<?php


class Model_Attribute extends Model_Table {
	public $table = "attribute";

	function init(){
		parent::init();

		$this->addField('name');
		$this->addField('possible_units')->hint('Comma separated values')->type('text');
		$this->add('dynamic_model/Controller_AutoCreator');

	}
}