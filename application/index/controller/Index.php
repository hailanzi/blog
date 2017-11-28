<?php
namespace app\index\controller;
use app\index\controller\Base;
class Index extends Base
{
    public function index()
    {
    	
		$articles=db('article')->paginate(3);
  		$page=$articles->render();
    	$this->assign('articles',$articles);
    	$this->assign('page',$page);
		$this->assign('articles',$articles);
        return $this->fetch();
    }
}
