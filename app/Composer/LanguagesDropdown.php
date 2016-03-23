<?php

namespace Northstyle\Composer;

use Northstyle\Module\Core\DataObject\Id;

use Northstyle\Module\Core\Repository\Language as LanguageRepository;

use Illuminate\Contracts\View\View;

class LanguagesDropdown {

	protected $languageRepository;

    /**
     * Create a new middleware instance.
     *
     * @param  Guard  $auth
     * @return void
     */
    public function __construct(LanguageRepository $languageRepository)
    {
		$this->languageRepository = $languageRepository;
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
		$languages = $this->languageRepository->findAll();

		$options = array();

		foreach ($languages as $language) {
			$options[$language->code] = $language->label;
		}

		$view->with('languagesOptions', $options);
    }
}