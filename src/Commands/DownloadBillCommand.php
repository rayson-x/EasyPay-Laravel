<?php

namespace EasyPay\Laravel\Commands;

use Illuminate\Console\Command;

class DownloadBillCommand extends BaseEasyPayCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'easypay:download:bill';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '下载对账单';

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
