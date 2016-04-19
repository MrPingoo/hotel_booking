<?php
namespace RGJL\HotelBooking\Tests\Unit\Controller;
/***************************************************************
 *  Copyright notice
 *
 *  (c) 2015 Renan Gautier <rg.gloumi@gmail.com>
 *  			Julian Layen <layenjulian@gmail.com>
 *  			
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 2 of the License, or
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

/**
 * Test case for class RGJL\HotelBooking\Controller\BookingController.
 *
 * @author Renan Gautier <rg.gloumi@gmail.com>
 * @author Julian Layen <layenjulian@gmail.com>
 */
class BookingControllerTest extends \TYPO3\CMS\Core\Tests\UnitTestCase {

	/**
	 * @var \RGJL\HotelBooking\Controller\BookingController
	 */
	protected $subject = NULL;

	protected function setUp() {
		$this->subject = $this->getMock('RGJL\\HotelBooking\\Controller\\BookingController', array('redirect', 'forward', 'addFlashMessage'), array(), '', FALSE);
	}

	protected function tearDown() {
		unset($this->subject);
	}

	/**
	 * @test
	 */
	public function listActionFetchesAllBookingsFromRepositoryAndAssignsThemToView() {

		$allBookings = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array(), array(), '', FALSE);

		$bookingRepository = $this->getMock('RGJL\\HotelBooking\\Domain\\Repository\\BookingRepository', array('findAll'), array(), '', FALSE);
		$bookingRepository->expects($this->once())->method('findAll')->will($this->returnValue($allBookings));
		$this->inject($this->subject, 'bookingRepository', $bookingRepository);

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$view->expects($this->once())->method('assign')->with('bookings', $allBookings);
		$this->inject($this->subject, 'view', $view);

		$this->subject->listAction();
	}

	/**
	 * @test
	 */
	public function showActionAssignsTheGivenBookingToView() {
		$booking = new \RGJL\HotelBooking\Domain\Model\Booking();

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$this->inject($this->subject, 'view', $view);
		$view->expects($this->once())->method('assign')->with('booking', $booking);

		$this->subject->showAction($booking);
	}

	/**
	 * @test
	 */
	public function newActionAssignsTheGivenBookingToView() {
		$booking = new \RGJL\HotelBooking\Domain\Model\Booking();

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$view->expects($this->once())->method('assign')->with('newBooking', $booking);
		$this->inject($this->subject, 'view', $view);

		$this->subject->newAction($booking);
	}

	/**
	 * @test
	 */
	public function createActionAddsTheGivenBookingToBookingRepository() {
		$booking = new \RGJL\HotelBooking\Domain\Model\Booking();

		$bookingRepository = $this->getMock('RGJL\\HotelBooking\\Domain\\Repository\\BookingRepository', array('add'), array(), '', FALSE);
		$bookingRepository->expects($this->once())->method('add')->with($booking);
		$this->inject($this->subject, 'bookingRepository', $bookingRepository);

		$this->subject->createAction($booking);
	}

	/**
	 * @test
	 */
	public function editActionAssignsTheGivenBookingToView() {
		$booking = new \RGJL\HotelBooking\Domain\Model\Booking();

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$this->inject($this->subject, 'view', $view);
		$view->expects($this->once())->method('assign')->with('booking', $booking);

		$this->subject->editAction($booking);
	}

	/**
	 * @test
	 */
	public function updateActionUpdatesTheGivenBookingInBookingRepository() {
		$booking = new \RGJL\HotelBooking\Domain\Model\Booking();

		$bookingRepository = $this->getMock('RGJL\\HotelBooking\\Domain\\Repository\\BookingRepository', array('update'), array(), '', FALSE);
		$bookingRepository->expects($this->once())->method('update')->with($booking);
		$this->inject($this->subject, 'bookingRepository', $bookingRepository);

		$this->subject->updateAction($booking);
	}

	/**
	 * @test
	 */
	public function deleteActionRemovesTheGivenBookingFromBookingRepository() {
		$booking = new \RGJL\HotelBooking\Domain\Model\Booking();

		$bookingRepository = $this->getMock('RGJL\\HotelBooking\\Domain\\Repository\\BookingRepository', array('remove'), array(), '', FALSE);
		$bookingRepository->expects($this->once())->method('remove')->with($booking);
		$this->inject($this->subject, 'bookingRepository', $bookingRepository);

		$this->subject->deleteAction($booking);
	}
}
