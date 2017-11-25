<?php
namespace  app\admin\validate;
use think\Validate;
class Cate extends Validate
{
	protected $rule=[
		'catename'=>'require|max:10|unique:cate',
		'cateeditname'=>'require|max:10|unique:cate',
		
	];
	
	protected $message  =   [
        'catename.require' => '栏目必须填写',
        'catename.max' => '栏目长度不得大于10位',
        'catename.unique' => '栏目不能重复',
        'cateeditname.require' => '栏目必须填写2',
        'cateeditname.max' => '栏目长度不得大于10位',
        'cateeditname.unique' => '栏目不能重复',
      

    ];

	
	protected $scene = [
	     'add' => ['catename'],
	     'edit' => ['catename'=>'require|max:10|unique:cate'],
	];
}
?>