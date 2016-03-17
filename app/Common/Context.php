<?php 

namespace Northstyle\Common;

use Illuminate\Foundation\Application as App;

class Context
{
	protected $app = null;

	protected $dashboard = null;

	protected $sourceEvent = null;

	public function __construct(App $app) {
		$this->app = $app;
	}

	public function setDashboard(Dashboard $dashboard) {
		$this->dashboard = $dashboard;
	}

	public function getAuthUser()
	{
		if (\Auth::check()) {
			return \Auth::user();
		}

		return null;
	}

	/**
	 * 
	 */
	public function isBusinessView() {
		if (!$this->dashboard) {
			return false;
		}

		return ($this->dashboard->getViewType() == 'business');
	}
	
	public function isClientView() {
		if (!$this->dashboard) {
			return false;
		}

		return ($this->dashboard->getViewType() == 'client');
	}
	
	public function isChainLevelView() {
		if (!$this->dashboard) {
			return false;
		}

		return ($this->isBusinessView() && $this->dashboard->getViewLevel() == 'chain');
	}
	
	public function isStoreLevelView() {
		if (!$this->dashboard) {
			return false;
		}

		return ($this->isBusinessView() && $this->dashboard->getViewLevel() == 'store');
	}

	public function getCurrentChain()
	{
		if (!$this->dashboard) {
			return null;
		}

		return $this->dashboard->getCurrentChain();
	}

	public function getCurrentStore()
	{
		if (!$this->dashboard) {
			return null;
		}

		return $this->dashboard->getCurrentStore();
	}

	public function isWelcomePopupActive() {
		if (!$this->dashboard) {
			return false;
		}

		return $this->dashboard->isWelcomePopupActive();
	}

	public function canAuthUserAddStore()
	{
		return $this->canAuthUserRemoveStore();
	}

	public function canAuthUserRemoveStore()
	{
		if (!$this->getAuthUser()) {
			return false;
		}
		
		if (!$this->isBusinessView()) {
			return false;
		}

		$authUser = \Auth::user();

		if (!$authUser->ownedChain) {
			return false;
		}

		if ($authUser->ownedChain->id != $this->dashboard->getCurrentChain()->id) {
			return false;
		}

		if ($this->isChainLevelView()) {
			return true;
		} else if ($this->isStoreLevelView()) {
			if ($this->dashboard->getCurrentChain()->stores->count() <= 1) {
				return true;
			}
		}

		return false;
	}

	public function canViewAllReports()
	{
		if (!$this->getAuthUser()) {
			return false;
		}

		if (!$this->canAuthUserManageBusinessEntity()) {
			return false;
		}

		return true;
	}

	public function canManageSystem()
	{
		$adminGuard = \Auth::driver('eloquent.admin');

		return $adminGuard->check();
	}

	public function isAuthClient()
	{
		if (!$this->getAuthUser()) {
			return false;
		}

		if ($this->getAuthUser()->ownedChain || $this->getAuthEmployment()) {
			return false;
		}

		return true;
	}

	public function canAuthAccessStore(\Store $store)
	{
		if ($this->getAuthUser()->ownedChain) {
			if ($store->chain->id == $this->getAuthUser()->ownedChain->id) {
				return true;
			}
		}

		foreach ($this->getAuthUser()->employments as $employment) {
			if ($store->id == $employment->store_id) {
				return true;
			}
		}

		return false;
	}

	public function canAuthUserUpgradeSubscriptionPackage()
	{
		if (!$this->isStoreLevelView()) {
			return false;
		}

		if (!$this->getAuthUser()) {
			return false;
		}

		$authUser = \Auth::user();

		if (!$this->canAuthManageCurrentStore()) {
			return false;
		}

		return true;
	}

	public function canAuthUserAddChain()
	{
		if (!$this->getAuthUser()) {
			return false;
		}

		$authUser = \Auth::user();

		/*
		if ($this->isStoreLevelView() && count($this->dashboard->getAccessibleStores()) > 1) {
			return false;
		}
		*/

		return true;
	}

	public function canAuthUserRemoveChain()
	{
		if (!$this->getAuthUser()) {
			return false;
		}

		$authUser = \Auth::user();

		if ($this->isStoreLevelView()) {
			return false;
		}

		return true;
	}

