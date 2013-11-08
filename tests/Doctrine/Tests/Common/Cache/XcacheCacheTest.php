<?php

namespace Doctrine\Tests\Common\Cache;

use Doctrine\Common\Cache\XcacheCache;

class XcacheCacheTest extends CacheTest
{
    public function setUp()
    {
        if ( ! extension_loaded('xcache')) {
            $this->markTestSkipped('The ' . __CLASS__ .' requires the use of xcache');
        }
        if (php_sapi_name() == 'cli' && version_compare(XCACHE_VERSION, '3.1.0', 'lt')) {
            $this->markTestSkipped('The ' . __CLASS__ .' cannot be tested on the command line with xcache versions before 3.1.0');
        }
        if (ini_get('xcache.var_size') <= 0) {
            $this->markTestSkipped('The ' . __CLASS__ .' requires php config option "xcache.var_size" to be > 0');
        }
    }

    protected function _getCacheDriver()
    {
        return new XcacheCache();
    }
}
