<?php

namespace Extcode\Dates\Tests\Domain\Model;

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
 * Dates Controller
 *
 * @author Daniel Lorenz <ext.dates@extco.de>
 */
class DateTest extends \TYPO3\CMS\Core\Tests\UnitTestCase
{
    /**
     * @var \Extcode\Dates\Domain\Model\Date
     */
    protected $fixture;

    public function setUp()
    {
        $this->fixture = new \Extcode\Dates\Domain\Model\Date();
    }

    public function tearDown()
    {
        unset($this->fixture);
    }

    /**
     * @test
     */
    public function getTypReturnsInitialValueForInteger()
    {
        $this->assertSame(
            0,
            $this->fixture->getTyp()
        );
    }

    /**
     * @test
     */
    public function setTypForIntegerSetsTyp()
    {
        $this->fixture->setTyp(12);

        $this->assertSame(
            12,
            $this->fixture->getTyp()
        );
    }

    /**
     * @test
     */
    public function getTargetGroupReturnsInitialValueForInteger()
    {
        $this->assertSame(
            0,
            $this->fixture->getTargetGroup()
        );
    }

    /**
     * @test
     */
    public function setTargetGroupForIntegerSetsTargetGroup()
    {
        $this->fixture->setTargetGroup(12);

        $this->assertSame(
            12,
            $this->fixture->getTargetGroup()
        );
    }

    /**
     * @test
     */
    public function getTitleInitiallyReturnsEmptyString()
    {
        $this->assertSame(
            '',
            $this->fixture->getTitle()
        );
    }

    /**
     * @test
     */
    public function setTitleForStringSetsTitle()
    {
        $this->fixture->setTitle('Title');

        $this->assertSame(
            'Title',
            $this->fixture->getTitle()
        );
    }

    /**
     * @test
     */
    public function getShortTitleInitiallyReturnsEmptyString()
    {
        $this->assertSame(
            '',
            $this->fixture->getShortTitle()
        );
    }

    /**
     * @test
     */
    public function setShortTitleForStringSetsShortTitle()
    {
        $this->fixture->setShortTitle('ShortTitle');

        $this->assertSame(
            'ShortTitle',
            $this->fixture->getShortTitle()
        );
    }

    /**
     * @test
     */
    public function getStartReturnsInitialValueForDateTime()
    {
    }

    /**
     * @test
     */
    public function setStartForDateTimeSetsStart()
    {
    }

    /**
     * @test
     */
    public function getEndReturnsInitialValueForDateTime()
    {
    }

    /**
     * @test
     */
    public function setEndForDateTimeSetsEnd()
    {
    }

    /**
     * @test
     */
    public function getWebsiteInitiallyReturnsEmptyString()
    {
        $this->assertSame(
            '',
            $this->fixture->getWebsite()
        );
    }

    /**
     * @test
     */
    public function setWebsiteForStringSetsWebsite()
    {
        $this->fixture->setWebsite('www.example.com');

        $this->assertSame(
            'www.example.com',
            $this->fixture->getWebsite()
        );
    }

    /**
     * @test
     */
    public function getBoothNumberInitiallyReturnsEmptyString()
    {
        $this->assertSame(
            '',
            $this->fixture->getBoothNumber()
        );
    }

    /**
     * @test
     */
    public function setBoothNumberForStringSetsBoothNumber()
    {
        $this->fixture->setBoothNumber('BoothNumber');

        $this->assertSame(
            'BoothNumber',
            $this->fixture->getBoothNumber()
        );
    }

    /**
     * @test
     */
    public function getFairHallInitiallyReturnsEmptyString()
    {
        $this->assertSame(
            '',
            $this->fixture->getFairHall()
        );
    }

    /**
     * @test
     */
    public function setFairHallForStringSetsFairHall()
    {
        $this->fixture->setFairHall('FairHall');

        $this->assertSame(
            'FairHall',
            $this->fixture->getFairHall()
        );
    }

    /**
     * @test
     */
    public function getDescriptionInitiallyReturnsEmptyString()
    {
        $this->assertSame(
            '',
            $this->fixture->getDescription()
        );
    }

    /**
     * @test
     */
    public function setDescriptionForStringSetsDescription()
    {
        $this->fixture->setDescription('Description');

        $this->assertSame(
            'Description',
            $this->fixture->getDescription()
        );
    }

