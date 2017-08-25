<?php
namespace app\index\controller;

use think\Controller;
use think\Request;

class Common extends Controller{

	public function __construct(Request $request=null){
		parent::__construct($request);
		//读取网站配置
		$webset=$this->loadWebSet();
		$this->assign('_webset',$webset);
		//读取顶级栏目数据
		$cateData=$this->loadCateData();
		$this->assign('_cateData',$cateData);
		//读取所有栏目数据
		$allCateData = $this->localAllCateData();
		$this->assign('_allCateData',$allCateData);
		//读取标签数据
		$tagData=$this->loadTagData();
		$this->assign('_tagData',$tagData);
		//读取文章数据
		$articleData=$this->loadArticleData();
		$this->assign('_articleData',$articleData);
		//读取链接数据
		$linkData=$this->loadLinkData();
		$this->assign('_linkData',$linkData);
	}
	//读取网站配置
	private function loadWebSet(){
		return db('webset')->column('webset_value','webset_name');
	}
	//读取顶级栏目数据
	private function loadCateData(){
		return db('cate')->where('cate_pid',0)->select();
	}
	//读取所有栏目数据
	private function localAllCateData(){
		return db('cate')->select();
	}
	//读取标签数据
	private function loadTagData(){
		return db('tag')->select();
	}
	//读取文章数据
	private function loadArticleData(){
		return db('article')->order('sendtime desc')->where('is_recycle',2)->limit(2)->field('arc_id,arc_title,sendtime')->select();
	}
	//读取链接数据
	private function loadLinkData(){
		return db('link')->select();
	}
}