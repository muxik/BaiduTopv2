<?php
/*
 * @Author: your name
 * @Date: 2020-03-08 21:44:27
 * @LastEditTime: 2020-03-08 23:51:14
 * @LastEditors: Please set LastEditors
 * @Description: In User Settings Edit
 * @FilePath: /composer/demo/app/index.php
 */

use QL\QueryList;

require 'vendor/autoload.php';

class GetTop
{
    public function get($op)
    {
        switch ($op) {
            case 1:
                //返回实时热点
                return $this->realtime();
                break;
            case 2:
                //返回今就热点
                return $this->today();
                break;
            case 3:
                //返回七日热点
                return $this->sevendays();
                break;
            case 4:
                //返回民生热点
                return $this->peopleslivelihood();
                break;
            case 5:
                //返回娱乐热点
                return $this->entertainment();
                break;
            case 6:
                //返回体育热点
                return $this->sports();
                break;
            default:
                return '操作失败';
                break;
        }
    }

    //操作
    private function op($url)
    {
        $data = QueryList::get($url)
            ->rules([
                'title' => ['.list-title', 'text'],
                'top' => ['td.last > span', 'text'],
            ])
            ->queryData();

        $data = mb_convert_encoding($data, 'utf-8', 'GBK,UTF-8,ASCII');

        return $data;
    }

    //实时热点
    private function realtime()
    {
        $url = "http://top.baidu.com/buzz.php?p=top10";

        $result = [
            'title' => '实时热点排行榜',
            'data' => $this->op($url)
        ];
        return $result;
    }

    //今日热点
    private function today()
    {
        $url = "http://top.baidu.com/buzz?b=341&c=513&fr=topbuzz_b1_c513";

        $result = [
            'title' => '今日热点事件排行榜',
            'data' => $this->op($url)
        ];
        return $result;
    }

    //七日热点
    private function sevendays()
    {
        $url = "http://top.baidu.com/buzz?b=42&c=513&fr=topbuzz_b341_c513";

        $result = [
            'title' => '七日热点排行榜',
            'data' => $this->op($url)
        ];
        return $result;
    }

    //民生
    private function peopleslivelihood()
    {
        $url = "http://top.baidu.com/buzz?b=342&c=513&fr=topbuzz_b42_c513";

        $result = [
            'title' => '民生热点排行榜',
            'data' => $this->op($url)
        ];
        return $result;
    }

    // 娱乐热点
    private function entertainment()
    {
        $url = "http://top.baidu.com/buzz?b=344&c=513&fr=topbuzz_b342_c513";

        $result = [
            'title' => '娱乐热点排行榜',
            'data' => $this->op($url)
        ];
        return $result;
    }

    // 体育热点
    private function sports()
    {
        $url = "http://top.baidu.com/buzz?b=11&c=513&fr=topbuzz_b344_c513";

        $result = [
            'title' => '体育热点排行榜',
            'data' => $this->op($url)
        ];
        return $result;
    }
}