	public function canAuthViewOrder(\Order $order)
	{
		$acl = \App::make('Northstyle\Acl\CanViewOrder');
		return $acl->can($this->getAuthUser(), $order);
	}

	public function canAuthUploadCurrentStoreLogo()
	{
		if (!$this->isStoreLevelView()) {
			return false;
		}

		$acl = \App::make('Northstyle\Acl\CanUploadStoreLogo');
		return $acl->can($this->getAuthUser(), $this->dashboard->getCurrentStore());
	}

	public function canAuthUploadCurrentChainLogo()
	{
		if (!$this->isChainLevelView()) {
			return false;
		}

		$acl = \App::make('Northstyle\Acl\CanUploadChainLogo');
		return $acl->can($this->getAuthUser(), $this->dashboard->getCurrentChain());
	}

	/**
	 * Checks if authenticated user is employed and manages the current store.
	 * 
	 * @return boolean
	 * @throws Exception
	 */
	public function canAuthManageCurrentStore() {
		if (!$this->isBusinessView() || !$this->isStoreLevelView()) {
			return false;
		}

		if ($this->getAuthUser()->ownedChain) {
			if ($this->dashboard->getCurrentStore()->chain->id == $this->getAuthUser()->ownedChain->id) {
				return true;
			}
		}

		foreach ($this->getAuthUser()->employments as $employment) {
			if ($this->dashboard->getCurrentStore()->id == $employment->store_id) {
				if ($employment->is_manager) {
					return true;
				}
			}
		}

		return false;
	}

	public function canAuthUserManageBusinessEntity() {
		if (!$this->isBusinessView()) {
			return false;
		}

		if ($this->isStoreLevelView() && !$this->canAuthManageCurrentStore()) {
			return false;
		}

		if ($this->isChainLevelView() && $this->dashboard->getCurrentChain()->id != $this->getAuthUser()->ownedChain->id) {
			return false;
		}

		return true;
	}

	/**
	 * Here we check whether the AuthUser can revoke store access for a specific employee at a store.
	 */
	public function canAuthRevokeEmployeeStoreAccess(\StoreEmployee $employee)
	{
		if (!$this->isStoreLevelView()) {
			return;
		}

		$acl = \App::make('Northstyle\Acl\CanRevokeEmployeeStoreAccess');
		return $acl->can($this->getAuthUser(), $employee);
	}

	/**
	 * Here we check whether the AuthUser can revoke store access for any employee at a store.
	 */
	public function canAuthRevokeStoreAccess()
	{
		if (!$this->isStoreLevelView()) {
			return false;
		}

		$acl = \App::make('Northstyle\Acl\CanRevokeStoreAccess');
		return $acl->can($this->getAuthUser(), $this->dashboard->getCurrentStore());
	}

	public function canAuthAddManagerEmployee()
	{
		if (!$this->isStoreLevelView()) {
			return;
		}

		$acl = \App::make('Northstyle\Acl\CanAddManagerEmployee');
		return $acl->can($this->getAuthUser(), $this->dashboard->getCurrentStore());
	}

	/**
	 * Checks if authenticated user is employed at currently loaded store, but isn't a manager.
	 * 
	 * @return boolean
	 */
	public function isAuthBasicEmployeeInCurrentStore() {
		if (!$this->isStoreLevelView()) {
			return false;
		}

		if ($this->canAuthManageCurrentStore()) {
			return false;
		}

		foreach ($this->getAuthUser()->employments as $employment) {
			if ($this->dashboard->getCurrentStore()->id == $employment->store_id) {
				if (!$employment->is_manager) {
					return true;
				}
			}
		}

		return false;
	}

	public function isAuthOfferingServicesAtCurrentStore() {
		if (!$this->isStoreLevelView()) {
			return false;
		}

		foreach ($this->getAuthUser()->employments as $employment) {
			if ($this->dashboard->getCurrentStore()->id == $employment->store_id) {
				if ($employment->is_offering_services) {
					return true;
				}
			}
		}

		return false;
	}

	public function isAuthEmployedAtCurrentStore() {
		if (!$this->isStoreLevelView()) {
			return null;
		}

		foreach ($this->getAuthUser()->employments as $employment) {
			if ($this->dashboard->getCurrentStore()->id == $employment->store_id) {
				return true;
			}
		}

		return false;
	}
	
