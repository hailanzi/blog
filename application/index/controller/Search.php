<?php
namespace app\index\controller;
use app\index\controller\Base;
class Search extends Base
{
    public function index()
    {
    	
    	if(request()->isGet())
    	{
    		$id=input('keywords');
    		$keywords=db('tags')->find($id);
    		$map['keywords']=['like','%'.$keywords['tagname'].'%'];
    		$searchres=db('article')->where($map)->select();
    		
    		if($searchres)
    		{
    			$this->assign(array(
                'searchres'=>$searchres,
                'keywords'=>$keywords['tagname']
                
                ));
    		}
    		 
                
            else
	    	{
	    		$this->assign(array(
	            'searchres'=>null,
	            'keywords'=>'暂无数据'
	             ));
	    	}    
    	}
    	
    	
    	return $this->fetch();
    	
    }
}
