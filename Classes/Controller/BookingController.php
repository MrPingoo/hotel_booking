<?php
namespace RGJL\HotelBooking\Controller;


/***************************************************************
 *
 *  Copyright notice
 *
 *  (c) 2015 Renan Gautier <rg.gloumi@gmail.com>
 *           Julian Layen <layenjulian@gmail.com>
 *
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
 * BookingController
 */
class BookingController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController {

	/**
	 * bookingRepository
	 *
	 * @var \RGJL\HotelBooking\Domain\Repository\BookingRepository
	 * @inject
	 */
	protected $bookingRepository = NULL;

	/**
	 * rentRepository
	 *
	 * @var \RGJL\HotelBooking\Domain\Repository\RentRepository
	 * @inject
	 */
	protected $rentRepository = NULL;

	/**
	 * action list
	 *
	 * @return void
	 */
	public function listAction() {
		$bookings = $this->bookingRepository->findAll();
		$this->view->assign('bookings', $bookings);
	}


	/**
	 * action listByRent
	 *
	 * @return void
	 */
	public function listByRentAction() {
		$bookings = $this->bookingRepository->findByUidForeign($this->request->getArgument('rent'));

		$this->view->assign('bookings', $bookings);
	}

	/**
	 * action show
	 *
	 * @param \RGJL\HotelBooking\Domain\Model\Booking $booking
	 * @return void
	 */
	public function showAction(\RGJL\HotelBooking\Domain\Model\Booking $booking) {
		$this->view->assign('booking', $booking);
	}

	/**
	 * action new
	 *
	 * @param \RGJL\HotelBooking\Domain\Model\Booking $newBooking
	 * @ignorevalidation $newBooking
	 * @return void
	 */
	public function newAction(\RGJL\HotelBooking\Domain\Model\Booking $newBooking = NULL) {
		$newBooking = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('RGJL\HotelBooking\Domain\Model\Booking');
		$rent = $this->rentRepository->findByUid($this->request->getArgument('rent'));
		$newBooking->setUidForeign($rent);
		$this->view->assign('newBooking', $newBooking);
	}

	/**
	 * action create
	 *
	 * @return void
	 */
	public function createAction() {

		// Args
		$args = $this->request->getArguments();
		if (isset($args['newBooking']['rent'])){
			$args['newBooking']['uidForeign'] = $args['newBooking']['rent'];
		}
		/** @var \TYPO3\CMS\Extbase\Object\ObjectManager objectManager */
		$this->objectManager = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('TYPO3\\CMS\\Extbase\\Object\\ObjectManager');
		/** @var \RGJL\HotelBooking\Domain\Model\Booking $newBooking */
		$newBooking = $this->objectManager->get('RGJL\\HotelBooking\\Domain\\Model\\Booking');
		$newBooking->setTitle($args['newBooking']['title']);
		$newBooking->setPrice($args['newBooking']['price']);
		$date = \DateTime::createFromFormat('d/m/Y H:s', $args['newBooking']['beginDate'] . ' 12:00');
		$newBooking->setBeginDate($date->format('c'));
		$date = \DateTime::createFromFormat('d/m/Y H:s', $args['newBooking']['endDate'] . ' 12:00');
		$newBooking->setEndDate($date->format('c'));

		// Set rent
		$rent = $this->rentRepository->findByUid($args['newBooking']['uidForeign']);
		$newBooking->setUidForeign($rent);

		$this->addFlashMessage('Résérvation validée', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::OK);
		$this->bookingRepository->add($newBooking);

		if (isset($args['newBooking']['rent'])){
			$this->redirect('all', 'Rent', 'HotelBooking');
		}

		$this->redirect('show', 'Rent', 'HotelBooking', array( 'rent' => $newBooking->getUidForeign()));
	}

	/**
	 * action edit
	 *
	 * @param \RGJL\HotelBooking\Domain\Model\Booking $booking
	 * @ignorevalidation $booking
	 * @return void
	 */
	public function editAction(\RGJL\HotelBooking\Domain\Model\Booking $booking) {
		$this->view->assign('booking', $booking);
	}

	/**
	 * action update
	 *
	 * @param \RGJL\HotelBooking\Domain\Model\Booking $booking
	 * @return void
	 */
	public function updateAction(\RGJL\HotelBooking\Domain\Model\Booking $booking) {
		//$this->addFlashMessage('The object was updated. Please be aware that this action is publicly accessible unless you implement an access check. See <a href="http://wiki.typo3.org/T3Doc/Extension_Builder/Using_the_Extension_Builder#1._Model_the_domain" target="_blank">Wiki</a>', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::ERROR);
		$this->bookingRepository->update($booking);
		$this->redirect('show', 'Rent', 'HotelBooking', array( 'rent' => $booking->getUidForeign()));
	}

	/**
	 * action delete
	 *
	 * @param \RGJL\HotelBooking\Domain\Model\Booking $booking
	 * @return void
	 */
	public function deleteAction(\RGJL\HotelBooking\Domain\Model\Booking $booking) {
		$beforeRemove = $booking;
		//$this->addFlashMessage('The object was deleted. Please be aware that this action is publicly accessible unless you implement an access check. See <a href="http://wiki.typo3.org/T3Doc/Extension_Builder/Using_the_Extension_Builder#1._Model_the_domain" target="_blank">Wiki</a>', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::ERROR);
		$this->bookingRepository->remove($booking);
		$this->redirect('show', 'Rent', 'HotelBooking', array( 'rent' => $beforeRemove->getUidForeign()));
	}

}