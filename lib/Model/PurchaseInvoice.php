<?php


class Model_PurchaseInvoice extends Model_QSPMaster {
	public $acl=true;
	public $acl_type = 'PurchaseInvoice';


	public $actions=[
		'Active'=>['view','edit','delete','deactivate','info'],
		'InActive'=>['view','edit','delete','activate'],
	];

	function init(){
		parent::init();
		$this->addCondition('type','PurchaseInvoice');
		$this->getElement('user_id')->system(true);
	}
}