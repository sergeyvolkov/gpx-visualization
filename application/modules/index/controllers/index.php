<?php
/**
 * Default module/controller
 *
 * @author   Anton Shevchuk
 * @created  06.07.11 18:39
 * @return   \Closure
 */

/**
 * @namespace
 */
namespace Application;

return
/**
 * @return void
 */
function () {
    /**
     * @var Bootstrap $this
     */
    $this->redirectTo('tracks', 'index');
};
