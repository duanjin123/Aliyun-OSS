## Lavel学习之compoer包开发
## 简介
- 本项目为测试项目，只为简单实现上传文件功能，代码简陋；
- 提供了上传功能，上传后返回oss请求地址；
- 提供了检查文件是否在oss存在的功能，返回bool类型；
- 提供了删除一个或多个文件的功能；
- 第一个composer包，自己学习测试用，不喜勿喷
#### 一、安装
1、修改composer.json，加入：
```$xslt
{
    "require": {
        "lincoo/aliyun_oss": "dev-master"
    }
}
```
然后执行：
```$xslt
composer update 
```
或者直接：
```$xslt
composer require "lincoo/aliyun_oss"
```
2、修改config/app.php，在providers数组下加入:
```$xslt
Lincoo\AliyunOSS\AliyunOssServiceProvider::class,
```
在aliases下加入：
```$xslt
'Client' => Lincoo\AliyunOSS\Client::class
```
3、发布包配置文件
```$xslt
php artisan vendor:publish
```
（记得在.env中加入相关配置）
4、重新加载composer包
```$xslt
composer dumpautoload
```
#### 二、使用
在controller中引入依赖,如上传文件a：
```$xslt
public function index(Client $client)
{
    $this->client->put($bucket, $object, $path, $acl);
}
```
其中$bucket是容器名，$object是上传后的文件名（前面可以加具体路径），$path是本地文件路径，$acl是文件的权限，可选值为private(私有)/public-read(公共读)/public-read-write(公共读写)
