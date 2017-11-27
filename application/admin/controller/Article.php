<?php
namespace app\admin\controller;
use app\admin\controller\Base;
use app\admin\model\Article as ArticleModel;
use app\admin\validate\Article as AdminVal;
class Article extends Base
{
    public function lists()
    {
       
       $article=new ArticleModel();
       $datasArticle=$article->select();
    
       $this->assign('datasArticle',$datasArticle);
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
       	
       	
       	$validate=new AdminVal();
		$result= $validate->scene('add')->check($data);
		if(!$result)	
		{
			$this->error($validate->getError());
			die;
		}
		
		$file=request()->file('pic');
       	if($file)
       	{
       		$info=$file->validate(['size'=>3145728,'ext'=>'jpg,png,gif'])->move(ROOT_PATH . 'public' . DS . 'uploads');
       		if($info)
       		{
       			$data['pic']=$info->getSaveName();	
       			
       		}
       		else
       		{
       			echo $file->getError();
       		}
       	}
       	
     	if(db('article')->insert($data))
       	{
       		$this->success('上传成功','admin/article/lists');
       	}
       	else
       	{
       		$this->error('上传失败');
       	}
       	
       }	
        $datascate=db('cate')->select();
        $this->assign('datascate',$datascate);
       return $this->fetch();
    }
     public function edit()
    {
    	
       return $this->fetch();
    }
}
