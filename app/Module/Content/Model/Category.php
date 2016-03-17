<?php

namespace Northstyle\Module\Content\Model;

use Baum\Node;

class Category extends Node
{
    protected $table = 'category';
    protected $fillable = ['title','content'];
    public function updateOrder($order, $orderPage)
    {
        $orderPage = $this->findOrFail($orderPage);
        if ($order == 'before') {
            $this->moveToLeftOf($orderPage);
        } elseif ($order == 'after') {
            $this->moveToRightOf($orderPage);

        } elseif ($order == 'childOf') {
            $this->makeChildOf($orderPage);
        }
    }

}
