<?php
/**
 * Created by Lincoo.
 * DateTime: 2018/7/3 下午5:31
 * Email: duan.jin@mydreamplus.com
 */

namespace Lincoo\AliyunOSS;
use OSS\OssClient;
use Illuminate\Support\ServiceProvider;
use Illuminate\Foundation\Application as LaravelApplication;

class AliyunOssServiceProvider extends ServiceProvider
{

    /**
     * 发布配置文件(执行php artisan vendor:publish时生成配置文件)
     */
    public function boot() {
        $source = realpath(__DIR__ . '/../config/config.php');
        if ($this->app instanceof LaravelApplication && $this->app->runningInConsole()) {
            $this->publishes([$source => config_path('config.php')]);
        }

        $this->mergeConfigFrom($source, 'aliyun-oss');
    }


    /**
     * 注册服务提供者
     */
    public function register()
    {
        // 绑定一个单例
        $this->app->singleton('Client', function () {
            $config = $this->app->make('config')->get('aliyun-oss');
            return new OssClient($config['id'],  $config['key'], $config['endpoint']);
        });

    }

}