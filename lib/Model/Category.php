<?php


class Model_Category extends Model_Table {
	public $table = "category";

	public $acl=true;
	public $acl_type = 'Category';


	public $status=[
		'Active',
		'InActive'
	];

	public $actions=[
		'Active'=>['view','edit','delete','deactivate','product'],
		'InActive'=>['view','edit','delete','activate']
	];

	function init(){
		parent::init();

		$this->hasOne('Employee','created_by_id')->defaultValue($this->app->auth->model->id)->system(true);
		$this->hasOne('ParentCategory','parent_id');
		
		$this->addField('name');
		$this->addField('description')->type('text')->display(['form'=>'RichText']);
		$this->addField('status')->enum($this->status)->defaultValue('Active');

		$this->hasMany('Category','parent_id',null,'SubCategories');

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
		//$this->add('text')->set('Display all products. Here we can add/update products.');
		$m= $this->add('Model_ProductCategoryAssociate');
		$m->addCondition('category_id',$this->id);

		$grid = $p->add('Grid');
		$grid->setModel('Product',['name']);

		$grid->addPaginator(100);

		// $c = $p->add('CRUD');
		// $c->setModel($m);
	}

}