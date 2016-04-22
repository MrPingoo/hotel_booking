<?php
namespace RGJL\HotelBooking\Controller;

/***************************************************************
 *
 *  Copyright notice
 *
 *  (c) 2015 Renan Gautier <rg.gloumi@gmail.com>
 *           Julian Layen <layenjulian@gmail.com>
 *
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/
use TYPO3\CMS\Extbase\Utility\DebuggerUtility;

/**
 * RentController
 */
class RentController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController {

	/**
	 * rentRepository
	 *
	 * @var \RGJL\HotelBooking\Domain\Repository\RentRepository
	 * @inject
	 */
	protected $rentRepository = NULL;

	/**
	 * bookingRepository
	 *
	 * @var \RGJL\HotelBooking\Domain\Repository\BookingRepository
	 * @inject
	 */
	protected $bookingRepository = NULL;

	/**
	 * action list
	 *
	 * @param RGJL\HotelBooking\Domain\Model\Rent
	 * @return void
	 */
	public function listAction() {
		$rents = $this->rentRepository->findAll();
		$this->view->assign('rents', $rents);
	}

	/**
	 * @param string $action Target action
	 * @param array $arguments Arguments
	 * @param string $controller Target controller. If NULL current controllerName is used
	 * @param string $extensionName Target Extension Name (without "tx_" prefix and no underscores). If NULL the current extension name is used
	 * @param string $pluginName Target plugin. If empty, the current plugin name is used
	 * @param int $pageUid target page. See TypoLink destination
	 * @param int $pageType type of the target page. See typolink.parameter
	 * @param bool $noCache set this to disable caching for the target page. You should not need this.
	 * @param bool $noCacheHash set this to suppress the cHash query parameter created by TypoLink. You should not need this.
	 * @param string $section the anchor to be added to the URI
	 * @param string $format The requested format, e.g. ".html
	 * @param bool $linkAccessRestrictedPages If set, links pointing to access restricted pages will still link to the page even though the page cannot be accessed.
	 * @param array $additionalParams additional query parameters that won't be prefixed like $arguments (overrule $arguments)
	 * @param bool $absolute If set, the URI of the rendered link is absolute
	 * @param bool $addQueryString If set, the current query parameters will be kept in the URI
	 * @param array $argumentsToBeExcludedFromQueryString arguments to be removed from the URI. Only active if $addQueryString = TRUE
	 * @param string $addQueryStringMethod Set which parameters will be kept. Only active if $addQueryString = TRUE
	 * @return string Rendered link
	 */
	public function createUri($action = NULL, array $arguments = array(), $controller = NULL, $extensionName = NULL, $pluginName = NULL, $pageUid = NULL, $pageType = 0, $noCache = FALSE, $noCacheHash = FALSE, $section = '', $format = '', $linkAccessRestrictedPages = FALSE, array $additionalParams = array(), $absolute = FALSE, $addQueryString = FALSE, array $argumentsToBeExcludedFromQueryString = array(), $addQueryStringMethod = NULL) {
		$uriBuilder = $this->controllerContext->getUriBuilder();
		$uri = $uriBuilder->reset()->setTargetPageUid($pageUid)->setTargetPageType($pageType)->setNoCache($noCache)->setUseCacheHash(!$noCacheHash)->setSection($section)->setFormat($format)->setLinkAccessRestrictedPages($linkAccessRestrictedPages)->setArguments($additionalParams)->setCreateAbsoluteUri($absolute)->setAddQueryString($addQueryString)->setArgumentsToBeExcludedFromQueryString($argumentsToBeExcludedFromQueryString)->setAddQueryStringMethod($addQueryStringMethod)->uriFor($action, $arguments, $controller, $extensionName, $pluginName);
		return $uri;
	}

	/**
	 * action show
	 *
	 * @param RGJL\HotelBooking\Domain\Model\Rent
	 * @return void
	 */
	public function showAction(\RGJL\HotelBooking\Domain\Model\Rent $rent) {
		$bookings = $this->bookingRepository->findByUidForeign($rent->getUid());
		$this->view->assign('rent', $rent);
		$this->view->assign('bookings', $bookings);
		$json = array();
		$i = 0;
		foreach ($bookings as $booking) {
			// Uri of bookings
			$uri = $this->createUri('show',array('booking' => $booking), 'Booking', NULL, NULL,  intval($GLOBALS['TSFE']->id));
			$json[$i]['url'] = $uri;
			$json[$i]['title'] = $rent->getName();
			$date = new \DateTime($booking->getBeginDate());
			$json[$i]['start'] = $date->format('Y-m-d').'T12:00:00';
			$date = new \DateTime($booking->getEndDate());
			$json[$i]['end'] = $date->format('Y-m-d').'T12:00:00';
			$i++;
		}
		$this->view->assign('json', json_encode($json));

	}

