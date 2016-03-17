<?php

namespace Northstyle\Widgets;

use Arrilot\Widgets\AbstractWidget;

use Northstyle\Module\Content\Model\Post;

class RecentNews extends AbstractWidget
{

    /**
     * The configuration array.
     *
     * @var array
     */
    protected $config = ['posts' => ['title' => 'First']];
    protected $posts = ['title' => 'First'];

    /**
     * Treat this method as a controller action.
     * Return view() or other content to display.
     */
    public function run(Post $post)
    {
        $posts = $post->get()->all();

        return view("widgets.recent_news", compact('posts'));
    }
}