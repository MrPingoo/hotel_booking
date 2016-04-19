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
 * Test case for class RGJL\HotelBooking\Controller\RentController.
 *
 * @author Renan Gautier <rg.gloumi@gmail.com>
 * @author Julian Layen <layenjulian@gmail.com>
 */
class RentControllerTest extends \TYPO3\CMS\Core\Tests\UnitTestCase {

	/**
	 * @var \RGJL\HotelBooking\Controller\RentController
	 */
	protected $subject = NULL;

	protected function setUp() {
		$this->subject = $this->getMock('RGJL\\HotelBooking\\Controller\\RentController', array('redirect', 'forward', 'addFlashMessage'), array(), '', FALSE);
	}

	protected function tearDown() {
		unset($this->subject);
	}

	/**
	 * @test
	 */
	public function listActionFetchesAllRentsFromRepositoryAndAssignsThemToView() {

		$allRents = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array(), array(), '', FALSE);

		$rentRepository = $this->getMock('RGJL\\HotelBooking\\Domain\\Repository\\RentRepository', array('findAll'), array(), '', FALSE);
		$rentRepository->expects($this->once())->method('findAll')->will($this->returnValue($allRents));
		$this->inject($this->subject, 'rentRepository', $rentRepository);

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$view->expects($this->once())->method('assign')->with('rents', $allRents);
		$this->inject($this->subject, 'view', $view);

		$this->subject->listAction();
	}

	/**
	 * @test
	 */
	public function showActionAssignsTheGivenRentToView() {
		$rent = new \RGJL\HotelBooking\Domain\Model\Rent();

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$this->inject($this->subject, 'view', $view);
		$view->expects($this->once())->method('assign')->with('rent', $rent);

		$this->subject->showAction($rent);
	}

	/**
	 * @test
	 */
	public function newActionAssignsTheGivenRentToView() {
		$rent = new \RGJL\HotelBooking\Domain\Model\Rent();

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$view->expects($this->once())->method('assign')->with('newRent', $rent);
		$this->inject($this->subject, 'view', $view);

		$this->subject->newAction($rent);
	}

	/**
	 * @test
	 */
	public function createActionAddsTheGivenRentToRentRepository() {
		$rent = new \RGJL\HotelBooking\Domain\Model\Rent();

		$rentRepository = $this->getMock('RGJL\\HotelBooking\\Domain\\Repository\\RentRepository', array('add'), array(), '', FALSE);
		$rentRepository->expects($this->once())->method('add')->with($rent);
		$this->inject($this->subject, 'rentRepository', $rentRepository);

		$this->subject->createAction($rent);
	}

	/**
	 * @test
	 */
	public function editActionAssignsTheGivenRentToView() {
		$rent = new \RGJL\HotelBooking\Domain\Model\Rent();

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$this->inject($this->subject, 'view', $view);
		$view->expects($this->once())->method('assign')->with('rent', $rent);

		$this->subject->editAction($rent);
	}

	/**
	 * @test
	 */
	public function updateActionUpdatesTheGivenRentInRentRepository() {
		$rent = new \RGJL\HotelBooking\Domain\Model\Rent();

		$rentRepository = $this->getMock('RGJL\\HotelBooking\\Domain\\Repository\\RentRepository', array('update'), array(), '', FALSE);
		$rentRepository->expects($this->once())->method('update')->with($rent);
		$this->inject($this->subject, 'rentRepository', $rentRepository);

		$this->subject->updateAction($rent);
	}

	/**
	 * @test
	 */
	public function deleteActionRemovesTheGivenRentFromRentRepository() {
		$rent = new \RGJL\HotelBooking\Domain\Model\Rent();

		$rentRepository = $this->getMock('RGJL\\HotelBooking\\Domain\\Repository\\RentRepository', array('remove'), array(), '', FALSE);
		$rentRepository->expects($this->once())->method('remove')->with($rent);
		$this->inject($this->subject, 'rentRepository', $rentRepository);

		$this->subject->deleteAction($rent);
	}
}
