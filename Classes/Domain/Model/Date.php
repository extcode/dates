<?php

namespace Extcode\Dates\Domain\Model;

/**
 * This file is part of the TYPO3 CMS project.
 *
 * It is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License, either version 2
 * of the License, or any later version.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * The TYPO3 project - inspiring people to share!
 */

/**
 * Date Model
 *
 * @package date
 * @author Daniel Lorenz <ext.dates@extco.de>
 */
class Date extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{

    /**
     * typ
     *
     * @var integer
     * @validate NotEmpty
     */
    protected $typ = 0;

    /**
     * targetGroup
     *
     * @var integer
     * @validate NotEmpty
     */
    protected $targetGroup = 0;

    /**
     * title
     *
     * @var string
     * @validate NotEmpty
     */
    protected $title;

    /**
     * shortTitle
     *
     * @var string
     */
    protected $shortTitle;

    /**
     * isFullTime
     *
     * @var boolean
     */
    protected $isFullTime = false;

    /**
     * start
     *
     * @var \DateTime
     * @validate NotEmpty
     */
    protected $start;

    /**
     * end
     *
     * @var \DateTime
     * @validate NotEmpty
     */
    protected $end;

    /**
     * openingTimes
     *
     * @var string
     */
    protected $openingTimes;

    /**
     * website
     *
     * @var string
     */
    protected $website;

    /**
     * fairHall
     *
     * @var string
     */
    protected $fairHall;

    /**
     * boothNumber
     *
     * @var string
     */
    protected $boothNumber;

    /**
     * description
     *
     * @var string
     */
    protected $description;

    /**
     * isBookable
     *
     * @var boolean
     */
    protected $isBookable = false;

    /**
     * isTeaser
     *
     * @var boolean
     */
    protected $isTeaser = false;

    /**
     * locations
     *
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Extcode\Dates\Domain\Model\Location>
     * @lazy
     */
    protected $locations;

    /**
     * representative
     *
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Extcode\Dates\Domain\Model\Representative>
     * @lazy
     */
    protected $representative;

    /**
     * Returns the typ
     *
     * @return integer $typ
     */
    public function getTyp()
    {
        return $this->typ;
    }

    /**
     * Sets the typ
     *
     * @param integer $typ
     * @return void
     */
    public function setTyp($typ)
    {
        $this->typ = $typ;
    }

    /**
     * Returns the targetGroup
     *
     * @return integer $targetGroup
     */
    public function getTargetGroup()
    {
        return $this->targetGroup;
    }

    /**
     * Sets the targetGroup
     *
     * @param integer $targetGroup
     * @return void
     */
    public function setTargetGroup($targetGroup)
    {
        $this->targetGroup = $targetGroup;
    }

    /**
     * Returns the title
     *
     * @return string $title
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Sets the title
     *
     * @param string $title
     * @return void
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getShortTitle()
    {
        return $this->shortTitle;
    }

    /**
     * @param string $shortTitle
     * @return void
     */
    public function setShortTitle($shortTitle)
    {
        $this->shortTitle = $shortTitle;
    }

    /**
     * Returns the isFullTime
     *
     * @return boolean $isFullTime
     */
    public function getIsFullTime()
    {
        return $this->isFullTime;
    }

    /**
     * Sets the isFullTime
     *
     * @param boolean $isFullTime
     * @return void
     */
    public function setIsFullTime($isFullTime)
    {
        $this->isFullTime = $isFullTime;
    }

    /**
     * Returns the boolean state of isFullTime
     *
     * @return boolean
     */
    public function isIsFullTime()
    {
        return $this->getIsFullTime();
    }

    /**
     * Returns the start
     *
     * @return DateTime $start
     */
    public function getStart()
    {
        return $this->start;
    }

    /**
     * Sets the start
     *
     * @param DateTime $start
     * @return void
     */
    public function setStart($start)
    {
        $this->start = $start;
    }

    /**
     * Returns the end
     *
     * @return DateTime $end
     */
    public function getEnd()
    {
        return $this->end;
    }

    /**
     * Sets the end
     *
     * @param DateTime $end
     * @return void
     */
    public function setEnd($end)
    {
        $this->end = $end;
    }

