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
 * Price
 */
class Price extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity {

	/**
	 * beginDate
	 *
	 * @var \DateTime
	 */
	protected $beginDate = NULL;

	/**
	 * endDate
	 *
	 * @var \DateTime
	 */
	protected $endDate = NULL;

	/**
	 * dayPrice
	 *
	 * @var float
	 */
	protected $dayPrice = 0.0;

	/**
	 * weekPrice
	 *
	 * @var float
	 */
	protected $weekPrice = 0.0;

	/**
	 * uidForeign
	 *
	 * @var \RGJL\HotelBooking\Domain\Model\Rent
	 */
	protected $uidForeign = NULL;

	/**
	 * Returns the beginDate
	 *
	 * @return \DateTime $beginDate
	 */
	public function getBeginDate() {
		return $this->beginDate;
	}

	/**
	 * Sets the beginDate
	 *
	 * @param \DateTime $beginDate
	 * @return void
	 */
	public function setBeginDate(\DateTime $beginDate) {
		$this->beginDate = $beginDate;
	}

	/**
	 * Returns the endDate
	 *
	 * @return \DateTime $endDate
	 */
	public function getEndDate() {
		return $this->endDate;
	}

	/**
	 * Sets the endDate
	 *
	 * @param \DateTime $endDate
	 * @return void
	 */
	public function setEndDate(\DateTime $endDate) {
		$this->endDate = $endDate;
	}

	/**
	 * Returns the dayPrice
	 *
	 * @return float $dayPrice
	 */
	public function getDayPrice() {
		return $this->dayPrice;
	}

	/**
	 * Sets the dayPrice
	 *
	 * @param float $dayPrice
	 * @return void
	 */
	public function setDayPrice($dayPrice) {
		$this->dayPrice = $dayPrice;
	}

	/**
	 * Returns the weekPrice
	 *
	 * @return float $weekPrice
	 */
	public function getWeekPrice() {
		return $this->weekPrice;
	}

	/**
	 * Sets the weekPrice
	 *
	 * @param float $weekPrice
	 * @return void
	 */
	public function setWeekPrice($weekPrice) {
		$this->weekPrice = $weekPrice;
	}

	/**
	 * Returns the uidForeign
	 *
	 * @return \RGJL\HotelBooking\Domain\Model\Rent uidForeign
	 */
	public function getUidForeign() {
		return $this->uidForeign;
	}

	/**
	 * Sets the uidForeign
	 *
	 * @param \RGJL\HotelBooking\Domain\Model\Rent $uidForeign
	 * @return \RGJL\HotelBooking\Domain\Model\Rent uidForeign
	 */
	public function setUidForeign(\RGJL\HotelBooking\Domain\Model\Rent $uidForeign) {
		$this->uidForeign = $uidForeign;
	}

}