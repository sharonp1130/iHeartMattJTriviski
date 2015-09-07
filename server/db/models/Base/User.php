<?php

namespace Base;

use \License as ChildLicense;
use \LicenseQuery as ChildLicenseQuery;
use \Location as ChildLocation;
use \LocationQuery as ChildLocationQuery;
use \User as ChildUser;
use \UserQuery as ChildUserQuery;
use \DateTime;
use \Exception;
use \PDO;
use Map\UserTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveRecord\ActiveRecordInterface;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\BadMethodCallException;
use Propel\Runtime\Exception\LogicException;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Map\TableMap;
use Propel\Runtime\Parser\AbstractParser;
use Propel\Runtime\Util\PropelDateTime;

/**
 * Base class that represents a row from the 'user' table.
 *
 *
 *
* @package    propel.generator..Base
*/
abstract class User implements ActiveRecordInterface
{
    /**
     * TableMap class name
     */
    const TABLE_MAP = '\\Map\\UserTableMap';


    /**
     * attribute to determine if this object has previously been saved.
     * @var boolean
     */
    protected $new = true;

    /**
     * attribute to determine whether this object has been deleted.
     * @var boolean
     */
    protected $deleted = false;

    /**
     * The columns that have been modified in current object.
     * Tracking modified columns allows us to only update modified columns.
     * @var array
     */
    protected $modifiedColumns = array();

    /**
     * The (virtual) columns that are added at runtime
     * The formatters can add supplementary columns based on a resultset
     * @var array
     */
    protected $virtualColumns = array();

    /**
     * The value for the userid field.
     * @var        int
     */
    protected $userid;

    /**
     * The value for the email field.
     * @var        string
     */
    protected $email;

    /**
     * The value for the isprovider field.
     * Note: this column has a database default value of: false
     * @var        boolean
     */
    protected $isprovider;

    /**
     * The value for the firstname field.
     * @var        string
     */
    protected $firstname;

    /**
     * The value for the lastname field.
     * @var        string
     */
    protected $lastname;

    /**
     * The value for the suffix field.
     * @var        string
     */
    protected $suffix;

    /**
     * The value for the address field.
     * @var        string
     */
    protected $address;

    /**
     * The value for the city field.
     * @var        string
     */
    protected $city;

    /**
     * The value for the zipcode field.
     * @var        string
     */
    protected $zipcode;

    /**
     * The value for the phonenumber field.
     * @var        string
     */
    protected $phonenumber;

    /**
     * The value for the phoneok field.
     * Note: this column has a database default value of: true
     * @var        boolean
     */
    protected $phoneok;

    /**
     * The value for the textok field.
     * Note: this column has a database default value of: true
     * @var        boolean
     */
    protected $textok;

    /**
     * The value for the emailok field.
     * Note: this column has a database default value of: true
     * @var        boolean
     */
    protected $emailok;

    /**
     * The value for the mondaystart field.
     * @var        \DateTime
     */
    protected $mondaystart;

    /**
     * The value for the mondayend field.
     * @var        \DateTime
     */
    protected $mondayend;

    /**
     * The value for the tuesdaystart field.
     * @var        \DateTime
     */
    protected $tuesdaystart;

    /**
     * The value for the tuesdayend field.
     * @var        \DateTime
     */
    protected $tuesdayend;

    /**
     * The value for the wednesdaystart field.
     * @var        \DateTime
     */
    protected $wednesdaystart;

    /**
     * The value for the wednesdayend field.
     * @var        \DateTime
     */
    protected $wednesdayend;

    /**
     * The value for the thursdaystart field.
     * @var        \DateTime
     */
    protected $thursdaystart;

    /**
     * The value for the thursdayend field.
     * @var        \DateTime
     */
    protected $thursdayend;

    /**
     * The value for the fridaystart field.
     * @var        \DateTime
     */
    protected $fridaystart;

    /**
     * The value for the fridayend field.
     * @var        \DateTime
     */
    protected $fridayend;

    /**
     * The value for the saturdaystart field.
     * @var        \DateTime
     */
    protected $saturdaystart;

    /**
     * The value for the saturdayend field.
     * @var        \DateTime
     */
    protected $saturdayend;

    /**
     * The value for the sundaystart field.
     * @var        \DateTime
     */
    protected $sundaystart;

    /**
     * The value for the sundayend field.
     * @var        \DateTime
     */
    protected $sundayend;

    /**
     * The value for the created_at field.
     * @var        \DateTime
     */
    protected $created_at;

    /**
     * The value for the updated_at field.
     * @var        \DateTime
     */
    protected $updated_at;

    /**
     * @var        ObjectCollection|ChildLicense[] Collection to store aggregation of ChildLicense objects.
     */
    protected $collLicenses;
    protected $collLicensesPartial;

    /**
     * @var        ObjectCollection|ChildLocation[] Collection to store aggregation of ChildLocation objects.
     */
    protected $collLocations;
    protected $collLocationsPartial;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var boolean
     */
    protected $alreadyInSave = false;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildLicense[]
     */
    protected $licensesScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildLocation[]
     */
    protected $locationsScheduledForDeletion = null;

    /**
     * Applies default values to this object.
     * This method should be called from the object's constructor (or
     * equivalent initialization method).
     * @see __construct()
     */
    public function applyDefaultValues()
    {
        $this->isprovider = false;
        $this->phoneok = true;
        $this->textok = true;
        $this->emailok = true;
    }

    /**
     * Initializes internal state of Base\User object.
     * @see applyDefaults()
     */
    public function __construct()
    {
        $this->applyDefaultValues();
    }

    /**
     * Returns whether the object has been modified.
     *
     * @return boolean True if the object has been modified.
     */
    public function isModified()
    {
        return !!$this->modifiedColumns;
    }

    /**
     * Has specified column been modified?
     *
     * @param  string  $col column fully qualified name (TableMap::TYPE_COLNAME), e.g. Book::AUTHOR_ID
     * @return boolean True if $col has been modified.
     */
    public function isColumnModified($col)
    {
        return $this->modifiedColumns && isset($this->modifiedColumns[$col]);
    }

    /**
     * Get the columns that have been modified in this object.
     * @return array A unique list of the modified column names for this object.
     */
    public function getModifiedColumns()
    {
        return $this->modifiedColumns ? array_keys($this->modifiedColumns) : [];
    }

    /**
     * Returns whether the object has ever been saved.  This will
     * be false, if the object was retrieved from storage or was created
     * and then saved.
     *
     * @return boolean true, if the object has never been persisted.
     */
    public function isNew()
    {
        return $this->new;
    }

    /**
     * Setter for the isNew attribute.  This method will be called
     * by Propel-generated children and objects.
     *
     * @param boolean $b the state of the object.
     */
    public function setNew($b)
    {
        $this->new = (boolean) $b;
    }

    /**
     * Whether this object has been deleted.
     * @return boolean The deleted state of this object.
     */
    public function isDeleted()
    {
        return $this->deleted;
    }

    /**
     * Specify whether this object has been deleted.
     * @param  boolean $b The deleted state of this object.
     * @return void
     */
    public function setDeleted($b)
    {
        $this->deleted = (boolean) $b;
    }

    /**
     * Sets the modified state for the object to be false.
     * @param  string $col If supplied, only the specified column is reset.
     * @return void
     */
    public function resetModified($col = null)
    {
        if (null !== $col) {
            if (isset($this->modifiedColumns[$col])) {
                unset($this->modifiedColumns[$col]);
            }
        } else {
            $this->modifiedColumns = array();
        }
    }

    /**
     * Compares this with another <code>User</code> instance.  If
     * <code>obj</code> is an instance of <code>User</code>, delegates to
     * <code>equals(User)</code>.  Otherwise, returns <code>false</code>.
     *
     * @param  mixed   $obj The object to compare to.
     * @return boolean Whether equal to the object specified.
     */
    public function equals($obj)
    {
        if (!$obj instanceof static) {
            return false;
        }

        if ($this === $obj) {
            return true;
        }

        if (null === $this->getPrimaryKey() || null === $obj->getPrimaryKey()) {
            return false;
        }

        return $this->getPrimaryKey() === $obj->getPrimaryKey();
    }

    /**
     * Get the associative array of the virtual columns in this object
     *
     * @return array
     */
    public function getVirtualColumns()
    {
        return $this->virtualColumns;
    }

    /**
     * Checks the existence of a virtual column in this object
     *
     * @param  string  $name The virtual column name
     * @return boolean
     */
    public function hasVirtualColumn($name)
    {
        return array_key_exists($name, $this->virtualColumns);
    }

    /**
     * Get the value of a virtual column in this object
     *
     * @param  string $name The virtual column name
     * @return mixed
     *
     * @throws PropelException
     */
    public function getVirtualColumn($name)
    {
        if (!$this->hasVirtualColumn($name)) {
            throw new PropelException(sprintf('Cannot get value of inexistent virtual column %s.', $name));
        }

        return $this->virtualColumns[$name];
    }

    /**
     * Set the value of a virtual column in this object
     *
     * @param string $name  The virtual column name
     * @param mixed  $value The value to give to the virtual column
     *
     * @return $this|User The current object, for fluid interface
     */
    public function setVirtualColumn($name, $value)
    {
        $this->virtualColumns[$name] = $value;

        return $this;
    }

    /**
     * Logs a message using Propel::log().
     *
     * @param  string  $msg
     * @param  int     $priority One of the Propel::LOG_* logging levels
     * @return boolean
     */
    protected function log($msg, $priority = Propel::LOG_INFO)
    {
        return Propel::log(get_class($this) . ': ' . $msg, $priority);
    }

    /**
     * Export the current object properties to a string, using a given parser format
     * <code>
     * $book = BookQuery::create()->findPk(9012);
     * echo $book->exportTo('JSON');
     *  => {"Id":9012,"Title":"Don Juan","ISBN":"0140422161","Price":12.99,"PublisherId":1234,"AuthorId":5678}');
     * </code>
     *
     * @param  mixed   $parser                 A AbstractParser instance, or a format name ('XML', 'YAML', 'JSON', 'CSV')
     * @param  boolean $includeLazyLoadColumns (optional) Whether to include lazy load(ed) columns. Defaults to TRUE.
     * @return string  The exported data
     */
    public function exportTo($parser, $includeLazyLoadColumns = true)
    {
        if (!$parser instanceof AbstractParser) {
            $parser = AbstractParser::getParser($parser);
        }

        return $parser->fromArray($this->toArray(TableMap::TYPE_PHPNAME, $includeLazyLoadColumns, array(), true));
    }

    /**
     * Clean up internal collections prior to serializing
     * Avoids recursive loops that turn into segmentation faults when serializing
     */
    public function __sleep()
    {
        $this->clearAllReferences();

        return array_keys(get_object_vars($this));
    }

    /**
     * Get the [userid] column value.
     *
     * @return int
     */
    public function getUserid()
    {
        return $this->userid;
    }

    /**
     * Get the [email] column value.
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Get the [isprovider] column value.
     *
     * @return boolean
     */
    public function getIsprovider()
    {
        return $this->isprovider;
    }

    /**
     * Get the [isprovider] column value.
     *
     * @return boolean
     */
    public function isIsprovider()
    {
        return $this->getIsprovider();
    }

    /**
     * Get the [firstname] column value.
     *
     * @return string
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Get the [lastname] column value.
     *
     * @return string
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * Get the [suffix] column value.
     *
     * @return string
     */
    public function getSuffix()
    {
        return $this->suffix;
    }

    /**
     * Get the [address] column value.
     *
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Get the [city] column value.
     *
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Get the [zipcode] column value.
     *
     * @return string
     */
    public function getZipcode()
    {
        return $this->zipcode;
    }

    /**
     * Get the [phonenumber] column value.
     *
     * @return string
     */
    public function getPhonenumber()
    {
        return $this->phonenumber;
    }

    /**
     * Get the [phoneok] column value.
     *
     * @return boolean
     */
    public function getPhoneok()
    {
        return $this->phoneok;
    }

    /**
     * Get the [phoneok] column value.
     *
     * @return boolean
     */
    public function isPhoneok()
    {
        return $this->getPhoneok();
    }

    /**
     * Get the [textok] column value.
     *
     * @return boolean
     */
    public function getTextok()
    {
        return $this->textok;
    }