    /**
     * @return string
     */
    public function getOpeningTimes()
    {
        return $this->openingTimes;
    }

    /**
     * @param string $openingTimes
     */
    public function setOpeningTimes($openingTimes)
    {
        $this->openingTimes = $openingTimes;
    }

    /**
     * Returns the website
     *
     * @return string $website
     */
    public function getWebsite()
    {
        return $this->website;
    }

    /**
     * Sets the website
     *
     * @param string $website
     * @return void
     */
    public function setWebsite($website)
    {
        $this->website = $website;
    }

    /**
     * Returns the fairHall
     *
     * @return string $fairHall
     */
    public function getFairHall()
    {
        return $this->fairHall;
    }

    /**
     * Sets the fairHall
     *
     * @param string $fairHall
     * @return void
     */
    public function setFairHall($fairHall)
    {
        $this->fairHall = $fairHall;
    }

    /**
     * Returns the boothNumber
     *
     * @return string $boothNumber
     */
    public function getBoothNumber()
    {
        return $this->boothNumber;
    }

    /**
     * Sets the boothNumber
     *
     * @param string $boothNumber
     * @return void
     */
    public function setBoothNumber($boothNumber)
    {
        $this->boothNumber = $boothNumber;
    }

    /**
     * Returns the description
     *
     * @return string $description
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Sets the description
     *
     * @param string $description
     * @return void
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * Returns the isBookable
     *
     * @return boolean $isBookable
     */
    public function getIsBookable()
    {
        return $this->isBookable;
    }

    /**
     * Sets the isBookable
     *
     * @param boolean $isBookable
     * @return void
     */
    public function setIsBookable($isBookable)
    {
        $this->isBookable = $isBookable;
    }

    /**
     * Returns the isTeaser
     *
     * @return boolean $isTeaser
     */
    public function getIsTeaser()
    {
        return $this->isTeaser;
    }

    /**
     * Sets the isTeaser
     *
     * @param boolean $isTeaser
     * @return void
     */
    public function setIsTeaser($isTeaser)
    {
        $this->isTeaser = $isTeaser;
    }

    /**
     * Returns the boolean state of isTeaser
     *
     * @return boolean
     */
    public function isIsTeaser()
    {
        return $this->getIsTeaser();
    }

    /**
     * Adds a Locations
     *
     * @param \Extcode\Dates\Domain\Model\Location $location
     *
     * @return void
     */
    public function addLocation(\Extcode\Dates\Domain\Model\Location $location)
    {
        $this->locations->attach($location);
    }

    /**
     * Removes a Locations
     *
     * @param \Extcode\Dates\Domain\Model\Location $locationToRemove
     *
     * @return void
     */
    public function removeLocation(\Extcode\Dates\Domain\Model\Location $locationToRemove)
    {
        $this->locations->detach($locationToRemove);
    }

    /**
     * Returns the locations
     *
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Extcode\Dates\Domain\Model\Location> $locations
     */
    public function getLocations()
    {
        return $this->locations;
    }

    /**
     * Sets the locations
     *
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage <\Extcode\Dates\Domain\Model\Location> $locations
     *
     * @return void
     */
    public function setLocations(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $locations)
    {
        $this->locations = $locations;
    }

    /**
     * Adds a Representatives
     *
     * @param \Extcode\Dates\Domain\Model\Representative $representative
     * @return void
     */
    public function addRepresentative(\Extcode\Dates\Domain\Model\Representative $representative)
    {
        $this->representative->attach($representative);
    }

    /**
     * Removes a Representatives
     *
     * @param \Extcode\Dates\Domain\Model\Representative $representativeToRemove The Representatives to be removed
     * @return void
     */
    public function removeRepresentative(\Extcode\Dates\Domain\Model\Representative $representativeToRemove)
    {
        $this->representative->detach($representativeToRemove);
    }

    /**
     * Returns the representative
     *
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Extcode\Dates\Domain\Model\Representative> $representative
     */
    public function getRepresentative()
    {
        return $this->representative;
    }

    /**
     * Sets the representative
     *
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage <\Extcode\Dates\Domain\Model\Representative> $representative
     * @return void
     */
    public function setRepresentative(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $representative)
    {
        $this->representative = $representative;
    }

}
