<?php
namespace app\admin\controller;
use think\Controller;
use app\admin\model\Admin as AdminModel;
use app\admin\validate\Admin as AdminVal;
class Admin extends Controller
{
	
    public function lists()
    {	
    		
  	$admin= new AdminModel();
  	$datas=$admin->select();
    $this->assign('datas',$datas);
    return $this->fetch();
    }
	public function add()
	{
		if(request()->isPost())
		{
			$data['username']=$_POST['username'];
			$data['password']=$_POST['password'];	
			$validate=new AdminVal();
			$result= $validate->scene('add')->check($data);
			if(!$result)	
			{
				$this->error($validate->getError());
				die;
			}	
			$admin= new AdminModel();
			$admin->save($data);
			
			
		}
		
		return $this->fetch();
	}
	
	
	public function edit()
	{
		return $this->fetch();
	}
	
}




?>