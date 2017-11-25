<?php
namespace app\admin\controller;
use app\admin\controller\Base;
class Article extends Base
{
    public function lists()
    {
    	
       return $this->fetch();
    }
}
