<?php /** @noinspection PhpUnnecessaryFullyQualifiedNameInspection */

namespace Smhsw\MiniApp;

use Foris\Easy\Sdk\ServiceContainer;
use Foris\Easy\Sdk\Providers\ConfigProvider;
use Foris\Easy\Sdk\Providers\CacheProvider;
use Foris\Easy\Sdk\Providers\LoggerProvider;
use Smhsw\MiniApp\Http\ServiceProvider as HttpClientProvider;

/**
 * Class Application
 *
 * @property \Smhsw\MiniApp\Auth\Auth                       $auth
 * @property \Smhsw\MiniApp\Auth\AccessToken                $access_token
 * @property \Smhsw\MiniApp\AppCode\AppCode                 $app_code
 * @property \Smhsw\MiniApp\Encryptor\Encryptor             $encryptor
 * @property \Smhsw\MiniApp\TemplateMessage\TemplateMessage $template_message
 * @property \Smhsw\MiniApp\ContentSecurity\ContentSecurity $content_security
 * @property \Smhsw\MiniApp\UserStorage\UserStorage         $user_storage
 * @property \Smhsw\MiniApp\Server\Server                   $server
 */
class Application extends ServiceContainer
{
    /**
     * @var array
     */
    protected $defaultProviders = [
        ConfigProvider::class,
        CacheProvider::class,
        LoggerProvider::class,
        HttpClientProvider::class,
    ];

    /**
     * 启用的组件
     *
     * @var array
     */
    protected $providers = [
        \Smhsw\MiniApp\Auth\ServiceProvider::class,
        \Smhsw\MiniApp\Encryptor\ServiceProvider::class,
        \Smhsw\MiniApp\AppCode\ServiceProvider::class,
        \Smhsw\MiniApp\TemplateMessage\ServiceProvider::class,
        \Smhsw\MiniApp\ContentSecurity\ServiceProvider::class,
        \Smhsw\MiniApp\UserStorage\ServiceProvider::class,
        \Smhsw\MiniApp\Server\ServiceProvider::class,
    ];

    /**
     * 重写配置信息
     *
     * @return array
     */
    public function getConfig()
    {
        $this->userConfig['http_client']['timeout'] = $this->userConfig['http_client']['timeout'] ?? 30;
        $this->userConfig['http_client']['base_uri'] = 'https://developer.toutiao.com/api/apps/';
        $this->userConfig['http_client']['response_type']=$this->userConfig['response_type'];//加
        return $this->userConfig;
    }
}
