<?php


class Model_Vendor extends Model_Table {
	public $table = "vendor";

	public $acl=true;
	public $acl_type = 'Vendor';


	public $status=[
		'Active',
		'InActive',
	];

	public $actions=[
		'Active'=>['view','edit','delete','deactivate','product','Inventory'],
		'InActive'=>['view','edit','delete','activate'],
	];

	function init(){
		parent::init();

		$this->hasOne('Employee','created_by_id')->defaultValue($this->app->auth->model->id)->system(true);
		$this->addField('name');
		$this->addfield('description')->type('text')->display(['form'=>'RichText']);
		$this->addfield('address')->type('text')->display(['form'=>'RichText']);
		$this->addField('type')->enum(['Vendor','Reseller']);
		$this->addField('status')->enum($this->status)->defaultValue('Active');


		$this->add('dynamic_model/Controller_AutoCreator');

		$this->is([
			'name|to_trim|required'
		]);

	}

	function deactivate(){

		$this['status']='InActive';
		$this->save();
	}

	function activate(){
		$this['status']='Active';
		$this->save();
	}

	function page_product($p)
	{
		$m= $this->add('Model_Product');
		$m->addCondition('vendor_id',$this->id);

		$c = $p->add('Grid');
		$c->setModel($m,['sku','name','description']);
	}

	function page_inventory($p)
	{
		$m = $this->add('Model_ProductInventory');
		$m->addCondition('vendor_id',$this->id);

		$c = $p->add('CRUD');
		$c->setModel($m,['product','qty','description']);

		if($c->isEditing()){
			$f = $c->form;
			$f->getElement('product_id')->getModel()->addCondition('vendor_id',$this->id);
		}
	}
}