    /**
     * @test
     */
    public function getIsBookableReturnsInitialValueForBoolean()
    {
        $this->assertSame(
            false,
            $this->fixture->getIsBookable()
        );
    }

    /**
     * @test
     */
    public function setIsBookableForBooleanSetsIsBookable()
    {
        $this->fixture->setIsBookable(true);

        $this->assertSame(
            true,
            $this->fixture->getIsBookable()
        );
    }

    /**
     * @test
     */
    public function getIsTeaserReturnsInitialValueForBoolean()
    {
        $this->assertSame(
            false,
            $this->fixture->getIsTeaser()
        );
    }

    /**
     * @test
     */
    public function setIsTeaserForBooleanSetsIsTeaser()
    {
        $this->fixture->setIsTeaser(true);

        $this->assertSame(
            true,
            $this->fixture->getIsTeaser()
        );
    }

    /**
     * @test
     */
    public function getLocationReturnsInitialValueForObjectStorageContainingLocation()
    {
        $newObjectStorage = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        $this->assertEquals(
            $newObjectStorage,
            $this->fixture->getLocations()
        );
    }

    /**
     * @test
     */
    public function setLocationForObjectStorageContainingLocationSetsLocation()
    {
        $location = new \Extcode\Dates\Domain\Model\Location();
        $objectStorageHoldingExactlyOneLocation = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        $objectStorageHoldingExactlyOneLocation->attach($location);
        $this->fixture->setLocations($objectStorageHoldingExactlyOneLocation);

        $this->assertSame(
            $objectStorageHoldingExactlyOneLocation,
            $this->fixture->getLocations()
        );
    }

    /**
     * @test
     */
    public function addLocationToObjectStorageHoldingLocation()
    {
        $location = new \Extcode\Dates\Domain\Model\Location();
        $objectStorageHoldingExactlyOneLocation = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        $objectStorageHoldingExactlyOneLocation->attach($location);
        $this->fixture->addLocation($location);

        $this->assertEquals(
            $objectStorageHoldingExactlyOneLocation,
            $this->fixture->getLocations()
        );
    }

    /**
     * @test
     */
    public function removeLocationFromObjectStorageHoldingLocation()
    {
        $location = new \Extcode\Dates\Domain\Model\Location();
        $localObjectStorage = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        $localObjectStorage->attach($location);
        $localObjectStorage->detach($location);
        $this->fixture->addLocation($location);
        $this->fixture->removeLocation($location);

        $this->assertEquals(
            $localObjectStorage,
            $this->fixture->getLocations()
        );
    }

    /**
     * @test
     */
    public function getRepresentativeReturnsInitialValueForObjectStorageContainingRepresentative()
    {
        $newObjectStorage = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        $this->assertEquals(
            $newObjectStorage,
            $this->fixture->getRepresentative()
        );
    }

    /**
     * @test
     */
    public function setRepresentativeForObjectStorageContainingRepresentativeSetsRepresentative()
    {
        $representative = new \Extcode\Dates\Domain\Model\Representative();
        $objectStorageHoldingExactlyOneRepresentative = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        $objectStorageHoldingExactlyOneRepresentative->attach($representative);
        $this->fixture->setRepresentative($objectStorageHoldingExactlyOneRepresentative);

        $this->assertSame(
            $objectStorageHoldingExactlyOneRepresentative,
            $this->fixture->getRepresentative()
        );
    }

    /**
     * @test
     */
    public function addRepresentativeToObjectStorageHoldingRepresentative()
    {
        $representative = new \Extcode\Dates\Domain\Model\Representative();
        $objectStorageHoldingExactlyOneRepresentative = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        $objectStorageHoldingExactlyOneRepresentative->attach($representative);
        $this->fixture->addRepresentative($representative);

        $this->assertEquals(
            $objectStorageHoldingExactlyOneRepresentative,
            $this->fixture->getRepresentative()
        );
    }

    /**
     * @test
     */
    public function removeRepresentativeFromObjectStorageHoldingRepresentative()
    {
        $representative = new \Extcode\Dates\Domain\Model\Representative();
        $localObjectStorage = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        $localObjectStorage->attach($representative);
        $localObjectStorage->detach($representative);
        $this->fixture->addRepresentative($representative);
        $this->fixture->removeRepresentative($representative);

        $this->assertEquals(
            $localObjectStorage,
            $this->fixture->getRepresentative()
        );
    }
}