	public function getAuthEmployment()
	{
		if (!$this->isStoreLevelView()) {
			return null;
		}

		foreach ($this->getAuthUser()->employments as $employment) {
			if ($this->dashboard->getCurrentStore()->id == $employment->store_id) {
				return $employment;
			}
		}

		return null;
	}

	public function isCurrentStoreExpired()
	{
		if (!$this->isStoreLevelView()) {
			return false;
		}

		$remainingDays = $this->getStoreSubscriptionRemainingDays($this->getCurrentStore());

		if ($remainingDays <= 0) {
			return true;
		}

		return false;
	}

	public function hasStoreSubscriptionExpired(\Store $store) {
		if (new \DateTime($store->c_expire_date) < new \DateTime()) {
			return true;
		} else {
			return false;
		}
	}

	public function isStoreInTrialPeriod(\Store $store) {
		if (!$store->c_package_id && date('Y-m-d') < date('Y-m-d', strtotime("+1 month", strtotime($store->created_at)))) {
			return true;
		}

		return false;		
	}

	public function isCurrentStoreInTrialPeriod() {
		if (!$this->isStoreLevelView()) {
			return false;
		}

		$store = $this->getCurrentStore();

		return $this->isStoreInTrialPeriod($store);
	}

	public function isStoreInPredeletionPeriod(\Store $store) {
		$interval = $store->c_expire_date->diff(new \DateTime());
		
		$diff = $interval->format('%m');

		if($diff < 2) {
			return true;
		}

		return false;
	}

	public function getCurrentBusinessEntityPublicPageUrl() {
		if (!$this->isBusinessView()) {
			return '';
		}

		if ($this->isChainLevelView()) {
			return \URL::to($this->dashboard->getCurrentChain()->b_slug);
		} else if ($this->isStoreLevelView()) {
			return $this->getStorePublicPageURL($this->dashboard->getCurrentStore());
		}
	}

	public function isDashboard()
	{
		return ($this->dashboard != null);
	}

	public function isDashboardCalendar()
	{
		return (!strcmp(\Route::currentRouteName(), 'calendar'));
	}

	public function isAddServiceScreen()
	{
		return (\Route::currentRouteName() == 'addServicePage');
	}

	public function isEditServiceScreen()
	{
		return (\Route::currentRouteName() == 'editServicePage');
	}

	public function isEditGeneralInfoSettingsScreen()
	{
		return (\Route::currentRouteName() == 'settingsBusinessInfo');
	}

	public function isFrontChainScreen() {
		return (
			\Route::currentRouteName() == 'brand'
		);
	}

	public function isFrontStoreScreen() {
		return (
			\Route::currentRouteName() == 'businessFront'
		);
	}

	public function isViewStoreSubscriptionOrderScreen()
	{
		return (\Route::currentRouteName() == 'settingsSubscriptionsOrdersView');
	}

	public function isViewMarketingMailScreen()
	{
		$route = \Route::currentRouteName();

		return ($route == 'marketingMail');
	}

	public function isComposeMarketingMailScreen()
	{
		$flag = false;
		$route = \Route::currentRouteName();

		if ($route == 'marketingMailTemplates') {
			$flag = true;
		}

		if ($route == 'postMarketingMailTemplates') {
			$flag = true;
		}

		if ($route == 'marketingMailCompose') {
			$flag = true;
		}

		if ($route == 'marketingMailComposePost') {
			$flag = true;
		}

		if ($route == 'marketingMailComposeTo') {
			$flag = true;
		}

		if ($route == 'marketingMailComposeToPost') {
			$flag = true;
		}

		if ($route == 'marketingMailView') {
			$flag = true;
		}

		if ($route == 'marketingMailSend') {
			$flag = true;
		}

		if ($route == 'marketingMailSendTest') {
			$flag = true;
		}

		if ($route == 'marketingMailSendRemove') {
			$flag = true;
		}

		return $flag;
	}

	public function isTestPopupScreen() {
		$route = \Route::currentRouteName();

		if ($route == 'testPopup') {
			return true;
		}

		return false;
	}

	public function requireFacebookSdk() {
		return ($this->isWelcomePopupActive());
	}

	public function requireTwitterWidgets() {
		return ($this->isWelcomePopupActive());
	}

	public function requireGooglePlusSdk() {
		return ($this->isWelcomePopupActive());
	}

