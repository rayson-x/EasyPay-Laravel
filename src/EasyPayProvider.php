<?php

namespace EasyPay\Laravel;

use EasyPay\Config;
use EasyPay\PayFactory;
use Illuminate\Support\ServiceProvider;

class EasyPayProvider extends ServiceProvider
{
    protected $trades = [
        // 支付宝可用操作
        'ali.qr.pay',
        'ali.wap.pay',
        'ali.refund',
        'ali.transfer',
        'ali.query.order',
        'ali.close.order',
        'ali.refund.query',
        // 微信可用操作
        'wechat.qr.pay',
        'wechat.pub.pay',
        'wechat.app.pay',
        'wechat.wap.pay',
        'wechat.refund',
        'wechat.transfer',
        'wechat.order.query',
        'wechat.order.close',
        'wechat.refund.query',        
    ];

    protected $notify = [
        'wechat.notify',
        'ali.notify',
    ];

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Bootstrap commands.
     *
     * @return void
     */
    protected function registerArtisanCommands()
    {
        $this->commands([
            Commands\AliPayCommand::class,
            Commands\WechatPayCommand::class,
            Commands\CloseOrderCommand::class,
            Commands\OrderQueryCommand::class,
            Commands\RefundCommand::class,
            Commands\RefundQueryCommand::class,
            Commands\TransferCommand::class,
            Commands\TransferQueryCommand::class,
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
        foreach ($this->trades as $service) {
            $this->app->bind($service, function ($app) use ($service) {
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
        return array_merge($this->trades, $this->notify);
    }
}