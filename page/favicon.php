<?php


class page_favicon extends Page {
	function init(){
		parent::init();
		$this->app->redirect($this->app->url('/'));
	}
}