<?php

namespace EasyPay\Laravel\Commands;

class AliPayCommand extends BaseEasyPayCommand
{
    protected $modes = [
        'qr'    => 'ali.qr.pay',
        'wap'   => 'ali.wap.pay',
    ];

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'easypay:ali';

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

        $service = app($this->modes[$mode]);

        $reflection = new \ReflectionClass($service);

        $params = call_user_func($reflection->getMethod('getRequireParams')->getClosure($service));

        $this->comment("填写必填参数");

        foreach ($params as $param) {
            if (!is_null($service->$param)) {
                continue;
            }

            $service->$param = $this->readline("请填写{$param}: ");
        }

        foreach ($this->getCustomParams() as $key => $value) {
            $service->$key = $value;
        }

        $this->handleResult($service->execute());
    }
}