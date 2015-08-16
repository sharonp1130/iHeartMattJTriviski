<?php

namespace Base;

use \User as ChildUser;
use \UserQuery as ChildUserQuery;
use \UsersettingsQuery as ChildUsersettingsQuery;
use \DateTime;
use \Exception;
use \PDO;
use Map\UsersettingsTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveRecord\ActiveRecordInterface;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\BadMethodCallException;
use Propel\Runtime\Exception\LogicException;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Map\TableMap;
use Propel\Runtime\Parser\AbstractParser;
use Propel\Runtime\Util\PropelDateTime;

/**
 * Base class that represents a row from the 'userSettings' table.
 *
 *
 *
* @package    propel.generator..Base
*/
abstract class Usersettings implements ActiveRecordInterface
{
    /**
     * TableMap class name
     */
    const TABLE_MAP = '\\Map\\UsersettingsTableMap';


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
     * The value for the settingsid field.
     * @var        int
     */
    protected $settingsid;

    /**
     * The value for the user field.
     * @var        int
     */
    protected $user;

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
     * @var        ChildUser
     */
    protected $aUser;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var boolean
     */
    protected $alreadyInSave = false;

    /**
     * Applies default values to this object.
     * This method should be called from the object's constructor (or
     * equivalent initialization method).
     * @see __construct()
     */
    public function applyDefaultValues()
    {
        $this->phoneok = true;
        $this->textok = true;
        $this->emailok = true;
    }

    /**
     * Initializes internal state of Base\Usersettings object.
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
     * Compares this with another <code>Usersettings</code> instance.  If
     * <code>obj</code> is an instance of <code>Usersettings</code>, delegates to
     * <code>equals(Usersettings)</code>.  Otherwise, returns <code>false</code>.
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
     * @return $this|Usersettings The current object, for fluid interface
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
     * Get the [settingsid] column value.
     *
     * @return int
     */
    public function getSettingsid()
    {
        return $this->settingsid;
    }

    /**
     * Get the [user] column value.
     *
     * @return int
     */
    public function getSettingsUser()
    {
        return $this->user;
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
     * @return string|DateTime Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00 00:00:00
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
     * @return string|DateTime Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00 00:00:00
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
     * @return string|DateTime Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00 00:00:00
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
     * @return string|DateTime Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00 00:00:00
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
     * @return string|DateTime Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00 00:00:00
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
     * @return string|DateTime Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00 00:00:00
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
     * @return string|DateTime Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00 00:00:00
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
     * @return string|DateTime Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00 00:00:00
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
     * @return string|DateTime Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00 00:00:00
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
     * @return string|DateTime Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00 00:00:00
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
     * @return string|DateTime Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00 00:00:00
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
     * @return string|DateTime Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00 00:00:00
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
     * @return string|DateTime Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00 00:00:00
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
     * @return string|DateTime Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00 00:00:00
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
     * Set the value of [settingsid] column.
     *
     * @param int $v new value
     * @return $this|\Usersettings The current object (for fluent API support)
     */
    public function setSettingsid($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->settingsid !== $v) {
            $this->settingsid = $v;
            $this->modifiedColumns[UsersettingsTableMap::COL_SETTINGSID] = true;
        }

        return $this;
    } // setSettingsid()

    /**
     * Set the value of [user] column.
     *
     * @param int $v new value
     * @return $this|\Usersettings The current object (for fluent API support)
     */
    public function setSettingsUser($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->user !== $v) {
            $this->user = $v;
            $this->modifiedColumns[UsersettingsTableMap::COL_USER] = true;
        }

        if ($this->aUser !== null && $this->aUser->getUserid() !== $v) {
            $this->aUser = null;
        }

