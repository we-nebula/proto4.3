<?php


class Model_ProductPricing extends Model_Table {
	public $table= 'product_pricing';

	function init(){
		parent::init();

		$this->hasOne('Product','product_id');
		$this->hasOne('MemberType','membertype_id')->hint('Can add multiple group price');
		$this->addField('mrp');
		$this->addField('sale');
		$this->addField('effective_from')->type('date');
		$this->addField('effective_to')->type('date');

		$this->addField('resller_discount');
		$this->addField('resller_drawable_cashback');
		$this->addField('reseller_non_drawable_cashback');

		$this->addField('network_drawable_cashback');
		$this->addField('network_non_drawable_cashback');

		$this->addField('p1');
		$this->addField('p2');
		$this->addField('p3');
		$this->addField('p4');

		$this->addField('discovery_fund');
		$this->addField('floating_days')->hint('Return policy days');

		$this->add('dynamic_model/Controller_AutoCreator');

		$this->is([
			'mrp|to_trim|required|int',
			'sale|int',
			'resller_discount|int',
			'resller_drawable_cashback|int',
			'reseller_non_drawable_cashback|int',
			'network_drawable_cashback|int',
			'network_non_drawable_cashback|int',
			'discovery_fund|int',
			'floating_days|int',
		]);
	}
}