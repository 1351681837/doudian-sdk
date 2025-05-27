安装方法
```
composer require "jloong/doudian-sdk"
```

#使用方法
1. 获取token
``` 
 AccessTokenBuilder::build($shop_id, 2);
```     

2. 刷新token
``` 
AccessTokenBuilder::refresh($refresh_token);
```
3. 请求
```
  /**
     * 发送请求并获取响应结果
     *
     * @param object $request 请求类实例，表示要发送的请求。
     * @param object $param 参数类实例，表示请求的参数。
     * @param array $paramData 请求参数数组，包含实际的请求数据（如 `shop_id` 等）。
     *
     * @return array 解码后的响应结果数组，包含从抖店 API 获取的响应数据。
     *
     * @throws \InvalidArgumentException 如果 `shop_id` 参数缺失或无效。
     * @throws \RuntimeException 如果获取 Token 失败或 API 请求失败。
     */
    public function sendRequest(
        object $request,    // 请求对象
        object $param,      // 参数对象
        array $paramData    // 请求数据数组
    ): array
    {
        // 获取Token方法
        $token = $this->getToken();

        // 动态设置请求参数，忽略值为 null 的参数
        foreach ($paramData as $key => $value) {
            if ($value !== null) { // 只处理非 null 参数
                $param->{$key} = $value;
            }
        }

        if (empty($token)) {
            throw new \RuntimeException('获取 Token 失败');
        }

        $request->setParam($param);

        // 执行请求并获取响应
        $response = $request->execute($token);

        // 错误处理：假设响应中有状态码字段进行验证
        if (isset($response->status) && $response->status !== 200) {
            // 如果返回的状态码不是 200，抛出异常
            throw new \RuntimeException('API 请求失败，错误码：' . $response->status);
        }

        // 将响应从 stdClass 转换为数组并返回
        return (array)$response;
    }


    /**
     * 获取订单详情列表
     */
    public function OrderOrderDetail(array $paramData): array
    {
        // 创建请求对象和参数对象
        $request = new OrderOrderDetailRequest();
        $param = new OrderOrderDetailParam();

        // 通过调用 sendRequest 方法来发送请求，并返回响应结果
        return $this->sendRequest($request, $param, $paramData);
    }
```