	public function requireGoogleMaps()
	{
		return (
			$this->isEditGeneralInfoSettingsScreen() || 
			$this->isFrontStoreScreen() || 
			$this->isViewStoreSubscriptionOrderScreen() || 
			$this->isBusinessRegistrationAboutBusinessStep() ||
			$this->isBusinessRegistrationStoresStep() ||
			$this->isTestPopupScreen()
		);
	}

	public function requireEasypayJs()
	{
		return ($this->isViewStoreSubscriptionOrderScreen() || $this->isTestPopupScreen());
	}

	public function getStorePublicPageURL(\Store $store, $parameters = array())
	{
		$helper = \App::make('Northstyle\Helper\StoreFrontPageURL');

		return $helper->generate($store, $parameters);
	}

	public function getChainPublicPageURL(\Chain $chain) {
		$helper = \App::make('Northstyle\Helper\ChainFrontPageURL');

		return $helper->generate($chain);
	}

	public function getCurrentEntitySocialShareName() {
		if (!$this->isBusinessView()) {
			return '/';
		}

		$authUser = $this->getAuthUser();

		if ($this->isMultistoreChain()) {
			$chain = $this->dashboard->getCurrentChain();

			return $chain->b_name;
		} else {
			$store = $this->dashboard->getCurrentStore();

			return $store->c_name;
		}
	}

	public function getCurrentEntitySocialShareURL() {
		if (!$this->isBusinessView()) {
			return '/';
		}

		$authUser = $this->getAuthUser();

		if ($this->isMultistoreChain()) {
			$chain = $this->dashboard->getCurrentChain();

			return $this->getChainPublicPageURL($chain);
		} else {
			$store = $this->dashboard->getCurrentStore();

			return $this->getStorePublicPageURL($store);
		}
	}

	public function isMultistoreChain() {
		if (!$this->isBusinessView()) {
			return false;
		}

		if ($this->dashboard->getCurrentChain()->b_slug) {
			return true;
		} else {
			return false;
		}
	}

	public function getCurrentEntityURL()
	{
		if (!$this->isBusinessView()) {
			return '/';
		}

		if ($this->isChainLevelView()) {
			if (!$this->dashboard->getCurrentChain()->b_slug) {
				return '/dashboard';
			}

			return '/' . $this->dashboard->getCurrentChain()->b_slug;
		} else if ($this->isStoreLevelView()) {
			$store = $this->dashboard->getCurrentStore();

			return $this->getStorePublicPageURL($store);
		}
	}

	public function getCurrentEntityEditURL()
	{
		return $this->getCurrentEntityURL() . '/edit';
	}

	public function getEmployeeAvatarURL($employee, $size = 'l', $previewFilename = '')
	{
		$defaultImageURL = \URL::to('assets/img/icons/svg/avatar-' . $size . '.svg');

		if ($previewFilename) {
			return \URL::to('uploads/previews/' . $previewFilename);
		}

		if (!$employee) {
			return $defaultImageURL;
		}

		if ($employee->avatar) {
			return 'uploads/profiles/' . $size . '/' . $employee->id . '/' . $employee->avatar;
		} else {
			return $defaultImageURL;
		}
	}

	public function getUserUploadAvatarURL($user, $previewFilename = '')
	{
		$defaultImageURL = \URL::to('assets/img/add_image.png');

		if ($previewFilename) {
			return \URL::to('uploads/previews/' . $previewFilename);
		}

		if (!$user) {
			return $defaultImageURL;
		}

		if ($user->u_avatar) {
			return 'uploads/users/l/' . $user->id . '/' . $user->u_avatar;
		} else {
			return $defaultImageURL;
		}
	}

	public function getUserAvatarURL($user, $size = 'l', $defaultImageURL = '')
	{
		if (!$defaultImageURL) {
			$defaultImageURL = \URL::to('assets/img/icons/svg/avatar-' . $size . '.svg');
		}

		if (!$user) {
			return $defaultImageURL;
		}

		if ($user->u_avatar) {
			return \URL::to('uploads/users/' . $size . '/' . $user->id . '/' . $user->u_avatar);
		} else {
			return $defaultImageURL;
		}
	}

