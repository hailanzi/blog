<?php
namespace app\index\controller;
use app\index\controller\Base;
class Cate extends Base
{
    public function index()
    {
    	$id=input('cid');
    	
		$articles=db('article')->where(['cateid'=>$id])->paginate(3);
	
			$page=$articles->render();
	    	$this->assign('articles',$articles);
	    	$this->assign('page',$page);
		
  		
        return $this->fetch();
    }
}