	/**
	 * action new
	 *
	 * @param RGJL\HotelBooking\Domain\Model\Rent
	 * @ignorevalidation $newRent
	 * @return void
	 */
	public function newAction(\RGJL\HotelBooking\Domain\Model\Rent $newRent = NULL) {
		$this->view->assign('newRents', $newRent);
	}

	/**
	 * action create
	 *
	 * @param RGJL\HotelBooking\Domain\Model\Rent
	 * @return void
	 */
	public function createAction(\RGJL\HotelBooking\Domain\Model\Rent $newRent) {
//		$this->addFlashMessage('The object was created. Please be aware that this action is publicly accessible unless you implement an access check. See <a href="http://wiki.typo3.org/T3Doc/Extension_Builder/Using_the_Extension_Builder#1._Model_the_domain" target="_blank">Wiki</a>', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::ERROR);
		$this->rentRepository->add($newRent);
		$this->redirect('list');
	}

	/**
	 * action edit
	 *
	 * @param RGJL\HotelBooking\Domain\Model\Rent
	 * @ignorevalidation $rent
	 * @return void
	 */
	public function editAction(\RGJL\HotelBooking\Domain\Model\Rent $rent) {
		$this->view->assign('rent', $rent);
	}

	/**
	 * action update
	 *
	 * @param RGJL\HotelBooking\Domain\Model\Rent
	 * @return void
	 */
	public function updateAction(\RGJL\HotelBooking\Domain\Model\Rent $rent) {
		$this->addFlashMessage('The object was updated. Please be aware that this action is publicly accessible unless you implement an access check. See <a href="http://wiki.typo3.org/T3Doc/Extension_Builder/Using_the_Extension_Builder#1._Model_the_domain" target="_blank">Wiki</a>', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::ERROR);
		$this->rentRepository->update($rent);
		$this->redirect('list');
	}

	/**
	 * action delete
	 *
	 * @param RGJL\HotelBooking\Domain\Model\Rent
	 * @return void
	 */
	public function deleteAction(\RGJL\HotelBooking\Domain\Model\Rent $rent) {
		$this->addFlashMessage('The object was deleted. Please be aware that this action is publicly accessible unless you implement an access check. See <a href="http://wiki.typo3.org/T3Doc/Extension_Builder/Using_the_Extension_Builder#1._Model_the_domain" target="_blank">Wiki</a>', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::ERROR);
		$this->rentRepository->remove($rent);
		$this->redirect('list');
	}

	/**
	 * action show
	 *
	 * @param RGJL\HotelBooking\Domain\Model\Rent
	 * @return void
	 */
	public function frontAction() {
		$rent = $this->rentRepository->findByUid($this->settings['flexform_rent']);
		$bookings = $this->bookingRepository->findByUidForeign($this->settings['flexform_rent']);
		$this->view->assign('rent', $rent);
		$this->view->assign('bookings', $bookings);
		$json = array();
		$i = 0;
		foreach ($bookings as $booking) {
			$json[$i]['title'] = $rent->getName();
			$date = new \DateTime($booking->getBeginDate());
			$json[$i]['start'] = $date->format('Y-m-d').'T12:00:00';
			$date = new \DateTime($booking->getEndDate());
			$json[$i]['end'] = $date->format('Y-m-d').'T12:00:00';
			$i++;
		}
		$this->view->assign('json', json_encode($json));

	}

	/**
	 * Will get the values from plugin.tx_exlpagesutilities_pageslist.settings.sorting_options
	 * and return an array which can be used for the flexform options field.
	 *
	 * @param array	$params
	 */
	public function getOptionsForFlexform(&$params) {

		$res = $GLOBALS['TYPO3_DB']->exec_SELECTquery('uid, name', 'tx_hotelbooking_domain_model_rent', 'hidden=0 AND deleted=0');

		while ($row = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($res)) {
			$options[$row['name']] = array($row['name'], $row['uid']);
		}

		asort($options);

		$params['items'] = $options;

	}

	/**
	 * action all
	 *
	 * @return void
	 */
	public function allAction() {
		$bookings = $this->bookingRepository->findAll();
		$rents = $this->rentRepository->findAll();
		$this->view->assign('rents', $rents);
		$this->view->assign('bookings', $bookings);
		$json = array();
		$i = 0;
		/** @var \RGJL\HotelBooking\Domain\Model\Rent $rent */
		foreach ($rents as $rent){
			$bookings = $this->bookingRepository->findByUidForeign($rent->getUid());
			foreach ($bookings as $booking) {
				// Uri of bookings
				$uri = $this->createUri('show',array('booking' => $booking), 'Booking', NULL, NULL,  intval($GLOBALS['TSFE']->id));
				$json[$i]['url'] = $uri;
				$date = new \DateTime($booking->getBeginDate());
				$json[$i]['title'] = $rent->getName();
				$json[$i]['start'] = $date->format('Y-m-d').'T12:00:00';
				$date = new \DateTime($booking->getEndDate());
				$json[$i]['end'] = $date->format('Y-m-d').'T12:00:00';
				$i++;
			}
		}

		$this->view->assign('json', json_encode($json));

	}

}