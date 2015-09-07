<?php

namespace Map;

use \User;
use \UserQuery;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\InstancePoolTrait;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\DataFetcher\DataFetcherInterface;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Map\RelationMap;
use Propel\Runtime\Map\TableMap;
use Propel\Runtime\Map\TableMapTrait;


/**
 * This class defines the structure of the 'user' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 */
class UserTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = '.Map.UserTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'user';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\User';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'User';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 29;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 29;

    /**
     * the column name for the userId field
     */
    const COL_USERID = 'user.userId';

    /**
     * the column name for the email field
     */
    const COL_EMAIL = 'user.email';

    /**
     * the column name for the isProvider field
     */
    const COL_ISPROVIDER = 'user.isProvider';

    /**
     * the column name for the firstName field
     */
    const COL_FIRSTNAME = 'user.firstName';

    /**
     * the column name for the lastName field
     */
    const COL_LASTNAME = 'user.lastName';

    /**
     * the column name for the suffix field
     */
    const COL_SUFFIX = 'user.suffix';

    /**
     * the column name for the address field
     */
    const COL_ADDRESS = 'user.address';

    /**
     * the column name for the city field
     */
    const COL_CITY = 'user.city';

    /**
     * the column name for the zipcode field
     */
    const COL_ZIPCODE = 'user.zipcode';

    /**
     * the column name for the phoneNumber field
     */
    const COL_PHONENUMBER = 'user.phoneNumber';

    /**
     * the column name for the phoneOk field
     */
    const COL_PHONEOK = 'user.phoneOk';

    /**
     * the column name for the textOk field
     */
    const COL_TEXTOK = 'user.textOk';

    /**
     * the column name for the emailOk field
     */
    const COL_EMAILOK = 'user.emailOk';

    /**
     * the column name for the mondayStart field
     */
    const COL_MONDAYSTART = 'user.mondayStart';

    /**
     * the column name for the mondayEnd field
     */
    const COL_MONDAYEND = 'user.mondayEnd';

    /**
     * the column name for the tuesdayStart field
     */
    const COL_TUESDAYSTART = 'user.tuesdayStart';

    /**
     * the column name for the tuesdayEnd field
     */
    const COL_TUESDAYEND = 'user.tuesdayEnd';

    /**
     * the column name for the wednesdayStart field
     */
    const COL_WEDNESDAYSTART = 'user.wednesdayStart';

    /**
     * the column name for the wednesdayEnd field
     */
    const COL_WEDNESDAYEND = 'user.wednesdayEnd';

    /**
     * the column name for the thursdayStart field
     */
    const COL_THURSDAYSTART = 'user.thursdayStart';

    /**
     * the column name for the thursdayEnd field
     */
    const COL_THURSDAYEND = 'user.thursdayEnd';

    /**
     * the column name for the fridayStart field
     */
    const COL_FRIDAYSTART = 'user.fridayStart';

    /**
     * the column name for the fridayEnd field
     */
    const COL_FRIDAYEND = 'user.fridayEnd';

    /**
     * the column name for the saturdayStart field
     */
    const COL_SATURDAYSTART = 'user.saturdayStart';

    /**
     * the column name for the saturdayEnd field
     */
    const COL_SATURDAYEND = 'user.saturdayEnd';

    /**
     * the column name for the sundayStart field
     */
    const COL_SUNDAYSTART = 'user.sundayStart';

    /**
     * the column name for the sundayEnd field
     */
    const COL_SUNDAYEND = 'user.sundayEnd';

    /**
     * the column name for the created_at field
     */
    const COL_CREATED_AT = 'user.created_at';

    /**
     * the column name for the updated_at field
     */
    const COL_UPDATED_AT = 'user.updated_at';

    /**
     * The default string format for model objects of the related table
     */
    const DEFAULT_STRING_FORMAT = 'YAML';

    /**
     * holds an array of fieldnames
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldNames[self::TYPE_PHPNAME][0] = 'Id'
     */
    protected static $fieldNames = array (
        self::TYPE_PHPNAME       => array('Userid', 'Email', 'Isprovider', 'Firstname', 'Lastname', 'Suffix', 'Address', 'City', 'Zipcode', 'Phonenumber', 'Phoneok', 'Textok', 'Emailok', 'Mondaystart', 'Mondayend', 'Tuesdaystart', 'Tuesdayend', 'Wednesdaystart', 'Wednesdayend', 'Thursdaystart', 'Thursdayend', 'Fridaystart', 'Fridayend', 'Saturdaystart', 'Saturdayend', 'Sundaystart', 'Sundayend', 'CreatedAt', 'UpdatedAt', ),
        self::TYPE_CAMELNAME     => array('userid', 'email', 'isprovider', 'firstname', 'lastname', 'suffix', 'address', 'city', 'zipcode', 'phonenumber', 'phoneok', 'textok', 'emailok', 'mondaystart', 'mondayend', 'tuesdaystart', 'tuesdayend', 'wednesdaystart', 'wednesdayend', 'thursdaystart', 'thursdayend', 'fridaystart', 'fridayend', 'saturdaystart', 'saturdayend', 'sundaystart', 'sundayend', 'createdAt', 'updatedAt', ),
        self::TYPE_COLNAME       => array(UserTableMap::COL_USERID, UserTableMap::COL_EMAIL, UserTableMap::COL_ISPROVIDER, UserTableMap::COL_FIRSTNAME, UserTableMap::COL_LASTNAME, UserTableMap::COL_SUFFIX, UserTableMap::COL_ADDRESS, UserTableMap::COL_CITY, UserTableMap::COL_ZIPCODE, UserTableMap::COL_PHONENUMBER, UserTableMap::COL_PHONEOK, UserTableMap::COL_TEXTOK, UserTableMap::COL_EMAILOK, UserTableMap::COL_MONDAYSTART, UserTableMap::COL_MONDAYEND, UserTableMap::COL_TUESDAYSTART, UserTableMap::COL_TUESDAYEND, UserTableMap::COL_WEDNESDAYSTART, UserTableMap::COL_WEDNESDAYEND, UserTableMap::COL_THURSDAYSTART, UserTableMap::COL_THURSDAYEND, UserTableMap::COL_FRIDAYSTART, UserTableMap::COL_FRIDAYEND, UserTableMap::COL_SATURDAYSTART, UserTableMap::COL_SATURDAYEND, UserTableMap::COL_SUNDAYSTART, UserTableMap::COL_SUNDAYEND, UserTableMap::COL_CREATED_AT, UserTableMap::COL_UPDATED_AT, ),
        self::TYPE_FIELDNAME     => array('userId', 'email', 'isProvider', 'firstName', 'lastName', 'suffix', 'address', 'city', 'zipcode', 'phoneNumber', 'phoneOk', 'textOk', 'emailOk', 'mondayStart', 'mondayEnd', 'tuesdayStart', 'tuesdayEnd', 'wednesdayStart', 'wednesdayEnd', 'thursdayStart', 'thursdayEnd', 'fridayStart', 'fridayEnd', 'saturdayStart', 'saturdayEnd', 'sundayStart', 'sundayEnd', 'created_at', 'updated_at', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('Userid' => 0, 'Email' => 1, 'Isprovider' => 2, 'Firstname' => 3, 'Lastname' => 4, 'Suffix' => 5, 'Address' => 6, 'City' => 7, 'Zipcode' => 8, 'Phonenumber' => 9, 'Phoneok' => 10, 'Textok' => 11, 'Emailok' => 12, 'Mondaystart' => 13, 'Mondayend' => 14, 'Tuesdaystart' => 15, 'Tuesdayend' => 16, 'Wednesdaystart' => 17, 'Wednesdayend' => 18, 'Thursdaystart' => 19, 'Thursdayend' => 20, 'Fridaystart' => 21, 'Fridayend' => 22, 'Saturdaystart' => 23, 'Saturdayend' => 24, 'Sundaystart' => 25, 'Sundayend' => 26, 'CreatedAt' => 27, 'UpdatedAt' => 28, ),
        self::TYPE_CAMELNAME     => array('userid' => 0, 'email' => 1, 'isprovider' => 2, 'firstname' => 3, 'lastname' => 4, 'suffix' => 5, 'address' => 6, 'city' => 7, 'zipcode' => 8, 'phonenumber' => 9, 'phoneok' => 10, 'textok' => 11, 'emailok' => 12, 'mondaystart' => 13, 'mondayend' => 14, 'tuesdaystart' => 15, 'tuesdayend' => 16, 'wednesdaystart' => 17, 'wednesdayend' => 18, 'thursdaystart' => 19, 'thursdayend' => 20, 'fridaystart' => 21, 'fridayend' => 22, 'saturdaystart' => 23, 'saturdayend' => 24, 'sundaystart' => 25, 'sundayend' => 26, 'createdAt' => 27, 'updatedAt' => 28, ),
        self::TYPE_COLNAME       => array(UserTableMap::COL_USERID => 0, UserTableMap::COL_EMAIL => 1, UserTableMap::COL_ISPROVIDER => 2, UserTableMap::COL_FIRSTNAME => 3, UserTableMap::COL_LASTNAME => 4, UserTableMap::COL_SUFFIX => 5, UserTableMap::COL_ADDRESS => 6, UserTableMap::COL_CITY => 7, UserTableMap::COL_ZIPCODE => 8, UserTableMap::COL_PHONENUMBER => 9, UserTableMap::COL_PHONEOK => 10, UserTableMap::COL_TEXTOK => 11, UserTableMap::COL_EMAILOK => 12, UserTableMap::COL_MONDAYSTART => 13, UserTableMap::COL_MONDAYEND => 14, UserTableMap::COL_TUESDAYSTART => 15, UserTableMap::COL_TUESDAYEND => 16, UserTableMap::COL_WEDNESDAYSTART => 17, UserTableMap::COL_WEDNESDAYEND => 18, UserTableMap::COL_THURSDAYSTART => 19, UserTableMap::COL_THURSDAYEND => 20, UserTableMap::COL_FRIDAYSTART => 21, UserTableMap::COL_FRIDAYEND => 22, UserTableMap::COL_SATURDAYSTART => 23, UserTableMap::COL_SATURDAYEND => 24, UserTableMap::COL_SUNDAYSTART => 25, UserTableMap::COL_SUNDAYEND => 26, UserTableMap::COL_CREATED_AT => 27, UserTableMap::COL_UPDATED_AT => 28, ),
        self::TYPE_FIELDNAME     => array('userId' => 0, 'email' => 1, 'isProvider' => 2, 'firstName' => 3, 'lastName' => 4, 'suffix' => 5, 'address' => 6, 'city' => 7, 'zipcode' => 8, 'phoneNumber' => 9, 'phoneOk' => 10, 'textOk' => 11, 'emailOk' => 12, 'mondayStart' => 13, 'mondayEnd' => 14, 'tuesdayStart' => 15, 'tuesdayEnd' => 16, 'wednesdayStart' => 17, 'wednesdayEnd' => 18, 'thursdayStart' => 19, 'thursdayEnd' => 20, 'fridayStart' => 21, 'fridayEnd' => 22, 'saturdayStart' => 23, 'saturdayEnd' => 24, 'sundayStart' => 25, 'sundayEnd' => 26, 'created_at' => 27, 'updated_at' => 28, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, )
    );

    /**
     * Initialize the table attributes and columns
     * Relations are not initialized by this method since they are lazy loaded
     *
     * @return void
     * @throws PropelException
     */
    public function initialize()
    {
        // attributes
        $this->setName('user');
        $this->setPhpName('User');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\User');
        $this->setPackage('');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('userId', 'Userid', 'INTEGER', true, 32, null);
        $this->addColumn('email', 'Email', 'VARCHAR', true, 50, null);
        $this->addColumn('isProvider', 'Isprovider', 'BOOLEAN', true, 1, false);
        $this->addColumn('firstName', 'Firstname', 'VARCHAR', true, 20, null);
        $this->addColumn('lastName', 'Lastname', 'VARCHAR', true, 20, null);
        $this->addColumn('suffix', 'Suffix', 'VARCHAR', false, 5, null);
        $this->addColumn('address', 'Address', 'VARCHAR', true, 64, null);
        $this->addColumn('city', 'City', 'VARCHAR', true, 64, null);
        $this->addColumn('zipcode', 'Zipcode', 'VARCHAR', true, 5, null);
        $this->addColumn('phoneNumber', 'Phonenumber', 'VARCHAR', true, 20, null);
        $this->addColumn('phoneOk', 'Phoneok', 'BOOLEAN', true, 1, true);
        $this->addColumn('textOk', 'Textok', 'BOOLEAN', true, 1, true);
        $this->addColumn('emailOk', 'Emailok', 'BOOLEAN', true, 1, true);
        $this->addColumn('mondayStart', 'Mondaystart', 'TIMESTAMP', false, null, null);
        $this->addColumn('mondayEnd', 'Mondayend', 'TIMESTAMP', false, null, null);
        $this->addColumn('tuesdayStart', 'Tuesdaystart', 'TIMESTAMP', false, null, null);
        $this->addColumn('tuesdayEnd', 'Tuesdayend', 'TIMESTAMP', false, null, null);
        $this->addColumn('wednesdayStart', 'Wednesdaystart', 'TIMESTAMP', false, null, null);
        $this->addColumn('wednesdayEnd', 'Wednesdayend', 'TIMESTAMP', false, null, null);
        $this->addColumn('thursdayStart', 'Thursdaystart', 'TIMESTAMP', false, null, null);
        $this->addColumn('thursdayEnd', 'Thursdayend', 'TIMESTAMP', false, null, null);
        $this->addColumn('fridayStart', 'Fridaystart', 'TIMESTAMP', false, null, null);
        $this->addColumn('fridayEnd', 'Fridayend', 'TIMESTAMP', false, null, null);
        $this->addColumn('saturdayStart', 'Saturdaystart', 'TIMESTAMP', false, null, null);
        $this->addColumn('saturdayEnd', 'Saturdayend', 'TIMESTAMP', false, null, null);
        $this->addColumn('sundayStart', 'Sundaystart', 'TIMESTAMP', false, null, null);
        $this->addColumn('sundayEnd', 'Sundayend', 'TIMESTAMP', false, null, null);
        $this->addColumn('created_at', 'CreatedAt', 'TIMESTAMP', false, null, null);
        $this->addColumn('updated_at', 'UpdatedAt', 'TIMESTAMP', false, null, null);
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('License', '\\License', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':user',
    1 => ':userId',
  ),
), null, 'CASCADE', 'Licenses', false);
        $this->addRelation('Location', '\\Location', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':user',
    1 => ':userId',
  ),
), null, 'CASCADE', 'Locations', false);
    } // buildRelations()

    /**
     *
     * Gets the list of behaviors registered for this table
     *
     * @return array Associative array (name => parameters) of behaviors
     */
    public function getBehaviors()
    {
        return array(
            'timestampable' => array('create_column' => 'created_at', 'update_column' => 'updated_at', 'disable_created_at' => 'false', 'disable_updated_at' => 'false', ),
        );
    } // getBehaviors()

    /**
     * Retrieves a string version of the primary key from the DB resultset row that can be used to uniquely identify a row in this table.
     *
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, a serialize()d version of the primary key will be returned.
     *
     * @param array  $row       resultset row.
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM
     *
     * @return string The primary key hash of the row
     */
    public static function getPrimaryKeyHashFromRow($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        // If the PK cannot be derived from the row, return NULL.
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Userid', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Userid', TableMap::TYPE_PHPNAME, $indexType)];
    }

    /**
     * Retrieves the primary key from the DB resultset row
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, an array of the primary key columns will be returned.
     *
     * @param array  $row       resultset row.
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM
     *
     * @return mixed The primary key of the row
     */
    public static function getPrimaryKeyFromRow($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        return (int) $row[
            $indexType == TableMap::TYPE_NUM
                ? 0 + $offset
                : self::translateFieldName('Userid', TableMap::TYPE_PHPNAME, $indexType)
        ];
    }

    /**
     * The class that the tableMap will make instances of.
     *
     * If $withPrefix is true, the returned path
     * uses a dot-path notation which is translated into a path
     * relative to a location on the PHP include_path.
     * (e.g. path.to.MyClass -> 'path/to/MyClass.php')
     *
     * @param boolean $withPrefix Whether or not to return the path with the class name
     * @return string path.to.ClassName
     */
    public static function getOMClass($withPrefix = true)
    {
        return $withPrefix ? UserTableMap::CLASS_DEFAULT : UserTableMap::OM_CLASS;
    }

    /**
     * Populates an object of the default type or an object that inherit from the default.
     *
     * @param array  $row       row returned by DataFetcher->fetch().
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType The index type of $row. Mostly DataFetcher->getIndexType().
                                 One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     * @return array           (User object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = UserTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = UserTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + UserTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = UserTableMap::OM_CLASS;
            /** @var User $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            UserTableMap::addInstanceToPool($obj, $key);
        }

        return array($obj, $col);
    }

    /**
     * The returned array will contain objects of the default type or
     * objects that inherit from the default.
     *
     * @param DataFetcherInterface $dataFetcher
     * @return array
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function populateObjects(DataFetcherInterface $dataFetcher)
    {
        $results = array();

        // set the class once to avoid overhead in the loop
        $cls = static::getOMClass(false);
        // populate the object(s)
        while ($row = $dataFetcher->fetch()) {
            $key = UserTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = UserTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var User $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                UserTableMap::addInstanceToPool($obj, $key);
            } // if key exists
        }

        return $results;
    }
    /**
     * Add all the columns needed to create a new object.
     *
     * Note: any columns that were marked with lazyLoad="true" in the
     * XML schema will not be added to the select list and only loaded
     * on demand.
     *
     * @param Criteria $criteria object containing the columns to add.
     * @param string   $alias    optional table alias
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function addSelectColumns(Criteria $criteria, $alias = null)
    {
        if (null === $alias) {
            $criteria->addSelectColumn(UserTableMap::COL_USERID);
            $criteria->addSelectColumn(UserTableMap::COL_EMAIL);
            $criteria->addSelectColumn(UserTableMap::COL_ISPROVIDER);
            $criteria->addSelectColumn(UserTableMap::COL_FIRSTNAME);
            $criteria->addSelectColumn(UserTableMap::COL_LASTNAME);
            $criteria->addSelectColumn(UserTableMap::COL_SUFFIX);
            $criteria->addSelectColumn(UserTableMap::COL_ADDRESS);
            $criteria->addSelectColumn(UserTableMap::COL_CITY);
            $criteria->addSelectColumn(UserTableMap::COL_ZIPCODE);
            $criteria->addSelectColumn(UserTableMap::COL_PHONENUMBER);
            $criteria->addSelectColumn(UserTableMap::COL_PHONEOK);
            $criteria->addSelectColumn(UserTableMap::COL_TEXTOK);
            $criteria->addSelectColumn(UserTableMap::COL_EMAILOK);
            $criteria->addSelectColumn(UserTableMap::COL_MONDAYSTART);
            $criteria->addSelectColumn(UserTableMap::COL_MONDAYEND);
            $criteria->addSelectColumn(UserTableMap::COL_TUESDAYSTART);
            $criteria->addSelectColumn(UserTableMap::COL_TUESDAYEND);
            $criteria->addSelectColumn(UserTableMap::COL_WEDNESDAYSTART);
            $criteria->addSelectColumn(UserTableMap::COL_WEDNESDAYEND);
            $criteria->addSelectColumn(UserTableMap::COL_THURSDAYSTART);
            $criteria->addSelectColumn(UserTableMap::COL_THURSDAYEND);
            $criteria->addSelectColumn(UserTableMap::COL_FRIDAYSTART);
            $criteria->addSelectColumn(UserTableMap::COL_FRIDAYEND);
            $criteria->addSelectColumn(UserTableMap::COL_SATURDAYSTART);
            $criteria->addSelectColumn(UserTableMap::COL_SATURDAYEND);
            $criteria->addSelectColumn(UserTableMap::COL_SUNDAYSTART);
            $criteria->addSelectColumn(UserTableMap::COL_SUNDAYEND);
            $criteria->addSelectColumn(UserTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(UserTableMap::COL_UPDATED_AT);
        } else {
            $criteria->addSelectColumn($alias . '.userId');
            $criteria->addSelectColumn($alias . '.email');
            $criteria->addSelectColumn($alias . '.isProvider');
            $criteria->addSelectColumn($alias . '.firstName');
            $criteria->addSelectColumn($alias . '.lastName');
            $criteria->addSelectColumn($alias . '.suffix');
            $criteria->addSelectColumn($alias . '.address');
            $criteria->addSelectColumn($alias . '.city');
            $criteria->addSelectColumn($alias . '.zipcode');
            $criteria->addSelectColumn($alias . '.phoneNumber');
            $criteria->addSelectColumn($alias . '.phoneOk');
            $criteria->addSelectColumn($alias . '.textOk');
            $criteria->addSelectColumn($alias . '.emailOk');
            $criteria->addSelectColumn($alias . '.mondayStart');
            $criteria->addSelectColumn($alias . '.mondayEnd');
            $criteria->addSelectColumn($alias . '.tuesdayStart');
            $criteria->addSelectColumn($alias . '.tuesdayEnd');
            $criteria->addSelectColumn($alias . '.wednesdayStart');
            $criteria->addSelectColumn($alias . '.wednesdayEnd');
            $criteria->addSelectColumn($alias . '.thursdayStart');
            $criteria->addSelectColumn($alias . '.thursdayEnd');
            $criteria->addSelectColumn($alias . '.fridayStart');
            $criteria->addSelectColumn($alias . '.fridayEnd');
            $criteria->addSelectColumn($alias . '.saturdayStart');
            $criteria->addSelectColumn($alias . '.saturdayEnd');
            $criteria->addSelectColumn($alias . '.sundayStart');
            $criteria->addSelectColumn($alias . '.sundayEnd');
            $criteria->addSelectColumn($alias . '.created_at');
            $criteria->addSelectColumn($alias . '.updated_at');
        }
    }

    /**
     * Returns the TableMap related to this object.
     * This method is not needed for general use but a specific application could have a need.
     * @return TableMap
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function getTableMap()
    {
        return Propel::getServiceContainer()->getDatabaseMap(UserTableMap::DATABASE_NAME)->getTable(UserTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(UserTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(UserTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new UserTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a User or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or User object or primary key or array of primary keys
     *              which is used to create the DELETE statement
     * @param  ConnectionInterface $con the connection to use
     * @return int             The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                         if supported by native driver or if emulated using Propel.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
     public static function doDelete($values, ConnectionInterface $con = null)
     {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(UserTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \User) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(UserTableMap::DATABASE_NAME);
            $criteria->add(UserTableMap::COL_USERID, (array) $values, Criteria::IN);
        }

        $query = UserQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            UserTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                UserTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the user table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return UserQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a User or Criteria object.
     *
     * @param mixed               $criteria Criteria or User object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(UserTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from User object
        }

        if ($criteria->containsKey(UserTableMap::COL_USERID) && $criteria->keyContainsValue(UserTableMap::COL_USERID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.UserTableMap::COL_USERID.')');
        }


        // Set the correct dbName
        $query = UserQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // UserTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
UserTableMap::buildTableMap();
