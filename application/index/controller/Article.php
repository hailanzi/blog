<?php
namespace app\index\controller;
use app\index\controller\Base;
class Article extends Base
{
    public function index()
    {
    	
		$id=input('aid');
		$data=db('article')->find($id);
        $this->assign('data',$data);
        return $this->fetch();
    }
}
