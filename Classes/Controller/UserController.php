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

/**
 * UserController
 */
class UserController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController {

	/**
	 * userRepository
	 *
	 * @var \RGJL\HotelBooking\Domain\Repository\UserRepository
	 * @inject
	 */
	protected $userRepository = NULL;

	/**
	 * action list
	 *
	 * @return void
	 */
	public function listAction() {
		$users = $this->userRepository->findAll();
		$this->view->assign('users', $users);
	}

	/**
	 * action show
	 *
	 * @param \RGJL\HotelBooking\Domain\Model\User $user
	 * @return void
	 */
	public function showAction(\RGJL\HotelBooking\Domain\Model\User $user) {
		$this->view->assign('user', $user);
	}

	/**
	 * action new
	 *
	 * @param \RGJL\HotelBooking\Domain\Model\User $newUser
	 * @ignorevalidation $newUser
	 * @return void
	 */
	public function newAction(\RGJL\HotelBooking\Domain\Model\User $newUser = NULL) {
		$this->view->assign('newUser', $newUser);
	}

	/**
	 * action create
	 *
	 * @param \RGJL\HotelBooking\Domain\Model\User $newUser
	 * @return void
	 */
	public function createAction(\RGJL\HotelBooking\Domain\Model\User $newUser) {
		$this->addFlashMessage('The object was created. Please be aware that this action is publicly accessible unless you implement an access check. See <a href="http://wiki.typo3.org/T3Doc/Extension_Builder/Using_the_Extension_Builder#1._Model_the_domain" target="_blank">Wiki</a>', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::ERROR);
		$this->userRepository->add($newUser);
		$this->redirect('list');
	}

	/**
	 * action edit
	 *
	 * @param \RGJL\HotelBooking\Domain\Model\User $user
	 * @ignorevalidation $user
	 * @return void
	 */
	public function editAction(\RGJL\HotelBooking\Domain\Model\User $user) {
		$this->view->assign('user', $user);
	}

	/**
	 * action update
	 *
	 * @param \RGJL\HotelBooking\Domain\Model\User $user
	 * @return void
	 */
	public function updateAction(\RGJL\HotelBooking\Domain\Model\User $user) {
		$this->addFlashMessage('The object was updated. Please be aware that this action is publicly accessible unless you implement an access check. See <a href="http://wiki.typo3.org/T3Doc/Extension_Builder/Using_the_Extension_Builder#1._Model_the_domain" target="_blank">Wiki</a>', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::ERROR);
		$this->userRepository->update($user);
		$this->redirect('list');
	}

	/**
	 * action delete
	 *
	 * @param \RGJL\HotelBooking\Domain\Model\User $user
	 * @return void
	 */
	public function deleteAction(\RGJL\HotelBooking\Domain\Model\User $user) {
		$this->addFlashMessage('The object was deleted. Please be aware that this action is publicly accessible unless you implement an access check. See <a href="http://wiki.typo3.org/T3Doc/Extension_Builder/Using_the_Extension_Builder#1._Model_the_domain" target="_blank">Wiki</a>', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::ERROR);
		$this->userRepository->remove($user);
		$this->redirect('list');
	}

}