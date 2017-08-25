<?php
namespace app\index\controller;


class Index extends Common{
	//主页
	public function index(){
		$headTitle="小高博客-首页";
		//文章数据
		$this->assign('headTitle',$headTitle);
		$articleData=db('article')->alias('a')->join('blog_cate b','a.cate_id=b.cate_id')->where('a.is_recycle',2)->paginate(2);
		//文章标签
		
		foreach($articleData as $k=>$v){
			$article[$k]['tags']=db('arc_tag')->alias('at')
				->join('blog_tag t','at.tag_id=t.tag_id')
				->where('at.arc_id',$v['arc_id'])->field('t.tag_id,t.tag_name')->select();
		}

		
		$this->assign('article',$article);
		$this->assign('articleData',$articleData);
		return $this->fetch();
	}
}