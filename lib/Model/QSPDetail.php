<?php


class Model_QSPDetail extends Model_Table {
	public $table = "qsp_detail";

	function init(){
		parent::init();

		$this->hasOne('QSPMaster','qsp_master_id');
		$this->hasOne('Product','product_id')->display(['form'=>'autocomplete/Basic']);
		$this->addField('qty');
		$this->addField('price');
		$this->addExpression('amount')->set('qty*price');

		$this->add('dynamic_model/Controller_AutoCreator');

		$this->is([
			// 'name|to_trim|required'
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

	function page_info($p)
	{
		/*$m= $this->add('Model_Wallet');
		$m->addCondition('user_id',$this->id);

		$c = $p->add('CRUD');
		$c->setModel($m);*/
	}
}