<?php
namespace RGJL\HotelBooking\Domain\Model;


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
 * Booking
 */
class Booking extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity {

	/**
	 * beginDate
	 *
	 * @var string
	 */
	protected $beginDate = NULL;

	/**
	 * title
	 *
	 * @var string
	 */
	protected $title = NULL;

	/**
	 * endDate
	 *
	 * @var string
	 */
	protected $endDate = NULL;

	/**
	 * price
	 *
	 * @var float
	 */
	protected $price = 0.0;

	/**
	 * uidForeign
	 *
	 * @var \RGJL\HotelBooking\Domain\Model\Rent
	 */
	protected $uidForeign = NULL;

	/**
	 * Returns the beginDate
	 *
	 * @return string $beginDate
	 */
	public function getBeginDate() {
		return $this->beginDate;
	}

	/**
	 * Sets the beginDate
	 *
	 * @param string $beginDate
	 * @return void
	 */
	public function setBeginDate($beginDate) {
		$this->beginDate = $beginDate;
	}

	/**
	 * Returns the endDate
	 *
	 * @return string $endDate
	 */
	public function getEndDate() {
		return $this->endDate;
	}

	/**
	 * Sets the endDate
	 *
	 * @param string $endDate
	 * @return void
	 */
	public function setEndDate($endDate) {
		$this->endDate = $endDate;
	}

	/**
	 * Returns the price
	 *
	 * @return float $price
	 */
	public function getPrice() {
		return $this->price;
	}

	/**
	 * Sets the price
	 *
	 * @param float $price
	 * @return void
	 */
	public function setPrice($price) {
		$this->price = $price;
	}

	/**
	 * Returns the uidForeign
	 *
	 * @return \RGJL\HotelBooking\Domain\Model\Rent $uidForeign
	 */
	public function getUidForeign() {
		return $this->uidForeign;
	}

	/**
	 * Sets the uidForeign
	 *
	 * @param \RGJL\HotelBooking\Domain\Model\Rent $uidForeign
	 * @return void
	 */
	public function setUidForeign(\RGJL\HotelBooking\Domain\Model\Rent $uidForeign) {
		$this->uidForeign = $uidForeign;
	}

	/**
	 * @return string
	 */
	public function getTitle()
	{
		return $this->title;
	}

	/**
	 * @param string $title
	 */
	public function setTitle($title)
	{
		$this->title = $title;
	}


}