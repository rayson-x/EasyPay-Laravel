<?php

namespace EasyPay\Laravel\Commands;

use Illuminate\Console\Command;

class CloseOrderCommand extends BaseEasyPayCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'easypay:close:order';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '关闭支付订单';

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
        // TODO
    }
}
