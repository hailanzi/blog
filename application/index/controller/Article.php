<?php
namespace app\index\controller;
use app\index\controller\Base;
class Article extends Base
{
    public function index()
    {
    	
		input('aid');
		
        return $this->fetch();
    }
}
