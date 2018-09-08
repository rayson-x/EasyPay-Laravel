<?php

namespace EasyPay\Laravel;

use EasyPay\Config;
use EasyPay\PayFactory;
use Illuminate\Support\ServiceProvider;

/**
 * 获取通知信息
 */
class EasyPayProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    protected function registerArtisanCommands()
    {
        $this->commands([
            // todo 生成测试例子
        ]);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/config.php' => config_path('easyPay.php'),
        ], 'config');

        $config = $this->app['config']['easyPay'];

        if (is_null($config)) {
            $config = [];
        }

        Config::loadConfig($config);
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        foreach ($this->provides() as $service) {
            $this->app->singleton($service, function ($app) use ($service) {
                return PayFactory::create($service);
            });
        }
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [
            // 支付宝可用操作
            'ali.qr.pay',
            'ali.wap.pay',
            'ali.refund',
            'ali.transfers',
            'ali.query.order',
            'ali.close.order',
            'ali.refund.query',
            // 微信可用操作
            'wechat.qr.pay',
            'wechat.pub.pay',
            'wechat.app.pay',
            'wechat.wap.pay',
            'wechat.refund',
            'wechat.transfers',
            'wechat.order.query',
            'wechat.order.close',
            'wechat.refund.query',
        ];
    }
}
