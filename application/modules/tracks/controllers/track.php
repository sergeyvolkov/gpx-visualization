<?php
/**
 * @author  volkov
 * @created 10/7/14 22:54 PM
 */

namespace Application;

/**
 * @route /track/{$id}
 * @privilege ViewTrack
 */
return function ($id) {
    /**
     * @var Bootstrap $this
     */

    $this->getLayout()->title('Track', \Bluz\View\View::POS_PREPEND);
};