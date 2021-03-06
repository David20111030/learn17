<?php

/**
  * 通信数据标准格式
  * code 状态码 (成功 200 失败 400 等)
  * message 提示信息 (邮箱格式不正确性 数据返回成功等)
  * data 返回数据
*/

class Response {

	const JSON = "json";

	/**
	  * 输出通信数据
	  * @param integer $code 状态码
	  * @param string $message 提示信息
	  * @param array $data 数据
	  * @param array $type 数据类型
	  * @return string
	*/
	public static function show($code, $message = '', $data = array(), $type) {

		if (!is_numeric($code)) {
			return '';
		}

		$result = array(
			'code' => $code,
			'message' => $message,
			'data' => $data
			);

		if ($type == 'json') {
			self::json($code, $message, $data);
		} elseif ($type == 'xml') {
			self::xmlEncode($code, $message, $data);
		} elseif ($type == "array") {
			echo '<pre>';
			var_dump($result);
			echo '</pre>';
		}
	}

	/**
	  * 按 json 方式输出通信数据
	  * @param integer $code 状态码
	  * @param string $message 提示信息
	  * @param array $data 数据
	  * @return string
	*/
	public static function json($code, $message = '', $data = array()) {

		if (!is_numeric($code)) {
			return '';
		}

		$result = array(
			'code' => $code,
			'message' => $message,
			'data' => $data
			);

		echo json_encode($result);
	}

	public static function xml(){
		// 以xml 格式显示
		header("Content-Type:text/xml");
		$xml = "<?xml version='1.0' encoding='UTF-8'?>";
		$xml .= "<root>\n";
		$xml .= "<code>200</code>\n";
		$xml .= "<message>数据返回成功</message>\n";
		$xml .= "<data>\n";
		$xml .= "<id>1</id>\n";
		$xml .= "<name>apeng</name>\n";
		$xml .= "</data>\n";
		$xml .= "</root>\n";
		echo $xml;
	}

	/**
	  * 按 xml 方式输出通信数据
	  * @param integer $code 状态码
	  * @param string $message 提示信息
	  * @param array $data 数据
	  * @return string
	*/
	public static function xmlEncode($code, $message, $data = array()) {
		if (!is_numeric($code)) {
			return '';
		}

		$result = array(
			'code' => $code,
			'message' => $message,
			'data' => $data
			);

		header("Content-Type:text/xml");
		$xml = "<?xml version='1.0' encoding='UTF-8'?>";
		$xml .= "<root>\n";
		
		$xml .= self::xmlToEncode($result);

		$xml .= "</root>\n";
		echo $xml;
	}

	public static function xmlToEncode($data) {

		$xml = $attr = "";
		foreach ($data as $key => $val) {
			if (is_numeric($key)) {
				$attr = " id='{$key}'";
				$key = "item";
			}
			$xml .= "<{$key}{$attr}>";
			$xml .= is_array($val)?self::xmlToEncode($val):$val;
			$xml .= "</{$key}>\n";
		}
		return $xml;
	}
}