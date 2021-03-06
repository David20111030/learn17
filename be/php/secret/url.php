<?php

/**
     URL 编码加密技术

     urlencode(string $str) 编码 URL 字符串
     $str 要编码的字符串
     返回值 返回编码后的字符串

     编码规范 此字符串中除了 -_. 之外的所有非字母数字字符都将被替换成百分号 (%) 后跟两面位十六进制数 空格则编码为加号 ( + )

     urldecode(string $str) 解码已编码的 URL 字符串
     $str 要解码的字符串
     返回值 返回解码后的字符串
*/

    $str = "this is a test";
    echo urlencode($str);
    echo "<hr/>";
    $str = "urlencode.php?username=2+3 imooc&king # or 1=1 \ ";
    echo urlencode($str);
    echo "<hr/>";
    $urlencodeStr = urlencode($str);
    $srcStr = $urldecode($urlencode);
    echo $srcStr;
    echo "<hr/>";
    if (!empty($_GET)) {
    	print_r($_GET);
    }

    echo "<a href='urlencode.php?username=imooc&king&age=2'>慕课网信息</a>";
    // 上面的信息使用 urlencode
    $username = "imooc&king";
    $queryString = "username=".urlencode($username)."&age=2";
    echo "<a href='urlencode.php?{$queryString}'>test</a>"

    /**
        rawurlencode(string $str) 按照 RFC1738 对 URL 进行编码
        $str 要编码的 URL
        返回值 返回字符串 把空格编码 %20

        rawurldecode(string $str) 对已编码的 URL 字符串进行解码
        $str 要解码的 URL
        返回值 返回字符串 此字符串中百分号 % 后跟两位十六进制的序列都将被替换成原义字符
    */

        echo "<hr/>";
        echo urlencode("慕课网");
        echo "<hr/>";
        echo urlencode("this is a test");
        echo "<hr/>";
        echo rawurlencode("this is a test");
        echo rawurldecode("");
