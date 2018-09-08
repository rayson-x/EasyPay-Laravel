<?php

return [
    // 微信配置信息
    'wechat' => [
        // 应用id
        'appid'         => '',
        // 商户支付密钥
        'key'           => '',
        // 商户号
        'mch_id'        => '',
        // 签名加密方式
        'sign_type'     => 'MD5',
        // 异步通知地址
        'notify_url'    => '',
        // ssl证书路径
        'ssl_cert_path' => '',
        // ssl密钥路径
        'ssl_key_path'  => '',
    ],
    // 支付宝配置信息
    'ali' => [
        // 应用id
        'app_id'            =>  '',
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
        'sign_type'         =>  'RSA',
        // 支付宝api版本
        'version'           =>  '1.0',
        // 销售产品码
        'product_code'      =>  'QUICK_WAP_PAY'
    ],
];