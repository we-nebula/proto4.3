<?php


class Model_ProductVariantPricing extends Model_Table {
	public $table= 'product_variant_pricing';

	function init(){
		parent::init();

		$this->hasOne('ProductVariant','variant_id');
		$this->hasOne('MemberType','membertype_id')->hint('Can add multiple group price');
		$this->addField('mrp');
		$this->addField('sale');
		$this->addField('specialdatefrom')->type('date');
		$this->addField('specialdateto')->type('date');

		$this->add('dynamic_model/Controller_AutoCreator');

		$this->is([
			'mrp|to_trim|required|int',
			'sale|int'
		]);
	} 
}