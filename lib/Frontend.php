<?php
class Frontend extends ApiFrontend {
    
    public $title = "We :: Commission System";

    function init() {
        parent::init();

        $app_paths = array('vendor','shared/addons2','shared/addons');

         $this->api->pathfinder
            ->addLocation(array(
                'addons' => $app_paths,
                'css' => ['templates'],
            ))
            ->setBasePath($this->pathfinder->base_location->getPath());
        
        $this->add('jUI');
        $this->dbConnect();
        // $this->add('Layout_Cube',null,'Layout');
       
        $auth=$this->add('BasicAuth');
        $auth->setModel('Employee','username','password');
        $auth->check();
        $this->app->employee = $auth->model;

        //$this->app->top_menu = $this->app->layout->add('Menu_TopBar',null,'Main_Menu');
        // $this->app->side_menu = $this->app->layout->add('Menu_SideBar',null,'Side_Menu');
      

        // $sys_menu = $this->app->top_menu->addMenu('System');
        // $cat_menu = $this->app->top_menu->addMenu('Catelogue');
        // $cat_menu->addItem(['Categories','icon'=>'fa fa-users'],$this->app->url('category'));

        //$e = $this->add('TopMenu',null,'Top_Menu');
        //$e->addItem('Test','test');


        $m = $this->add('Menu_Horizontal',null,'Menu');
        $m->addItem('Dashboard','index');

        $t = $m->addMenu('Catelogue');
        $t->addItem('Category','category');
        $t->addItem('Product','product');

        $t = $m->addMenu('Vendor');
        $t->addItem('Vendor','vendor');

        //$t = $m->addMenu('Users');
        //$t->addItem(['Users','icon'=>'fa fa-users'],'appusers');
        //$t->addItem('Wallet','wallet');

        $m->addItem(['Users'],'appusers');

        $t = $m->addMenu(['Commerce']);
        $t->addItem('PurchaseInvoice','purchaseinvoice');

        //$t = $m->addMenu('Micro Influencers');
        //$t->addItem('Micro Influencers','micro_influencers');

        $t = $m->addMenu('Content');
        $t->addItem('Page content','pagecontent');
        $t->addItem('Banner','banner');
        
        $t = $m->addMenu('System');
        $t->addItem('Department','department');
        $t->addItem('Post','post');
        $t->addItem('Employee','employee');
        $s = $t->addMenu('Settings');
        $s->addItem('Member Type','membertype');
        $s->addItem('Coupon','coupon');
        $s->addItem('Discount','discount');
        $s->addItem('Points','point');
        $s->addItem('City','city');
        
        $t = $m->addMenu('Reports');
        $t->addItem('Order','order');
        //$t->addItem('Track Order','track_order');

        /*$t = $m->addMenu('Plan');
        $t->addItem('a','B');
        $t = $m->addMenu('Commissions');
        $t->addItem('a','B');

        $t = $m->addItem('Learn','learn');*/

        $m->addMenuItem('logout','Logout');
        // $this->addLayout('UserMenu');

        $this->addStylesheet('we');

    }
}
