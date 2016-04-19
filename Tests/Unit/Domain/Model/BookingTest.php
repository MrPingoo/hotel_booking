<?php

namespace RGJL\HotelBooking\Tests\Unit\Domain\Model;

/***************************************************************
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
 * Test case for class \RGJL\HotelBooking\Domain\Model\Booking.
 *
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 * @author Renan Gautier <rg.gloumi@gmail.com>
 * @author Julian Layen <layenjulian@gmail.com>
 */
class BookingTest extends \TYPO3\CMS\Core\Tests\UnitTestCase {
	/**
	 * @var \RGJL\HotelBooking\Domain\Model\Booking
	 */
	protected $subject = NULL;

	protected function setUp() {
		$this->subject = new \RGJL\HotelBooking\Domain\Model\Booking();
	}

	protected function tearDown() {
		unset($this->subject);
	}

	/**
	 * @test
	 */
	public function getBeginDateReturnsInitialValueForDateTime() {
		$this->assertEquals(
			NULL,
			$this->subject->getBeginDate()
		);
	}

	/**
	 * @test
	 */
	public function setBeginDateForDateTimeSetsBeginDate() {
		$dateTimeFixture = new \DateTime();
		$this->subject->setBeginDate($dateTimeFixture);

		$this->assertAttributeEquals(
			$dateTimeFixture,
			'beginDate',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getEndDateReturnsInitialValueForDateTime() {
		$this->assertEquals(
			NULL,
			$this->subject->getEndDate()
		);
	}

	/**
	 * @test
	 */
	public function setEndDateForDateTimeSetsEndDate() {
		$dateTimeFixture = new \DateTime();
		$this->subject->setEndDate($dateTimeFixture);

		$this->assertAttributeEquals(
			$dateTimeFixture,
			'endDate',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getPriceReturnsInitialValueForFloat() {
		$this->assertSame(
			0.0,
			$this->subject->getPrice()
		);
	}

	/**
	 * @test
	 */
	public function setPriceForFloatSetsPrice() {
		$this->subject->setPrice(3.14159265);

		$this->assertAttributeEquals(
			3.14159265,
			'price',
			$this->subject,
			'',
			0.000000001
		);
	}

	/**
	 * @test
	 */
	public function getUidForeignReturnsInitialValueForRent() {
		$this->assertEquals(
			NULL,
			$this->subject->getUidForeign()
		);
	}

	/**
	 * @test
	 */
	public function setUidForeignForRentSetsUidForeign() {
		$uidForeignFixture = new \RGJL\HotelBooking\Domain\Model\Rent();
		$this->subject->setUidForeign($uidForeignFixture);

		$this->assertAttributeEquals(
			$uidForeignFixture,
			'uidForeign',
			$this->subject
		);
	}
}
