<?php
namespace app\admin\controller;
use app\admin\controller\Base;
class Links extends Base
{
    public function lists()
    {
      $datas=db('links')->order('id asc')->paginate(3); 
      $page=$datas->render();
      $this->assign('datas',$datas);
      $this->assign('page',$page);
       return $this->fetch();
    }
    public function add(){
    	
    	if(request()->isPost())
    	{
    		$datas=[
    		'title' => input('title'),
    		'url' => input('url'),
    		'desc' => input('desc'),
    		];
    		$validate=new \app\admin\validate\Links();
    		$result=$validate->scene('add')->check($datas);
    		if(!$result)
			{
				$this->error( $validate->getError());
				die;	
			}
			if(db('links')->insert($datas))
			{
				$this->success('添加成功','admin/links/lists');
			}
			else
			{
				$this->error('添加失败','admin/links/add');
			}
    		
    	}
    	 return $this->fetch();
    }
    
    public function edit(){
    	
    	$id=input('id');
    	
    	if(request()->isPost())
    	{
    		
    		$datas=[
    		'id' =>input('id'),
    		'title' => input('title'),
    		'url' => input('url'),
    		'desc' => input('desc'),
    		];
    		$validate=new \app\admin\validate\Links();
    		$result=$validate->scene('edit')->check($datas);
    		if(!$result)
			{
				$this->error( $validate->getError());
				die;	
			}
			if(db('links')->update($datas))
			{
				$this->success('添加成功','admin/links/lists');
			}
			else
			{
				$this->error('添加失败','admin/links/add');
			}	
    	}
    	$data=db('links')->find($id);
    	$this->assign('data',$data);
    	return $this->fetch();
    }
    
    public function del(){
		$id=input('id');
		if(db('links')->delete($id))
		{
			$this->success('删除成功','lists');
			
		}
		else
		{
			$this->error('删除失败');
		}
	}
}
