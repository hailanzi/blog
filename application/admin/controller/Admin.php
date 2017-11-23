<?php
namespace app\admin\controller;
use think\Controller;
class Admin extends Controller
{
    public function lists()
    {
    	
       return $this->fetch();
    }
	public function add()
	{
		return $this->fetch();
	}
	public function edit()
	{
		return $this->fetch();
	}
	
}




?>