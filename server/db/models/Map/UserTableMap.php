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
    const NUM_COLUMNS = 10;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 10;

    /**
     * the column name for the userId field
     */
    const COL_USERID = 'user.userId';

    /**
     * the column name for the isProvider field
     */
    const COL_ISPROVIDER = 'user.isProvider';

    /**
     * the column name for the userName field
     */
    const COL_USERNAME = 'user.userName';

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
     * the column name for the phoneNumber field
     */
    const COL_PHONENUMBER = 'user.phoneNumber';

    /**
     * the column name for the email field
     */
    const COL_EMAIL = 'user.email';

    /**
     * the column name for the lastUpdate field
     */
    const COL_LASTUPDATE = 'user.lastUpdate';

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
        self::TYPE_PHPNAME       => array('Userid', 'Isprovider', 'Username', 'Firstname', 'Lastname', 'Suffix', 'Address', 'Phonenumber', 'Email', 'Lastupdate', ),
        self::TYPE_CAMELNAME     => array('userid', 'isprovider', 'username', 'firstname', 'lastname', 'suffix', 'address', 'phonenumber', 'email', 'lastupdate', ),
        self::TYPE_COLNAME       => array(UserTableMap::COL_USERID, UserTableMap::COL_ISPROVIDER, UserTableMap::COL_USERNAME, UserTableMap::COL_FIRSTNAME, UserTableMap::COL_LASTNAME, UserTableMap::COL_SUFFIX, UserTableMap::COL_ADDRESS, UserTableMap::COL_PHONENUMBER, UserTableMap::COL_EMAIL, UserTableMap::COL_LASTUPDATE, ),
        self::TYPE_FIELDNAME     => array('userId', 'isProvider', 'userName', 'firstName', 'lastName', 'suffix', 'address', 'phoneNumber', 'email', 'lastUpdate', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('Userid' => 0, 'Isprovider' => 1, 'Username' => 2, 'Firstname' => 3, 'Lastname' => 4, 'Suffix' => 5, 'Address' => 6, 'Phonenumber' => 7, 'Email' => 8, 'Lastupdate' => 9, ),
        self::TYPE_CAMELNAME     => array('userid' => 0, 'isprovider' => 1, 'username' => 2, 'firstname' => 3, 'lastname' => 4, 'suffix' => 5, 'address' => 6, 'phonenumber' => 7, 'email' => 8, 'lastupdate' => 9, ),
        self::TYPE_COLNAME       => array(UserTableMap::COL_USERID => 0, UserTableMap::COL_ISPROVIDER => 1, UserTableMap::COL_USERNAME => 2, UserTableMap::COL_FIRSTNAME => 3, UserTableMap::COL_LASTNAME => 4, UserTableMap::COL_SUFFIX => 5, UserTableMap::COL_ADDRESS => 6, UserTableMap::COL_PHONENUMBER => 7, UserTableMap::COL_EMAIL => 8, UserTableMap::COL_LASTUPDATE => 9, ),
        self::TYPE_FIELDNAME     => array('userId' => 0, 'isProvider' => 1, 'userName' => 2, 'firstName' => 3, 'lastName' => 4, 'suffix' => 5, 'address' => 6, 'phoneNumber' => 7, 'email' => 8, 'lastUpdate' => 9, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, )
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
        $this->addColumn('isProvider', 'Isprovider', 'BOOLEAN', true, 1, false);
        $this->addColumn('userName', 'Username', 'VARCHAR', true, 32, null);
        $this->addColumn('firstName', 'Firstname', 'VARCHAR', true, 20, null);
        $this->addColumn('lastName', 'Lastname', 'VARCHAR', true, 20, null);
        $this->addColumn('suffix', 'Suffix', 'VARCHAR', false, 5, null);
        $this->addColumn('address', 'Address', 'VARCHAR', true, 64, null);
        $this->addColumn('phoneNumber', 'Phonenumber', 'VARCHAR', true, 20, null);
        $this->addColumn('email', 'Email', 'VARCHAR', true, 50, null);
        $this->addColumn('lastUpdate', 'Lastupdate', 'TIMESTAMP', true, null, null);
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
        $this->addRelation('Usersettings', '\\Usersettings', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':user',
    1 => ':userId',
  ),
), null, 'CASCADE', 'Usersettingss', false);
    } // buildRelations()

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
            $criteria->addSelectColumn(UserTableMap::COL_ISPROVIDER);
            $criteria->addSelectColumn(UserTableMap::COL_USERNAME);
            $criteria->addSelectColumn(UserTableMap::COL_FIRSTNAME);
            $criteria->addSelectColumn(UserTableMap::COL_LASTNAME);
            $criteria->addSelectColumn(UserTableMap::COL_SUFFIX);
            $criteria->addSelectColumn(UserTableMap::COL_ADDRESS);
            $criteria->addSelectColumn(UserTableMap::COL_PHONENUMBER);
            $criteria->addSelectColumn(UserTableMap::COL_EMAIL);
            $criteria->addSelectColumn(UserTableMap::COL_LASTUPDATE);
        } else {
            $criteria->addSelectColumn($alias . '.userId');
            $criteria->addSelectColumn($alias . '.isProvider');
            $criteria->addSelectColumn($alias . '.userName');
            $criteria->addSelectColumn($alias . '.firstName');
            $criteria->addSelectColumn($alias . '.lastName');
            $criteria->addSelectColumn($alias . '.suffix');
            $criteria->addSelectColumn($alias . '.address');
            $criteria->addSelectColumn($alias . '.phoneNumber');
            $criteria->addSelectColumn($alias . '.email');
            $criteria->addSelectColumn($alias . '.lastUpdate');
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
