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
 * @author Daniel Lorenz <ext.dates@extco.de>
 */
class Date extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{

    /**
     * typ
     *
     * @var int
     * @validate NotEmpty
     */
    protected $typ = 0;

    /**
     * targetGroup
     *
     * @var int
     * @validate NotEmpty
     */
    protected $targetGroup = 0;

    /**
     * title
     *
     * @var string
     * @validate NotEmpty
     */
    protected $title = '';

    /**
     * shortTitle
     *
     * @var string
     */
    protected $shortTitle = '';

    /**
     * isFullTime
     *
     * @var bool
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
    protected $website = '';

    /**
     * fairHall
     *
     * @var string
     */
    protected $fairHall = '';

    /**
     * boothNumber
     *
     * @var string
     */
    protected $boothNumber = '';

    /**
     * description
     *
     * @var string
     */
    protected $description = '';

    /**
     * isBookable
     *
     * @var bool
     */
    protected $isBookable = false;

    /**
     * isTeaser
     *
     * @var bool
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
     * Product constructor.
     */
    public function __construct()
    {
        $this->locations = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        $this->representative = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
    }

    /**
     * Returns the typ
     *
     * @return int $typ
     */
    public function getTyp()
    {
        return $this->typ;
    }

    /**
     * Sets the typ
     *
     * @param int $typ
     */
    public function setTyp($typ)
    {
        $this->typ = $typ;
    }

    /**
     * Returns the targetGroup
     *
     * @return int $targetGroup
     */
    public function getTargetGroup()
    {
        return $this->targetGroup;
    }

    /**
     * Sets the targetGroup
     *
     * @param int $targetGroup
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
     */
    public function setShortTitle($shortTitle)
    {
        $this->shortTitle = $shortTitle;
    }

    /**
     * Returns the isFullTime
     *
     * @return bool $isFullTime
     */
    public function getIsFullTime()
    {
        return $this->isFullTime;
    }

    /**
     * Sets the isFullTime
     *
     * @param bool $isFullTime
     */
    public function setIsFullTime($isFullTime)
    {
        $this->isFullTime = $isFullTime;
    }

    /**
     * Returns the boolean state of isFullTime
     *
     * @return bool
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
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * Returns the isBookable
     *
     * @return bool $isBookable
     */
    public function getIsBookable()
    {
        return $this->isBookable;
    }

    /**
     * Sets the isBookable
     *
     * @param bool $isBookable
     */
    public function setIsBookable($isBookable)
    {
        $this->isBookable = $isBookable;
    }

    /**
     * Returns the isTeaser
     *
     * @return bool $isTeaser
     */
    public function getIsTeaser()
    {
        return $this->isTeaser;
    }

    /**
     * Sets the isTeaser
     *
     * @param bool $isTeaser
     */
    public function setIsTeaser($isTeaser)
    {
        $this->isTeaser = $isTeaser;
    }

    /**
     * Returns the boolean state of isTeaser
     *
     * @return bool
     */
    public function isIsTeaser()
    {
        return $this->getIsTeaser();
    }

    /**
     * Adds a Locations
     *
     * @param \Extcode\Dates\Domain\Model\Location $location
     */
    public function addLocation(\Extcode\Dates\Domain\Model\Location $location)
    {
        $this->locations->attach($location);
    }

    /**
     * Removes a Locations
     *
     * @param \Extcode\Dates\Domain\Model\Location $locationToRemove
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
     */
    public function setLocations(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $locations)
    {
        $this->locations = $locations;
    }

    /**
     * Adds a Representatives
     *
     * @param \Extcode\Dates\Domain\Model\Representative $representative
     */
    public function addRepresentative(\Extcode\Dates\Domain\Model\Representative $representative)
    {
        $this->representative->attach($representative);
    }

    /**
     * Removes a Representatives
     *
     * @param \Extcode\Dates\Domain\Model\Representative $representativeToRemove The Representatives to be removed
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
     */
    public function setRepresentative(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $representative)
    {
        $this->representative = $representative;
    }
}
