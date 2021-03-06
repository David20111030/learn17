<?php

/**
    Apache Benchmark (ab)

    简介
    ab 是由 Apache 提供的压力测试软件 安装 apache 服务器时会自带该压测软件

    ./ab -n1000 -c100 http://
    -n 请求数 requests
    -c 并发数 connection
    url 目标压测地址

    ab -h #帮助文档
    ab -n100 -c10 http://www.app.com

    windows 上使用
    cmd
    d:
    cd D:\files\wamp\bin\apache\Apache2.4.4\bin #进入apache 安装目录
    ab -n100 -c10 http://

    主要优化二个值
    Requests per second 每秒接收请求数 (尽可能多)
    Time per request 处理一个请求数所花的时间 (尽可小)

    PHP 语言级性能优化

    优化点 少写代码 多用PHP 自身能力
           性能问题 自写代码冗余较多 可读性不佳 并且性能低

    为什么性能低
        PHP 代码需要编译解析为底层语言 这一过程每次请求都会处理一遍 开销大

    好的方法
        多使用PHP 内置变量 常量 函数
*/