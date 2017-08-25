<?php
namespace app\index\controller;

use app\common\model\Category;

class Lists extends Common{
	//标签或者栏目下的文章
	public function index(){
		$headTitle="小高博客-首页";
		$this->assign('headTitle',$headTitle);
		$tag_id=input('param.tag_id');
		$cate_id=input('param.cate_id');
		//标签
		if($tag_id){
			$headData=[
				'title'=>'标签',
				'name'=>db('tag')->where('tag_id',$tag_id)->value('tag_name'),
				'total'=>db('arc_tag')->alias('at')->join('blog_article a','at.arc_id=a.arc_id')->where('a.is_recycle',2)->where('tag_id',$tag_id)->count(),
			];
			$articleData=db('article')->alias('a')->join('blog_cate b','a.cate_id=b.cate_id')->join('blog_arc_tag at','at.arc_id=a.arc_id')->where('a.is_recycle',2)->where('at.tag_id',$tag_id)->select();
		}
		//文章
		if($cate_id){
			$cids = (new Category())->getSon(db('cate')->select(),$cate_id);
			$cids[] = $cate_id;
			$headData=[
				'title'=>'类别',
				'name'=>db('cate')->where('cate_id',$cate_id)->value('cate_name'),
				'total'=>db('article')->whereIn('cate_id',$cids)->where('is_recycle',2)->count(),
			];
			$articleData = db('article')->alias('a')
				->join('__CATE__ c','a.cate_id=c.cate_id')->where('a.is_recycle',2)->whereIn('a.cate_id',$cids)->select();
		}
		foreach($articleData as $k=>$v){
				$articleData[$k]['tags']=db('arc_tag')->alias('at')
					->join('blog_tag t','at.tag_id=t.tag_id')
					->where('at.arc_id',$v['arc_id'])->field('t.tag_id,t.tag_name')->select();
			}
			$headTitle="小高博客-{$headData['name']}";
			$this->assign('headTitle',$headTitle);
			$this->assign('articleData',$articleData);
			$this->assign('headData',$headData);
		return $this->fetch();
	}

}