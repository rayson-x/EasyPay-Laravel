## 安装
> composer require easy-pay/sdk-laravel

## 简单使用
```php
<?php
// routes/web.php

Route::get('wechat/qr', function () {
    $trade = app('wechat.qr.pay');

    $trade->attach = 'wechat pay test';
    $trade->body = '微信扫码支付,测试订单';
    $trade->out_trade_no = substr(md5(uniqid()), 0, 18) . date("YmdHis");
    $trade->total_fee = 1;
    $trade->spbill_create_ip = $_SERVER['REMOTE_ADDR'];
    $trade->product_id = 123;

    $url = $trade->execute();
    // 生成二维码
    $qrCode = (new Endroid\QrCode\QrCode($url))->setSize(300);

    return response($qrCode->get('png'), 200, ['Content-Type' => 'image/png']);
});
```