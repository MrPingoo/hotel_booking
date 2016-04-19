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
 * Test case for class RGJL\HotelBooking\Controller\GitesController.
 *
 * @author Renan Gautier <rg.gloumi@gmail.com>
 * @author Julian Layen <layenjulian@gmail.com>
 */
class GitesControllerTest extends \TYPO3\CMS\Core\Tests\UnitTestCase {

	/**
	 * @var \RGJL\HotelBooking\Controller\GitesController
	 */
	protected $subject = NULL;

	protected function setUp() {
		$this->subject = $this->getMock('RGJL\\HotelBooking\\Controller\\GitesController', array('redirect', 'forward', 'addFlashMessage'), array(), '', FALSE);
	}

	protected function tearDown() {
		unset($this->subject);
	}

	/**
	 * @test
	 */
	public function listActionFetchesAllGitessFromRepositoryAndAssignsThemToView() {

		$allGitess = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array(), array(), '', FALSE);

		$gitesRepository = $this->getMock('RGJL\\HotelBooking\\Domain\\Repository\\GitesRepository', array('findAll'), array(), '', FALSE);
		$gitesRepository->expects($this->once())->method('findAll')->will($this->returnValue($allGitess));
		$this->inject($this->subject, 'gitesRepository', $gitesRepository);

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$view->expects($this->once())->method('assign')->with('gitess', $allGitess);
		$this->inject($this->subject, 'view', $view);

		$this->subject->listAction();
	}

	/**
	 * @test
	 */
	public function showActionAssignsTheGivenGitesToView() {
		$gites = new \RGJL\HotelBooking\Domain\Model\Gites();

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$this->inject($this->subject, 'view', $view);
		$view->expects($this->once())->method('assign')->with('gites', $gites);

		$this->subject->showAction($gites);
	}

	/**
	 * @test
	 */
	public function newActionAssignsTheGivenGitesToView() {
		$gites = new \RGJL\HotelBooking\Domain\Model\Gites();

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$view->expects($this->once())->method('assign')->with('newGites', $gites);
		$this->inject($this->subject, 'view', $view);

		$this->subject->newAction($gites);
	}

	/**
	 * @test
	 */
	public function createActionAddsTheGivenGitesToGitesRepository() {
		$gites = new \RGJL\HotelBooking\Domain\Model\Gites();

		$gitesRepository = $this->getMock('RGJL\\HotelBooking\\Domain\\Repository\\GitesRepository', array('add'), array(), '', FALSE);
		$gitesRepository->expects($this->once())->method('add')->with($gites);
		$this->inject($this->subject, 'gitesRepository', $gitesRepository);

		$this->subject->createAction($gites);
	}

	/**
	 * @test
	 */
	public function editActionAssignsTheGivenGitesToView() {
		$gites = new \RGJL\HotelBooking\Domain\Model\Gites();

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$this->inject($this->subject, 'view', $view);
		$view->expects($this->once())->method('assign')->with('gites', $gites);

		$this->subject->editAction($gites);
	}

	/**
	 * @test
	 */
	public function updateActionUpdatesTheGivenGitesInGitesRepository() {
		$gites = new \RGJL\HotelBooking\Domain\Model\Gites();

		$gitesRepository = $this->getMock('RGJL\\HotelBooking\\Domain\\Repository\\GitesRepository', array('update'), array(), '', FALSE);
		$gitesRepository->expects($this->once())->method('update')->with($gites);
		$this->inject($this->subject, 'gitesRepository', $gitesRepository);

		$this->subject->updateAction($gites);
	}

	/**
	 * @test
	 */
	public function deleteActionRemovesTheGivenGitesFromGitesRepository() {
		$gites = new \RGJL\HotelBooking\Domain\Model\Gites();

		$gitesRepository = $this->getMock('RGJL\\HotelBooking\\Domain\\Repository\\GitesRepository', array('remove'), array(), '', FALSE);
		$gitesRepository->expects($this->once())->method('remove')->with($gites);
		$this->inject($this->subject, 'gitesRepository', $gitesRepository);

		$this->subject->deleteAction($gites);
	}
}
