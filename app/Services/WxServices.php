<?php
namespace App\Services;

use EasyWeChat\Factory;
use GuzzleHttp\Client;

class WxServices extends Services
{
    protected $config;

    protected $wx;

    public function __construct()
    {
        $this->config = [
            'app_id' => 'wxb1a5ebcde00ec096',
            'secret' => '0f540b8807a5eab8dc8dcb8a8bd4edb6',
            'response_type' => 'array',
            'oauth' => [
                'scopes'   => ['snsapi_userinfo'],
                'callback' => 'http://ifcocn.ifcocn.com/build'
            ]
        ];

        $this->wx = Factory::officialAccount($this->config);
    }


    public function oauth()
    {
        return $this->wx->oauth->scopes(['snsapi_userinfo'])
        ->redirect();
    }


    public function user()
    {
        return $this->wx->oauth->user();
    }


    public function downloadAvatar($url, $path)
    {
        $client = new Client();
        $response = $client->get($url, ['save_to' => $path]);
    }

}
