<?php
namespace app\admin\controller;
use app\admin\controller\Base;
use app\admin\model\Admin as AdminModel;
use app\admin\validate\Admin as AdminVal;
class Admin extends Base
{
	
    public function lists()
    {	
    		
  	$admin= new AdminModel();
  	$datas=$admin-> order('id asc')->paginate(3);
  	$page=$datas->render();
    $this->assign('datas',$datas);
    $this->assign('page',$page);
    return $this->fetch();
    }
	public function add()
	{
		if(request()->isPost())
		{
			$data['username']=$_POST['username'];
			$data['password']=md5($_POST['password']);	
			$validate=new AdminVal();
			$result= $validate->scene('add')->check($data);
			if(!$result)	
			{
				$this->error($validate->getError());
				die;
			}	
			$admin= new AdminModel();
			if($admin->save($data))
			{
				$this->success('添加成功','lists');
			}
			else
			{
				$this->error('添加失败');
			}
			
			
		}
		
		return $this->fetch();
	}
	
	
	public function edit()
	{
		
		    $id=input('id');
		    
		    $data=db('admin')->where(['id'=>$id])->find();
		    $this->assign('data',$data);
		    
		   if(request()->isPost())
		   {
		   	
		   	$editData['username']= input('username');
		   	$editData['id']= input('id');
		   	if(input('password'))
		   	{
		   		$editData['password']= md5(input('password'));
		   	}
		   	else
		   	{
		   		$editData['password']= $data['password'];
		   	}
		    
		    $validate=new AdminVal();
			$result= $validate->scene('edit')->check($editData);
			if(!$result)	
			{
				$this->error($validate->getError());
				die;
			}	
			
			if( $data['username'] == input('username') && $data['password'] == $editData['password'])
			{
		
			$this->success('更新成功','lists');
			}
			else
			{
				if(db('admin')->update($editData)) 
			   {
					$this->success('更新成功','lists');
				}
				else
				{
					
					//$this->error('添加失败');
					
				}
			}
			
		   	
		   }
		    
		    
     		return $this->fetch();
	}
	
	public function del(){
		$id=input('id');
		if(db('admin')->delete($id))
		{
			$this->success('删除成功','lists');
			
		}
		else
		{
			$this->error('删除失败');
		}
	}
	
	public function logout(){
		session(null);
		$this->success('退出成功','admin/login/index');
		
		
		
	}
	
}




?>