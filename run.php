<?php
/*
 * @Author: your name
 * @Date: 2020-03-08 23:34:13
 * @LastEditTime: 2020-03-09 00:19:07
 * @LastEditors: Please set LastEditors
 * @Description: In User Settings Edit
 * @FilePath: /composer/queryL/run.php
 */

error_reporting(0);
date_default_timezone_set('PRC');

require __DIR__ . '/GetTop.php';
$time = date('H:i:s');
$top = new GetTop();

// 获取终端输入
echo  <<<EOT
== 欢迎使用百度风云榜爬虫 ==
请输入操作:
    <1>:获取实时热点
    <2>:获取今日热点
    <3>:获取七日热点
    <4>:获取民生热点
    <5>:获取娱乐热点
    <6>:获取体育热点
    <Ctrl+C>退出

EOT;


while (!feof(STDIN)) {
    echo "请输入:";
    $get_input = fread(STDIN, 1024);
    $is = preg_match('/[1-6]/',$get_input);
    if (!$is) {
        echo "输入错误！<Ctrl+C>退出\n";
        continue;
    }
    $data = $top->get($get_input);
    $filename = __DIR__. '/data/' . time() . '--' . $data['title'] . '.txt';

    foreach ($data as $key => $value) {
        foreach ($value as $v) {
            $result .= '热点标题：' . $v['title'] . '---- 热度:' . $v['top'] . "\n";
        }
    }
    file_put_contents($filename,$result);
    echo  "[{$time}] 爬取成功！ 文件位置：.$filename\n";
}

