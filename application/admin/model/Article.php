<?php
namespace app\admin\model;
use think\Model;
use think\Db;

class Article extends Model
{
	public function cate()
	{
		return $this->belongsTo('cate','cateid');
	}
}
?>