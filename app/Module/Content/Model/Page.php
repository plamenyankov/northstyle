<?php

namespace Northstyle\Module\Content\Model;

use Baum\Node;

class Page extends Node
{
    protected $fillable = ['title', 'name', 'uri', 'content', 'template'];

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

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = $value ? $value : null;
    }

    public function setTemplateAttribute($value)
    {
        $this->attributes['template'] = $value ? $value : null;
    }

	public function scopePublishedDesc($query) {
		$query->orderBy('published_at','desc');

		return $query;
	}

	public function scopeVisible($query) {
		$query->where('hidden', false);

		return $query;
	}
}
