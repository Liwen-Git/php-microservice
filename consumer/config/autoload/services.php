<?php
return [
    'consumers' => value(function () {
        $consumers = [];
        $services = [
            'CalculatorService',
            'LotteryService',
        ];
        foreach ($services as $name) {
            $consumers[] = [
                // 对应消费者类的 $serviceName
                'name' => $name,
                // 这个消费者要从哪个服务中心获取节点信息，如不配置则不会从服务中心获取节点信息
                'registry' => [
                    'protocol' => 'consul',
                    'address' => 'http://consul-server-leader:8500',
                ],
                // 如果没有指定上面的 registry 配置，即为直接对指定的节点进行消费，通过下面的 nodes 参数来配置服务提供者的节点信息
                'nodes' => [
                    [
                        'host' => 'provider-1',
                        'port' => 9503,
                    ]
                ]
            ];
        }
        return $consumers;
    })
];
