<?php
/**
 * @author  volkov
 * @created 7/7/14 6:26 PM
 */

namespace Application;

use Application\Info;
use Bluz\View\View;

/**
 * @var View $view
 */
return function () use ($view) {
    /**
     * @var Bootstrap $this
     */

    $this->getView()->title('Commits history', View::POS_PREPEND);

    $info = new Info\Info();
    $view->history = $info->getCommitsHistory();

};
