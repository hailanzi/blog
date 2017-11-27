<?php
namespace app\admin\controller;
use app\admin\controller\Base;
use think\Db;
class Tag extends Base
{
    public function lists()
    {
    	
    $datas=db('tags')->order('id asc')->paginate(3); 
  	$page=$datas->render();
    $this->assign('datas',$datas);
    $this->assign('page',$page);
       return $this->fetch();
    }
	
	public function add()
	{
		
		
		
		if(request()->isPost())
		{
		$data['tagname']=input('tagname');
		
		$validate= new \app\admin\validate\Tag();
		$result=$validate->scene('add')->check($data);
		if(!$result)
		{
			$this->error( $validate->getError());
			die;
			
		}
		if(db('tags')->insert($data))
		{
			$this->success('添加成功','admin/tag/lists');
		}
		else
		{
			$this->error('添加失败','admin/tag/add');
		}
		
		}
		return $this->fetch();
	}
	
	public function edit(){
		$id=input('id');
		
		$data=db('tags')->where(['id'=>$id])->find();
		$this->assign('data',$data);
		if(request()->isPost())
		{
			
			$data['tagname']=input('tagname');
			$data['id']=input('id');
		    $validate= new \app\admin\validate\Tag();
		    $result=$validate->scene('edit')->check($data);		
		
		
		if(!$result)
		{
			$this->error( $validate->getError());
			die;
			
		}
		
		if(db('tags')->update($data))
		{
			$this->success('添加成功','admin/tag/lists');
		}
		else
		{
			$this->error('添加失败','admin/tag/add');
		}
		
		}
		
		
		return $this->fetch();
			
	}
	
		public function del(){
		$id=input('id');
		
		if(db('tags')->delete($id))
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