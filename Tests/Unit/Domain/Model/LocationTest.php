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
 * @package dates
 * @author Daniel Lorenz <ext.dates@extco.de>
 */
class LocationTest extends \TYPO3\CMS\Core\Tests\UnitTestCase
{
    /**
     * @var \Extcode\Dates\Domain\Model\Location
     */
    protected $fixture;

    public function setUp()
    {
        $this->fixture = new \Extcode\Dates\Domain\Model\Location();
    }

    public function tearDown()
    {
        unset($this->fixture);
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
}
