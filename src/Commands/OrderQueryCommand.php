<?php

namespace EasyPay\Laravel\Commands;

use Illuminate\Console\Command;

class OrderQueryCommand extends BaseEasyPayCommand
{
    protected $modes = [
        'ali'       => 'ali.order.query',
        'wechat'    => 'wechat.order.query',
    ];

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'easypay:order:query';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '查询订单';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $mode = $this->readline('请输入支付方式 [' . join(',', array_keys($this->modes)) . '] :');

        if (!array_key_exists($mode, $this->modes)) {
            $this->error("错误的支付方式: {$mode}");
        }

        $this->handleResult($this->runService(app($this->modes[$mode])));
    }
}
