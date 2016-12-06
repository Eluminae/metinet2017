<?php
/**
 * @author Boris Guéry <guery.b@gmail.com>
 */

namespace Metinet\Config;

class ChainLoader implements Loader
{
    private $loaders;

    public function __construct(array $loaders)
    {
        $this->loaders = $loaders;
    }

    public function load()
    {
        $config = [];
        foreach ($this->loaders as $loader) {
            $config = array_merge_recursive($config, $loader->load());
        }

        return $config;
    }
}
