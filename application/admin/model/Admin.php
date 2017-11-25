<?php
namespace app\admin\model;
use think\Model;
use think\Db;

class Admin extends Model
{
	function login($data)
	{
		$captcha=new \think\captcha\Captcha();
		if(!$captcha->check($data['code']))
		{
			//输入的验证码不正确
			return 1;
		}
		$user=Db::name('admin')->where(['username'=>$data['username']])->find();
		if($user)
		{
			$spass=Db::name('admin')->where(['password'=>md5($data['password'])])->find();	
			if($spass)
			{
				session('user',$user['username']);
				session('uid',$user['id']);
				//验证成功
				return 3;
			}
			else
			{
				//数码的密码有误
				return 4;
			}
		}
		else
		{
			// 用户名不存在
			return 2; 
		}
	}
 		
}
?>