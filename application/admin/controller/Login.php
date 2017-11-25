<?php
namespace app\admin\controller;
use think\Controller;
use app\admin\model\Admin;
class Login extends Controller
{
	
	public function index(){
		$data=input();
		if(request()->isPost())
		{
			$admin=new Admin();
			$loginAdmin=$admin->login($data);
			switch($loginAdmin)
			{
				case 1:
					$this->error('你输入的验证码不正确','admin/login/index');
				break;
				case 2:
					$this->error('用户名不存在,请注册','admin/login/index');
				break;
				case 3:
					$this->success('登入成功','admin/admin/lists');
				break;
				case 4:
					$this->error('用户密码不正确','admin/login/index');
				break;
			}
		}
		
		return	$this->fetch();
	}
	
	
}


?>