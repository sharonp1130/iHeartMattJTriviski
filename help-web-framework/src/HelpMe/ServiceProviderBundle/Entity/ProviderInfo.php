<?php

namespace HelpMe\ServiceProviderBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ProviderInfo
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="HelpMe\ServiceProviderBundle\Entity\ProviderInfoRepository")
 */
class ProviderInfo
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var boolean
     *
     * @ORM\Column(name="phoneOk", type="boolean")
     */
    private $phoneOk;

    /**
     * @var boolean
     *
     * @ORM\Column(name="textOk", type="boolean")
     */
    private $textOk;

    /**
     * @var boolean
     *
     * @ORM\Column(name="emailOk", type="boolean")
     */
    private $emailOk;

    /**
     * @var integer
     *
     * @ORM\Column(name="provider", type="integer")
     */
    private $provider;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="mondayStart", type="time")
     */
    private $mondayStart;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="mondayEnd", type="time")
     */
    private $mondayEnd;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="tuesdayStart", type="time")
     */
    private $tuesdayStart;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="tuesdayEnd", type="time")
     */
    private $tuesdayEnd;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="wednesdayStart", type="time")
     */
    private $wednesdayStart;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="wednsesdayEnd", type="time")
     */
    private $wednsesdayEnd;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="thursdayStart", type="time")
     */
    private $thursdayStart;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="thursdayEnd", type="time")
     */
    private $thursdayEnd;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fridayStart", type="time")
     */
    private $fridayStart;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fridayEnd", type="time")
     */
    private $fridayEnd;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="saturdayStart", type="time")
     */
    private $saturdayStart;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="saturdayEnd", type="time")
     */
    private $saturdayEnd;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="sundayStart", type="time")
     */
    private $sundayStart;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="sundayEnd", type="time")
     */
    private $sundayEnd;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created", type="datetime")
     */
    private $created;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="lastModified", type="datetime")
     */
    private $lastModified;


    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set phoneOk
     *
     * @param boolean $phoneOk
     *
     * @return ProviderInfo
     */
    public function setPhoneOk($phoneOk)
    {
        $this->phoneOk = $phoneOk;

        return $this;
    }

    /**
     * Get phoneOk
     *
     * @return boolean
     */
    public function getPhoneOk()
    {
        return $this->phoneOk;
    }

    /**
     * Set textOk
     *
     * @param boolean $textOk
     *
     * @return ProviderInfo
     */
    public function setTextOk($textOk)
    {
        $this->textOk = $textOk;

        return $this;
    }

    /**
     * Get textOk
     *
     * @return boolean
     */
    public function getTextOk()
    {
        return $this->textOk;
    }

    /**
     * Set emailOk
     *
     * @param boolean $emailOk
     *
     * @return ProviderInfo
     */
    public function setEmailOk($emailOk)
    {
        $this->emailOk = $emailOk;

        return $this;
    }

    /**
     * Get emailOk
     *
     * @return boolean
     */
    public function getEmailOk()
    {
        return $this->emailOk;
    }

    /**
     * Set provider
     *
     * @param integer $provider
     *
     * @return ProviderInfo
     */
    public function setProvider($provider)
    {
        $this->provider = $provider;

        return $this;
    }

    /**
     * Get provider
     *
     * @return integer
     */
    public function getProvider()
    {
        return $this->provider;
    }

    /**
     * Set mondayStart
     *
     * @param \DateTime $mondayStart
     *
     * @return ProviderInfo
     */
    public function setMondayStart($mondayStart)
    {
        $this->mondayStart = $mondayStart;

        return $this;
    }

    /**
     * Get mondayStart
     *
     * @return \DateTime
     */
    public function getMondayStart()
    {
        return $this->mondayStart;
    }

    /**
     * Set mondayEnd
     *
     * @param \DateTime $mondayEnd
     *
     * @return ProviderInfo
     */
    public function setMondayEnd($mondayEnd)
    {
        $this->mondayEnd = $mondayEnd;

        return $this;
    }

    /**
     * Get mondayEnd
     *
     * @return \DateTime
     */
    public function getMondayEnd()
    {
        return $this->mondayEnd;
    }

    /**
     * Set tuesdayStart
     *
     * @param \DateTime $tuesdayStart
     *
     * @return ProviderInfo
     */
    public function setTuesdayStart($tuesdayStart)
    {
        $this->tuesdayStart = $tuesdayStart;

        return $this;
    }

    /**
     * Get tuesdayStart
     *
     * @return \DateTime
     */
    public function getTuesdayStart()
    {
        return $this->tuesdayStart;
    }

    /**
     * Set tuesdayEnd
     *
     * @param \DateTime $tuesdayEnd
     *
     * @return ProviderInfo
     */
    public function setTuesdayEnd($tuesdayEnd)
    {
        $this->tuesdayEnd = $tuesdayEnd;

        return $this;
    }

    /**
     * Get tuesdayEnd
     *
     * @return \DateTime
     */
    public function getTuesdayEnd()
    {
        return $this->tuesdayEnd;
    }

    /**
     * Set wednesdayStart
     *
     * @param \DateTime $wednesdayStart
     *
     * @return ProviderInfo
     */
    public function setWednesdayStart($wednesdayStart)
    {
        $this->wednesdayStart = $wednesdayStart;

        return $this;
    }

    /**
     * Get wednesdayStart
     *
     * @return \DateTime
     */
    public function getWednesdayStart()
    {
        return $this->wednesdayStart;
    }

    /**
     * Set wednsesdayEnd
     *
     * @param \DateTime $wednsesdayEnd
     *
     * @return ProviderInfo
     */
    public function setWednsesdayEnd($wednsesdayEnd)
    {
        $this->wednsesdayEnd = $wednsesdayEnd;

        return $this;
    }

    /**
     * Get wednsesdayEnd
     *
     * @return \DateTime
     */
    public function getWednsesdayEnd()
    {
        return $this->wednsesdayEnd;
    }

    /**
     * Set thursdayStart
     *
     * @param \DateTime $thursdayStart
     *
     * @return ProviderInfo
     */
    public function setThursdayStart($thursdayStart)
    {
        $this->thursdayStart = $thursdayStart;

        return $this;
    }

    /**
     * Get thursdayStart
     *
     * @return \DateTime
     */
    public function getThursdayStart()
    {
        return $this->thursdayStart;
    }

    /**
     * Set thursdayEnd
     *
     * @param \DateTime $thursdayEnd
     *
     * @return ProviderInfo
     */
    public function setThursdayEnd($thursdayEnd)
    {
        $this->thursdayEnd = $thursdayEnd;

        return $this;
    }

    /**
     * Get thursdayEnd
     *
     * @return \DateTime
     */
    public function getThursdayEnd()
    {
        return $this->thursdayEnd;
    }

    /**
     * Set fridayStart
     *
     * @param \DateTime $fridayStart
     *
     * @return ProviderInfo
     */
    public function setFridayStart($fridayStart)
    {
        $this->fridayStart = $fridayStart;

        return $this;
    }

    /**
     * Get fridayStart
     *
     * @return \DateTime
     */
    public function getFridayStart()
    {
        return $this->fridayStart;
    }

    /**
     * Set fridayEnd
     *
     * @param \DateTime $fridayEnd
     *
     * @return ProviderInfo
     */
    public function setFridayEnd($fridayEnd)
    {
        $this->fridayEnd = $fridayEnd;

        return $this;
    }

    /**
     * Get fridayEnd
     *
     * @return \DateTime
     */
    public function getFridayEnd()
    {
        return $this->fridayEnd;
    }

    /**
     * Set saturdayStart
     *
     * @param \DateTime $saturdayStart
     *
     * @return ProviderInfo
     */
    public function setSaturdayStart($saturdayStart)
    {
        $this->saturdayStart = $saturdayStart;

        return $this;
    }

    /**
     * Get saturdayStart
     *
     * @return \DateTime
     */
    public function getSaturdayStart()
    {
        return $this->saturdayStart;
    }

    /**
     * Set saturdayEnd
     *
     * @param \DateTime $saturdayEnd
     *
     * @return ProviderInfo
     */
    public function setSaturdayEnd($saturdayEnd)
    {
        $this->saturdayEnd = $saturdayEnd;

        return $this;
    }

    /**
     * Get saturdayEnd
     *
     * @return \DateTime
     */
    public function getSaturdayEnd()
    {
        return $this->saturdayEnd;
    }

    /**
     * Set sundayStart
     *
     * @param \DateTime $sundayStart
     *
     * @return ProviderInfo
     */
    public function setSundayStart($sundayStart)
    {
        $this->sundayStart = $sundayStart;

        return $this;
    }

    /**
     * Get sundayStart
     *
     * @return \DateTime
     */
    public function getSundayStart()
    {
        return $this->sundayStart;
    }

    /**
     * Set sundayEnd
     *
     * @param \DateTime $sundayEnd
     *
     * @return ProviderInfo
     */
    public function setSundayEnd($sundayEnd)
    {
        $this->sundayEnd = $sundayEnd;

        return $this;
    }

    /**
     * Get sundayEnd
     *
     * @return \DateTime
     */
    public function getSundayEnd()
    {
        return $this->sundayEnd;
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     *
     * @return ProviderInfo
     */
    public function setCreated($created)
    {
        $this->created = $created;

        return $this;
    }

    /**
     * Get created
     *
     * @return \DateTime
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * Set lastModified
     *
     * @param \DateTime $lastModified
     *
     * @return ProviderInfo
     */
    public function setLastModified($lastModified)
    {
        $this->lastModified = $lastModified;

        return $this;
    }

    /**
     * Get lastModified
     *
     * @return \DateTime
     */
    public function getLastModified()
    {
        return $this->lastModified;
    }
}

