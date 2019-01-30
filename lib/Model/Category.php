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

		$p->add('Controller_ManySelect',[
			'first_model'=> $this,
			'second_model'=>$this->add('Model_Product'),
			'association_model' => $this->add('Model_ProductCategoryAssociate'),
			'first_field_in_association'=>"category_id",
			'second_field_in_association'=>"product_id",
			'grid_fields'=>['name','sku'],
			'delete_old'=>true
		]);


		// $m= $this->add('Model_ProductCategoryAssociate');
		// $m->addCondition('category_id',$this->id);

		// $old_products = array_column($m->getRows(),'product_id');

		// $form = $p->add('Form');
		// $prod_field = $form->addField('Text','selected_products');
		// $prod_field->set(json_encode($old_products));
		// $form->addSubmit('Update');

		// $grid = $p->add('Grid');
		// $grid->setModel('Product',['name','sku']);

		// $grid->addSelectable($prod_field);

		// $grid->addPaginator(100);

		// if($form->isSubmitted()){

		// 	$selected_products = json_decode($form['selected_products'],true);
		// 	// remove differences of old_products and selected products

		// 	$un_selected = array_merge([0],array_diff($selected_products, $old_products));

		// 	$m= $this->add('Model_ProductCategoryAssociate');
		// 	$m->addCondition('category_id',$this->id);
		// 	$m->addCondition('product_id',$un_selected);
		// 	$m->deleteAll();
			

		// 	foreach ($selected_products as $sp) {
		// 		$m= $this->add('Model_ProductCategoryAssociate');
		// 		$m->addCondition('category_id',$this->id);
		// 		$m->addCondition('product_id',$sp);
		// 		$m->tryLoadAny();
		// 		if(!$m->loaded()) $m->save();

		// 	}
			
		// }

		// $c = $p->add('CRUD');
		// $c->setModel($m);
	}

}