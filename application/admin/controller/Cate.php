<?php
namespace app\admin\controller;
use think\Controller;
class Cate extends Controller
{
    public function lists()
    {
    	
       return $this->fetch();
    }
	
	public function add()
	{
		return $this->fetch();
	}
}


?>