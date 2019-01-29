<?php


class Model_ProductPricing extends Model_Table {
	public $table= 'product_pricing';

	function init(){
		parent::init();

		$this->hasOne('Product','product_id');
		$this->hasOne('MemberType','membertype_id');
		$this->addField('mrp');

		$this->add('dynamic_model/Controller_AutoCreator');
	}
}