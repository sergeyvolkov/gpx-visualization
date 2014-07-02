<?php
/**
 * @copyright Bluz PHP Team
 * @link https://github.com/bluzphp/skeleton
 */

/**
 * @namespace
 */
namespace Application\Tracks;

use Application\Points;

class Table extends \Bluz\Db\Table
{
    /**
     * Table
     *
     * @var string
     */
    protected $table = 'tracks';

    /**
     * Primary key(s)
     * @var array
     */
    protected $primary = array('id');

    public function saveFileContent($data)
    {
        $handler = $this->getAdapter()->handler();

        try {
            $handler->beginTransaction();

            // save track info
            $info = $this->create($data['info'])->save();

            // save track points
            foreach ($data['points'] as $point) {
                $point['trackId'] = $info['id'];
                Points\Table::create($point)->save();
            }

            $handler->commit();
        } catch (\Exception $ex) {
            $handler->rollBack();
        }

    }
}