    /**
     * Get the [textok] column value.
     *
     * @return boolean
     */
    public function isTextok()
    {
        return $this->getTextok();
    }

    /**
     * Get the [emailok] column value.
     *
     * @return boolean
     */
    public function getEmailok()
    {
        return $this->emailok;
    }

    /**
     * Get the [emailok] column value.
     *
     * @return boolean
     */
    public function isEmailok()
    {
        return $this->getEmailok();
    }

    /**
     * Get the [optionally formatted] temporal [mondaystart] column value.
     *
     *
     * @param      string $format The date/time format string (either date()-style or strftime()-style).
     *                            If format is NULL, then the raw DateTime object will be returned.
     *
     * @return string|DateTime Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL
     *
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getMondaystart($format = NULL)
    {
        if ($format === null) {
            return $this->mondaystart;
        } else {
            return $this->mondaystart instanceof \DateTime ? $this->mondaystart->format($format) : null;
        }
    }

    /**
     * Get the [optionally formatted] temporal [mondayend] column value.
     *
     *
     * @param      string $format The date/time format string (either date()-style or strftime()-style).
     *                            If format is NULL, then the raw DateTime object will be returned.
     *
     * @return string|DateTime Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL
     *
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getMondayend($format = NULL)
    {
        if ($format === null) {
            return $this->mondayend;
        } else {
            return $this->mondayend instanceof \DateTime ? $this->mondayend->format($format) : null;
        }
    }

    /**
     * Get the [optionally formatted] temporal [tuesdaystart] column value.
     *
     *
     * @param      string $format The date/time format string (either date()-style or strftime()-style).
     *                            If format is NULL, then the raw DateTime object will be returned.
     *
     * @return string|DateTime Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL
     *
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getTuesdaystart($format = NULL)
    {
        if ($format === null) {
            return $this->tuesdaystart;
        } else {
            return $this->tuesdaystart instanceof \DateTime ? $this->tuesdaystart->format($format) : null;
        }
    }

    /**
     * Get the [optionally formatted] temporal [tuesdayend] column value.
     *
     *
     * @param      string $format The date/time format string (either date()-style or strftime()-style).
     *                            If format is NULL, then the raw DateTime object will be returned.
     *
     * @return string|DateTime Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL
     *
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getTuesdayend($format = NULL)
    {
        if ($format === null) {
            return $this->tuesdayend;
        } else {
            return $this->tuesdayend instanceof \DateTime ? $this->tuesdayend->format($format) : null;
        }
    }

    /**
     * Get the [optionally formatted] temporal [wednesdaystart] column value.
     *
     *
     * @param      string $format The date/time format string (either date()-style or strftime()-style).
     *                            If format is NULL, then the raw DateTime object will be returned.
     *
     * @return string|DateTime Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL
     *
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getWednesdaystart($format = NULL)
    {
        if ($format === null) {
            return $this->wednesdaystart;
        } else {
            return $this->wednesdaystart instanceof \DateTime ? $this->wednesdaystart->format($format) : null;
        }
    }

    /**
     * Get the [optionally formatted] temporal [wednesdayend] column value.
     *
     *
     * @param      string $format The date/time format string (either date()-style or strftime()-style).
     *                            If format is NULL, then the raw DateTime object will be returned.
     *
     * @return string|DateTime Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL
     *
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getWednesdayend($format = NULL)
    {
        if ($format === null) {
            return $this->wednesdayend;
        } else {
            return $this->wednesdayend instanceof \DateTime ? $this->wednesdayend->format($format) : null;
        }
    }

    /**
     * Get the [optionally formatted] temporal [thursdaystart] column value.
     *
     *
     * @param      string $format The date/time format string (either date()-style or strftime()-style).
     *                            If format is NULL, then the raw DateTime object will be returned.
     *
     * @return string|DateTime Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL
     *
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getThursdaystart($format = NULL)
    {
        if ($format === null) {
            return $this->thursdaystart;
        } else {
            return $this->thursdaystart instanceof \DateTime ? $this->thursdaystart->format($format) : null;
        }
    }

    /**
     * Get the [optionally formatted] temporal [thursdayend] column value.
     *
     *
     * @param      string $format The date/time format string (either date()-style or strftime()-style).
     *                            If format is NULL, then the raw DateTime object will be returned.
     *
     * @return string|DateTime Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL
     *
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getThursdayend($format = NULL)
    {
        if ($format === null) {
            return $this->thursdayend;
        } else {
            return $this->thursdayend instanceof \DateTime ? $this->thursdayend->format($format) : null;
        }
    }

    /**
     * Get the [optionally formatted] temporal [fridaystart] column value.
     *
     *
     * @param      string $format The date/time format string (either date()-style or strftime()-style).
     *                            If format is NULL, then the raw DateTime object will be returned.
     *
     * @return string|DateTime Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL
     *
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getFridaystart($format = NULL)
    {
        if ($format === null) {
            return $this->fridaystart;
        } else {
            return $this->fridaystart instanceof \DateTime ? $this->fridaystart->format($format) : null;
        }
    }

    /**
     * Get the [optionally formatted] temporal [fridayend] column value.
     *
     *
     * @param      string $format The date/time format string (either date()-style or strftime()-style).
     *                            If format is NULL, then the raw DateTime object will be returned.
     *
     * @return string|DateTime Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL
     *
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getFridayend($format = NULL)
    {
        if ($format === null) {
            return $this->fridayend;
        } else {
            return $this->fridayend instanceof \DateTime ? $this->fridayend->format($format) : null;
        }
    }

    /**
     * Get the [optionally formatted] temporal [saturdaystart] column value.
     *
     *
     * @param      string $format The date/time format string (either date()-style or strftime()-style).
     *                            If format is NULL, then the raw DateTime object will be returned.
     *
     * @return string|DateTime Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL
     *
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getSaturdaystart($format = NULL)
    {
        if ($format === null) {
            return $this->saturdaystart;
        } else {
            return $this->saturdaystart instanceof \DateTime ? $this->saturdaystart->format($format) : null;
        }
    }

    /**
     * Get the [optionally formatted] temporal [saturdayend] column value.
     *
     *
     * @param      string $format The date/time format string (either date()-style or strftime()-style).
     *                            If format is NULL, then the raw DateTime object will be returned.
     *
     * @return string|DateTime Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL
     *
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getSaturdayend($format = NULL)
    {
        if ($format === null) {
            return $this->saturdayend;
        } else {
            return $this->saturdayend instanceof \DateTime ? $this->saturdayend->format($format) : null;
        }
    }

    /**
     * Get the [optionally formatted] temporal [sundaystart] column value.
     *
     *
     * @param      string $format The date/time format string (either date()-style or strftime()-style).
     *                            If format is NULL, then the raw DateTime object will be returned.
     *
     * @return string|DateTime Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL
     *
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getSundaystart($format = NULL)
    {
        if ($format === null) {
            return $this->sundaystart;
        } else {
            return $this->sundaystart instanceof \DateTime ? $this->sundaystart->format($format) : null;
        }
    }

    /**
     * Get the [optionally formatted] temporal [sundayend] column value.
     *
     *
     * @param      string $format The date/time format string (either date()-style or strftime()-style).
     *                            If format is NULL, then the raw DateTime object will be returned.
     *
     * @return string|DateTime Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL
     *
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getSundayend($format = NULL)
    {
        if ($format === null) {
            return $this->sundayend;
        } else {
            return $this->sundayend instanceof \DateTime ? $this->sundayend->format($format) : null;
        }
    }

    /**
     * Get the [optionally formatted] temporal [created_at] column value.
     *
     *
     * @param      string $format The date/time format string (either date()-style or strftime()-style).
     *                            If format is NULL, then the raw DateTime object will be returned.
     *
     * @return string|DateTime Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00 00:00:00
     *
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getCreatedAt($format = NULL)
    {
        if ($format === null) {
            return $this->created_at;
        } else {
            return $this->created_at instanceof \DateTime ? $this->created_at->format($format) : null;
        }
    }

    /**
     * Get the [optionally formatted] temporal [updated_at] column value.
     *
     *
     * @param      string $format The date/time format string (either date()-style or strftime()-style).
     *                            If format is NULL, then the raw DateTime object will be returned.
     *
     * @return string|DateTime Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00 00:00:00
     *
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getUpdatedAt($format = NULL)
    {
        if ($format === null) {
            return $this->updated_at;
        } else {
            return $this->updated_at instanceof \DateTime ? $this->updated_at->format($format) : null;
        }
    }

    /**
     * Set the value of [userid] column.
     *
     * @param int $v new value
     * @return $this|\User The current object (for fluent API support)
     */
    public function setUserid($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->userid !== $v) {
            $this->userid = $v;
            $this->modifiedColumns[UserTableMap::COL_USERID] = true;
        }

