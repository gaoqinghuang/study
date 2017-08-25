<?php
namespace app\common\model;

use think\Model;
use think\Request;

class Article extends Model{
	protected $pk='arc_id';
	protected $table='blog_article';
	protected $auto = ['admin_id'];//自动完成
    protected $insert = ['sendtime'];  
    protected $update = ['updatetime'];

    protected function setAdminIdAttr($value)
    {
        return session('admin.admin_id');
    }
    protected function setSendtimeAttr($value)
    {
        return time();
    }
    protected function setUpdatetimeAttr($value)
    {
        return time();
    }
    //文章的添加
	public function store($data){
		if(!isset($data['tag'])){
			return ['valid'=>0,'msg'=>'请选择标签'];
		}
		//处理图片
		$file = Request()->file('arc_thumb');
			$info=$file->rule('md5')->move(ROOT_PATH.'public'. DS .'static'. DS .'index'. DS .'images');
			$data['arc_thumb']='__STATIC__/index/images/'.$info->getSaveName();
			//添加到数据库
		$result=$this->validate(true)->allowField(true)->save($data);
		if($result){
			foreach($data['tag'] as $v){
				$arcTagData=[
					'arc_id'=>$this->arc_id,
					'tag_id'=>$v,
				];
				(new ArcTag())->save($arcTagData);
			}
			return ['valid'=>1,'msg'=>'文章添加成功'];
		}else{
			return ['valid'=>0,'msg'=>$this->getError()];
		}
	}
	//获得首页数据
	public function getAll($recycle){
		$data=db('article')
		->alias('a')
		->join('__CATE__ c','a.cate_id = c.cate_id')
		->where('a.is_recycle',$recycle)
		->field('a.arc_id,a.arc_title,a.arc_author,a.sendtime,c.cate_name,a.arc_sort')
		->order('a.arc_sort desc,a.sendtime desc,a.arc_id desc')
		->paginate(6);
		return $data;
	}
	//修改排序
		public function changeSort ( $data )
	{
		$result = $this->save( $data , [ $this->pk => $data[ 'arc_id' ] ] );
	}
	//编辑
	public function edit ( $data ){
		//对图片的操作
		$file = Request()->file('arc_thumb');
		$info=$file->rule('md5')->move(ROOT_PATH.'public'. DS .'static'. DS .'index'. DS .'images');
		$data['arc_thumb']='__STATIC__/index/images/'.$info->getSaveName();
		//数据保存
		$res = $this->validate( true )->allowField( true )->save( $data , [ $this->pk => $data[ 'arc_id' ] ] );
		if ($res) {
			(new ArcTag())->where('arc_id',$data['arc_id'])->delete();
			foreach ( $data[ 'tag' ] as $v ) {
				$arcTagData = [
					'arc_id' => $this->arc_id ,
					'tag_id' => $v ,
				];
				( new ArcTag() )->save( $arcTagData );
			}
			return [ 'valid' => 1 , 'msg' => '操作成功' ];
		}
		else {
			return [ 'valid' => 0 , 'msg' => $this->getError() ];
		}
	}
}