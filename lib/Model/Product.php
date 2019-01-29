<?php


class Model_Product extends Model_Table {
	public $table = "product";

	public $acl=true;
	public $acl_type = 'Category';


	public $status=[
		'Active',
		'InActive',
	];

	public $actions=[
		'Active'=>['view','edit','delete','deactivate','pricing','variant'],
		'InActive'=>['view','edit','delete','activate']
	];

	function init(){
		parent::init();

		$this->hasOne('Employee','created_by_id')->defaultValue($this->app->auth->model->id)->system(true);
		$this->hasOne('Vendor','vendor_id')->hint('Todo Many');

		$this->addField('name');
		$this->addField('description')->type('text')->display(['form'=>'RichText']);
		$this->addField('status')->enum($this->status)->defaultValue('Active');
		$this->addField('dimensions');

		$this->hasOne('Product','related_product_id')->hint('Todo Many');
		$this->hasMany('ProductPricing','product_id');

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

	function page_pricing($p){
		$m= $this->add('Model_ProductPricing');
		$m->addCondition('product_id',$this->id);

		$c = $p->add('CRUD');
		$c->setModel($m);
	}

	function page_variant($v)
	{
		$m= $this->add('Model_ProductVariant');
		$m->addCondition('product_id',$this->id);

		$c = $v->add('CRUD');
		$c->setModel($m);
	}
}