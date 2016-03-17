<?php

namespace Northstyle\Common;

use \Illuminate\Support\Collection as Collection;

class Dashboard {
	protected $viewType = 'client';
	protected $viewLevel = '';
	protected $accessLevel = '';

    protected $currentChain = null;
    protected $currentStore = null;

    protected $accessibleStores = array();
	protected $accessibleChains = array();

	protected $storesCount = 0;

	protected $isWelcomePopupActive = false;

	public function isWelcomePopupActive() {
		return $this->isWelcomePopupActive;
	}

	public function activateWelcomePopup() {
		$this->isWelcomePopupActive = true;
	}

	public function setViewType($viewType) {
		$this->viewType = $viewType;
	}

	public function setViewLevel($viewLevel) {
		$this->viewLevel = $viewLevel;
	}

	public function setCurrentChain($chain) {
		$this->currentChain = $chain;
	}

	public function setCurrentStore($store) {
		$this->currentStore = $store;
	}

	public function setAccessibleStores(Collection $stores) {
		$this->accesssibleStores = $stores;
	}

	public function setAccessibleChains($chains) {
		$this->accessibleChains = $chains;
	}

	public function setStoresCount($storesCount) {
		$this->storesCount = $storesCount;
	}

	public function getViewType() {
		return $this->viewType;
	}

	public function getViewLevel() {
		return $this->viewLevel;
	}

	public function getCurrentChain()
	{
		return $this->currentChain;
	}

	public function getCurrentStore()
	{
		return $this->currentStore;
	}

	public function getAccessibleStores()
	{
		return $this->accessibleStores;
	}

	public function getAccessibleChains()
	{
		return $this->accessibleChains;
	}

	public function getStoresCount() {
		return $this->storesCount;
	}
}