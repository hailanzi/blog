<?php
namespace  app\admin\validate;
use think\Validate;
class Tag extends Validate
{
	protected $rule=[
		'tagname'=>'require|max:10',
		
		
	];
	
	protected $message  =   [
        'tagname.require' => '标签必须填写',
        'tagname.max' => '栏目长度不得大于10位',
      
        
      

    ];

	
	protected $scene = [
	     'add' => ['tagname'],
	     'edit' => ['tagname'],
	];
}
?>