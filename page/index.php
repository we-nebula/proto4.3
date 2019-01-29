<?php


class page_index extends Page {

	function init(){
		parent::init();

		$cols = $this->add('Columns');
		$col1=$cols->addColumn(4);
		$col2=$cols->addColumn(4);
		$col3=$cols->addColumn(4);

		$col2->add('H3')->set('FORM HERE');
		$form= $col2->add('Form');
		$form->addField('name')->validate('required|len|>3');
		$form->addField('age');
		$form->addSubmit('GO');

		if($form->isSubmitted()){
			$form->js()->reload()->univ()->successMessage('Done')->execute();
		}

	}
	
}