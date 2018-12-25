<?php

return [
    // 微信配置信息
    'wechat' => [
        // 应用id
        'appid'             =>  env('WEIXIN_APPID'),
        // 应用密钥
        'key'               =>  env('WEIXIN_MCH_KEY'),
        // 商户ID
        'mch_id'            =>  env('WEIXIN_MCH_ID'),
        // 回调地址
        'notify_url'        =>  'http://example.com',
        // ssl证书路径
        'ssl_cert_path'     =>  env('WEIXIN_CERT_FILE'),
        // ssl密钥路径
        'ssl_key_path'      =>  env('WEIXIN_KEY_FILE'),
        // 签名加密方式
        'sign_type'         => 'MD5',
    ],
    // 支付宝配置信息
    'ali' => [
        // 应用id
        'app_id'            =>  env('ALIPAY_APPID'),
        // 沙箱测试开关
        'is_sand_box'       =>  true,
        // 生成的RSA证书私钥,用于生成签名
        'ssl_private_key'   =>  '',
        // 阿里提供的公钥,用于验证签名
        'ali_public_key'    =>  '',
        // 格式
        'format'            =>  'JSON',
        // 字符编码
        'charset'           =>  'UTF-8',
        // 签名加密方式
        'sign_type'         =>  'RSA2',
        // 支付宝api版本
        'version'           =>  '1.0',
        // 销售产品码
        'product_code'      =>  'QUICK_WAP_PAY'
    ],
];