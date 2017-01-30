<?php

namespace TYPO3\ContentRatingExtbase\Tests\Unit\Domain\Model;

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2014 
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
 * Test case for class \TYPO3\ContentRatingExtbase\Domain\Model\Rates.
 *
 * @version $Id$
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 */
class RatesTest extends \TYPO3\CMS\Core\Tests\UnitTestCase {
	/**
	 * @var \TYPO3\ContentRatingExtbase\Domain\Model\Rates
	 */
	protected $subject;

	public function setUp() {
		$this->subject = new \TYPO3\ContentRatingExtbase\Domain\Model\Rates();
	}

	public function tearDown() {
		unset($this->subject);
	}

	/**
	 * @test
	 */
	public function getRateurlReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getRateurl()
		);
	}

	/**
	 * @test
	 */
	public function setRateurlForStringSetsRateurl() {
		$this->subject->setRateurl('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'rateurl',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getRatepidReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getRatepid()
		);
	}

	/**
	 * @test
	 */
	public function setRatepidForStringSetsRatepid() {
		$this->subject->setRatepid('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'ratepid',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getRategetvarsReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getRategetvars()
		);
	}

	/**
	 * @test
	 */
	public function setRategetvarsForStringSetsRategetvars() {
		$this->subject->setRategetvars('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'rategetvars',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getRateipReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getRateip()
		);
	}

	/**
	 * @test
	 */
	public function setRateipForStringSetsRateip() {
		$this->subject->setRateip('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'rateip',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getRatevalueReturnsInitialValueForInteger() {
		$this->assertSame(
			0,
			$this->subject->getRatevalue()
		);
	}

	/**
	 * @test
	 */
	public function setRatevalueForIntegerSetsRatevalue() {
		$this->subject->setRatevalue(12);

		$this->assertAttributeEquals(
			12,
			'ratevalue',
			$this->subject
		);
	}
}
