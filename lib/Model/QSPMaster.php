<?php


class Model_QSPMaster extends Model_Table {
	public $table = "qsp_master";
	public $acl=true;

	public $status=[
		'Active',
		'InActive',
	];

	function init(){
		parent::init();

		$this->hasOne('Employee','created_by_id')->defaultValue($this->app->auth->model->id)->system(true);
		$this->hasOne('Appuser','user_id');
		$this->hasOne('Vendor','vendor_id')->display(['form'=>'autocomplete/Basic']);
		$this->addField('invoice_no');
		$this->addField('order_date');
		$this->addField('paid_amount');
		$this->addField('type')->enum(['PurchaseOrder','PurchaseInvoice','SalesOrder','SalesInvoice','Quotation']);
		$this->addField('status')->enum($this->status)->defaultValue('Active');

		$this->hasMany('QSPDetail','qsp_master_id');

		$this->addExpression('total_amount')->set($this->refSQL('QSPDetail')->sum('amount'));
		//$this->addExpression('final_amount')->set($this->sum('total_amount'));

		$this->add('dynamic_model/Controller_AutoCreator');

		$this->is([
			// 'name|to_trim|required'
		]);


	}

	function newInvoiceNumber(){
		return 
		$this->newInstance()->_dsql()->del('fields')->field('MAX(invoice_no)')->getOne() + 1;
	}

	function deactivate(){

		$this['status']='InActive';
		$this->save();
	}

	function activate(){
		$this['status']='Active';
		$this->save();
	}

	function page_info($p)
	{
		/*$m= $this->add('Model_Wallet');
		$m->addCondition('user_id',$this->id);

		$c = $p->add('CRUD');
		$c->setModel($m);*/
	}
}