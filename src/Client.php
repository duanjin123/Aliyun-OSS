<?php
/**
 * Created by Lincoo.
 * DateTime: 2018/7/3 下午8:18
 * Email: duan.jin@mydreamplus.com
 */
namespace Lincoo\AliyunOSS;

class Client
{
    /**
     * @var \Illuminate\Foundation\Application|mixed
     */
    protected $app;


    /**
     * Client constructor.
     */
    public function __construct()
    {
        $this->app = app('Client');
    }


    /**
     * 上传本地文件到oss
     * @param string $bucket
     * @param string $name  上传后的文件名
     * @param string $filePath 文件本地地址
     * @param string $acl 文件权限【可选值： 'private', 'public-read', 'public-read-write'】
     * @return mixed
     */
    public function put(
        $bucket,
        $name,
        $filePath,
        $acl = 'public-read'
    )
    {
        $result = $this->app->uploadFile($bucket, $name,  $filePath);
        if ($result) {
            $this->app->putObjectAcl($bucket, $name, $acl);
            return $result['info']['url'];
        }
    }


    /**
     * 列出所有buckets名称
     * @return array
     */
    public function buckets() {
        $lists = $this->app->listBuckets();
        if ($lists) {
            return $lists;
        }
    }


    /**
     * 检查文件是否存在
     * @param $bucket
     * @param $name
     * @return mixed
     */
    public function check($bucket, $name)
    {
        $result = $this->app->doesObjectExist($bucket, $name);

        return $result;

    }

    /**
     * 删除单个或多个文件
     * @param $bucket
     * @param $object
     * @return mixed
     */
    public function delete($bucket, $object)
    {
        if (!is_array($object)) {
            return $this->app->deleteObject($bucket, $object);
        }

        return $this->app->deleteObjects($bucket, $object);

    }

}