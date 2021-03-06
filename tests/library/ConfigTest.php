<?php
/**
 * Tiny Api Framework.
 *
 * @link https://github.com/cizel/tiny
 *
 * @copyright 2017-2017 i@cizel.cn
 *
 */
namespace Tests\Library;

use Config;
use Tests\TestCase;
use Yaf_Application;

/**
 * @coversDefaultClass \Config
 */
class ConfigTest extends TestCase
{
    /**
     * @covers ::get
     * 测试配置和配置文件是否一致
     */
    public function testConfigConsistency()
    {
        $env=Yaf_Application::app()->environ();
        $config=parse_ini_file(APP_PATH . '/conf/app.ini', true);
        $current=$config[$env . ':common'] + $config['common'];
        foreach ($current as $key => $value) {
            $this->assertSame($current[$key], Config::get($key), $key);
        }
    }

    /**
     * 检测 Get 的值不存在为空值的情况
     */
    public function testEmpty()
    {
        $this->assertEmpty(Config::get(uniqid('_te_', true)));
    }

    /**
     * 测试 Get 的默认值的情况
     */
    public function testDefault()
    {
        $key=uniqid('_td_', true);
        $default=[false, null, 1, true, [1,2,4], 'test'];
        foreach ($default as $k => $d) {
            $this->assertSame(Config::get($k . $key, $d), $d);
        }
    }
}
