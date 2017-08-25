<?php
namespace app\index\controller;



class Content extends Common{
	//首页
	public function index(){
		$arc_id=input('param.arc_id');
		//点击数加一
		db('article')->where('arc_id',$arc_id)->setInc('arc_click');
		//文章的数据
		$articleData=db('article')->where('arc_id',$arc_id)->find();
		$articleData['tags']=db('article')->alias('a')->join('blog_arc_tag at','a.arc_id=at.arc_id')->join('blog_tag t','at.tag_id=t.tag_id')->where('a.arc_id',$arc_id)->field('t.tag_name,t.tag_id')->select();
		$headTitle="小高博客-{$articleData['arc_title']}";
		$this->assign('headTitle',$headTitle);
		$this->assign('articleData',$articleData);
		return $this->fetch();
	}
}