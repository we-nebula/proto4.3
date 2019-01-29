<?php


class Model_MemberType extends Model_Table {
	public $table = "member_type";

	function init(){
		parent::init();

		$this->addField('name');

		$this->hasMany('AppUser','membertype_id');
		$this->hasMany('ProductPricing','membertype_id');

		$this->add('dynamic_model/Controller_AutoCreator');

	}
}