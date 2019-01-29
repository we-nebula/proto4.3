<?php


class Model_AttributeSET extends Model_Table {
	public $table = "attribute_set";

	function init(){
		parent::init();

		$this->addField('name');

		$this->hasMany('Attribute_SETAttribute','attribute_set_id',null,'SETAttributes');

		$this->add('dynamic_model/Controller_AutoCreator');
	}
}