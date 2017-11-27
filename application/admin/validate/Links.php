<?php
namespace  app\admin\validate;
use think\Validate;
class Links extends Validate
{
	protected $rule=[
		'title'=>'require|max:10',
		'url'=>'require',
		
	];
	
	protected $message  =   [
        'title.require' => '标题必须填写',
        'title.max' => '栏目长度不得大于100位',
        'url.require' => '必须填写',
        

    ];

	
	protected $scene = [
	     'add' => ['title','url'],
	     'edit' => ['title','url'],
	];
}
?>