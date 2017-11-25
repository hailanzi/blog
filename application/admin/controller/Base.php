<?php
namespace app\admin\controller;
use think\Controller;
class Base extends Controller
{
   public function _initialize(){
   	if(!session('user'))
   	{
   		$this->error('请先登入系统！','admin/login/index');
   	}
   	
   }
}


?>