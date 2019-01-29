<?php


class Model_Attribute_SETAttribute extends Model_Table {
	public $table = "attribute_set_attribute";

	function init(){
		parent::init();

		$this->hasOne('AttributeSET','attribute_set_id');
		$this->hasOne('Attribute','attribute_id');
		$this->addField('values');

		$this->add('dynamic_model/Controller_AutoCreator');
	}
}