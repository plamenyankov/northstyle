<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Presenters
    |--------------------------------------------------------------------------
    |
    | Define your objects and their corrosponding presenters here to have them
    | automatically decorated when resolved in a view. The array key should
    | be your object and the value will be the presenter. Remember to use
    | the class names and not actual instances.
    |
    */
    Northstyle\Page::class => Northstyle\Presenters\PagePresenter::class,
    Northstyle\Category::class => Northstyle\Presenters\PagePresenter::class,
    Northstyle\Post::class => Northstyle\Presenters\PostPresenter::class,
    Northstyle\Article::class => Northstyle\Presenters\ArticlePresenter::class,
    Northstyle\User::class => Northstyle\Presenters\UserPresenter::class,
];
