<?php


class Model_ProductInventory extends Model_Table {
	public $table= 'product_inventory';

	function init(){
		parent::init();

		$this->hasOne('Vendor','vendor_id');
		$this->hasOne('Product','product_id')->hint('Product will come based on vendor product.');
		$this->addField('qty');
		$this->addField('description')->type('text');
		
		$this->add('dynamic_model/Controller_AutoCreator');

		$this->is([
			'product_id|to_trim|required',
			'qty|required|int'
		]);
	}
}