        return $this;
    } // setUserid()

    /**
     * Set the value of [email] column.
     *
     * @param string $v new value
     * @return $this|\User The current object (for fluent API support)
     */
    public function setEmail($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->email !== $v) {
            $this->email = $v;
            $this->modifiedColumns[UserTableMap::COL_EMAIL] = true;
        }

        return $this;
    } // setEmail()

    /**
     * Sets the value of the [isprovider] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     *
     * @param  boolean|integer|string $v The new value
     * @return $this|\User The current object (for fluent API support)
     */
    public function setIsprovider($v)
    {
        if ($v !== null) {
            if (is_string($v)) {
                $v = in_array(strtolower($v), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
            } else {
                $v = (boolean) $v;
            }
        }

        if ($this->isprovider !== $v) {
            $this->isprovider = $v;
            $this->modifiedColumns[UserTableMap::COL_ISPROVIDER] = true;
        }

        return $this;
    } // setIsprovider()

    /**
     * Set the value of [firstname] column.
     *
     * @param string $v new value
     * @return $this|\User The current object (for fluent API support)
     */
    public function setFirstname($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->firstname !== $v) {
            $this->firstname = $v;
            $this->modifiedColumns[UserTableMap::COL_FIRSTNAME] = true;
        }

        return $this;
    } // setFirstname()

    /**
     * Set the value of [lastname] column.
     *
     * @param string $v new value
     * @return $this|\User The current object (for fluent API support)
     */
    public function setLastname($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->lastname !== $v) {
            $this->lastname = $v;
            $this->modifiedColumns[UserTableMap::COL_LASTNAME] = true;
        }

        return $this;
    } // setLastname()

    /**
     * Set the value of [suffix] column.
     *
     * @param string $v new value
     * @return $this|\User The current object (for fluent API support)
     */
    public function setSuffix($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->suffix !== $v) {
            $this->suffix = $v;
            $this->modifiedColumns[UserTableMap::COL_SUFFIX] = true;
        }

        return $this;
    } // setSuffix()

    /**
     * Set the value of [address] column.
     *
     * @param string $v new value
     * @return $this|\User The current object (for fluent API support)
     */
    public function setAddress($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->address !== $v) {
            $this->address = $v;
            $this->modifiedColumns[UserTableMap::COL_ADDRESS] = true;
        }

        return $this;
    } // setAddress()

    /**
     * Set the value of [city] column.
     *
     * @param string $v new value
     * @return $this|\User The current object (for fluent API support)
     */
    public function setCity($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->city !== $v) {
            $this->city = $v;
            $this->modifiedColumns[UserTableMap::COL_CITY] = true;
        }

        return $this;
    } // setCity()

    /**
     * Set the value of [zipcode] column.
     *
     * @param string $v new value
     * @return $this|\User The current object (for fluent API support)
     */
    public function setZipcode($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->zipcode !== $v) {
            $this->zipcode = $v;
            $this->modifiedColumns[UserTableMap::COL_ZIPCODE] = true;
        }

        return $this;
    } // setZipcode()

    /**
     * Set the value of [phonenumber] column.
     *
     * @param string $v new value
     * @return $this|\User The current object (for fluent API support)
     */
    public function setPhonenumber($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->phonenumber !== $v) {
            $this->phonenumber = $v;
            $this->modifiedColumns[UserTableMap::COL_PHONENUMBER] = true;
        }

        return $this;
    } // setPhonenumber()

    /**
     * Sets the value of the [phoneok] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     *
     * @param  boolean|integer|string $v The new value
     * @return $this|\User The current object (for fluent API support)
     */
    public function setPhoneok($v)
    {
        if ($v !== null) {
            if (is_string($v)) {
                $v = in_array(strtolower($v), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
            } else {
                $v = (boolean) $v;
            }
        }

        if ($this->phoneok !== $v) {
            $this->phoneok = $v;
            $this->modifiedColumns[UserTableMap::COL_PHONEOK] = true;
        }

        return $this;
    } // setPhoneok()

    /**
     * Sets the value of the [textok] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     *
     * @param  boolean|integer|string $v The new value
     * @return $this|\User The current object (for fluent API support)
     */
    public function setTextok($v)
    {
        if ($v !== null) {
            if (is_string($v)) {
                $v = in_array(strtolower($v), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
            } else {
                $v = (boolean) $v;
            }
        }

        if ($this->textok !== $v) {
            $this->textok = $v;
            $this->modifiedColumns[UserTableMap::COL_TEXTOK] = true;
        }

        return $this;
    } // setTextok()

    /**
     * Sets the value of the [emailok] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     *
     * @param  boolean|integer|string $v The new value
     * @return $this|\User The current object (for fluent API support)
     */
    public function setEmailok($v)
    {
        if ($v !== null) {
            if (is_string($v)) {
                $v = in_array(strtolower($v), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
            } else {
                $v = (boolean) $v;
            }
        }

        if ($this->emailok !== $v) {
            $this->emailok = $v;
            $this->modifiedColumns[UserTableMap::COL_EMAILOK] = true;
        }

        return $this;
    } // setEmailok()

    /**
     * Sets the value of [mondaystart] column to a normalized version of the date/time value specified.
     *
     * @param  mixed $v string, integer (timestamp), or \DateTime value.
     *               Empty strings are treated as NULL.
     * @return $this|\User The current object (for fluent API support)
     */
    public function setMondaystart($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->mondaystart !== null || $dt !== null) {
            if ($this->mondaystart === null || $dt === null || $dt->format("H:i:s") !== $this->mondaystart->format("H:i:s")) {
                $this->mondaystart = $dt === null ? null : clone $dt;
                $this->modifiedColumns[UserTableMap::COL_MONDAYSTART] = true;
            }
        } // if either are not null

        return $this;
    } // setMondaystart()

    /**
     * Sets the value of [mondayend] column to a normalized version of the date/time value specified.
     *
     * @param  mixed $v string, integer (timestamp), or \DateTime value.
     *               Empty strings are treated as NULL.
     * @return $this|\User The current object (for fluent API support)
     */
    public function setMondayend($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->mondayend !== null || $dt !== null) {
            if ($this->mondayend === null || $dt === null || $dt->format("H:i:s") !== $this->mondayend->format("H:i:s")) {
                $this->mondayend = $dt === null ? null : clone $dt;
                $this->modifiedColumns[UserTableMap::COL_MONDAYEND] = true;
            }
        } // if either are not null

        return $this;
    } // setMondayend()

    /**
     * Sets the value of [tuesdaystart] column to a normalized version of the date/time value specified.
     *
     * @param  mixed $v string, integer (timestamp), or \DateTime value.
     *               Empty strings are treated as NULL.
     * @return $this|\User The current object (for fluent API support)
     */
    public function setTuesdaystart($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->tuesdaystart !== null || $dt !== null) {
            if ($this->tuesdaystart === null || $dt === null || $dt->format("H:i:s") !== $this->tuesdaystart->format("H:i:s")) {
                $this->tuesdaystart = $dt === null ? null : clone $dt;
                $this->modifiedColumns[UserTableMap::COL_TUESDAYSTART] = true;
            }
        } // if either are not null

        return $this;
    } // setTuesdaystart()

    /**
     * Sets the value of [tuesdayend] column to a normalized version of the date/time value specified.
     *
     * @param  mixed $v string, integer (timestamp), or \DateTime value.
     *               Empty strings are treated as NULL.
     * @return $this|\User The current object (for fluent API support)
     */
    public function setTuesdayend($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->tuesdayend !== null || $dt !== null) {
            if ($this->tuesdayend === null || $dt === null || $dt->format("H:i:s") !== $this->tuesdayend->format("H:i:s")) {
                $this->tuesdayend = $dt === null ? null : clone $dt;
                $this->modifiedColumns[UserTableMap::COL_TUESDAYEND] = true;
            }
        } // if either are not null

        return $this;
    } // setTuesdayend()

    /**
     * Sets the value of [wednesdaystart] column to a normalized version of the date/time value specified.
     *
     * @param  mixed $v string, integer (timestamp), or \DateTime value.
     *               Empty strings are treated as NULL.
     * @return $this|\User The current object (for fluent API support)
     */
    public function setWednesdaystart($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->wednesdaystart !== null || $dt !== null) {
            if ($this->wednesdaystart === null || $dt === null || $dt->format("H:i:s") !== $this->wednesdaystart->format("H:i:s")) {
                $this->wednesdaystart = $dt === null ? null : clone $dt;
                $this->modifiedColumns[UserTableMap::COL_WEDNESDAYSTART] = true;
            }
        } // if either are not null

        return $this;
    } // setWednesdaystart()

    /**
     * Sets the value of [wednesdayend] column to a normalized version of the date/time value specified.
     *
     * @param  mixed $v string, integer (timestamp), or \DateTime value.
     *               Empty strings are treated as NULL.
     * @return $this|\User The current object (for fluent API support)
     */
    public function setWednesdayend($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->wednesdayend !== null || $dt !== null) {
            if ($this->wednesdayend === null || $dt === null || $dt->format("H:i:s") !== $this->wednesdayend->format("H:i:s")) {
                $this->wednesdayend = $dt === null ? null : clone $dt;
                $this->modifiedColumns[UserTableMap::COL_WEDNESDAYEND] = true;
            }
        } // if either are not null

        return $this;
    } // setWednesdayend()

    /**
     * Sets the value of [thursdaystart] column to a normalized version of the date/time value specified.
     *
     * @param  mixed $v string, integer (timestamp), or \DateTime value.
     *               Empty strings are treated as NULL.
     * @return $this|\User The current object (for fluent API support)
     */
    public function setThursdaystart($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->thursdaystart !== null || $dt !== null) {
            if ($this->thursdaystart === null || $dt === null || $dt->format("H:i:s") !== $this->thursdaystart->format("H:i:s")) {
                $this->thursdaystart = $dt === null ? null : clone $dt;
                $this->modifiedColumns[UserTableMap::COL_THURSDAYSTART] = true;
            }
        } // if either are not null

        return $this;
    } // setThursdaystart()

    /**
     * Sets the value of [thursdayend] column to a normalized version of the date/time value specified.
     *
     * @param  mixed $v string, integer (timestamp), or \DateTime value.
     *               Empty strings are treated as NULL.
     * @return $this|\User The current object (for fluent API support)
     */
    public function setThursdayend($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->thursdayend !== null || $dt !== null) {
            if ($this->thursdayend === null || $dt === null || $dt->format("H:i:s") !== $this->thursdayend->format("H:i:s")) {
                $this->thursdayend = $dt === null ? null : clone $dt;
                $this->modifiedColumns[UserTableMap::COL_THURSDAYEND] = true;
            }
        } // if either are not null

        return $this;
    } // setThursdayend()

    /**
     * Sets the value of [fridaystart] column to a normalized version of the date/time value specified.
     *
     * @param  mixed $v string, integer (timestamp), or \DateTime value.
     *               Empty strings are treated as NULL.
     * @return $this|\User The current object (for fluent API support)
     */
    public function setFridaystart($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->fridaystart !== null || $dt !== null) {
            if ($this->fridaystart === null || $dt === null || $dt->format("H:i:s") !== $this->fridaystart->format("H:i:s")) {
                $this->fridaystart = $dt === null ? null : clone $dt;
                $this->modifiedColumns[UserTableMap::COL_FRIDAYSTART] = true;
            }
        } // if either are not null

        return $this;
    } // setFridaystart()

    /**
     * Sets the value of [fridayend] column to a normalized version of the date/time value specified.
     *
     * @param  mixed $v string, integer (timestamp), or \DateTime value.
     *               Empty strings are treated as NULL.
     * @return $this|\User The current object (for fluent API support)
     */
    public function setFridayend($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->fridayend !== null || $dt !== null) {
            if ($this->fridayend === null || $dt === null || $dt->format("H:i:s") !== $this->fridayend->format("H:i:s")) {
                $this->fridayend = $dt === null ? null : clone $dt;
                $this->modifiedColumns[UserTableMap::COL_FRIDAYEND] = true;
            }
        } // if either are not null

        return $this;
    } // setFridayend()

    /**
     * Sets the value of [saturdaystart] column to a normalized version of the date/time value specified.
     *
     * @param  mixed $v string, integer (timestamp), or \DateTime value.
     *               Empty strings are treated as NULL.
     * @return $this|\User The current object (for fluent API support)
     */
    public function setSaturdaystart($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->saturdaystart !== null || $dt !== null) {
            if ($this->saturdaystart === null || $dt === null || $dt->format("H:i:s") !== $this->saturdaystart->format("H:i:s")) {
                $this->saturdaystart = $dt === null ? null : clone $dt;
                $this->modifiedColumns[UserTableMap::COL_SATURDAYSTART] = true;
            }
        } // if either are not null

        return $this;
    } // setSaturdaystart()

    /**
     * Sets the value of [saturdayend] column to a normalized version of the date/time value specified.
     *
     * @param  mixed $v string, integer (timestamp), or \DateTime value.
     *               Empty strings are treated as NULL.
     * @return $this|\User The current object (for fluent API support)
     */
    public function setSaturdayend($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->saturdayend !== null || $dt !== null) {
            if ($this->saturdayend === null || $dt === null || $dt->format("H:i:s") !== $this->saturdayend->format("H:i:s")) {
                $this->saturdayend = $dt === null ? null : clone $dt;
                $this->modifiedColumns[UserTableMap::COL_SATURDAYEND] = true;
            }
        } // if either are not null

        return $this;
    } // setSaturdayend()

    /**
     * Sets the value of [sundaystart] column to a normalized version of the date/time value specified.
     *
     * @param  mixed $v string, integer (timestamp), or \DateTime value.
     *               Empty strings are treated as NULL.
     * @return $this|\User The current object (for fluent API support)
     */
    public function setSundaystart($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->sundaystart !== null || $dt !== null) {
            if ($this->sundaystart === null || $dt === null || $dt->format("H:i:s") !== $this->sundaystart->format("H:i:s")) {
                $this->sundaystart = $dt === null ? null : clone $dt;
                $this->modifiedColumns[UserTableMap::COL_SUNDAYSTART] = true;
            }
        } // if either are not null

        return $this;
    } // setSundaystart()

    /**
     * Sets the value of [sundayend] column to a normalized version of the date/time value specified.
     *
     * @param  mixed $v string, integer (timestamp), or \DateTime value.
     *               Empty strings are treated as NULL.
     * @return $this|\User The current object (for fluent API support)
     */
    public function setSundayend($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->sundayend !== null || $dt !== null) {
            if ($this->sundayend === null || $dt === null || $dt->format("H:i:s") !== $this->sundayend->format("H:i:s")) {
                $this->sundayend = $dt === null ? null : clone $dt;
                $this->modifiedColumns[UserTableMap::COL_SUNDAYEND] = true;
            }
        } // if either are not null

        return $this;
    } // setSundayend()

    /**
     * Sets the value of [created_at] column to a normalized version of the date/time value specified.
     *
     * @param  mixed $v string, integer (timestamp), or \DateTime value.
     *               Empty strings are treated as NULL.
     * @return $this|\User The current object (for fluent API support)
     */
    public function setCreatedAt($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->created_at !== null || $dt !== null) {
            if ($this->created_at === null || $dt === null || $dt->format("Y-m-d H:i:s") !== $this->created_at->format("Y-m-d H:i:s")) {
                $this->created_at = $dt === null ? null : clone $dt;
                $this->modifiedColumns[UserTableMap::COL_CREATED_AT] = true;
            }
        } // if either are not null

        return $this;
    } // setCreatedAt()

    /**
     * Sets the value of [updated_at] column to a normalized version of the date/time value specified.
     *
     * @param  mixed $v string, integer (timestamp), or \DateTime value.
     *               Empty strings are treated as NULL.
     * @return $this|\User The current object (for fluent API support)
     */
    public function setUpdatedAt($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->updated_at !== null || $dt !== null) {
            if ($this->updated_at === null || $dt === null || $dt->format("Y-m-d H:i:s") !== $this->updated_at->format("Y-m-d H:i:s")) {
                $this->updated_at = $dt === null ? null : clone $dt;
                $this->modifiedColumns[UserTableMap::COL_UPDATED_AT] = true;
            }
        } // if either are not null

        return $this;
    } // setUpdatedAt()

    /**
     * Indicates whether the columns in this object are only set to default values.
     *
     * This method can be used in conjunction with isModified() to indicate whether an object is both
     * modified _and_ has some values set which are non-default.
     *
     * @return boolean Whether the columns in this object are only been set with default values.
     */
    public function hasOnlyDefaultValues()
    {
            if ($this->isprovider !== false) {
                return false;
            }

            if ($this->phoneok !== true) {
                return false;
            }

            if ($this->textok !== true) {
                return false;
            }

            if ($this->emailok !== true) {
                return false;
            }

        // otherwise, everything was equal, so return TRUE
        return true;
    } // hasOnlyDefaultValues()

    /**
     * Hydrates (populates) the object variables with values from the database resultset.
     *
     * An offset (0-based "start column") is specified so that objects can be hydrated
     * with a subset of the columns in the resultset rows.  This is needed, for example,
     * for results of JOIN queries where the resultset row includes columns from two or
     * more tables.
     *
     * @param array   $row       The row returned by DataFetcher->fetch().
     * @param int     $startcol  0-based offset column which indicates which restultset column to start with.
     * @param boolean $rehydrate Whether this object is being re-hydrated from the database.
     * @param string  $indexType The index type of $row. Mostly DataFetcher->getIndexType().
                                  One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                            TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *
     * @return int             next starting column
     * @throws PropelException - Any caught Exception will be rewrapped as a PropelException.
     */
    public function hydrate($row, $startcol = 0, $rehydrate = false, $indexType = TableMap::TYPE_NUM)
    {
        try {

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : UserTableMap::translateFieldName('Userid', TableMap::TYPE_PHPNAME, $indexType)];
            $this->userid = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : UserTableMap::translateFieldName('Email', TableMap::TYPE_PHPNAME, $indexType)];
            $this->email = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : UserTableMap::translateFieldName('Isprovider', TableMap::TYPE_PHPNAME, $indexType)];
            $this->isprovider = (null !== $col) ? (boolean) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : UserTableMap::translateFieldName('Firstname', TableMap::TYPE_PHPNAME, $indexType)];
            $this->firstname = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : UserTableMap::translateFieldName('Lastname', TableMap::TYPE_PHPNAME, $indexType)];
            $this->lastname = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : UserTableMap::translateFieldName('Suffix', TableMap::TYPE_PHPNAME, $indexType)];
            $this->suffix = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : UserTableMap::translateFieldName('Address', TableMap::TYPE_PHPNAME, $indexType)];
            $this->address = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 7 + $startcol : UserTableMap::translateFieldName('City', TableMap::TYPE_PHPNAME, $indexType)];
            $this->city = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 8 + $startcol : UserTableMap::translateFieldName('Zipcode', TableMap::TYPE_PHPNAME, $indexType)];
            $this->zipcode = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 9 + $startcol : UserTableMap::translateFieldName('Phonenumber', TableMap::TYPE_PHPNAME, $indexType)];
            $this->phonenumber = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 10 + $startcol : UserTableMap::translateFieldName('Phoneok', TableMap::TYPE_PHPNAME, $indexType)];
            $this->phoneok = (null !== $col) ? (boolean) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 11 + $startcol : UserTableMap::translateFieldName('Textok', TableMap::TYPE_PHPNAME, $indexType)];
            $this->textok = (null !== $col) ? (boolean) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 12 + $startcol : UserTableMap::translateFieldName('Emailok', TableMap::TYPE_PHPNAME, $indexType)];
            $this->emailok = (null !== $col) ? (boolean) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 13 + $startcol : UserTableMap::translateFieldName('Mondaystart', TableMap::TYPE_PHPNAME, $indexType)];
            $this->mondaystart = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 14 + $startcol : UserTableMap::translateFieldName('Mondayend', TableMap::TYPE_PHPNAME, $indexType)];
            $this->mondayend = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 15 + $startcol : UserTableMap::translateFieldName('Tuesdaystart', TableMap::TYPE_PHPNAME, $indexType)];
            $this->tuesdaystart = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 16 + $startcol : UserTableMap::translateFieldName('Tuesdayend', TableMap::TYPE_PHPNAME, $indexType)];
            $this->tuesdayend = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 17 + $startcol : UserTableMap::translateFieldName('Wednesdaystart', TableMap::TYPE_PHPNAME, $indexType)];
            $this->wednesdaystart = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 18 + $startcol : UserTableMap::translateFieldName('Wednesdayend', TableMap::TYPE_PHPNAME, $indexType)];
            $this->wednesdayend = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 19 + $startcol : UserTableMap::translateFieldName('Thursdaystart', TableMap::TYPE_PHPNAME, $indexType)];
            $this->thursdaystart = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 20 + $startcol : UserTableMap::translateFieldName('Thursdayend', TableMap::TYPE_PHPNAME, $indexType)];
            $this->thursdayend = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 21 + $startcol : UserTableMap::translateFieldName('Fridaystart', TableMap::TYPE_PHPNAME, $indexType)];
            $this->fridaystart = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 22 + $startcol : UserTableMap::translateFieldName('Fridayend', TableMap::TYPE_PHPNAME, $indexType)];
            $this->fridayend = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 23 + $startcol : UserTableMap::translateFieldName('Saturdaystart', TableMap::TYPE_PHPNAME, $indexType)];
            $this->saturdaystart = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 24 + $startcol : UserTableMap::translateFieldName('Saturdayend', TableMap::TYPE_PHPNAME, $indexType)];
            $this->saturdayend = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 25 + $startcol : UserTableMap::translateFieldName('Sundaystart', TableMap::TYPE_PHPNAME, $indexType)];
            $this->sundaystart = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 26 + $startcol : UserTableMap::translateFieldName('Sundayend', TableMap::TYPE_PHPNAME, $indexType)];
            $this->sundayend = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 27 + $startcol : UserTableMap::translateFieldName('CreatedAt', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->created_at = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 28 + $startcol : UserTableMap::translateFieldName('UpdatedAt', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->updated_at = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 29; // 29 = UserTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\User'), 0, $e);
        }
    }

    /**
     * Checks and repairs the internal consistency of the object.
     *
     * This method is executed after an already-instantiated object is re-hydrated
     * from the database.  It exists to check any foreign keys to make sure that
     * the objects related to the current object are correct based on foreign key.
     *
     * You can override this method in the stub class, but you should always invoke
     * the base method from the overridden method (i.e. parent::ensureConsistency()),
     * in case your model changes.
     *
     * @throws PropelException
     */
    public function ensureConsistency()
    {
    } // ensureConsistency

    /**
     * Reloads this object from datastore based on primary key and (optionally) resets all associated objects.
     *
     * This will only work if the object has been saved and has a valid primary key set.
     *
     * @param      boolean $deep (optional) Whether to also de-associated any related objects.
     * @param      ConnectionInterface $con (optional) The ConnectionInterface connection to use.
     * @return void
     * @throws PropelException - if this object is deleted, unsaved or doesn't have pk match in db
     */
    public function reload($deep = false, ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("Cannot reload a deleted object.");
        }

        if ($this->isNew()) {
            throw new PropelException("Cannot reload an unsaved object.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(UserTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildUserQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->collLicenses = null;

            $this->collLocations = null;

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param      ConnectionInterface $con
     * @return void
     * @throws PropelException
     * @see User::setDeleted()
     * @see User::isDeleted()
     */
    public function delete(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(UserTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildUserQuery::create()
                ->filterByPrimaryKey($this->getPrimaryKey());
            $ret = $this->preDelete($con);
            if ($ret) {
                $deleteQuery->delete($con);
                $this->postDelete($con);
                $this->setDeleted(true);
            }
        });
    }

    /**
     * Persists this object to the database.
     *
     * If the object is new, it inserts it; otherwise an update is performed.
     * All modified related objects will also be persisted in the doSave()
     * method.  This method wraps all precipitate database operations in a
     * single transaction.
     *
     * @param      ConnectionInterface $con
     * @return int             The number of rows affected by this insert/update and any referring fk objects' save() operations.
     * @throws PropelException
     * @see doSave()
     */
    public function save(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("You cannot save an object that has been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(UserTableMap::DATABASE_NAME);
        }

        return $con->transaction(function () use ($con) {
            $isInsert = $this->isNew();
            $ret = $this->preSave($con);
            if ($isInsert) {
                $ret = $ret && $this->preInsert($con);
                // timestampable behavior

                if (!$this->isColumnModified(UserTableMap::COL_CREATED_AT)) {
                    $this->setCreatedAt(time());
                }
                if (!$this->isColumnModified(UserTableMap::COL_UPDATED_AT)) {
                    $this->setUpdatedAt(time());
                }
            } else {
                $ret = $ret && $this->preUpdate($con);
                // timestampable behavior
                if ($this->isModified() && !$this->isColumnModified(UserTableMap::COL_UPDATED_AT)) {
                    $this->setUpdatedAt(time());
                }
            }
            if ($ret) {
                $affectedRows = $this->doSave($con);
                if ($isInsert) {
                    $this->postInsert($con);
                } else {
                    $this->postUpdate($con);
                }
                $this->postSave($con);
                UserTableMap::addInstanceToPool($this);
            } else {
                $affectedRows = 0;
            }

            return $affectedRows;
        });
    }

    /**
     * Performs the work of inserting or updating the row in the database.
     *
     * If the object is new, it inserts it; otherwise an update is performed.
     * All related objects are also updated in this method.
     *
     * @param      ConnectionInterface $con
     * @return int             The number of rows affected by this insert/update and any referring fk objects' save() operations.
     * @throws PropelException
     * @see save()
     */
    protected function doSave(ConnectionInterface $con)
    {
        $affectedRows = 0; // initialize var to track total num of affected rows
        if (!$this->alreadyInSave) {
            $this->alreadyInSave = true;

            if ($this->isNew() || $this->isModified()) {
                // persist changes
                if ($this->isNew()) {
                    $this->doInsert($con);
                    $affectedRows += 1;
                } else {
                    $affectedRows += $this->doUpdate($con);
                }
                $this->resetModified();
            }

            if ($this->licensesScheduledForDeletion !== null) {
                if (!$this->licensesScheduledForDeletion->isEmpty()) {
                    \LicenseQuery::create()
                        ->filterByPrimaryKeys($this->licensesScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->licensesScheduledForDeletion = null;
                }
            }

            if ($this->collLicenses !== null) {
                foreach ($this->collLicenses as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->locationsScheduledForDeletion !== null) {
                if (!$this->locationsScheduledForDeletion->isEmpty()) {
                    \LocationQuery::create()
                        ->filterByPrimaryKeys($this->locationsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->locationsScheduledForDeletion = null;
                }
            }

            if ($this->collLocations !== null) {
                foreach ($this->collLocations as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            $this->alreadyInSave = false;

        }

        return $affectedRows;
    } // doSave()

    /**
     * Insert the row in the database.
     *
     * @param      ConnectionInterface $con
     *
     * @throws PropelException
     * @see doSave()
     */
    protected function doInsert(ConnectionInterface $con)
    {
        $modifiedColumns = array();
        $index = 0;

        $this->modifiedColumns[UserTableMap::COL_USERID] = true;
        if (null !== $this->userid) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . UserTableMap::COL_USERID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(UserTableMap::COL_USERID)) {
            $modifiedColumns[':p' . $index++]  = 'userId';
        }
        if ($this->isColumnModified(UserTableMap::COL_EMAIL)) {
            $modifiedColumns[':p' . $index++]  = 'email';
        }
        if ($this->isColumnModified(UserTableMap::COL_ISPROVIDER)) {
            $modifiedColumns[':p' . $index++]  = 'isProvider';
        }
        if ($this->isColumnModified(UserTableMap::COL_FIRSTNAME)) {
            $modifiedColumns[':p' . $index++]  = 'firstName';
        }
        if ($this->isColumnModified(UserTableMap::COL_LASTNAME)) {
            $modifiedColumns[':p' . $index++]  = 'lastName';
        }
        if ($this->isColumnModified(UserTableMap::COL_SUFFIX)) {
            $modifiedColumns[':p' . $index++]  = 'suffix';
        }
        if ($this->isColumnModified(UserTableMap::COL_ADDRESS)) {
            $modifiedColumns[':p' . $index++]  = 'address';
        }
        if ($this->isColumnModified(UserTableMap::COL_CITY)) {
            $modifiedColumns[':p' . $index++]  = 'city';
        }
        if ($this->isColumnModified(UserTableMap::COL_ZIPCODE)) {
            $modifiedColumns[':p' . $index++]  = 'zipcode';
        }
        if ($this->isColumnModified(UserTableMap::COL_PHONENUMBER)) {
            $modifiedColumns[':p' . $index++]  = 'phoneNumber';
        }
        if ($this->isColumnModified(UserTableMap::COL_PHONEOK)) {
            $modifiedColumns[':p' . $index++]  = 'phoneOk';
        }
        if ($this->isColumnModified(UserTableMap::COL_TEXTOK)) {
            $modifiedColumns[':p' . $index++]  = 'textOk';
        }
        if ($this->isColumnModified(UserTableMap::COL_EMAILOK)) {
            $modifiedColumns[':p' . $index++]  = 'emailOk';
        }
        if ($this->isColumnModified(UserTableMap::COL_MONDAYSTART)) {
            $modifiedColumns[':p' . $index++]  = 'mondayStart';
        }
        if ($this->isColumnModified(UserTableMap::COL_MONDAYEND)) {
            $modifiedColumns[':p' . $index++]  = 'mondayEnd';
        }
        if ($this->isColumnModified(UserTableMap::COL_TUESDAYSTART)) {
            $modifiedColumns[':p' . $index++]  = 'tuesdayStart';
        }
        if ($this->isColumnModified(UserTableMap::COL_TUESDAYEND)) {
            $modifiedColumns[':p' . $index++]  = 'tuesdayEnd';
        }
        if ($this->isColumnModified(UserTableMap::COL_WEDNESDAYSTART)) {
            $modifiedColumns[':p' . $index++]  = 'wednesdayStart';
        }
        if ($this->isColumnModified(UserTableMap::COL_WEDNESDAYEND)) {
            $modifiedColumns[':p' . $index++]  = 'wednesdayEnd';
        }
        if ($this->isColumnModified(UserTableMap::COL_THURSDAYSTART)) {
            $modifiedColumns[':p' . $index++]  = 'thursdayStart';
        }
        if ($this->isColumnModified(UserTableMap::COL_THURSDAYEND)) {
            $modifiedColumns[':p' . $index++]  = 'thursdayEnd';
        }
        if ($this->isColumnModified(UserTableMap::COL_FRIDAYSTART)) {
            $modifiedColumns[':p' . $index++]  = 'fridayStart';
        }
        if ($this->isColumnModified(UserTableMap::COL_FRIDAYEND)) {
            $modifiedColumns[':p' . $index++]  = 'fridayEnd';
        }
        if ($this->isColumnModified(UserTableMap::COL_SATURDAYSTART)) {
            $modifiedColumns[':p' . $index++]  = 'saturdayStart';
        }
        if ($this->isColumnModified(UserTableMap::COL_SATURDAYEND)) {
            $modifiedColumns[':p' . $index++]  = 'saturdayEnd';
        }
        if ($this->isColumnModified(UserTableMap::COL_SUNDAYSTART)) {
            $modifiedColumns[':p' . $index++]  = 'sundayStart';
        }
        if ($this->isColumnModified(UserTableMap::COL_SUNDAYEND)) {
            $modifiedColumns[':p' . $index++]  = 'sundayEnd';
        }
        if ($this->isColumnModified(UserTableMap::COL_CREATED_AT)) {
            $modifiedColumns[':p' . $index++]  = 'created_at';
        }
        if ($this->isColumnModified(UserTableMap::COL_UPDATED_AT)) {
            $modifiedColumns[':p' . $index++]  = 'updated_at';
        }

        $sql = sprintf(
            'INSERT INTO user (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case 'userId':
                        $stmt->bindValue($identifier, $this->userid, PDO::PARAM_INT);
                        break;
                    case 'email':
                        $stmt->bindValue($identifier, $this->email, PDO::PARAM_STR);
                        break;
                    case 'isProvider':
                        $stmt->bindValue($identifier, (int) $this->isprovider, PDO::PARAM_INT);
                        break;
                    case 'firstName':
                        $stmt->bindValue($identifier, $this->firstname, PDO::PARAM_STR);
                        break;
                    case 'lastName':
                        $stmt->bindValue($identifier, $this->lastname, PDO::PARAM_STR);
                        break;
                    case 'suffix':
                        $stmt->bindValue($identifier, $this->suffix, PDO::PARAM_STR);
                        break;
                    case 'address':
                        $stmt->bindValue($identifier, $this->address, PDO::PARAM_STR);
                        break;
                    case 'city':
                        $stmt->bindValue($identifier, $this->city, PDO::PARAM_STR);
                        break;
                    case 'zipcode':
                        $stmt->bindValue($identifier, $this->zipcode, PDO::PARAM_STR);
                        break;
                    case 'phoneNumber':
                        $stmt->bindValue($identifier, $this->phonenumber, PDO::PARAM_STR);
                        break;
                    case 'phoneOk':
                        $stmt->bindValue($identifier, (int) $this->phoneok, PDO::PARAM_INT);
                        break;
                    case 'textOk':
                        $stmt->bindValue($identifier, (int) $this->textok, PDO::PARAM_INT);
                        break;
                    case 'emailOk':
                        $stmt->bindValue($identifier, (int) $this->emailok, PDO::PARAM_INT);
                        break;
                    case 'mondayStart':
                        $stmt->bindValue($identifier, $this->mondaystart ? $this->mondaystart->format("Y-m-d H:i:s") : null, PDO::PARAM_STR);
                        break;
                    case 'mondayEnd':
                        $stmt->bindValue($identifier, $this->mondayend ? $this->mondayend->format("Y-m-d H:i:s") : null, PDO::PARAM_STR);
                        break;
                    case 'tuesdayStart':
                        $stmt->bindValue($identifier, $this->tuesdaystart ? $this->tuesdaystart->format("Y-m-d H:i:s") : null, PDO::PARAM_STR);
                        break;
                    case 'tuesdayEnd':
                        $stmt->bindValue($identifier, $this->tuesdayend ? $this->tuesdayend->format("Y-m-d H:i:s") : null, PDO::PARAM_STR);
                        break;
                    case 'wednesdayStart':
                        $stmt->bindValue($identifier, $this->wednesdaystart ? $this->wednesdaystart->format("Y-m-d H:i:s") : null, PDO::PARAM_STR);
                        break;
                    case 'wednesdayEnd':
                        $stmt->bindValue($identifier, $this->wednesdayend ? $this->wednesdayend->format("Y-m-d H:i:s") : null, PDO::PARAM_STR);
                        break;
                    case 'thursdayStart':
                        $stmt->bindValue($identifier, $this->thursdaystart ? $this->thursdaystart->format("Y-m-d H:i:s") : null, PDO::PARAM_STR);
                        break;
                    case 'thursdayEnd':
                        $stmt->bindValue($identifier, $this->thursdayend ? $this->thursdayend->format("Y-m-d H:i:s") : null, PDO::PARAM_STR);
                        break;
                    case 'fridayStart':
                        $stmt->bindValue($identifier, $this->fridaystart ? $this->fridaystart->format("Y-m-d H:i:s") : null, PDO::PARAM_STR);
                        break;
                    case 'fridayEnd':
                        $stmt->bindValue($identifier, $this->fridayend ? $this->fridayend->format("Y-m-d H:i:s") : null, PDO::PARAM_STR);
                        break;
                    case 'saturdayStart':
                        $stmt->bindValue($identifier, $this->saturdaystart ? $this->saturdaystart->format("Y-m-d H:i:s") : null, PDO::PARAM_STR);
                        break;
                    case 'saturdayEnd':
                        $stmt->bindValue($identifier, $this->saturdayend ? $this->saturdayend->format("Y-m-d H:i:s") : null, PDO::PARAM_STR);
                        break;
                    case 'sundayStart':
                        $stmt->bindValue($identifier, $this->sundaystart ? $this->sundaystart->format("Y-m-d H:i:s") : null, PDO::PARAM_STR);
                        break;
                    case 'sundayEnd':
                        $stmt->bindValue($identifier, $this->sundayend ? $this->sundayend->format("Y-m-d H:i:s") : null, PDO::PARAM_STR);
                        break;
                    case 'created_at':
                        $stmt->bindValue($identifier, $this->created_at ? $this->created_at->format("Y-m-d H:i:s") : null, PDO::PARAM_STR);
                        break;
                    case 'updated_at':
                        $stmt->bindValue($identifier, $this->updated_at ? $this->updated_at->format("Y-m-d H:i:s") : null, PDO::PARAM_STR);
                        break;
                }
            }
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute INSERT statement [%s]', $sql), 0, $e);
        }

        try {
            $pk = $con->lastInsertId();
        } catch (Exception $e) {
            throw new PropelException('Unable to get autoincrement id.', 0, $e);
        }
        $this->setUserid($pk);

        $this->setNew(false);
    }

    /**
     * Update the row in the database.
     *
     * @param      ConnectionInterface $con
     *
     * @return Integer Number of updated rows
     * @see doSave()
     */
    protected function doUpdate(ConnectionInterface $con)
    {
        $selectCriteria = $this->buildPkeyCriteria();
        $valuesCriteria = $this->buildCriteria();

        return $selectCriteria->doUpdate($valuesCriteria, $con);
    }

    /**
     * Retrieves a field from the object by name passed in as a string.
     *
     * @param      string $name name
     * @param      string $type The type of fieldname the $name is of:
     *                     one of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                     TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *                     Defaults to TableMap::TYPE_PHPNAME.
     * @return mixed Value of field.
     */
    public function getByName($name, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = UserTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
        $field = $this->getByPosition($pos);

        return $field;
    }

    /**
     * Retrieves a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param      int $pos position in xml schema
     * @return mixed Value of field at $pos
     */
    public function getByPosition($pos)
    {
        switch ($pos) {
            case 0:
                return $this->getUserid();
                break;
            case 1:
                return $this->getEmail();
                break;
            case 2:
                return $this->getIsprovider();
                break;
            case 3:
                return $this->getFirstname();
                break;
            case 4:
                return $this->getLastname();
                break;
            case 5:
                return $this->getSuffix();
                break;
            case 6:
                return $this->getAddress();
                break;
            case 7:
                return $this->getCity();
                break;
            case 8:
                return $this->getZipcode();
                break;
            case 9:
                return $this->getPhonenumber();
                break;
            case 10:
                return $this->getPhoneok();
                break;
            case 11:
                return $this->getTextok();
                break;
            case 12:
                return $this->getEmailok();
                break;
            case 13:
                return $this->getMondaystart();
                break;
            case 14:
                return $this->getMondayend();
                break;
            case 15:
                return $this->getTuesdaystart();
                break;
            case 16:
                return $this->getTuesdayend();
                break;
            case 17:
                return $this->getWednesdaystart();
                break;
            case 18:
                return $this->getWednesdayend();
                break;
            case 19:
                return $this->getThursdaystart();
                break;
            case 20:
                return $this->getThursdayend();
                break;
            case 21:
                return $this->getFridaystart();
                break;
            case 22:
                return $this->getFridayend();
                break;
            case 23:
                return $this->getSaturdaystart();
                break;
            case 24:
                return $this->getSaturdayend();
                break;
            case 25:
                return $this->getSundaystart();
                break;
            case 26:
                return $this->getSundayend();
                break;
            case 27:
                return $this->getCreatedAt();
                break;
            case 28:
                return $this->getUpdatedAt();
                break;
            default:
                return null;
                break;
        } // switch()
    }

    /**
     * Exports the object as an array.
     *
     * You can specify the key type of the array by passing one of the class
     * type constants.
     *
     * @param     string  $keyType (optional) One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME,
     *                    TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *                    Defaults to TableMap::TYPE_PHPNAME.
     * @param     boolean $includeLazyLoadColumns (optional) Whether to include lazy loaded columns. Defaults to TRUE.
     * @param     array $alreadyDumpedObjects List of objects to skip to avoid recursion
     * @param     boolean $includeForeignObjects (optional) Whether to include hydrated related objects. Default to FALSE.
     *
     * @return array an associative array containing the field names (as keys) and field values
     */
    public function toArray($keyType = TableMap::TYPE_PHPNAME, $includeLazyLoadColumns = true, $alreadyDumpedObjects = array(), $includeForeignObjects = false)
    {

        if (isset($alreadyDumpedObjects['User'][$this->hashCode()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['User'][$this->hashCode()] = true;
        $keys = UserTableMap::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getUserid(),
            $keys[1] => $this->getEmail(),
            $keys[2] => $this->getIsprovider(),
            $keys[3] => $this->getFirstname(),
            $keys[4] => $this->getLastname(),
            $keys[5] => $this->getSuffix(),
            $keys[6] => $this->getAddress(),
            $keys[7] => $this->getCity(),
            $keys[8] => $this->getZipcode(),
            $keys[9] => $this->getPhonenumber(),
            $keys[10] => $this->getPhoneok(),
            $keys[11] => $this->getTextok(),
            $keys[12] => $this->getEmailok(),
            $keys[13] => $this->getMondaystart(),
            $keys[14] => $this->getMondayend(),
            $keys[15] => $this->getTuesdaystart(),
            $keys[16] => $this->getTuesdayend(),
            $keys[17] => $this->getWednesdaystart(),
            $keys[18] => $this->getWednesdayend(),
            $keys[19] => $this->getThursdaystart(),
            $keys[20] => $this->getThursdayend(),
            $keys[21] => $this->getFridaystart(),
            $keys[22] => $this->getFridayend(),
            $keys[23] => $this->getSaturdaystart(),
            $keys[24] => $this->getSaturdayend(),
            $keys[25] => $this->getSundaystart(),
            $keys[26] => $this->getSundayend(),
            $keys[27] => $this->getCreatedAt(),
            $keys[28] => $this->getUpdatedAt(),
        );

        $utc = new \DateTimeZone('utc');
        if ($result[$keys[13]] instanceof \DateTime) {
            // When changing timezone we don't want to change existing instances
            $dateTime = clone $result[$keys[13]];
            $result[$keys[13]] = $dateTime->setTimezone($utc)->format('Y-m-d\TH:i:s\Z');
        }

        if ($result[$keys[14]] instanceof \DateTime) {
            // When changing timezone we don't want to change existing instances
            $dateTime = clone $result[$keys[14]];
            $result[$keys[14]] = $dateTime->setTimezone($utc)->format('Y-m-d\TH:i:s\Z');
        }

        if ($result[$keys[15]] instanceof \DateTime) {
            // When changing timezone we don't want to change existing instances
            $dateTime = clone $result[$keys[15]];
            $result[$keys[15]] = $dateTime->setTimezone($utc)->format('Y-m-d\TH:i:s\Z');
        }

        if ($result[$keys[16]] instanceof \DateTime) {
            // When changing timezone we don't want to change existing instances
            $dateTime = clone $result[$keys[16]];
            $result[$keys[16]] = $dateTime->setTimezone($utc)->format('Y-m-d\TH:i:s\Z');
        }

        if ($result[$keys[17]] instanceof \DateTime) {
            // When changing timezone we don't want to change existing instances
            $dateTime = clone $result[$keys[17]];
            $result[$keys[17]] = $dateTime->setTimezone($utc)->format('Y-m-d\TH:i:s\Z');
        }

        if ($result[$keys[18]] instanceof \DateTime) {
            // When changing timezone we don't want to change existing instances
            $dateTime = clone $result[$keys[18]];
            $result[$keys[18]] = $dateTime->setTimezone($utc)->format('Y-m-d\TH:i:s\Z');
        }

        if ($result[$keys[19]] instanceof \DateTime) {
            // When changing timezone we don't want to change existing instances
            $dateTime = clone $result[$keys[19]];
            $result[$keys[19]] = $dateTime->setTimezone($utc)->format('Y-m-d\TH:i:s\Z');
        }

        if ($result[$keys[20]] instanceof \DateTime) {
            // When changing timezone we don't want to change existing instances
            $dateTime = clone $result[$keys[20]];
            $result[$keys[20]] = $dateTime->setTimezone($utc)->format('Y-m-d\TH:i:s\Z');
        }

        if ($result[$keys[21]] instanceof \DateTime) {
            // When changing timezone we don't want to change existing instances
            $dateTime = clone $result[$keys[21]];
            $result[$keys[21]] = $dateTime->setTimezone($utc)->format('Y-m-d\TH:i:s\Z');
        }

        if ($result[$keys[22]] instanceof \DateTime) {
            // When changing timezone we don't want to change existing instances
            $dateTime = clone $result[$keys[22]];
            $result[$keys[22]] = $dateTime->setTimezone($utc)->format('Y-m-d\TH:i:s\Z');
        }

        if ($result[$keys[23]] instanceof \DateTime) {
            // When changing timezone we don't want to change existing instances
            $dateTime = clone $result[$keys[23]];
            $result[$keys[23]] = $dateTime->setTimezone($utc)->format('Y-m-d\TH:i:s\Z');
        }

        if ($result[$keys[24]] instanceof \DateTime) {
            // When changing timezone we don't want to change existing instances
            $dateTime = clone $result[$keys[24]];
            $result[$keys[24]] = $dateTime->setTimezone($utc)->format('Y-m-d\TH:i:s\Z');
        }

        if ($result[$keys[25]] instanceof \DateTime) {
            // When changing timezone we don't want to change existing instances
            $dateTime = clone $result[$keys[25]];
            $result[$keys[25]] = $dateTime->setTimezone($utc)->format('Y-m-d\TH:i:s\Z');
        }

        if ($result[$keys[26]] instanceof \DateTime) {
            // When changing timezone we don't want to change existing instances
            $dateTime = clone $result[$keys[26]];
            $result[$keys[26]] = $dateTime->setTimezone($utc)->format('Y-m-d\TH:i:s\Z');
        }

        if ($result[$keys[27]] instanceof \DateTime) {
            // When changing timezone we don't want to change existing instances
            $dateTime = clone $result[$keys[27]];
            $result[$keys[27]] = $dateTime->setTimezone($utc)->format('Y-m-d\TH:i:s\Z');
        }

        if ($result[$keys[28]] instanceof \DateTime) {
            // When changing timezone we don't want to change existing instances
            $dateTime = clone $result[$keys[28]];
            $result[$keys[28]] = $dateTime->setTimezone($utc)->format('Y-m-d\TH:i:s\Z');
        }

        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->collLicenses) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'licenses';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'licenses';
                        break;
                    default:
                        $key = 'Licenses';
                }

                $result[$key] = $this->collLicenses->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collLocations) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'locations';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'locations';
                        break;
                    default:
                        $key = 'Locations';
                }

                $result[$key] = $this->collLocations->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
        }

        return $result;
    }

    /**
     * Sets a field from the object by name passed in as a string.
     *
     * @param  string $name
     * @param  mixed  $value field value
     * @param  string $type The type of fieldname the $name is of:
     *                one of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *                Defaults to TableMap::TYPE_PHPNAME.
     * @return $this|\User
     */
    public function setByName($name, $value, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = UserTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

        return $this->setByPosition($pos, $value);
    }

    /**
     * Sets a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param  int $pos position in xml schema
     * @param  mixed $value field value
     * @return $this|\User
     */
    public function setByPosition($pos, $value)
    {
        switch ($pos) {
            case 0:
                $this->setUserid($value);
                break;
            case 1:
                $this->setEmail($value);
                break;
            case 2:
                $this->setIsprovider($value);
                break;
            case 3:
                $this->setFirstname($value);
                break;
            case 4:
                $this->setLastname($value);
                break;
            case 5:
                $this->setSuffix($value);
                break;
            case 6:
                $this->setAddress($value);
                break;
            case 7:
                $this->setCity($value);
                break;
            case 8:
                $this->setZipcode($value);
                break;
            case 9:
                $this->setPhonenumber($value);
                break;
            case 10:
                $this->setPhoneok($value);
                break;
            case 11:
                $this->setTextok($value);
                break;
            case 12:
                $this->setEmailok($value);
                break;
            case 13:
                $this->setMondaystart($value);
                break;
            case 14:
                $this->setMondayend($value);
                break;
            case 15:
                $this->setTuesdaystart($value);
                break;
            case 16:
                $this->setTuesdayend($value);
                break;
            case 17:
                $this->setWednesdaystart($value);
                break;
            case 18:
                $this->setWednesdayend($value);
                break;
            case 19:
                $this->setThursdaystart($value);
                break;
            case 20:
                $this->setThursdayend($value);
                break;
            case 21:
                $this->setFridaystart($value);
                break;
            case 22:
                $this->setFridayend($value);
                break;
            case 23:
                $this->setSaturdaystart($value);
                break;
            case 24:
                $this->setSaturdayend($value);
                break;
            case 25:
                $this->setSundaystart($value);
                break;
            case 26:
                $this->setSundayend($value);
                break;
            case 27:
                $this->setCreatedAt($value);
                break;
            case 28:
                $this->setUpdatedAt($value);
                break;
        } // switch()

        return $this;
    }

    /**
     * Populates the object using an array.
     *
     * This is particularly useful when populating an object from one of the
     * request arrays (e.g. $_POST).  This method goes through the column
     * names, checking to see whether a matching key exists in populated
     * array. If so the setByName() method is called for that column.
     *
     * You can specify the key type of the array by additionally passing one
     * of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME,
     * TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     * The default key type is the column's TableMap::TYPE_PHPNAME.
     *
     * @param      array  $arr     An array to populate the object from.
     * @param      string $keyType The type of keys the array uses.
     * @return void
     */
    public function fromArray($arr, $keyType = TableMap::TYPE_PHPNAME)
    {
        $keys = UserTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setUserid($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setEmail($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setIsprovider($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setFirstname($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setLastname($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setSuffix($arr[$keys[5]]);
        }
        if (array_key_exists($keys[6], $arr)) {
            $this->setAddress($arr[$keys[6]]);
        }
        if (array_key_exists($keys[7], $arr)) {
            $this->setCity($arr[$keys[7]]);
        }
        if (array_key_exists($keys[8], $arr)) {
            $this->setZipcode($arr[$keys[8]]);
        }
        if (array_key_exists($keys[9], $arr)) {
            $this->setPhonenumber($arr[$keys[9]]);
        }
        if (array_key_exists($keys[10], $arr)) {
            $this->setPhoneok($arr[$keys[10]]);
        }
        if (array_key_exists($keys[11], $arr)) {
            $this->setTextok($arr[$keys[11]]);
        }
        if (array_key_exists($keys[12], $arr)) {
            $this->setEmailok($arr[$keys[12]]);
        }
        if (array_key_exists($keys[13], $arr)) {
            $this->setMondaystart($arr[$keys[13]]);
        }
        if (array_key_exists($keys[14], $arr)) {
            $this->setMondayend($arr[$keys[14]]);
        }
        if (array_key_exists($keys[15], $arr)) {
            $this->setTuesdaystart($arr[$keys[15]]);
        }
        if (array_key_exists($keys[16], $arr)) {
            $this->setTuesdayend($arr[$keys[16]]);
        }
        if (array_key_exists($keys[17], $arr)) {
            $this->setWednesdaystart($arr[$keys[17]]);
        }
        if (array_key_exists($keys[18], $arr)) {
            $this->setWednesdayend($arr[$keys[18]]);
        }
        if (array_key_exists($keys[19], $arr)) {
            $this->setThursdaystart($arr[$keys[19]]);
        }
        if (array_key_exists($keys[20], $arr)) {
            $this->setThursdayend($arr[$keys[20]]);
        }
        if (array_key_exists($keys[21], $arr)) {
            $this->setFridaystart($arr[$keys[21]]);
        }
        if (array_key_exists($keys[22], $arr)) {
            $this->setFridayend($arr[$keys[22]]);
        }
        if (array_key_exists($keys[23], $arr)) {
            $this->setSaturdaystart($arr[$keys[23]]);
        }
        if (array_key_exists($keys[24], $arr)) {
            $this->setSaturdayend($arr[$keys[24]]);
        }
        if (array_key_exists($keys[25], $arr)) {
            $this->setSundaystart($arr[$keys[25]]);
        }
        if (array_key_exists($keys[26], $arr)) {
            $this->setSundayend($arr[$keys[26]]);
        }
        if (array_key_exists($keys[27], $arr)) {
            $this->setCreatedAt($arr[$keys[27]]);
        }
        if (array_key_exists($keys[28], $arr)) {
            $this->setUpdatedAt($arr[$keys[28]]);
        }
    }

     /**
     * Populate the current object from a string, using a given parser format
     * <code>
     * $book = new Book();
     * $book->importFrom('JSON', '{"Id":9012,"Title":"Don Juan","ISBN":"0140422161","Price":12.99,"PublisherId":1234,"AuthorId":5678}');
     * </code>
     *
     * You can specify the key type of the array by additionally passing one
     * of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME,
     * TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     * The default key type is the column's TableMap::TYPE_PHPNAME.
     *
     * @param mixed $parser A AbstractParser instance,
     *                       or a format name ('XML', 'YAML', 'JSON', 'CSV')
     * @param string $data The source data to import from
     * @param string $keyType The type of keys the array uses.
     *
     * @return $this|\User The current object, for fluid interface
     */
    public function importFrom($parser, $data, $keyType = TableMap::TYPE_PHPNAME)
    {
        if (!$parser instanceof AbstractParser) {
            $parser = AbstractParser::getParser($parser);
        }

        $this->fromArray($parser->toArray($data), $keyType);

        return $this;
    }

    /**
     * Build a Criteria object containing the values of all modified columns in this object.
     *
     * @return Criteria The Criteria object containing all modified values.
     */
    public function buildCriteria()
    {
        $criteria = new Criteria(UserTableMap::DATABASE_NAME);

        if ($this->isColumnModified(UserTableMap::COL_USERID)) {
            $criteria->add(UserTableMap::COL_USERID, $this->userid);
        }
        if ($this->isColumnModified(UserTableMap::COL_EMAIL)) {
            $criteria->add(UserTableMap::COL_EMAIL, $this->email);
        }
        if ($this->isColumnModified(UserTableMap::COL_ISPROVIDER)) {
            $criteria->add(UserTableMap::COL_ISPROVIDER, $this->isprovider);
        }
        if ($this->isColumnModified(UserTableMap::COL_FIRSTNAME)) {
            $criteria->add(UserTableMap::COL_FIRSTNAME, $this->firstname);
        }
        if ($this->isColumnModified(UserTableMap::COL_LASTNAME)) {
            $criteria->add(UserTableMap::COL_LASTNAME, $this->lastname);
        }
        if ($this->isColumnModified(UserTableMap::COL_SUFFIX)) {
            $criteria->add(UserTableMap::COL_SUFFIX, $this->suffix);
        }
        if ($this->isColumnModified(UserTableMap::COL_ADDRESS)) {
            $criteria->add(UserTableMap::COL_ADDRESS, $this->address);
        }
        if ($this->isColumnModified(UserTableMap::COL_CITY)) {
            $criteria->add(UserTableMap::COL_CITY, $this->city);
        }
        if ($this->isColumnModified(UserTableMap::COL_ZIPCODE)) {
            $criteria->add(UserTableMap::COL_ZIPCODE, $this->zipcode);
        }
        if ($this->isColumnModified(UserTableMap::COL_PHONENUMBER)) {
            $criteria->add(UserTableMap::COL_PHONENUMBER, $this->phonenumber);
        }
        if ($this->isColumnModified(UserTableMap::COL_PHONEOK)) {
            $criteria->add(UserTableMap::COL_PHONEOK, $this->phoneok);
        }
        if ($this->isColumnModified(UserTableMap::COL_TEXTOK)) {
            $criteria->add(UserTableMap::COL_TEXTOK, $this->textok);
        }
        if ($this->isColumnModified(UserTableMap::COL_EMAILOK)) {
            $criteria->add(UserTableMap::COL_EMAILOK, $this->emailok);
        }
        if ($this->isColumnModified(UserTableMap::COL_MONDAYSTART)) {
            $criteria->add(UserTableMap::COL_MONDAYSTART, $this->mondaystart);
        }
        if ($this->isColumnModified(UserTableMap::COL_MONDAYEND)) {
            $criteria->add(UserTableMap::COL_MONDAYEND, $this->mondayend);
        }
        if ($this->isColumnModified(UserTableMap::COL_TUESDAYSTART)) {
            $criteria->add(UserTableMap::COL_TUESDAYSTART, $this->tuesdaystart);
        }
        if ($this->isColumnModified(UserTableMap::COL_TUESDAYEND)) {
            $criteria->add(UserTableMap::COL_TUESDAYEND, $this->tuesdayend);
        }
        if ($this->isColumnModified(UserTableMap::COL_WEDNESDAYSTART)) {
            $criteria->add(UserTableMap::COL_WEDNESDAYSTART, $this->wednesdaystart);
        }
        if ($this->isColumnModified(UserTableMap::COL_WEDNESDAYEND)) {
            $criteria->add(UserTableMap::COL_WEDNESDAYEND, $this->wednesdayend);
        }
        if ($this->isColumnModified(UserTableMap::COL_THURSDAYSTART)) {
            $criteria->add(UserTableMap::COL_THURSDAYSTART, $this->thursdaystart);
        }
        if ($this->isColumnModified(UserTableMap::COL_THURSDAYEND)) {
            $criteria->add(UserTableMap::COL_THURSDAYEND, $this->thursdayend);
        }
        if ($this->isColumnModified(UserTableMap::COL_FRIDAYSTART)) {
            $criteria->add(UserTableMap::COL_FRIDAYSTART, $this->fridaystart);
        }
        if ($this->isColumnModified(UserTableMap::COL_FRIDAYEND)) {
            $criteria->add(UserTableMap::COL_FRIDAYEND, $this->fridayend);
        }
        if ($this->isColumnModified(UserTableMap::COL_SATURDAYSTART)) {
            $criteria->add(UserTableMap::COL_SATURDAYSTART, $this->saturdaystart);
        }
        if ($this->isColumnModified(UserTableMap::COL_SATURDAYEND)) {
            $criteria->add(UserTableMap::COL_SATURDAYEND, $this->saturdayend);
        }
        if ($this->isColumnModified(UserTableMap::COL_SUNDAYSTART)) {
            $criteria->add(UserTableMap::COL_SUNDAYSTART, $this->sundaystart);
        }
        if ($this->isColumnModified(UserTableMap::COL_SUNDAYEND)) {
            $criteria->add(UserTableMap::COL_SUNDAYEND, $this->sundayend);
        }
        if ($this->isColumnModified(UserTableMap::COL_CREATED_AT)) {
            $criteria->add(UserTableMap::COL_CREATED_AT, $this->created_at);
        }
        if ($this->isColumnModified(UserTableMap::COL_UPDATED_AT)) {
            $criteria->add(UserTableMap::COL_UPDATED_AT, $this->updated_at);
        }

        return $criteria;
    }

    /**
     * Builds a Criteria object containing the primary key for this object.
     *
     * Unlike buildCriteria() this method includes the primary key values regardless
     * of whether or not they have been modified.
     *
     * @throws LogicException if no primary key is defined
     *
     * @return Criteria The Criteria object containing value(s) for primary key(s).
     */
    public function buildPkeyCriteria()
    {
        $criteria = ChildUserQuery::create();
        $criteria->add(UserTableMap::COL_USERID, $this->userid);

        return $criteria;
    }

    /**
     * If the primary key is not null, return the hashcode of the
     * primary key. Otherwise, return the hash code of the object.
     *
     * @return int Hashcode
     */
    public function hashCode()
    {
        $validPk = null !== $this->getUserid();

        $validPrimaryKeyFKs = 0;
        $primaryKeyFKs = [];

        if ($validPk) {
            return crc32(json_encode($this->getPrimaryKey(), JSON_UNESCAPED_UNICODE));
        } elseif ($validPrimaryKeyFKs) {
            return crc32(json_encode($primaryKeyFKs, JSON_UNESCAPED_UNICODE));
        }

        return spl_object_hash($this);
    }

    /**
     * Returns the primary key for this object (row).
     * @return int
     */
    public function getPrimaryKey()
    {
        return $this->getUserid();
    }

    /**
     * Generic method to set the primary key (userid column).
     *
     * @param       int $key Primary key.
     * @return void
     */
    public function setPrimaryKey($key)
    {
        $this->setUserid($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     * @return boolean
     */
    public function isPrimaryKeyNull()
    {
        return null === $this->getUserid();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param      object $copyObj An object of \User (or compatible) type.
     * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setEmail($this->getEmail());
        $copyObj->setIsprovider($this->getIsprovider());
        $copyObj->setFirstname($this->getFirstname());
        $copyObj->setLastname($this->getLastname());
        $copyObj->setSuffix($this->getSuffix());
        $copyObj->setAddress($this->getAddress());
        $copyObj->setCity($this->getCity());
        $copyObj->setZipcode($this->getZipcode());
        $copyObj->setPhonenumber($this->getPhonenumber());
        $copyObj->setPhoneok($this->getPhoneok());
        $copyObj->setTextok($this->getTextok());
        $copyObj->setEmailok($this->getEmailok());
        $copyObj->setMondaystart($this->getMondaystart());
        $copyObj->setMondayend($this->getMondayend());
        $copyObj->setTuesdaystart($this->getTuesdaystart());
        $copyObj->setTuesdayend($this->getTuesdayend());
        $copyObj->setWednesdaystart($this->getWednesdaystart());
        $copyObj->setWednesdayend($this->getWednesdayend());
        $copyObj->setThursdaystart($this->getThursdaystart());
        $copyObj->setThursdayend($this->getThursdayend());
        $copyObj->setFridaystart($this->getFridaystart());
        $copyObj->setFridayend($this->getFridayend());
        $copyObj->setSaturdaystart($this->getSaturdaystart());
        $copyObj->setSaturdayend($this->getSaturdayend());
        $copyObj->setSundaystart($this->getSundaystart());
        $copyObj->setSundayend($this->getSundayend());
        $copyObj->setCreatedAt($this->getCreatedAt());
        $copyObj->setUpdatedAt($this->getUpdatedAt());

        if ($deepCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);

            foreach ($this->getLicenses() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addLicense($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getLocations() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addLocation($relObj->copy($deepCopy));
                }
            }

        } // if ($deepCopy)

        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setUserid(NULL); // this is a auto-increment column, so set to default value
        }
    }

    /**
     * Makes a copy of this object that will be inserted as a new row in table when saved.
     * It creates a new object filling in the simple attributes, but skipping any primary
     * keys that are defined for the table.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param  boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @return \User Clone of current object.
     * @throws PropelException
     */
    public function copy($deepCopy = false)
    {
        // we use get_class(), because this might be a subclass
        $clazz = get_class($this);
        $copyObj = new $clazz();
        $this->copyInto($copyObj, $deepCopy);

        return $copyObj;
    }


    /**
     * Initializes a collection based on the name of a relation.
     * Avoids crafting an 'init[$relationName]s' method name
     * that wouldn't work when StandardEnglishPluralizer is used.
     *
     * @param      string $relationName The name of the relation to initialize
     * @return void
     */
    public function initRelation($relationName)
    {
        if ('License' == $relationName) {
            return $this->initLicenses();
        }
        if ('Location' == $relationName) {
            return $this->initLocations();
        }
    }

    /**
     * Clears out the collLicenses collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addLicenses()
     */
    public function clearLicenses()
    {
        $this->collLicenses = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collLicenses collection loaded partially.
     */
    public function resetPartialLicenses($v = true)
    {
        $this->collLicensesPartial = $v;
    }

    /**
     * Initializes the collLicenses collection.
     *
     * By default this just sets the collLicenses collection to an empty array (like clearcollLicenses());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initLicenses($overrideExisting = true)
    {
        if (null !== $this->collLicenses && !$overrideExisting) {
            return;
        }
        $this->collLicenses = new ObjectCollection();
        $this->collLicenses->setModel('\License');
    }

    /**
     * Gets an array of ChildLicense objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildUser is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildLicense[] List of ChildLicense objects
     * @throws PropelException
     */
    public function getLicenses(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collLicensesPartial && !$this->isNew();
        if (null === $this->collLicenses || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collLicenses) {
                // return empty collection
                $this->initLicenses();
            } else {
                $collLicenses = ChildLicenseQuery::create(null, $criteria)
                    ->filterByUser($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collLicensesPartial && count($collLicenses)) {
                        $this->initLicenses(false);

                        foreach ($collLicenses as $obj) {
                            if (false == $this->collLicenses->contains($obj)) {
                                $this->collLicenses->append($obj);
                            }
                        }

                        $this->collLicensesPartial = true;
                    }

                    return $collLicenses;
                }

                if ($partial && $this->collLicenses) {
                    foreach ($this->collLicenses as $obj) {
                        if ($obj->isNew()) {
                            $collLicenses[] = $obj;
                        }
                    }
                }

                $this->collLicenses = $collLicenses;
                $this->collLicensesPartial = false;
            }
        }

        return $this->collLicenses;
    }

    /**
     * Sets a collection of ChildLicense objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $licenses A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildUser The current object (for fluent API support)
     */
    public function setLicenses(Collection $licenses, ConnectionInterface $con = null)
    {
        /** @var ChildLicense[] $licensesToDelete */
        $licensesToDelete = $this->getLicenses(new Criteria(), $con)->diff($licenses);


        $this->licensesScheduledForDeletion = $licensesToDelete;

        foreach ($licensesToDelete as $licenseRemoved) {
            $licenseRemoved->setUser(null);
        }

        $this->collLicenses = null;
        foreach ($licenses as $license) {
            $this->addLicense($license);
        }

        $this->collLicenses = $licenses;
        $this->collLicensesPartial = false;

        return $this;
    }

    /**
     * Returns the number of related License objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related License objects.
     * @throws PropelException
     */
    public function countLicenses(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collLicensesPartial && !$this->isNew();
        if (null === $this->collLicenses || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collLicenses) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getLicenses());
            }

            $query = ChildLicenseQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByUser($this)
                ->count($con);
        }

        return count($this->collLicenses);
    }

    /**
     * Method called to associate a ChildLicense object to this object
     * through the ChildLicense foreign key attribute.
     *
     * @param  ChildLicense $l ChildLicense
     * @return $this|\User The current object (for fluent API support)
     */
    public function addLicense(ChildLicense $l)
    {
        if ($this->collLicenses === null) {
            $this->initLicenses();
            $this->collLicensesPartial = true;
        }

        if (!$this->collLicenses->contains($l)) {
            $this->doAddLicense($l);
        }

        return $this;
    }

    /**
     * @param ChildLicense $license The ChildLicense object to add.
     */
    protected function doAddLicense(ChildLicense $license)
    {
        $this->collLicenses[]= $license;
        $license->setUser($this);
    }

    /**
     * @param  ChildLicense $license The ChildLicense object to remove.
     * @return $this|ChildUser The current object (for fluent API support)
     */
    public function removeLicense(ChildLicense $license)
    {
        if ($this->getLicenses()->contains($license)) {
            $pos = $this->collLicenses->search($license);
            $this->collLicenses->remove($pos);
            if (null === $this->licensesScheduledForDeletion) {
                $this->licensesScheduledForDeletion = clone $this->collLicenses;
                $this->licensesScheduledForDeletion->clear();
            }
            $this->licensesScheduledForDeletion[]= clone $license;
            $license->setUser(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this User is new, it will return
     * an empty collection; or if this User has previously
     * been saved, it will retrieve related Licenses from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in User.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildLicense[] List of ChildLicense objects
     */
    public function getLicensesJoinService(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildLicenseQuery::create(null, $criteria);
        $query->joinWith('Service', $joinBehavior);

        return $this->getLicenses($query, $con);
    }

    /**
     * Clears out the collLocations collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addLocations()
     */
    public function clearLocations()
    {
        $this->collLocations = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collLocations collection loaded partially.
     */
    public function resetPartialLocations($v = true)
    {
        $this->collLocationsPartial = $v;
    }

    /**
     * Initializes the collLocations collection.
     *
     * By default this just sets the collLocations collection to an empty array (like clearcollLocations());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initLocations($overrideExisting = true)
    {
        if (null !== $this->collLocations && !$overrideExisting) {
            return;
        }
        $this->collLocations = new ObjectCollection();
        $this->collLocations->setModel('\Location');
    }

    /**
     * Gets an array of ChildLocation objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildUser is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildLocation[] List of ChildLocation objects
     * @throws PropelException
     */
    public function getLocations(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collLocationsPartial && !$this->isNew();
        if (null === $this->collLocations || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collLocations) {
                // return empty collection
                $this->initLocations();
            } else {
                $collLocations = ChildLocationQuery::create(null, $criteria)
                    ->filterByUser($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collLocationsPartial && count($collLocations)) {
                        $this->initLocations(false);

                        foreach ($collLocations as $obj) {
                            if (false == $this->collLocations->contains($obj)) {
                                $this->collLocations->append($obj);
                            }
                        }

                        $this->collLocationsPartial = true;
                    }

                    return $collLocations;
                }

                if ($partial && $this->collLocations) {
                    foreach ($this->collLocations as $obj) {
                        if ($obj->isNew()) {
                            $collLocations[] = $obj;
                        }
                    }
                }

                $this->collLocations = $collLocations;
                $this->collLocationsPartial = false;
            }
        }

        return $this->collLocations;
    }

    /**
     * Sets a collection of ChildLocation objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $locations A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildUser The current object (for fluent API support)
     */
    public function setLocations(Collection $locations, ConnectionInterface $con = null)
    {
        /** @var ChildLocation[] $locationsToDelete */
        $locationsToDelete = $this->getLocations(new Criteria(), $con)->diff($locations);


        $this->locationsScheduledForDeletion = $locationsToDelete;

        foreach ($locationsToDelete as $locationRemoved) {
            $locationRemoved->setUser(null);
        }

        $this->collLocations = null;
        foreach ($locations as $location) {
            $this->addLocation($location);
        }

        $this->collLocations = $locations;
        $this->collLocationsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Location objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related Location objects.
     * @throws PropelException
     */
    public function countLocations(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collLocationsPartial && !$this->isNew();
        if (null === $this->collLocations || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collLocations) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getLocations());
            }

            $query = ChildLocationQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByUser($this)
                ->count($con);
        }

        return count($this->collLocations);
    }

    /**
     * Method called to associate a ChildLocation object to this object
     * through the ChildLocation foreign key attribute.
     *
     * @param  ChildLocation $l ChildLocation
     * @return $this|\User The current object (for fluent API support)
     */
    public function addLocation(ChildLocation $l)
    {
        if ($this->collLocations === null) {
            $this->initLocations();
            $this->collLocationsPartial = true;
        }

        if (!$this->collLocations->contains($l)) {
            $this->doAddLocation($l);
        }

        return $this;
    }

    /**
     * @param ChildLocation $location The ChildLocation object to add.
     */
    protected function doAddLocation(ChildLocation $location)
    {
        $this->collLocations[]= $location;
        $location->setUser($this);
    }

    /**
     * @param  ChildLocation $location The ChildLocation object to remove.
     * @return $this|ChildUser The current object (for fluent API support)
     */
    public function removeLocation(ChildLocation $location)
    {
        if ($this->getLocations()->contains($location)) {
            $pos = $this->collLocations->search($location);
            $this->collLocations->remove($pos);
            if (null === $this->locationsScheduledForDeletion) {
                $this->locationsScheduledForDeletion = clone $this->collLocations;
                $this->locationsScheduledForDeletion->clear();
            }
            $this->locationsScheduledForDeletion[]= clone $location;
            $location->setUser(null);
        }

        return $this;
    }

    /**
     * Clears the current object, sets all attributes to their default values and removes
     * outgoing references as well as back-references (from other objects to this one. Results probably in a database
     * change of those foreign objects when you call `save` there).
     */
    public function clear()
    {
        $this->userid = null;
        $this->email = null;
        $this->isprovider = null;
        $this->firstname = null;
        $this->lastname = null;
        $this->suffix = null;
        $this->address = null;
        $this->city = null;
        $this->zipcode = null;
        $this->phonenumber = null;
        $this->phoneok = null;
        $this->textok = null;
        $this->emailok = null;
        $this->mondaystart = null;
        $this->mondayend = null;
        $this->tuesdaystart = null;
        $this->tuesdayend = null;
        $this->wednesdaystart = null;
        $this->wednesdayend = null;
        $this->thursdaystart = null;
        $this->thursdayend = null;
        $this->fridaystart = null;
        $this->fridayend = null;
        $this->saturdaystart = null;
        $this->saturdayend = null;
        $this->sundaystart = null;
        $this->sundayend = null;
        $this->created_at = null;
        $this->updated_at = null;
        $this->alreadyInSave = false;
        $this->clearAllReferences();
        $this->applyDefaultValues();
        $this->resetModified();
        $this->setNew(true);
        $this->setDeleted(false);
    }

    /**
     * Resets all references and back-references to other model objects or collections of model objects.
     *
     * This method is used to reset all php object references (not the actual reference in the database).
     * Necessary for object serialisation.
     *
     * @param      boolean $deep Whether to also clear the references on all referrer objects.
     */
    public function clearAllReferences($deep = false)
    {
        if ($deep) {
            if ($this->collLicenses) {
                foreach ($this->collLicenses as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collLocations) {
                foreach ($this->collLocations as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        $this->collLicenses = null;
        $this->collLocations = null;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(UserTableMap::DEFAULT_STRING_FORMAT);
    }

    // timestampable behavior

    /**
     * Mark the current object so that the update date doesn't get updated during next save
     *
     * @return     $this|ChildUser The current object (for fluent API support)
     */
    public function keepUpdateDateUnchanged()
    {
        $this->modifiedColumns[UserTableMap::COL_UPDATED_AT] = true;

        return $this;
    }

    /**
     * Code to be run before persisting the object
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preSave(ConnectionInterface $con = null)
    {
        return true;
    }

    /**
     * Code to be run after persisting the object
     * @param ConnectionInterface $con
     */
    public function postSave(ConnectionInterface $con = null)
    {

    }

    /**
     * Code to be run before inserting to database
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preInsert(ConnectionInterface $con = null)
    {
        return true;
    }

    /**
     * Code to be run after inserting to database
     * @param ConnectionInterface $con
     */
    public function postInsert(ConnectionInterface $con = null)
    {

    }

    /**
     * Code to be run before updating the object in database
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preUpdate(ConnectionInterface $con = null)
    {
        return true;
    }

    /**
     * Code to be run after updating the object in database
     * @param ConnectionInterface $con
     */
    public function postUpdate(ConnectionInterface $con = null)
    {

    }

    /**
     * Code to be run before deleting the object in database
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preDelete(ConnectionInterface $con = null)
    {
        return true;
    }

    /**
     * Code to be run after deleting the object in database
     * @param ConnectionInterface $con
     */
    public function postDelete(ConnectionInterface $con = null)
    {

    }


    /**
     * Derived method to catches calls to undefined methods.
     *
     * Provides magic import/export method support (fromXML()/toXML(), fromYAML()/toYAML(), etc.).
     * Allows to define default __call() behavior if you overwrite __call()
     *
     * @param string $name
     * @param mixed  $params
     *
     * @return array|string
     */
    public function __call($name, $params)
    {
        if (0 === strpos($name, 'get')) {
            $virtualColumn = substr($name, 3);
            if ($this->hasVirtualColumn($virtualColumn)) {
                return $this->getVirtualColumn($virtualColumn);
            }

            $virtualColumn = lcfirst($virtualColumn);
            if ($this->hasVirtualColumn($virtualColumn)) {
                return $this->getVirtualColumn($virtualColumn);
            }
        }

        if (0 === strpos($name, 'from')) {
            $format = substr($name, 4);

            return $this->importFrom($format, reset($params));
        }

        if (0 === strpos($name, 'to')) {
            $format = substr($name, 2);
            $includeLazyLoadColumns = isset($params[0]) ? $params[0] : true;

            return $this->exportTo($format, $includeLazyLoadColumns);
        }

        throw new BadMethodCallException(sprintf('Call to undefined method: %s.', $name));
    }

}
