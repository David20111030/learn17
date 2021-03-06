<?php
namespace frontend\controllers;
use yii\web\Controller;

/**
 * 使用文件缓存时注意事项
 * 多节点环境下使用 flush() 时只删除当前节点下的数据  使用脚本(exec('/opt/php-5.6.8/bin/php /file-path param >> /log-file'))删除或者使用其它缓存技术 
*/
// 缓存相关
class CacheController extends Controller{
	// 数据缓存之添加删除等
	public function actionData(){
		// 获取缓存组件
		$cache = \YII::$app->cache;
		// 写
		$cache->add('key1', 'welcome to yii world');
		$cache->add('key1', 'welcome to yii worle too'); // 如果二个相同的key 只取第一个
		// 修改
		$cache->set('key1', 'welcome to yii');
		// 删除
		$cache->delete('key1');
		// 清空
		$cache->flush();
		// 读
		var_dump($cache->get('key1'));	
	}
	// 数据缓存之有效期
	public function actionValidity(){
		// 获取缓存组件
		$cache = \YII::$app->cache;
		// 有效期设置 10s
		// $cache->add('key', 'welcome to yii world', 10);
		echo $cache->get('key');
	}
	// 依赖 (修改会导致失效)
	public function actionDepend(){
		$cache = \YII::$app->cache;
		// 文件依赖 abc.txt (与根目录下 如果找不到文件会直接返回false)
		$depend = new \yii\caching\FileDependency(['fileName'=>'abc.txt']);
		$cache->add('file_key', 'welcome to yii world', 3000, $depend);
		var_dump($cache->get('file_key'));
		// 表达式依赖
		$depend = new \yii\caching\ExpressionDependency(
			['expression'=>'\YII::$app->request->get("name")']
			);
		$cache->add('expression_key', 'welcome to yii world', 3000, $depend);
		var_dump($cache->get('expression_key'));
		// DB 依赖
		$depend = new \yii\caching\DbDependency(
			['sql'=>'SELECT count(*) FROM yii.order']
			);
		$cache->add('db_key', 'welcome to yii world', 3000, $depend);
		var_dump($cache->get('db_key'));
	}
	// 行为 (在所有方法之前执行)
	public function behaviors(){
		return [
		    [
		        'class'=>'yii\filters\PageCache',
		        'duration'=>1000,
		        'only'=>['index','test'],
		        'dependency'=>[
		            'class'=>'yii\caching\FileDependency',
		            'fileName'=>'abc.txt'
		        ]
		    ]
		];
	}
	public function actionIndex(){
		echo '4';
	}
	public function actionTest(){
		echo '5';
	}
}