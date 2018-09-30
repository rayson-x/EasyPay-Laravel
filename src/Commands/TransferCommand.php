<?php

namespace EasyPay\Laravel\Commands;

use Illuminate\Console\Command;

class TransferCommand extends BaseEasyPayCommand
{
    protected $modes = [
        'ali'       => 'ali.transfer',
        'wechat'    => 'wechat.transfer',
    ];

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'easypay:transfer';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '企业转账';

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
        $mode = $this->readline('请输入转账方式 [' . join(',', array_keys($this->modes)) . '] :');

        if (!array_key_exists($mode, $this->modes)) {
            $this->error("错误的转账方式: {$mode}");
        }

        $this->handleResult($this->runService(app($this->modes[$mode])));
    }
}
