<?php
/**
 * @author  volkov
 * @created 7/1/14 12:40 PM
 */

namespace Application;

/**
 * @privilege ViewTracks
 */
return function () {
    /**
     * @var Bootstrap $this
     */

    $this->getLayout()->title('Tracks list', \Bluz\View\View::POS_PREPEND);
};