        return $this;
    } // setSettingsUser()

    /**
     * Sets the value of the [phoneok] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     *
     * @param  boolean|integer|string $v The new value
     * @return $this|\Usersettings The current object (for fluent API support)
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
            $this->modifiedColumns[UsersettingsTableMap::COL_PHONEOK] = true;
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
     * @return $this|\Usersettings The current object (for fluent API support)
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
            $this->modifiedColumns[UsersettingsTableMap::COL_TEXTOK] = true;
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
     * @return $this|\Usersettings The current object (for fluent API support)
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
            $this->modifiedColumns[UsersettingsTableMap::COL_EMAILOK] = true;
        }

        return $this;
    } // setEmailok()

    /**
     * Sets the value of [mondaystart] column to a normalized version of the date/time value specified.
     *
     * @param  mixed $v string, integer (timestamp), or \DateTime value.
     *               Empty strings are treated as NULL.
     * @return $this|\Usersettings The current object (for fluent API support)
     */
    public function setMondaystart($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->mondaystart !== null || $dt !== null) {
            if ($this->mondaystart === null || $dt === null || $dt->format("Y-m-d H:i:s") !== $this->mondaystart->format("Y-m-d H:i:s")) {
                $this->mondaystart = $dt === null ? null : clone $dt;
                $this->modifiedColumns[UsersettingsTableMap::COL_MONDAYSTART] = true;
            }
        } // if either are not null

        return $this;
    } // setMondaystart()

    /**
     * Sets the value of [mondayend] column to a normalized version of the date/time value specified.
     *
     * @param  mixed $v string, integer (timestamp), or \DateTime value.
     *               Empty strings are treated as NULL.
     * @return $this|\Usersettings The current object (for fluent API support)
     */
    public function setMondayend($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->mondayend !== null || $dt !== null) {
            if ($this->mondayend === null || $dt === null || $dt->format("Y-m-d H:i:s") !== $this->mondayend->format("Y-m-d H:i:s")) {
                $this->mondayend = $dt === null ? null : clone $dt;
                $this->modifiedColumns[UsersettingsTableMap::COL_MONDAYEND] = true;
            }
        } // if either are not null

        return $this;
    } // setMondayend()

    /**
     * Sets the value of [tuesdaystart] column to a normalized version of the date/time value specified.
     *
     * @param  mixed $v string, integer (timestamp), or \DateTime value.
     *               Empty strings are treated as NULL.
     * @return $this|\Usersettings The current object (for fluent API support)
     */
    public function setTuesdaystart($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->tuesdaystart !== null || $dt !== null) {
            if ($this->tuesdaystart === null || $dt === null || $dt->format("Y-m-d H:i:s") !== $this->tuesdaystart->format("Y-m-d H:i:s")) {
                $this->tuesdaystart = $dt === null ? null : clone $dt;
                $this->modifiedColumns[UsersettingsTableMap::COL_TUESDAYSTART] = true;
            }
        } // if either are not null

        return $this;
    } // setTuesdaystart()

    /**
     * Sets the value of [tuesdayend] column to a normalized version of the date/time value specified.
     *
     * @param  mixed $v string, integer (timestamp), or \DateTime value.
     *               Empty strings are treated as NULL.
     * @return $this|\Usersettings The current object (for fluent API support)
     */
    public function setTuesdayend($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->tuesdayend !== null || $dt !== null) {
            if ($this->tuesdayend === null || $dt === null || $dt->format("Y-m-d H:i:s") !== $this->tuesdayend->format("Y-m-d H:i:s")) {
                $this->tuesdayend = $dt === null ? null : clone $dt;
                $this->modifiedColumns[UsersettingsTableMap::COL_TUESDAYEND] = true;
            }
        } // if either are not null

        return $this;
    } // setTuesdayend()

    /**
     * Sets the value of [wednesdaystart] column to a normalized version of the date/time value specified.
     *
     * @param  mixed $v string, integer (timestamp), or \DateTime value.
     *               Empty strings are treated as NULL.
     * @return $this|\Usersettings The current object (for fluent API support)
     */
    public function setWednesdaystart($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->wednesdaystart !== null || $dt !== null) {
            if ($this->wednesdaystart === null || $dt === null || $dt->format("Y-m-d H:i:s") !== $this->wednesdaystart->format("Y-m-d H:i:s")) {
                $this->wednesdaystart = $dt === null ? null : clone $dt;
                $this->modifiedColumns[UsersettingsTableMap::COL_WEDNESDAYSTART] = true;
            }
        } // if either are not null

        return $this;
    } // setWednesdaystart()

    /**
     * Sets the value of [wednesdayend] column to a normalized version of the date/time value specified.
     *
     * @param  mixed $v string, integer (timestamp), or \DateTime value.
     *               Empty strings are treated as NULL.
     * @return $this|\Usersettings The current object (for fluent API support)
     */
    public function setWednesdayend($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->wednesdayend !== null || $dt !== null) {
            if ($this->wednesdayend === null || $dt === null || $dt->format("Y-m-d H:i:s") !== $this->wednesdayend->format("Y-m-d H:i:s")) {
                $this->wednesdayend = $dt === null ? null : clone $dt;
                $this->modifiedColumns[UsersettingsTableMap::COL_WEDNESDAYEND] = true;
            }
        } // if either are not null

        return $this;
    } // setWednesdayend()

    /**
     * Sets the value of [thursdaystart] column to a normalized version of the date/time value specified.
     *
     * @param  mixed $v string, integer (timestamp), or \DateTime value.
     *               Empty strings are treated as NULL.
     * @return $this|\Usersettings The current object (for fluent API support)
     */
    public function setThursdaystart($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->thursdaystart !== null || $dt !== null) {
            if ($this->thursdaystart === null || $dt === null || $dt->format("Y-m-d H:i:s") !== $this->thursdaystart->format("Y-m-d H:i:s")) {
                $this->thursdaystart = $dt === null ? null : clone $dt;
                $this->modifiedColumns[UsersettingsTableMap::COL_THURSDAYSTART] = true;
            }
        } // if either are not null

        return $this;
    } // setThursdaystart()

    /**
     * Sets the value of [thursdayend] column to a normalized version of the date/time value specified.
     *
     * @param  mixed $v string, integer (timestamp), or \DateTime value.
     *               Empty strings are treated as NULL.
     * @return $this|\Usersettings The current object (for fluent API support)
     */
    public function setThursdayend($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->thursdayend !== null || $dt !== null) {
            if ($this->thursdayend === null || $dt === null || $dt->format("Y-m-d H:i:s") !== $this->thursdayend->format("Y-m-d H:i:s")) {
                $this->thursdayend = $dt === null ? null : clone $dt;
                $this->modifiedColumns[UsersettingsTableMap::COL_THURSDAYEND] = true;
            }
        } // if either are not null

        return $this;
    } // setThursdayend()

    /**
     * Sets the value of [fridaystart] column to a normalized version of the date/time value specified.
     *
     * @param  mixed $v string, integer (timestamp), or \DateTime value.
     *               Empty strings are treated as NULL.
     * @return $this|\Usersettings The current object (for fluent API support)
     */
    public function setFridaystart($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->fridaystart !== null || $dt !== null) {
            if ($this->fridaystart === null || $dt === null || $dt->format("Y-m-d H:i:s") !== $this->fridaystart->format("Y-m-d H:i:s")) {
                $this->fridaystart = $dt === null ? null : clone $dt;
                $this->modifiedColumns[UsersettingsTableMap::COL_FRIDAYSTART] = true;
            }
        } // if either are not null

        return $this;
    } // setFridaystart()

    /**
     * Sets the value of [fridayend] column to a normalized version of the date/time value specified.
     *
     * @param  mixed $v string, integer (timestamp), or \DateTime value.
     *               Empty strings are treated as NULL.
     * @return $this|\Usersettings The current object (for fluent API support)
     */
    public function setFridayend($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->fridayend !== null || $dt !== null) {
            if ($this->fridayend === null || $dt === null || $dt->format("Y-m-d H:i:s") !== $this->fridayend->format("Y-m-d H:i:s")) {
                $this->fridayend = $dt === null ? null : clone $dt;
                $this->modifiedColumns[UsersettingsTableMap::COL_FRIDAYEND] = true;
            }
        } // if either are not null

        return $this;
    } // setFridayend()

    /**
     * Sets the value of [saturdaystart] column to a normalized version of the date/time value specified.
     *
     * @param  mixed $v string, integer (timestamp), or \DateTime value.
     *               Empty strings are treated as NULL.
     * @return $this|\Usersettings The current object (for fluent API support)
     */
    public function setSaturdaystart($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->saturdaystart !== null || $dt !== null) {
            if ($this->saturdaystart === null || $dt === null || $dt->format("Y-m-d H:i:s") !== $this->saturdaystart->format("Y-m-d H:i:s")) {
                $this->saturdaystart = $dt === null ? null : clone $dt;
                $this->modifiedColumns[UsersettingsTableMap::COL_SATURDAYSTART] = true;
            }
        } // if either are not null

        return $this;
    } // setSaturdaystart()

    /**
     * Sets the value of [saturdayend] column to a normalized version of the date/time value specified.
     *
     * @param  mixed $v string, integer (timestamp), or \DateTime value.
     *               Empty strings are treated as NULL.
     * @return $this|\Usersettings The current object (for fluent API support)
     */
    public function setSaturdayend($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->saturdayend !== null || $dt !== null) {
            if ($this->saturdayend === null || $dt === null || $dt->format("Y-m-d H:i:s") !== $this->saturdayend->format("Y-m-d H:i:s")) {
                $this->saturdayend = $dt === null ? null : clone $dt;
                $this->modifiedColumns[UsersettingsTableMap::COL_SATURDAYEND] = true;
            }
        } // if either are not null

        return $this;
    } // setSaturdayend()

    /**
     * Sets the value of [sundaystart] column to a normalized version of the date/time value specified.
     *
     * @param  mixed $v string, integer (timestamp), or \DateTime value.
     *               Empty strings are treated as NULL.
     * @return $this|\Usersettings The current object (for fluent API support)
     */
    public function setSundaystart($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->sundaystart !== null || $dt !== null) {
            if ($this->sundaystart === null || $dt === null || $dt->format("Y-m-d H:i:s") !== $this->sundaystart->format("Y-m-d H:i:s")) {
                $this->sundaystart = $dt === null ? null : clone $dt;
                $this->modifiedColumns[UsersettingsTableMap::COL_SUNDAYSTART] = true;
            }
        } // if either are not null

        return $this;
    } // setSundaystart()

    /**
     * Sets the value of [sundayend] column to a normalized version of the date/time value specified.
     *
     * @param  mixed $v string, integer (timestamp), or \DateTime value.
     *               Empty strings are treated as NULL.
     * @return $this|\Usersettings The current object (for fluent API support)
     */
    public function setSundayend($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->sundayend !== null || $dt !== null) {
            if ($this->sundayend === null || $dt === null || $dt->format("Y-m-d H:i:s") !== $this->sundayend->format("Y-m-d H:i:s")) {
                $this->sundayend = $dt === null ? null : clone $dt;
                $this->modifiedColumns[UsersettingsTableMap::COL_SUNDAYEND] = true;
            }
        } // if either are not null

        return $this;
    } // setSundayend()

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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : UsersettingsTableMap::translateFieldName('Settingsid', TableMap::TYPE_PHPNAME, $indexType)];
            $this->settingsid = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : UsersettingsTableMap::translateFieldName('SettingsUser', TableMap::TYPE_PHPNAME, $indexType)];
            $this->user = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : UsersettingsTableMap::translateFieldName('Phoneok', TableMap::TYPE_PHPNAME, $indexType)];
            $this->phoneok = (null !== $col) ? (boolean) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : UsersettingsTableMap::translateFieldName('Textok', TableMap::TYPE_PHPNAME, $indexType)];
            $this->textok = (null !== $col) ? (boolean) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : UsersettingsTableMap::translateFieldName('Emailok', TableMap::TYPE_PHPNAME, $indexType)];
            $this->emailok = (null !== $col) ? (boolean) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : UsersettingsTableMap::translateFieldName('Mondaystart', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->mondaystart = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : UsersettingsTableMap::translateFieldName('Mondayend', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->mondayend = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 7 + $startcol : UsersettingsTableMap::translateFieldName('Tuesdaystart', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->tuesdaystart = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 8 + $startcol : UsersettingsTableMap::translateFieldName('Tuesdayend', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->tuesdayend = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 9 + $startcol : UsersettingsTableMap::translateFieldName('Wednesdaystart', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->wednesdaystart = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 10 + $startcol : UsersettingsTableMap::translateFieldName('Wednesdayend', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->wednesdayend = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 11 + $startcol : UsersettingsTableMap::translateFieldName('Thursdaystart', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->thursdaystart = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 12 + $startcol : UsersettingsTableMap::translateFieldName('Thursdayend', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->thursdayend = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 13 + $startcol : UsersettingsTableMap::translateFieldName('Fridaystart', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->fridaystart = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 14 + $startcol : UsersettingsTableMap::translateFieldName('Fridayend', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->fridayend = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 15 + $startcol : UsersettingsTableMap::translateFieldName('Saturdaystart', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->saturdaystart = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 16 + $startcol : UsersettingsTableMap::translateFieldName('Saturdayend', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->saturdayend = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 17 + $startcol : UsersettingsTableMap::translateFieldName('Sundaystart', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->sundaystart = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 18 + $startcol : UsersettingsTableMap::translateFieldName('Sundayend', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->sundayend = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 19; // 19 = UsersettingsTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\Usersettings'), 0, $e);
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
        if ($this->aUser !== null && $this->user !== $this->aUser->getUserid()) {
            $this->aUser = null;
        }
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
            $con = Propel::getServiceContainer()->getReadConnection(UsersettingsTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildUsersettingsQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aUser = null;
        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param      ConnectionInterface $con
     * @return void
     * @throws PropelException
     * @see Usersettings::setDeleted()
     * @see Usersettings::isDeleted()
     */
    public function delete(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(UsersettingsTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildUsersettingsQuery::create()
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
            $con = Propel::getServiceContainer()->getWriteConnection(UsersettingsTableMap::DATABASE_NAME);
        }

        return $con->transaction(function () use ($con) {
            $isInsert = $this->isNew();
            $ret = $this->preSave($con);
            if ($isInsert) {
                $ret = $ret && $this->preInsert($con);
            } else {
                $ret = $ret && $this->preUpdate($con);
            }
            if ($ret) {
                $affectedRows = $this->doSave($con);
                if ($isInsert) {
                    $this->postInsert($con);
                } else {
                    $this->postUpdate($con);
                }
                $this->postSave($con);
                UsersettingsTableMap::addInstanceToPool($this);
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

            // We call the save method on the following object(s) if they
            // were passed to this object by their corresponding set
            // method.  This object relates to these object(s) by a
            // foreign key reference.

            if ($this->aUser !== null) {
                if ($this->aUser->isModified() || $this->aUser->isNew()) {
                    $affectedRows += $this->aUser->save($con);
                }
                $this->setUser($this->aUser);
            }

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

        $this->modifiedColumns[UsersettingsTableMap::COL_SETTINGSID] = true;
        if (null !== $this->settingsid) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . UsersettingsTableMap::COL_SETTINGSID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(UsersettingsTableMap::COL_SETTINGSID)) {
            $modifiedColumns[':p' . $index++]  = 'settingsId';
        }
        if ($this->isColumnModified(UsersettingsTableMap::COL_USER)) {
            $modifiedColumns[':p' . $index++]  = 'user';
        }
        if ($this->isColumnModified(UsersettingsTableMap::COL_PHONEOK)) {
            $modifiedColumns[':p' . $index++]  = 'phoneOk';
        }
        if ($this->isColumnModified(UsersettingsTableMap::COL_TEXTOK)) {
            $modifiedColumns[':p' . $index++]  = 'textOk';
        }
        if ($this->isColumnModified(UsersettingsTableMap::COL_EMAILOK)) {
            $modifiedColumns[':p' . $index++]  = 'emailOk';
        }
        if ($this->isColumnModified(UsersettingsTableMap::COL_MONDAYSTART)) {
            $modifiedColumns[':p' . $index++]  = 'mondayStart';
        }
        if ($this->isColumnModified(UsersettingsTableMap::COL_MONDAYEND)) {
            $modifiedColumns[':p' . $index++]  = 'mondayEnd';
        }
        if ($this->isColumnModified(UsersettingsTableMap::COL_TUESDAYSTART)) {
            $modifiedColumns[':p' . $index++]  = 'tuesdayStart';
        }
        if ($this->isColumnModified(UsersettingsTableMap::COL_TUESDAYEND)) {
            $modifiedColumns[':p' . $index++]  = 'tuesdayEnd';
        }
        if ($this->isColumnModified(UsersettingsTableMap::COL_WEDNESDAYSTART)) {
            $modifiedColumns[':p' . $index++]  = 'wednesdayStart';
        }
        if ($this->isColumnModified(UsersettingsTableMap::COL_WEDNESDAYEND)) {
            $modifiedColumns[':p' . $index++]  = 'wednesdayEnd';
        }
        if ($this->isColumnModified(UsersettingsTableMap::COL_THURSDAYSTART)) {
            $modifiedColumns[':p' . $index++]  = 'thursdayStart';
        }
        if ($this->isColumnModified(UsersettingsTableMap::COL_THURSDAYEND)) {
            $modifiedColumns[':p' . $index++]  = 'thursdayEnd';
        }
        if ($this->isColumnModified(UsersettingsTableMap::COL_FRIDAYSTART)) {
            $modifiedColumns[':p' . $index++]  = 'fridayStart';
        }
        if ($this->isColumnModified(UsersettingsTableMap::COL_FRIDAYEND)) {
            $modifiedColumns[':p' . $index++]  = 'fridayEnd';
        }
        if ($this->isColumnModified(UsersettingsTableMap::COL_SATURDAYSTART)) {
            $modifiedColumns[':p' . $index++]  = 'saturdayStart';
        }
        if ($this->isColumnModified(UsersettingsTableMap::COL_SATURDAYEND)) {
            $modifiedColumns[':p' . $index++]  = 'saturdayEnd';
        }
        if ($this->isColumnModified(UsersettingsTableMap::COL_SUNDAYSTART)) {
            $modifiedColumns[':p' . $index++]  = 'sundayStart';
        }
        if ($this->isColumnModified(UsersettingsTableMap::COL_SUNDAYEND)) {
            $modifiedColumns[':p' . $index++]  = 'sundayEnd';
        }

        $sql = sprintf(
            'INSERT INTO userSettings (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case 'settingsId':
                        $stmt->bindValue($identifier, $this->settingsid, PDO::PARAM_INT);
                        break;
                    case 'user':
                        $stmt->bindValue($identifier, $this->user, PDO::PARAM_INT);
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
        $this->setSettingsid($pk);

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
        $pos = UsersettingsTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getSettingsid();
                break;
            case 1:
                return $this->getSettingsUser();
                break;
            case 2:
                return $this->getPhoneok();
                break;
            case 3:
                return $this->getTextok();
                break;
            case 4:
                return $this->getEmailok();
                break;
            case 5:
                return $this->getMondaystart();
                break;
            case 6:
                return $this->getMondayend();
                break;
            case 7:
                return $this->getTuesdaystart();
                break;
            case 8:
                return $this->getTuesdayend();
                break;
            case 9:
                return $this->getWednesdaystart();
                break;
            case 10:
                return $this->getWednesdayend();
                break;
            case 11:
                return $this->getThursdaystart();
                break;
            case 12:
                return $this->getThursdayend();
                break;
            case 13:
                return $this->getFridaystart();
                break;
            case 14:
                return $this->getFridayend();
                break;
            case 15:
                return $this->getSaturdaystart();
                break;
            case 16:
                return $this->getSaturdayend();
                break;
            case 17:
                return $this->getSundaystart();
                break;
            case 18:
                return $this->getSundayend();
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

        if (isset($alreadyDumpedObjects['Usersettings'][$this->hashCode()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['Usersettings'][$this->hashCode()] = true;
        $keys = UsersettingsTableMap::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getSettingsid(),
            $keys[1] => $this->getSettingsUser(),
            $keys[2] => $this->getPhoneok(),
            $keys[3] => $this->getTextok(),
            $keys[4] => $this->getEmailok(),
            $keys[5] => $this->getMondaystart(),
            $keys[6] => $this->getMondayend(),
            $keys[7] => $this->getTuesdaystart(),
            $keys[8] => $this->getTuesdayend(),
            $keys[9] => $this->getWednesdaystart(),
            $keys[10] => $this->getWednesdayend(),
            $keys[11] => $this->getThursdaystart(),
            $keys[12] => $this->getThursdayend(),
            $keys[13] => $this->getFridaystart(),
            $keys[14] => $this->getFridayend(),
            $keys[15] => $this->getSaturdaystart(),
            $keys[16] => $this->getSaturdayend(),
            $keys[17] => $this->getSundaystart(),
            $keys[18] => $this->getSundayend(),
        );

        $utc = new \DateTimeZone('utc');
        if ($result[$keys[5]] instanceof \DateTime) {
            // When changing timezone we don't want to change existing instances
            $dateTime = clone $result[$keys[5]];
            $result[$keys[5]] = $dateTime->setTimezone($utc)->format('Y-m-d\TH:i:s\Z');
        }

        if ($result[$keys[6]] instanceof \DateTime) {
            // When changing timezone we don't want to change existing instances
            $dateTime = clone $result[$keys[6]];
            $result[$keys[6]] = $dateTime->setTimezone($utc)->format('Y-m-d\TH:i:s\Z');
        }

        if ($result[$keys[7]] instanceof \DateTime) {
            // When changing timezone we don't want to change existing instances
            $dateTime = clone $result[$keys[7]];
            $result[$keys[7]] = $dateTime->setTimezone($utc)->format('Y-m-d\TH:i:s\Z');
        }

        if ($result[$keys[8]] instanceof \DateTime) {
            // When changing timezone we don't want to change existing instances
            $dateTime = clone $result[$keys[8]];
            $result[$keys[8]] = $dateTime->setTimezone($utc)->format('Y-m-d\TH:i:s\Z');
        }

        if ($result[$keys[9]] instanceof \DateTime) {
            // When changing timezone we don't want to change existing instances
            $dateTime = clone $result[$keys[9]];
            $result[$keys[9]] = $dateTime->setTimezone($utc)->format('Y-m-d\TH:i:s\Z');
        }

        if ($result[$keys[10]] instanceof \DateTime) {
            // When changing timezone we don't want to change existing instances
            $dateTime = clone $result[$keys[10]];
            $result[$keys[10]] = $dateTime->setTimezone($utc)->format('Y-m-d\TH:i:s\Z');
        }

        if ($result[$keys[11]] instanceof \DateTime) {
            // When changing timezone we don't want to change existing instances
            $dateTime = clone $result[$keys[11]];
            $result[$keys[11]] = $dateTime->setTimezone($utc)->format('Y-m-d\TH:i:s\Z');
        }

        if ($result[$keys[12]] instanceof \DateTime) {
            // When changing timezone we don't want to change existing instances
            $dateTime = clone $result[$keys[12]];
            $result[$keys[12]] = $dateTime->setTimezone($utc)->format('Y-m-d\TH:i:s\Z');
        }

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

        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->aUser) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'user';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'user';
                        break;
                    default:
                        $key = 'User';
                }

                $result[$key] = $this->aUser->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
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
     * @return $this|\Usersettings
     */
    public function setByName($name, $value, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = UsersettingsTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

        return $this->setByPosition($pos, $value);
    }

    /**
     * Sets a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param  int $pos position in xml schema
     * @param  mixed $value field value
     * @return $this|\Usersettings
     */
    public function setByPosition($pos, $value)
    {
        switch ($pos) {
            case 0:
                $this->setSettingsid($value);
                break;
            case 1:
                $this->setSettingsUser($value);
                break;
            case 2:
                $this->setPhoneok($value);
                break;
            case 3:
                $this->setTextok($value);
                break;
            case 4:
                $this->setEmailok($value);
                break;
            case 5:
                $this->setMondaystart($value);
                break;
            case 6:
                $this->setMondayend($value);
                break;
            case 7:
                $this->setTuesdaystart($value);
                break;
            case 8:
                $this->setTuesdayend($value);
                break;
            case 9:
                $this->setWednesdaystart($value);
                break;
            case 10:
                $this->setWednesdayend($value);
                break;
            case 11:
                $this->setThursdaystart($value);
                break;
            case 12:
                $this->setThursdayend($value);
                break;
            case 13:
                $this->setFridaystart($value);
                break;
            case 14:
                $this->setFridayend($value);
                break;
            case 15:
                $this->setSaturdaystart($value);
                break;
            case 16:
                $this->setSaturdayend($value);
                break;
            case 17:
                $this->setSundaystart($value);
                break;
            case 18:
                $this->setSundayend($value);
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
        $keys = UsersettingsTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setSettingsid($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setSettingsUser($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setPhoneok($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setTextok($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setEmailok($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setMondaystart($arr[$keys[5]]);
        }
        if (array_key_exists($keys[6], $arr)) {
            $this->setMondayend($arr[$keys[6]]);
        }
        if (array_key_exists($keys[7], $arr)) {
            $this->setTuesdaystart($arr[$keys[7]]);
        }
        if (array_key_exists($keys[8], $arr)) {
            $this->setTuesdayend($arr[$keys[8]]);
        }
        if (array_key_exists($keys[9], $arr)) {
            $this->setWednesdaystart($arr[$keys[9]]);
        }
        if (array_key_exists($keys[10], $arr)) {
            $this->setWednesdayend($arr[$keys[10]]);
        }
        if (array_key_exists($keys[11], $arr)) {
            $this->setThursdaystart($arr[$keys[11]]);
        }
        if (array_key_exists($keys[12], $arr)) {
            $this->setThursdayend($arr[$keys[12]]);
        }
        if (array_key_exists($keys[13], $arr)) {
            $this->setFridaystart($arr[$keys[13]]);
        }
        if (array_key_exists($keys[14], $arr)) {
            $this->setFridayend($arr[$keys[14]]);
        }
        if (array_key_exists($keys[15], $arr)) {
            $this->setSaturdaystart($arr[$keys[15]]);
        }
        if (array_key_exists($keys[16], $arr)) {
            $this->setSaturdayend($arr[$keys[16]]);
        }
        if (array_key_exists($keys[17], $arr)) {
            $this->setSundaystart($arr[$keys[17]]);
        }
        if (array_key_exists($keys[18], $arr)) {
            $this->setSundayend($arr[$keys[18]]);
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
     * @return $this|\Usersettings The current object, for fluid interface
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
        $criteria = new Criteria(UsersettingsTableMap::DATABASE_NAME);

        if ($this->isColumnModified(UsersettingsTableMap::COL_SETTINGSID)) {
            $criteria->add(UsersettingsTableMap::COL_SETTINGSID, $this->settingsid);
        }
        if ($this->isColumnModified(UsersettingsTableMap::COL_USER)) {
            $criteria->add(UsersettingsTableMap::COL_USER, $this->user);
        }
        if ($this->isColumnModified(UsersettingsTableMap::COL_PHONEOK)) {
            $criteria->add(UsersettingsTableMap::COL_PHONEOK, $this->phoneok);
        }
        if ($this->isColumnModified(UsersettingsTableMap::COL_TEXTOK)) {
            $criteria->add(UsersettingsTableMap::COL_TEXTOK, $this->textok);
        }
        if ($this->isColumnModified(UsersettingsTableMap::COL_EMAILOK)) {
            $criteria->add(UsersettingsTableMap::COL_EMAILOK, $this->emailok);
        }
        if ($this->isColumnModified(UsersettingsTableMap::COL_MONDAYSTART)) {
            $criteria->add(UsersettingsTableMap::COL_MONDAYSTART, $this->mondaystart);
        }
        if ($this->isColumnModified(UsersettingsTableMap::COL_MONDAYEND)) {
            $criteria->add(UsersettingsTableMap::COL_MONDAYEND, $this->mondayend);
        }
        if ($this->isColumnModified(UsersettingsTableMap::COL_TUESDAYSTART)) {
            $criteria->add(UsersettingsTableMap::COL_TUESDAYSTART, $this->tuesdaystart);
        }
        if ($this->isColumnModified(UsersettingsTableMap::COL_TUESDAYEND)) {
            $criteria->add(UsersettingsTableMap::COL_TUESDAYEND, $this->tuesdayend);
        }
        if ($this->isColumnModified(UsersettingsTableMap::COL_WEDNESDAYSTART)) {
            $criteria->add(UsersettingsTableMap::COL_WEDNESDAYSTART, $this->wednesdaystart);
        }
        if ($this->isColumnModified(UsersettingsTableMap::COL_WEDNESDAYEND)) {
            $criteria->add(UsersettingsTableMap::COL_WEDNESDAYEND, $this->wednesdayend);
        }
        if ($this->isColumnModified(UsersettingsTableMap::COL_THURSDAYSTART)) {
            $criteria->add(UsersettingsTableMap::COL_THURSDAYSTART, $this->thursdaystart);
        }
        if ($this->isColumnModified(UsersettingsTableMap::COL_THURSDAYEND)) {
            $criteria->add(UsersettingsTableMap::COL_THURSDAYEND, $this->thursdayend);
        }
        if ($this->isColumnModified(UsersettingsTableMap::COL_FRIDAYSTART)) {
            $criteria->add(UsersettingsTableMap::COL_FRIDAYSTART, $this->fridaystart);
        }
        if ($this->isColumnModified(UsersettingsTableMap::COL_FRIDAYEND)) {
            $criteria->add(UsersettingsTableMap::COL_FRIDAYEND, $this->fridayend);
        }
        if ($this->isColumnModified(UsersettingsTableMap::COL_SATURDAYSTART)) {
            $criteria->add(UsersettingsTableMap::COL_SATURDAYSTART, $this->saturdaystart);
        }
        if ($this->isColumnModified(UsersettingsTableMap::COL_SATURDAYEND)) {
            $criteria->add(UsersettingsTableMap::COL_SATURDAYEND, $this->saturdayend);
        }
        if ($this->isColumnModified(UsersettingsTableMap::COL_SUNDAYSTART)) {
            $criteria->add(UsersettingsTableMap::COL_SUNDAYSTART, $this->sundaystart);
        }
        if ($this->isColumnModified(UsersettingsTableMap::COL_SUNDAYEND)) {
            $criteria->add(UsersettingsTableMap::COL_SUNDAYEND, $this->sundayend);
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
        $criteria = ChildUsersettingsQuery::create();
        $criteria->add(UsersettingsTableMap::COL_SETTINGSID, $this->settingsid);

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
        $validPk = null !== $this->getSettingsid();

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
        return $this->getSettingsid();
    }

    /**
     * Generic method to set the primary key (settingsid column).
     *
     * @param       int $key Primary key.
     * @return void
     */
    public function setPrimaryKey($key)
    {
        $this->setSettingsid($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     * @return boolean
     */
    public function isPrimaryKeyNull()
    {
        return null === $this->getSettingsid();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param      object $copyObj An object of \Usersettings (or compatible) type.
     * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setSettingsUser($this->getSettingsUser());
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
        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setSettingsid(NULL); // this is a auto-increment column, so set to default value
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
     * @return \Usersettings Clone of current object.
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
     * Declares an association between this object and a ChildUser object.
     *
     * @param  ChildUser $v
     * @return $this|\Usersettings The current object (for fluent API support)
     * @throws PropelException
     */
    public function setUser(ChildUser $v = null)
    {
        if ($v === null) {
            $this->setSettingsUser(NULL);
        } else {
            $this->setSettingsUser($v->getUserid());
        }

        $this->aUser = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildUser object, it will not be re-added.
        if ($v !== null) {
            $v->addUsersettings($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildUser object
     *
     * @param  ConnectionInterface $con Optional Connection object.
     * @return ChildUser The associated ChildUser object.
     * @throws PropelException
     */
    public function getUser(ConnectionInterface $con = null)
    {
        if ($this->aUser === null && ($this->user !== null)) {
            $this->aUser = ChildUserQuery::create()->findPk($this->user, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aUser->addUsersettingss($this);
             */
        }

        return $this->aUser;
    }

    /**
     * Clears the current object, sets all attributes to their default values and removes
     * outgoing references as well as back-references (from other objects to this one. Results probably in a database
     * change of those foreign objects when you call `save` there).
     */
    public function clear()
    {
        if (null !== $this->aUser) {
            $this->aUser->removeUsersettings($this);
        }
        $this->settingsid = null;
        $this->user = null;
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
        } // if ($deep)

        $this->aUser = null;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(UsersettingsTableMap::DEFAULT_STRING_FORMAT);
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
