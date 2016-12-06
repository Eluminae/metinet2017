<?php
/**
 * @author Boris Guéry <guery.b@gmail.com>
 */

namespace Metinet\Config;

use Symfony\Component\Yaml\Yaml;

class YamlLoader implements Loader
{
    private $path;

    public function __construct($path)
    {
        $this->path = $path;
    }

    public function load()
    {
        return Yaml::parse(file_get_contents($this->path));
    }
}
