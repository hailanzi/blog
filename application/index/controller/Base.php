<?php
namespace app\index\controller;
use think\Controller;
class Base extends Controller
{
	
	public function _initialize(){
		$tagsheader=db('tags')->select();
		$catesheader=db('cate')->select();	
		$this->assign('tagsheader',$tagsheader);
		$this->assign('catesheader',$catesheader);
	} 
	
   
}
?>