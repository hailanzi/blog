<?php
namespace app\index\controller;
use app\index\controller\Base;
class Index extends Base
{
    public function index()
    {
    	
		$articles=db('article')->select();
		
		$this->assign('articles',$articles);
        return $this->fetch();
    }
}
