<?php

namespace EasyPay\Laravel\Commands;

use Illuminate\Console\Command;

abstract class BaseEasyPayCommand extends Command
{
    protected $getRequireFunc = 'getRequireParams';

    protected $tradeTypes = ['ali', 'wechat'];

    /**
     * @param $service
     * @return mixed
     */
    public function runService($service)
    {
        $this->setRequireParams($service);

        foreach ($this->getCustomParams() as $key => $value) {
            $service->$key = $value;
        }

        return $service->execute();
    }

    /**
     * @return string
     */
    protected function readline($prompt = null)
    {
        $this->info($prompt);

        return rtrim(fgets(STDIN, 1024));
    }

    /**
     * @param object $service
     */
    protected function setRequireParams($service)
    {
        $this->comment("填写必填参数");

        foreach ($this->getRequireParams($service) as $param) {
            if (!is_null($service->$param)) {
                continue;
            }

            $service->$param = $this->readline("请填写{$param}: ");
        }
    }

    /**
     * @param object $service
     * @return array
     */
    protected function getRequireParams($service)
    {
        $reflection = new \ReflectionClass($service);

        return call_user_func(
            $reflection->getMethod($this->getRequireFunc)->getClosure($service)
        );
    }

    /**
     * @return array
     */
    protected function getCustomParams()
    {
        $params = [];

        if ('y' === $this->readline('是否填写自定义参数 [y/n]: ')) {
            $this->info('填写自定义参数,格式为 key=value,输入 end 结束');

            while (true) {
                $line = $this->readline();

                if ($line === 'end') {
                    break;
                }

                $parts = explode('=', $line, 2);

                if (count($parts) == 2) {
                    list($key, $value) = $parts;

                    $params[$key] = $value;
                }
            }
        }

        return $params;
    }

    /**
     * @param mixed $result
     * @return void
     */
    protected function handleResult($result)
    {
        $path = $this->readline("请输入请求结果保存路径,不指定将直接返回结果: ");

        if (!$path) {
            $this->info($result);
        } else {
            file_put_contents($path, $result);
        }
    }
}
