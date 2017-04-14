<?php

namespace Extcode\Dates\Tests\Controller;

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
class DatesControllerTest extends \TYPO3\CMS\Core\Tests\UnitTestCase
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
    public function dummyMethod()
    {
        $this->markTestIncomplete();
    }
}