	public function getChainLogoURL($chain, $size = 'm') {
		$nologoUrl = 'assets/img/icons/svg/business.svg';

		if (!$chain->b_logo) {
			$logoUrl = $nologoUrl;
		} else {
			if (file_exists(base_path() . '/public/uploads/chain/' . $size . '/' . $chain->id . '/' . $chain->b_logo)) {
				$logoUrl = 'uploads/chain/' . $size . '/' . $chain->id . '/' . $chain->b_logo;
			} else {
				$logoUrl = $nologoUrl;
			}
		}

		return $logoUrl;
	}

	public function getStoreLogoURL($store, $size = 'm')
	{
		$nologoUrl = 'assets/img/icons/svg/business.svg';

		if (!$store->c_logo) {
			$logoUrl = $nologoUrl;
		} else {
			if (file_exists(base_path() . '/public/uploads/stores/' . $size . '/' . $store->id . '/' . $store->c_logo)) {
				$logoUrl = 'uploads/stores/' . $size . '/' . $store->id . '/' . $store->c_logo;
			} else {
				$logoUrl = $nologoUrl;
			}
		}

		return $logoUrl;
	}

	public function getCurrentBusinessEntityLogoURL($size = 'm')
	{
		$nologoUrl = 'uploads/stores/no-image-chain.png';

		if (!$this->isBusinessView()) {
			return $nologoUrl;
		}

		if ($this->isStoreLevelView()) {
			return $this->getStoreLogoURL($this->getCurrentStore(), $size);
		} else if ($this->isChainLevelView()) {
			return 'uploads/business/' . $size . '/' . $this->dashboard->getCurrentChain()->id . '/' . $this->dashboard->getCurrentChain()->b_logo;
		}
	}
	
	public function getStorePromotionLogoURL(\StorePromotion $storePromotion, $size = 'm')
	{
		if ($storePromotion->p_image) {
			return \URL::to('uploads/promotions/' . $size . '/' . $storePromotion->id . '/' . $storePromotion->p_image);
		} else {
			if ($storePromotion->isActive()) {
				return \URL::to('assets/img/icons/svg/noimage-promo.svg');
			} else {
				return \URL::to('assets/img/icons/svg/noimage-promo-inactive.svg');
			}
		}
	}

	public function getStoreGalleryImageURL($storeImage, $size = 'xxxl') {
		return \URL::to('uploads/stores/' . $size . '/' . $storeImage->store_id . '/' . $storeImage['g_image']);
	}

	public function isBusinessRegistrationScreen() {
		$flag = false;
		$route = \Route::currentRouteName();

		if ($route == 'registerAboutYou') {
			$flag = true;
		}

		if ($route == 'registerAboutBussiness') {
			$flag = true;
		}

		if ($route == 'registerObjectsBussiness') {
			$flag = true;
		}

		if ($route == 'registerBusinessStore') {
			$flag = true;
		}

		if ($route == 'registerEmployees') {
			$flag = true;
		}

		if ($route == 'registerAddServices') {
			$flag = true;
		}

		return $flag;
	}

	public function isBusinessRegistrationAboutYouStep() {
		$currentRouteName = \Route::currentRouteName();

		if ($currentRouteName == 'registerAboutYou') {
			return true;
		}

		return false;
	}

	public function isBusinessRegistrationAboutBusinessStep() {
		$currentRouteName = \Route::currentRouteName();

		if ($currentRouteName == 'registerAboutBussiness' || $currentRouteName == 'registerAboutSmallBussiness') {
			return true;
		}

		return false;
	}

	public function isBusinessRegistrationStoresStep() {
		$currentRouteName = \Route::currentRouteName();

		if ($currentRouteName == 'registerObjectsBussiness') {
			return true;
		}

		return false;
	}

	public function isBusinessRegistrationEmployeesStep() {
		$currentRouteName = \Route::currentRouteName();

		if ($currentRouteName == 'registerEmployees') {
			return true;
		}

		return false;
	}

	public function isBusinessRegistrationServicesStep() {
		$currentRouteName = \Route::currentRouteName();

		if ($currentRouteName == 'registerServices') {
			return true;
		}

		return false;
	}

	public function getStoreSubscriptionRemainingDays(\Store $store)
	{
		return $store->calculateSubscriptionRemainingDays();
	}

	public function setSourceEvent($sourceEvent)
	{
		$this->sourceEvent = $sourceEvent;
	}

	public function hasSourceEvent()
	{
		return ($this->sourceEvent != null);
	}

	public function getSourceEvent()
	{
		return $this->sourceEvent;
	}
}