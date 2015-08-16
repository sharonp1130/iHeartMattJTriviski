<?php

namespace Map;

use \Usersettings;
use \UsersettingsQuery;
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
 * This class defines the structure of the 'userSettings' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 */
class UsersettingsTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = '.Map.UsersettingsTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'userSettings';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\Usersettings';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'Usersettings';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 19;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 19;

    /**
     * the column name for the settingsId field
     */
    const COL_SETTINGSID = 'userSettings.settingsId';

    /**
     * the column name for the user field
     */
    const COL_USER = 'userSettings.user';

    /**
     * the column name for the phoneOk field
     */
    const COL_PHONEOK = 'userSettings.phoneOk';

    /**
     * the column name for the textOk field
     */
    const COL_TEXTOK = 'userSettings.textOk';

    /**
     * the column name for the emailOk field
     */
    const COL_EMAILOK = 'userSettings.emailOk';

    /**
     * the column name for the mondayStart field
     */
    const COL_MONDAYSTART = 'userSettings.mondayStart';

    /**
     * the column name for the mondayEnd field
     */
    const COL_MONDAYEND = 'userSettings.mondayEnd';

    /**
     * the column name for the tuesdayStart field
     */
    const COL_TUESDAYSTART = 'userSettings.tuesdayStart';

    /**
     * the column name for the tuesdayEnd field
     */
    const COL_TUESDAYEND = 'userSettings.tuesdayEnd';

    /**
     * the column name for the wednesdayStart field
     */
    const COL_WEDNESDAYSTART = 'userSettings.wednesdayStart';

    /**
     * the column name for the wednesdayEnd field
     */
    const COL_WEDNESDAYEND = 'userSettings.wednesdayEnd';

    /**
     * the column name for the thursdayStart field
     */
    const COL_THURSDAYSTART = 'userSettings.thursdayStart';

    /**
     * the column name for the thursdayEnd field
     */
    const COL_THURSDAYEND = 'userSettings.thursdayEnd';

    /**
     * the column name for the fridayStart field
     */
    const COL_FRIDAYSTART = 'userSettings.fridayStart';

    /**
     * the column name for the fridayEnd field
     */
    const COL_FRIDAYEND = 'userSettings.fridayEnd';

    /**
     * the column name for the saturdayStart field
     */
    const COL_SATURDAYSTART = 'userSettings.saturdayStart';

    /**
     * the column name for the saturdayEnd field
     */
    const COL_SATURDAYEND = 'userSettings.saturdayEnd';

    /**
     * the column name for the sundayStart field
     */
    const COL_SUNDAYSTART = 'userSettings.sundayStart';

    /**
     * the column name for the sundayEnd field
     */
    const COL_SUNDAYEND = 'userSettings.sundayEnd';

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
        self::TYPE_PHPNAME       => array('Settingsid', 'SettingsUser', 'Phoneok', 'Textok', 'Emailok', 'Mondaystart', 'Mondayend', 'Tuesdaystart', 'Tuesdayend', 'Wednesdaystart', 'Wednesdayend', 'Thursdaystart', 'Thursdayend', 'Fridaystart', 'Fridayend', 'Saturdaystart', 'Saturdayend', 'Sundaystart', 'Sundayend', ),
        self::TYPE_CAMELNAME     => array('settingsid', 'settingsUser', 'phoneok', 'textok', 'emailok', 'mondaystart', 'mondayend', 'tuesdaystart', 'tuesdayend', 'wednesdaystart', 'wednesdayend', 'thursdaystart', 'thursdayend', 'fridaystart', 'fridayend', 'saturdaystart', 'saturdayend', 'sundaystart', 'sundayend', ),
        self::TYPE_COLNAME       => array(UsersettingsTableMap::COL_SETTINGSID, UsersettingsTableMap::COL_USER, UsersettingsTableMap::COL_PHONEOK, UsersettingsTableMap::COL_TEXTOK, UsersettingsTableMap::COL_EMAILOK, UsersettingsTableMap::COL_MONDAYSTART, UsersettingsTableMap::COL_MONDAYEND, UsersettingsTableMap::COL_TUESDAYSTART, UsersettingsTableMap::COL_TUESDAYEND, UsersettingsTableMap::COL_WEDNESDAYSTART, UsersettingsTableMap::COL_WEDNESDAYEND, UsersettingsTableMap::COL_THURSDAYSTART, UsersettingsTableMap::COL_THURSDAYEND, UsersettingsTableMap::COL_FRIDAYSTART, UsersettingsTableMap::COL_FRIDAYEND, UsersettingsTableMap::COL_SATURDAYSTART, UsersettingsTableMap::COL_SATURDAYEND, UsersettingsTableMap::COL_SUNDAYSTART, UsersettingsTableMap::COL_SUNDAYEND, ),
        self::TYPE_FIELDNAME     => array('settingsId', 'user', 'phoneOk', 'textOk', 'emailOk', 'mondayStart', 'mondayEnd', 'tuesdayStart', 'tuesdayEnd', 'wednesdayStart', 'wednesdayEnd', 'thursdayStart', 'thursdayEnd', 'fridayStart', 'fridayEnd', 'saturdayStart', 'saturdayEnd', 'sundayStart', 'sundayEnd', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('Settingsid' => 0, 'SettingsUser' => 1, 'Phoneok' => 2, 'Textok' => 3, 'Emailok' => 4, 'Mondaystart' => 5, 'Mondayend' => 6, 'Tuesdaystart' => 7, 'Tuesdayend' => 8, 'Wednesdaystart' => 9, 'Wednesdayend' => 10, 'Thursdaystart' => 11, 'Thursdayend' => 12, 'Fridaystart' => 13, 'Fridayend' => 14, 'Saturdaystart' => 15, 'Saturdayend' => 16, 'Sundaystart' => 17, 'Sundayend' => 18, ),
        self::TYPE_CAMELNAME     => array('settingsid' => 0, 'settingsUser' => 1, 'phoneok' => 2, 'textok' => 3, 'emailok' => 4, 'mondaystart' => 5, 'mondayend' => 6, 'tuesdaystart' => 7, 'tuesdayend' => 8, 'wednesdaystart' => 9, 'wednesdayend' => 10, 'thursdaystart' => 11, 'thursdayend' => 12, 'fridaystart' => 13, 'fridayend' => 14, 'saturdaystart' => 15, 'saturdayend' => 16, 'sundaystart' => 17, 'sundayend' => 18, ),
        self::TYPE_COLNAME       => array(UsersettingsTableMap::COL_SETTINGSID => 0, UsersettingsTableMap::COL_USER => 1, UsersettingsTableMap::COL_PHONEOK => 2, UsersettingsTableMap::COL_TEXTOK => 3, UsersettingsTableMap::COL_EMAILOK => 4, UsersettingsTableMap::COL_MONDAYSTART => 5, UsersettingsTableMap::COL_MONDAYEND => 6, UsersettingsTableMap::COL_TUESDAYSTART => 7, UsersettingsTableMap::COL_TUESDAYEND => 8, UsersettingsTableMap::COL_WEDNESDAYSTART => 9, UsersettingsTableMap::COL_WEDNESDAYEND => 10, UsersettingsTableMap::COL_THURSDAYSTART => 11, UsersettingsTableMap::COL_THURSDAYEND => 12, UsersettingsTableMap::COL_FRIDAYSTART => 13, UsersettingsTableMap::COL_FRIDAYEND => 14, UsersettingsTableMap::COL_SATURDAYSTART => 15, UsersettingsTableMap::COL_SATURDAYEND => 16, UsersettingsTableMap::COL_SUNDAYSTART => 17, UsersettingsTableMap::COL_SUNDAYEND => 18, ),
        self::TYPE_FIELDNAME     => array('settingsId' => 0, 'user' => 1, 'phoneOk' => 2, 'textOk' => 3, 'emailOk' => 4, 'mondayStart' => 5, 'mondayEnd' => 6, 'tuesdayStart' => 7, 'tuesdayEnd' => 8, 'wednesdayStart' => 9, 'wednesdayEnd' => 10, 'thursdayStart' => 11, 'thursdayEnd' => 12, 'fridayStart' => 13, 'fridayEnd' => 14, 'saturdayStart' => 15, 'saturdayEnd' => 16, 'sundayStart' => 17, 'sundayEnd' => 18, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, )
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
        $this->setName('userSettings');
        $this->setPhpName('Usersettings');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\Usersettings');
        $this->setPackage('');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('settingsId', 'Settingsid', 'INTEGER', true, 32, null);
        $this->addForeignKey('user', 'SettingsUser', 'INTEGER', 'user', 'userId', true, 32, null);
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
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('User', '\\User', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':user',
    1 => ':userId',
  ),
), null, 'CASCADE', null, false);
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Settingsid', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Settingsid', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('Settingsid', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? UsersettingsTableMap::CLASS_DEFAULT : UsersettingsTableMap::OM_CLASS;
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
     * @return array           (Usersettings object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = UsersettingsTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = UsersettingsTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + UsersettingsTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = UsersettingsTableMap::OM_CLASS;
            /** @var Usersettings $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            UsersettingsTableMap::addInstanceToPool($obj, $key);
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
            $key = UsersettingsTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = UsersettingsTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var Usersettings $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                UsersettingsTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(UsersettingsTableMap::COL_SETTINGSID);
            $criteria->addSelectColumn(UsersettingsTableMap::COL_USER);
            $criteria->addSelectColumn(UsersettingsTableMap::COL_PHONEOK);
            $criteria->addSelectColumn(UsersettingsTableMap::COL_TEXTOK);
            $criteria->addSelectColumn(UsersettingsTableMap::COL_EMAILOK);
            $criteria->addSelectColumn(UsersettingsTableMap::COL_MONDAYSTART);
            $criteria->addSelectColumn(UsersettingsTableMap::COL_MONDAYEND);
            $criteria->addSelectColumn(UsersettingsTableMap::COL_TUESDAYSTART);
            $criteria->addSelectColumn(UsersettingsTableMap::COL_TUESDAYEND);
            $criteria->addSelectColumn(UsersettingsTableMap::COL_WEDNESDAYSTART);
            $criteria->addSelectColumn(UsersettingsTableMap::COL_WEDNESDAYEND);
            $criteria->addSelectColumn(UsersettingsTableMap::COL_THURSDAYSTART);
            $criteria->addSelectColumn(UsersettingsTableMap::COL_THURSDAYEND);
            $criteria->addSelectColumn(UsersettingsTableMap::COL_FRIDAYSTART);
            $criteria->addSelectColumn(UsersettingsTableMap::COL_FRIDAYEND);
            $criteria->addSelectColumn(UsersettingsTableMap::COL_SATURDAYSTART);
            $criteria->addSelectColumn(UsersettingsTableMap::COL_SATURDAYEND);
            $criteria->addSelectColumn(UsersettingsTableMap::COL_SUNDAYSTART);
            $criteria->addSelectColumn(UsersettingsTableMap::COL_SUNDAYEND);
        } else {
            $criteria->addSelectColumn($alias . '.settingsId');
            $criteria->addSelectColumn($alias . '.user');
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
        return Propel::getServiceContainer()->getDatabaseMap(UsersettingsTableMap::DATABASE_NAME)->getTable(UsersettingsTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(UsersettingsTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(UsersettingsTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new UsersettingsTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a Usersettings or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or Usersettings object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(UsersettingsTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Usersettings) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(UsersettingsTableMap::DATABASE_NAME);
            $criteria->add(UsersettingsTableMap::COL_SETTINGSID, (array) $values, Criteria::IN);
        }

        $query = UsersettingsQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            UsersettingsTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                UsersettingsTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the userSettings table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return UsersettingsQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a Usersettings or Criteria object.
     *
     * @param mixed               $criteria Criteria or Usersettings object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(UsersettingsTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from Usersettings object
        }

        if ($criteria->containsKey(UsersettingsTableMap::COL_SETTINGSID) && $criteria->keyContainsValue(UsersettingsTableMap::COL_SETTINGSID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.UsersettingsTableMap::COL_SETTINGSID.')');
        }


        // Set the correct dbName
        $query = UsersettingsQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // UsersettingsTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
UsersettingsTableMap::buildTableMap();
