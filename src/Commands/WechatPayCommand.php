<?php

namespace EasyPay\Laravel\Commands;

class WechatPayCommand extends BaseEasyPayCommand
{
    protected $modes = [
        'qr'    => 'wechat.qr.pay',
        'wap'   => 'wechat.wap.pay',
        'pub'   => 'wechat.pub.pay',
        'app'   => 'wechat.app.pay',
    ];

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'easypay:wechat';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '建立一个支付宝订单';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $mode = $this->readline('请输入使用的支付方式 [' . join(',', array_keys($this->modes)) . '] :');

        if (!array_key_exists($mode, $this->modes)) {
            $this->error("错误的支付方式: {$mode}");
        }

        $this->handleResult($this->runService(app($this->modes[$mode])));
    }
}
