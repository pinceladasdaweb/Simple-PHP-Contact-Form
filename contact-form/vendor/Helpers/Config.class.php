<?php

namespace Helpers;

/**
 * Powerful And Easy Configuration with PHP.
 *
 * @package   Config
 * @author    Pedro Rogério <pinceladasdaweb@hotmail.com>
 * @copyright 2015 Pedro Rogério <pinceladasdaweb@hotmail.com>
 * @license   http://opensource.org/licenses/GPL-3.0 GNU General Public License 3.0
 * @version   Release: 0.0.1
 * @link      https://github.com/pinceladasdaweb/Config
 */
class Config
{
    protected $data;
    protected $default = null;

    public function load($file)
    {
        $this->data = include $file;
    }

    public function get($key, $default = null)
    {
        $this->default = $default;

        $segments = explode('.', $key);
        $data = $this->data;

        foreach ($segments as $segment) {
            if (isset($data[$segment])) {
                $data = $data[$segment];
            } else {
                $data = $this->default;
                break;
            }
        }

        return $data;
    }

    public function exists($key)
    {
        return $this->get($key) !== $this->default;
    }
}