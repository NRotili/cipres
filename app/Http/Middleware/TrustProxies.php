<?php

namespace App\Http\Middleware;

use Fideloper\Proxy\TrustProxies as Middleware;
use Illuminate\Http\Request;

{
    /**
     * The trusted proxies for this application.
     *
     * @var array|string|null
     */
    //protected $proxies;

    protected $proxies = [
                '104.237.3.91'  //replace with load balancer's public IP
                    ];
    ]
    /**
     * The headers that should be used to detect proxies.
     *
     * @var int
     */
    protected $headers = Request::HEADER_X_FORWARDED_FOR | Request::HEADER_X_FORWARDED_HOST | Request::HEADER_X_FORWARDED_PORT | Request::HEADER_X_FORWARDED_PROTO | Request::HEADER_X_FORWARDED_AWS_ELB;
}
