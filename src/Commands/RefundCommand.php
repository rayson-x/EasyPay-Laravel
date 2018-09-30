<?php

namespace EasyPay\Laravel\Commands;

use Illuminate\Console\Command;

class RefundCommand extends BaseEasyPayCommand
{
    protected $modes = [
        'ali'       => 'ali.refund',
        'wechat'    => 'wechat.refund',
    ];

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'easypay:refund';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '订单退款';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

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
