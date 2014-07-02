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
use Bluz\Db\Query\Select;

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

    public function getAllPoints($userId)
    {
        $select = new Select();
        $select->select(
            'p.id',
            'p.latitude',
            'p.longitude',
            'p.altitude',
            'p.datetime'
        )
            ->from('points', 'p')
            ->join('p', 'tracks', 't', 'p.trackId = t.id')
            ->where('t.userId = ?', $userId);

        return $select->execute();
    }
}
