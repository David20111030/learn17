<?php
namespace frontend\controllers;
use yii\web\Controller;
class PartController extends Controller{
	// 片段缓存
	public function actionIndex(){
		return $this->renderPartial('index');
	}
	// 设置片段缓存有效期
	public function actionDuration(){
		return $this->renderPartial('duration');
	}
	// 嵌套缓存
	public function actionInner(){
		return $this->renderPartial('inner');
	}
}