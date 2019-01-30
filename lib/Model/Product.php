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
		'Active'=>['view','edit','delete','deactivate','pricing','variant','image'],
		'InActive'=>['view','edit','delete','activate']
	];

	function init(){
		parent::init();

		$this->hasOne('Employee','created_by_id')->defaultValue($this->app->auth->model->id)->system(true);
		$this->hasOne('Vendor','vendor_id')->hint('Todo Many');

		$this->addField('name');
		$this->addField('sku');
		$this->addField('description')->type('text')->display(['form'=>'RichText']);
		$this->addField('status')->enum($this->status)->defaultValue('Active');
		$this->addField('profit');
		$this->addField('dimensions');

		$this->hasOne('Product','related_product_id')->hint('Todo Many');
		$this->hasMany('ProductPricing','product_id');
		$this->hasMany('ProductInventory','product_id');
		$this->hasMany('ProductImage','product_id');

		$this->add('dynamic_model/Controller_AutoCreator');

		$this->is([
			'name|to_trim|required',
			'sku|to_trim|required',
			'profit|to_trim|int'
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

		if($c->isEditing()){
			$form= $c->form;
			$form->add('Controller_FLC')
			->showLables(true)
			->makePanelsCoppalsible(true)
			->addContentSpot()
			->layout([
					'membertype_id~Member Type'=>'Basic Price~c1~4',
					'mrp'=>'c2~4',
					'sale'=>'c3~4',
					'effective_from'=>'c4~4', // closed to make panel default collapsed
					'effective_to'=>'c5~4',
					'resller_discount'=>'Resller~c1~4',
					'resller_drawable_cashback' => 'c2~4',
					'reseller_non_drawable_cashback' => 'c3~4',
					'network_drawable_cashback' => 'Network~c1~6',
					'network_non_drawable_cashback' => 'c2~6',
				]);
		}
		$c->setModel($m);

	}

	function page_variant($p)
	{
		$m= $this->add('Model_ProductVariant');
		$m->addCondition('product_id',$this->id);

		$c = $p->add('CRUD');
		$c->setModel($m);
	}

	function page_image($p)
	{
		$m= $this->add('Model_ProductImage');
		$m->addCondition('product_id',$this->id);

		$c = $p->add('CRUD');
		$c->setModel($m);
	}
}