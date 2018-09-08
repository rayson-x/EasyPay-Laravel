<?php

namespace EasyPay\Laravel\Commands;

use Illuminate\Console\Command;

class TransferQueryCommand extends BaseEasyPayCommand
{
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
