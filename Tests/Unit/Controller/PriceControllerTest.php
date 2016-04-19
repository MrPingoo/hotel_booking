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
 * Test case for class RGJL\HotelBooking\Controller\PriceController.
 *
 * @author Renan Gautier <rg.gloumi@gmail.com>
 * @author Julian Layen <layenjulian@gmail.com>
 */
class PriceControllerTest extends \TYPO3\CMS\Core\Tests\UnitTestCase {

	/**
	 * @var \RGJL\HotelBooking\Controller\PriceController
	 */
	protected $subject = NULL;

	protected function setUp() {
		$this->subject = $this->getMock('RGJL\\HotelBooking\\Controller\\PriceController', array('redirect', 'forward', 'addFlashMessage'), array(), '', FALSE);
	}

	protected function tearDown() {
		unset($this->subject);
	}

	/**
	 * @test
	 */
	public function listActionFetchesAllPricesFromRepositoryAndAssignsThemToView() {

		$allPrices = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array(), array(), '', FALSE);

		$priceRepository = $this->getMock('RGJL\\HotelBooking\\Domain\\Repository\\PriceRepository', array('findAll'), array(), '', FALSE);
		$priceRepository->expects($this->once())->method('findAll')->will($this->returnValue($allPrices));
		$this->inject($this->subject, 'priceRepository', $priceRepository);

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$view->expects($this->once())->method('assign')->with('prices', $allPrices);
		$this->inject($this->subject, 'view', $view);

		$this->subject->listAction();
	}

	/**
	 * @test
	 */
	public function showActionAssignsTheGivenPriceToView() {
		$price = new \RGJL\HotelBooking\Domain\Model\Price();

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$this->inject($this->subject, 'view', $view);
		$view->expects($this->once())->method('assign')->with('price', $price);

		$this->subject->showAction($price);
	}

	/**
	 * @test
	 */
	public function newActionAssignsTheGivenPriceToView() {
		$price = new \RGJL\HotelBooking\Domain\Model\Price();

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$view->expects($this->once())->method('assign')->with('newPrice', $price);
		$this->inject($this->subject, 'view', $view);

		$this->subject->newAction($price);
	}

	/**
	 * @test
	 */
	public function createActionAddsTheGivenPriceToPriceRepository() {
		$price = new \RGJL\HotelBooking\Domain\Model\Price();

		$priceRepository = $this->getMock('RGJL\\HotelBooking\\Domain\\Repository\\PriceRepository', array('add'), array(), '', FALSE);
		$priceRepository->expects($this->once())->method('add')->with($price);
		$this->inject($this->subject, 'priceRepository', $priceRepository);

		$this->subject->createAction($price);
	}

	/**
	 * @test
	 */
	public function editActionAssignsTheGivenPriceToView() {
		$price = new \RGJL\HotelBooking\Domain\Model\Price();

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$this->inject($this->subject, 'view', $view);
		$view->expects($this->once())->method('assign')->with('price', $price);

		$this->subject->editAction($price);
	}

	/**
	 * @test
	 */
	public function updateActionUpdatesTheGivenPriceInPriceRepository() {
		$price = new \RGJL\HotelBooking\Domain\Model\Price();

		$priceRepository = $this->getMock('RGJL\\HotelBooking\\Domain\\Repository\\PriceRepository', array('update'), array(), '', FALSE);
		$priceRepository->expects($this->once())->method('update')->with($price);
		$this->inject($this->subject, 'priceRepository', $priceRepository);

		$this->subject->updateAction($price);
	}

	/**
	 * @test
	 */
	public function deleteActionRemovesTheGivenPriceFromPriceRepository() {
		$price = new \RGJL\HotelBooking\Domain\Model\Price();

		$priceRepository = $this->getMock('RGJL\\HotelBooking\\Domain\\Repository\\PriceRepository', array('remove'), array(), '', FALSE);
		$priceRepository->expects($this->once())->method('remove')->with($price);
		$this->inject($this->subject, 'priceRepository', $priceRepository);

		$this->subject->deleteAction($price);
	}
}
