<?php
/**
 * @author  volkov
 * @created 7/2/14 12:36 PM
 */

namespace Application;

/**
 * @route /api/all-routes
 * @privilege ViewAllRoutes
 */
return function () {
    /**
     * @var Bootstrap $this
     */
    $this->useJson();

    $userId = app()->user()->id;

    if (!$userId) {
        throw new \Exception('Page not found', 404);
    }

    $points = Tracks\Table::getInstance()->getAllPoints($userId);

    return ['status' => 'success', 'points' => $points];
};
