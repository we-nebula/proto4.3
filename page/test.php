<?php


class page_test extends Page {

	function init(){
		parent::init();

		$selected = ['2','3'];
		$old_associats = ['1','2'];
		$un_selected = array_diff($old_associats,$selected);
		echo "<pre>";
		var_dump($selected,$old_associats,$un_selected);		
	}
	
}