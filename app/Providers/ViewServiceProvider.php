<?php

namespace Northstyle\Providers;

use Northstyle\View\Composers;
use Illuminate\Support\ServiceProvider;
use Northstyle\View\ThemeViewFinder;

use Illuminate\Support\ServiceProvider as IlluminateServiceProvider;

class ViewServiceProvider extends IlluminateServiceProvider {
	public function register() {
        $this->app->singleton('theme.finder',function($app){

            $finder = new ThemeViewFinder($app['files'],$app['config']['view.paths']);
            $config = $app['config']['cms.theme'];
            $finder->setBasePath($app['path.public'].'/'.$config['folder']);
            $finder->setActiveTheme($config['active']);
            return $finder;
        });
	}

	public function boot() {
        $this->app['view']->composer(['layouts.auth','layouts.backend'],Composers\AddStatusMessage::class);
        $this->app['view']->composer('layouts.backend',Composers\AddAdminUser::class);
        $this->app['view']->composer('layouts.frontend',Composers\InjectPages::class);
		$this->app['view']->composer('*', \Northstyle\Composer\Dashboard::class);
		$this->app['view']->composer('*', \Northstyle\Composer\LanguagesDropdown::class);
		$this->app['view']->composer('*', \Northstyle\Module\Content\Composer\PaddedPageTitleDropdownOptions::class);
		$this->app['view']->composer('*', \Northstyle\Module\Shop\Composer\AccessibleStoresDropdownOptions::class);

        $this->app['view']->setFinder($this->app['theme.finder']);

		$this->app['view']->share('linkToPaddedTitle', function($pageDO, $link) {
			$helper = new \Northstyle\Module\Content\Helper\LinkToPaddedTitle();

			return $helper->linkToPaddedTitle($pageDO, $link);
		});
	}
}