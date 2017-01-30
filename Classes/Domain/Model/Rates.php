<?php
namespace TYPO3\ContentRatingExtbase\Domain\Model;


/***************************************************************
 *
 *  Copyright notice
 *
 *  (c) 2014
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
 * Rates
 */
class Rates extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity {

	/**
	 * rateurl
	 *
	 * @var string
	 */
	protected $rateurl = '';

	/**
	 * ratepid
	 *
	 * @var string
	 */
	protected $ratepid = '';

	/**
	 * rategetvars
	 *
	 * @var string
	 */
	protected $rategetvars = '';

	/**
	 * rateip
	 *
	 * @var string
	 */
	protected $rateip = '';

	/**
	 * ratevalue
	 *
	 * @var integer
	 */
	protected $ratevalue = 0;

	/**
	 * Returns the rateurl
	 *
	 * @return string $rateurl
	 */
	public function getRateurl() {
		return $this->rateurl;
	}

	/**
	 * Sets the rateurl
	 *
	 * @param string $rateurl
	 * @return void
	 */
	public function setRateurl($rateurl) {
		$this->rateurl = $rateurl;
	}

	/**
	 * Returns the ratepid
	 *
	 * @return string $ratepid
	 */
	public function getRatepid() {
		return $this->ratepid;
	}

	/**
	 * Sets the ratepid
	 *
	 * @param string $ratepid
	 * @return void
	 */
	public function setRatepid($ratepid) {
		$this->ratepid = $ratepid;
	}

	/**
	 * Returns the rategetvars
	 *
	 * @return string $rategetvars
	 */
	public function getRategetvars() {
		return $this->rategetvars;
	}

	/**
	 * Sets the rategetvars
	 *
	 * @param string $rategetvars
	 * @return void
	 */
	public function setRategetvars($rategetvars) {
		$this->rategetvars = $rategetvars;
	}

	/**
	 * Returns the rateip
	 *
	 * @return string $rateip
	 */
	public function getRateip() {
		return $this->rateip;
	}

	/**
	 * Sets the rateip
	 *
	 * @param string $rateip
	 * @return void
	 */
	public function setRateip($rateip) {
		$this->rateip = $rateip;
	}

	/**
	 * Returns the ratevalue
	 *
	 * @return integer $ratevalue
	 */
	public function getRatevalue() {
		return $this->ratevalue;
	}

	/**
	 * Sets the ratevalue
	 *
	 * @param integer $ratevalue
	 * @return void
	 */
	public function setRatevalue($ratevalue) {
		$this->ratevalue = $ratevalue;
	}

}