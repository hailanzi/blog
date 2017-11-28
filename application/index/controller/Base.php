<?php
namespace app\index\controller;
use think\Controller;
class Base extends Controller
{
	
	public function _initialize(){
		$this->right();
		$tagsheader=db('tags')->select();
		$catesheader=db('cate')->select();	
		$this->assign('tagsheader',$tagsheader);
		$this->assign('catesheader',$catesheader);
		
	} 
	
	public function right()
	{
		$datasclick=db('article')->order('click desc')->limit(8)->select();
		$datasstatus=db('article')->where('state','=',1)->order('click desc')->limit(8)->select();
		$this->assign('datasclick',$datasclick);
		$this->assign('datasstatus',$datasstatus);
	}
	
   
}
?>