<?php
namespace MMA\Templates;
use Illuminate\View\View;
/**
 * Created by PhpStorm.
 * User: vipbs
 * Date: 20/12/2015
 * Time: 18:14
 */
abstract class AbstractTemplate
{
    protected $view;

    abstract public function prepare(View $view, array $parameters);

    public function getView(){
        return $this->view;
    }
}