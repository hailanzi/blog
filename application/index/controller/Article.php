<?php
namespace app\index\controller;
use app\index\controller\Base;
class Article extends Base
{
    public function index()
    {
    	
		$id=input('aid');
		$data=db('article')->find($id);
		db('article')->where(['id'=>$id])->setInc('click');
		$ralateres=$this->arlike($data['keywords']);
		$catesid=db('article')->where(['cateid'=>$data['cateid']])->select();
		
		$this->assign('catesid',$catesid);
        $this->assign('data',$data);
        $this->assign('ralateres',$ralateres);
        return $this->fetch();
    }
    
    public function arlike($keywords)
    {
    	$arrs=explode('，',$keywords);
    	$arrlike=array();
    	
    	foreach($arrs as $key=>$val)
    	{
    		$map['keywords']=['like','%'.$val.'%'];
   		   $artkeywords=db('article')->where($map)->select();
   		   $arrlike=array_merge($arrlike,$artkeywords);
    	}
    	
        return $arrlike;
              	
    }

	
	


}
