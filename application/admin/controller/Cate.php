<?php
namespace app\admin\controller;
use app\admin\controller\Base;
use think\Db;
class Cate extends Base
{
    public function lists()
    {
    	
    $datas=db('cate')->order('id asc')->paginate(3); 
  	$page=$datas->render();
    $this->assign('datas',$datas);
    $this->assign('page',$page);
       return $this->fetch();
    }
	
	public function add()
	{
		$data['catename']=input('catename');
		if(request()->isPost())
		{
		$validate= new \app\admin\validate\Cate();
		$result=$validate->scene('add')->check($data);
		if(!$result)
		{
			$this->error( $validate->getError());
			die;
			
		}
		if(db('cate')->insert($data))
		{
			$this->success('添加成功','admin/cate/lists');
		}
		else
		{
			$this->error('添加失败','admin/cate/add');
		}
		
		}
		return $this->fetch();
	}
	
	public function edit(){
		$id=input('id');
		
		$data=db('cate')->where(['id'=>$id])->find();
		$this->assign('data',$data);
		if(request()->isPost())
		{
			$editdata['id']=$id;
			$editdata['catename']=input('cateeditname');
			if($editdata['catename'] != $data['catename'])
			{
			$validate= new \app\admin\validate\Cate();
			$result=$validate->scene('edit')->check($editdata);
			if(!$result)
			{
				$this->error( $validate->getError());
				die;
				
			}
			
			if(db('cate')->update($editdata))
				{
					$this->success('添加成功','admin/cate/lists');
				}
				else
				{
					$this->error('添加失败','admin/cate/lists');
				}
		
			}
			
			else
			{
				$this->success('修改成功1','admin/cate/lists');
			}
				
		}
		return $this->fetch();
			
	}
	
		public function del(){
		$id=input('id');
		if(db('cate')->delete($id))
		{
			$this->success('删除成功','lists');
			
		}
		else
		{
			$this->error('删除失败');
		}
	}
		
		
	
}


?>