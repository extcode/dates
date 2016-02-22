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
 * Registration Model
 *
 * @package dates
 * @author Daniel Lorenz <ext.dates@extco.de>
 */
class Registration extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{

    /**
     * date
     *
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Extcode\Dates\Domain\Model\Date>
     * @lazy
     */
    protected $date;

    /**
     * appointment
     *
     * @var string
     * @validate NotEmpty
     */
    protected $appointment;

    /**
     * participant
     *
     * @var string
     */
    protected $participant;

    /**
     * company
     *
     * @var string
     */
    protected $company;

    /**
     * position
     *
     * @var string
     */
    protected $position;

    /**
     * street
     *
     * @var string
     * @validate NotEmpty
     */
    protected $street;

    /**
     * streetNumber
     *
     * @var string
     * @validate NotEmpty
     */
    protected $streetNumber;

    /**
     * zip
     *
     * @var string
     * @validate NotEmpty
     */
    protected $zip;

    /**
     * city
     *
     * @var string
     * @validate NotEmpty
     */
    protected $city;

    /**
     * title
     *
     * @var string
     * @validate NotEmpty
     */
    protected $name;

    /**
     * email
     *
     * @var string
     * @validate NotEmpty
     * @validate EmailAddress
     */
    protected $email;

    /**
     * phone
     *
     * @var string
     */
    protected $phone;

    /**
     * comment
     *
     * @var string
     */
    protected $comment;

    /**
     * @param string $appointment
     */
    public function setAppointment($appointment)
    {
        $this->appointment = $appointment;
    }

    /**
     * @return string
     */
    public function getAppointment()
    {
        return $this->appointment;
    }

    /**
     * @param string $participant
     */
    public function setParticipant($participant)
    {
        $this->participant = $participant;
    }

    /**
     * @return string
     */
    public function getParticipant()
    {
        return $this->participant;
    }

    /**
     * @param string $city
     */
    public function setCity($city)
    {
        $this->city = $city;
    }

    /**
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @param string $comment
     */
    public function setComment($comment)
    {
        $this->comment = $comment;
    }

    /**
     * @return string
     */
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * @param string $company
     */
    public function setCompany($company)
    {
        $this->company = $company;
    }

    /**
     * @return string
     */
    public function getCompany()
    {
        return $this->company;
    }

    /**
     * @param string $position
     */
    public function setPosition($position)
    {
        $this->position = $position;
    }

    /**
     * @return string
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * @param \\TYPO3\CMS\Extbase\Persistence\ObjectStorage $date
     */
    public function setDate($date)
    {
        $this->date = $date;
    }

    /**
     * @return \\TYPO3\CMS\Extbase\Persistence\ObjectStorage
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param string $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $street
     */
    public function setStreet($street)
    {
        $this->street = $street;
    }

    /**
     * @return string
     */
    public function getStreet()
    {
        return $this->street;
    }

    /**
     * @param string $streetNumber
     */
    public function setStreetNumber($streetNumber)
    {
        $this->streetNumber = $streetNumber;
    }

    /**
     * @return string
     */
    public function getStreetNumber()
    {
        return $this->streetNumber;
    }

    /**
     * @param string $phone
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;
    }

    /**
     * @return string
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * @param string $zip
     */
    public function setZip($zip)
    {
        $this->zip = $zip;
    }

    /**
     * @return string
     */
    public function getZip()
    {
        return $this->zip;
    }
}
