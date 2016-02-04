<?php
/**
 * Created by PhpStorm.
 * User: vipbs
 * Date: 21/12/2015
 * Time: 21:53
 */

namespace Northstyle\Presenters;

use Lewis\Presenter\AbstractPresenter;
use League\CommonMark\CommonMarkConverter;

class ArticlePresenter extends AbstractPresenter
{
//    protected $markdown;

    /**
     * PostPresenter constructor.
     */
    public function __construct($object, CommonMarkConverter $markdown)
    {
        $this->markdown = $markdown;
        parent::__construct($object);
    }

    public function bodyHtml(){
        return $this->content?$this->markdown->convertToHtml($this->content):null;
    }

    public function publishedDate()
    {

        if ($this->published_at) {
            return $this->published_at->toFormattedDateString();
        }
        return 'Not yet published';
    }

    public function publishedHighlight()
    {
        if ($this->published_at && $this->published_at->isFuture()) {
            return 'info';
        } elseif (!$this->published_at) {
            return 'warning';
        }
    }
}