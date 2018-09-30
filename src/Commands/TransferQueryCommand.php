<?php

namespace EasyPay\Laravel\Commands;

use Illuminate\Console\Command;

class TransferQueryCommand extends BaseEasyPayCommand
{
    protected $modes = [
        'ali'       => 'ali.transfer.query',
        'wechat'    => 'wechat.transfer.query',
    ];

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'easypay:transfer:query';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '企业转账查询';

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
