<?php
/**
 * Created by PhpStorm.
 * User: vipbs
 * Date: 17/12/2015
 * Time: 10:09
 */

namespace Northstyle\View;

use Illuminate\View\FileViewFinder;

class ThemeViewFinder extends FileViewFinder
{
    protected $activeTheme;
    protected $basePath;

    public function setBasePath($path){
        $this->basePath = $path;
    }

    public function setActiveTheme($theme){
        $this->activeTheme = $theme;

        array_unshift($this->paths,$this->basePath.'/'.$theme.'/views');
    }
}