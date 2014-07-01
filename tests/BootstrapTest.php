<?php
/**
 * @copyright Bluz PHP Team
 * @link https://github.com/bluzphp/skeleton
 */

/**
 * @namespace
 */
namespace Application\Tests;

use Bluz\Application;
use Bluz\Request;
use Application\Bootstrap;

/**
 * Bootstrap
 *
 * @package  Application/Tests
 *
 * @author   Anton Shevchuk
 * @created  20.07.11 17:38
 */
class BootstrapTest extends Bootstrap
{
    /**
     * Get dispatched module name
     *
     * @return string
     */
    public function getModule()
    {
        return $this->dispatchModule;
    }

    /**
     * Get dispatched controller name
     *
     * @return string
     */
    public function getController()
    {
        return $this->dispatchController;
    }
}
