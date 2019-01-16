<?php

namespace EasyPay\Laravel;

use EasyPay\Config;
use EasyPay\Notify;
use EasyPay\PayFactory;
use Illuminate\Support\Arr;
use Illuminate\Support\ServiceProvider;

class EasyPayProvider extends ServiceProvider
{
    protected $services = [
        // alipay
        'ali.qr.pay',
        'ali.wap.pay',
        'ali.refund',
        'ali.transfer',
        'ali.query.order',
        'ali.close.order',
        'ali.refund.query',
        // wechat
        'wechat.qr.pay',
        'wechat.pub.pay',
        'wechat.program.pay',
        'wechat.app.pay',
        'wechat.wap.pay',
        'wechat.refund',
        'wechat.transfer',
        'wechat.order.query',
        'wechat.order.close',
        'wechat.refund.query',        
    ];

    protected $notifies = [
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
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/config.php' => config_path('easyPay.php'),
            ], 'config');
        }
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        // Register services
        foreach ($this->services as $service) {
            $this->app->bind($service, function ($app, $options = []) use ($service) {
                if (empty($options)) {
                    $path = Arr::first(explode('.', $service));
                    $options = config("easyPay.{$path}");
                }

                return PayFactory::create($service, $options);
            });
        }

        foreach ($this->notifies as $notify) {
            $this->app->bind($notify, function ($app, $options = []) use ($notify) {
                $service = Arr::first(explode('.', $notify));
                $options = $options ?: config("easyPay.{$service}");
                $request = $app->get('request');

                return Notify::fromRequest($service, $request, $options);
            });
        }

        // Register commands
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
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return array_merge($this->services, $this->notify);
    }
}