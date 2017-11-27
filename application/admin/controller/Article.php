<?php
namespace app\admin\controller;
use app\admin\controller\Base;
use app\admin\model\Article as ArticleModel;
use app\admin\validate\Article as AdminVal;
class Article extends Base
{
	public  $imgsrc=array();
    public function lists()
    {
       
    $article=new ArticleModel();
    $datasArticle=$article->order('id asc')->paginate(3);  
  	$page=$datasArticle->render();
    $this->assign('datasArticle',$datasArticle);
    $this->assign('page',$page); 
    return $this->fetch();
    }
      public function add()
    {
    	
       if(request()->isPost())
       {
       	$data=[
	       	'title' => input('title'),
	       	'keywords' => input('keywords'),
	       	'desc' => input('desc'),
	       	'author' => input('author'),
	       	'cateid' => input('cateid'),
	       	
	       	'content' => input('content'),
	       	'time' => time()
       	
       	];
       
       	if(input('state') == 'on')
       	{
       		$data['state']=1;
       	}
       	else
       	{
       		$data['state']=0;
       	}
     
       	$validate=new AdminVal();
		$result= $validate->scene('add')->check($data);
		if(!$result)	
		{
			$this->error($validate->getError());
			die;
		}
		
		if(!$_FILES['pic']['error'])
		
		{
			
			
		$file=request()->file('pic');
       	if($file)
       	{
       		$info=$file->validate(['size'=>3145728,'ext'=>'jpg,png,gif'])->move(ROOT_PATH . 'public' . DS . 'uploads');
       		if($info)
       		{
       			
       			
       		$data['pic']= str_replace('\\','/',$info->getSaveName());	
       			
       		}
       		else
       		{
       			echo $file->getError();
       		}
       	}
			
		}
		
		else
		{
			$data['pic']='';
			
		}
		
       	
       	
     	if(db('article')->insert($data))
       	{
       		$this->success('编辑成功','admin/article/lists');
       	}
       	else
       	{
       		$this->error('编辑成功');
       	}
       	
       }	
        $datascate=db('cate')->select();
        $this->assign('datascate',$datascate);
       return $this->fetch();
    }
     public function edit()
    {
       $id=input('id');
       $article=new ArticleModel();
       $data=$article->find($id);
       
      	if(request()->isPost())
      	{
      		$dataedit=[
	       	'title' => input('title'),
	       	'keywords' => input('keywords'),
	       	'desc' => input('desc'),
	       	'author' => input('author'),
	       	'cateid' => input('cateid'), 	
	       	'content' => input('content'),
	       	'time' => time()
       	
       	];
       
       	if(input('state') == 'on')
       	{
       		$dataedit['state']=1;
       	}
       	else
       	{
       		$dataedit['state']=0;
       	}
      		$validate=new AdminVal();
			$result= $validate->scene('edit')->check($dataedit);
		if(!$result)	
		{
			$this->error($validate->getError());
			die;
		}
				
		if(!$_FILES['pic']['error'])
			{
			$file=request()->file('pic');
			if($file)
	       	{
	       		$info=$file->validate(['size'=>3145728,'ext'=>'jpg,png,gif'])->move(ROOT_PATH . 'public' . DS . 'uploads');
	       		if($info)
	       		{
	       			
	       			
	       		$dataedit['pic']= str_replace('\\','/',$info->getSaveName());	
	       			
	       		}
	       		else
	       		{
	       			echo $file->getError();
	       		}
	       	}	
      	}
	       	else
	       	{
	        $dataedit['pic']=$data['pic'];
	       	}
       		
       	if(db('article')->insert($dataedit))
       	{
       		$this->success('编辑成功','admin/article/lists');
       	}
       	else
       	{
       		$this->error('编辑成功');
       	}
      	}
      	
       $this->assign('data',$data);
       $rows=db('cate')->select();
       $this->assign('rows',$rows);
       return $this->fetch();
    }
    
    public function del(){
    	$id=input('id');
    	
			if( db('article')->delete($id))
			{
				$this->success('删除成功','lists');
			}		
		else
		{
			$this->error('删除失败');
		}		
    }
    
}
