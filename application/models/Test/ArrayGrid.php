<?php
/**
 * @copyright Bluz PHP Team
 * @link https://github.com/bluzphp/skeleton
 */

/**
 * @namespace
 */
namespace Application\Test;

use Bluz\Grid\Grid;

/**
 * Test Grid based on Array
 *
 * @category Application
 * @package  Test
 */
class ArrayGrid extends Grid
{
    protected $uid = 'arr';
    /**
     * init
     * 
     * @return self
     */
    public function init()
    {
         // Array
         $adapter = new \Bluz\Grid\Source\ArraySource();
         $adapter->setSource(
             [
                 ['id'=>1, 'name'=>'Foo', 'email'=>'a@bc.com', 'status'=>'active'],
                 ['id'=>2, 'name'=>'Bar', 'email'=>'d@ef.com', 'status'=>'active'],
                 ['id'=>3, 'name'=>'Foo 2', 'email'=>'m@ef.com', 'status'=>'disable'],
                 ['id'=>4, 'name'=>'Foo 3', 'email'=>'j@ef.com', 'status'=>'disable'],
                 ['id'=>5, 'name'=>'Foo 4', 'email'=>'g@ef.com', 'status'=>'disable'],
                 ['id'=>6, 'name'=>'Foo 5', 'email'=>'r@ef.com', 'status'=>'disable'],
                 ['id'=>7, 'name'=>'Foo 6', 'email'=>'m@ef.com', 'status'=>'disable'],
                 ['id'=>8, 'name'=>'Foo 7', 'email'=>'n@ef.com', 'status'=>'disable'],
                 ['id'=>9, 'name'=>'Foo 8', 'email'=>'w@ef.com', 'status'=>'disable'],
                 ['id'=>10, 'name'=>'Foo 9', 'email'=>'l@ef.com', 'status'=>'disable'],
            ]
         );

         $this->setAdapter($adapter);
         $this->setDefaultLimit(3);
         $this->setAllowOrders(['name', 'email', 'id']);
         $this->setAllowFilters(['name', 'status', 'id']);

         return $this;
    }
}
