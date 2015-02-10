Pwiki
============

Pwiki develop version - 2014.8

by Mtao 

Introduction
-------------------

Pwiki 是一个简易的wiki框架，采用php语言编写, 引用了symfony console组件

Quick Start
-------------------


配置
-----------
在使用时需设定 bootsrap.php 中常量 `HTMLPATH` `MARKDOWNPATH` 
并建立相对应的文件夹已此来确定自己markdown文件与生成的html文件位置，
如不设定默认为程序根目录

查看帮助
-----------

    $ ./bin/pwiki

查看目前状态，有哪些列表
-----------


    $ ./bin/pwiki status 


创建一个新的wiki
-----------


    $ ./bin/pwiki new title category


生成html
-----------


    $ ./bin/pwiki generate all

    Usage: php ./bin/pwiki [options]

    one (key)  单个文件生成
    ignore        忽略已生成文件
    all        全部生成
