<?php

namespace Base;

use \Usersettings as ChildUsersettings;
use \UsersettingsQuery as ChildUsersettingsQuery;
use \Exception;
use \PDO;
use Map\UsersettingsTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'userSettings' table.
 *
 *
 *
 * @method     ChildUsersettingsQuery orderBySettingsid($order = Criteria::ASC) Order by the settingsId column
 * @method     ChildUsersettingsQuery orderBySettingsUser($order = Criteria::ASC) Order by the user column
 * @method     ChildUsersettingsQuery orderByPhoneok($order = Criteria::ASC) Order by the phoneOk column
 * @method     ChildUsersettingsQuery orderByTextok($order = Criteria::ASC) Order by the textOk column
 * @method     ChildUsersettingsQuery orderByEmailok($order = Criteria::ASC) Order by the emailOk column
 * @method     ChildUsersettingsQuery orderByMondaystart($order = Criteria::ASC) Order by the mondayStart column
 * @method     ChildUsersettingsQuery orderByMondayend($order = Criteria::ASC) Order by the mondayEnd column
 * @method     ChildUsersettingsQuery orderByTuesdaystart($order = Criteria::ASC) Order by the tuesdayStart column
 * @method     ChildUsersettingsQuery orderByTuesdayend($order = Criteria::ASC) Order by the tuesdayEnd column
 * @method     ChildUsersettingsQuery orderByWednesdaystart($order = Criteria::ASC) Order by the wednesdayStart column
 * @method     ChildUsersettingsQuery orderByWednesdayend($order = Criteria::ASC) Order by the wednesdayEnd column
 * @method     ChildUsersettingsQuery orderByThursdaystart($order = Criteria::ASC) Order by the thursdayStart column
 * @method     ChildUsersettingsQuery orderByThursdayend($order = Criteria::ASC) Order by the thursdayEnd column
 * @method     ChildUsersettingsQuery orderByFridaystart($order = Criteria::ASC) Order by the fridayStart column
 * @method     ChildUsersettingsQuery orderByFridayend($order = Criteria::ASC) Order by the fridayEnd column
 * @method     ChildUsersettingsQuery orderBySaturdaystart($order = Criteria::ASC) Order by the saturdayStart column
 * @method     ChildUsersettingsQuery orderBySaturdayend($order = Criteria::ASC) Order by the saturdayEnd column
 * @method     ChildUsersettingsQuery orderBySundaystart($order = Criteria::ASC) Order by the sundayStart column
 * @method     ChildUsersettingsQuery orderBySundayend($order = Criteria::ASC) Order by the sundayEnd column
 * @method     ChildUsersettingsQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ChildUsersettingsQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 *
 * @method     ChildUsersettingsQuery groupBySettingsid() Group by the settingsId column
 * @method     ChildUsersettingsQuery groupBySettingsUser() Group by the user column
 * @method     ChildUsersettingsQuery groupByPhoneok() Group by the phoneOk column
 * @method     ChildUsersettingsQuery groupByTextok() Group by the textOk column
 * @method     ChildUsersettingsQuery groupByEmailok() Group by the emailOk column
 * @method     ChildUsersettingsQuery groupByMondaystart() Group by the mondayStart column
 * @method     ChildUsersettingsQuery groupByMondayend() Group by the mondayEnd column
 * @method     ChildUsersettingsQuery groupByTuesdaystart() Group by the tuesdayStart column
 * @method     ChildUsersettingsQuery groupByTuesdayend() Group by the tuesdayEnd column
 * @method     ChildUsersettingsQuery groupByWednesdaystart() Group by the wednesdayStart column
 * @method     ChildUsersettingsQuery groupByWednesdayend() Group by the wednesdayEnd column
 * @method     ChildUsersettingsQuery groupByThursdaystart() Group by the thursdayStart column
 * @method     ChildUsersettingsQuery groupByThursdayend() Group by the thursdayEnd column
 * @method     ChildUsersettingsQuery groupByFridaystart() Group by the fridayStart column
 * @method     ChildUsersettingsQuery groupByFridayend() Group by the fridayEnd column
 * @method     ChildUsersettingsQuery groupBySaturdaystart() Group by the saturdayStart column
 * @method     ChildUsersettingsQuery groupBySaturdayend() Group by the saturdayEnd column
 * @method     ChildUsersettingsQuery groupBySundaystart() Group by the sundayStart column
 * @method     ChildUsersettingsQuery groupBySundayend() Group by the sundayEnd column
 * @method     ChildUsersettingsQuery groupByCreatedAt() Group by the created_at column
 * @method     ChildUsersettingsQuery groupByUpdatedAt() Group by the updated_at column
 *
 * @method     ChildUsersettingsQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildUsersettingsQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildUsersettingsQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildUsersettingsQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildUsersettingsQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildUsersettingsQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildUsersettingsQuery leftJoinUser($relationAlias = null) Adds a LEFT JOIN clause to the query using the User relation
 * @method     ChildUsersettingsQuery rightJoinUser($relationAlias = null) Adds a RIGHT JOIN clause to the query using the User relation
 * @method     ChildUsersettingsQuery innerJoinUser($relationAlias = null) Adds a INNER JOIN clause to the query using the User relation
 *
 * @method     ChildUsersettingsQuery joinWithUser($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the User relation
 *
 * @method     ChildUsersettingsQuery leftJoinWithUser() Adds a LEFT JOIN clause and with to the query using the User relation
 * @method     ChildUsersettingsQuery rightJoinWithUser() Adds a RIGHT JOIN clause and with to the query using the User relation
 * @method     ChildUsersettingsQuery innerJoinWithUser() Adds a INNER JOIN clause and with to the query using the User relation
 *
 * @method     \UserQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildUsersettings findOne(ConnectionInterface $con = null) Return the first ChildUsersettings matching the query
 * @method     ChildUsersettings findOneOrCreate(ConnectionInterface $con = null) Return the first ChildUsersettings matching the query, or a new ChildUsersettings object populated from the query conditions when no match is found
 *
 * @method     ChildUsersettings findOneBySettingsid(int $settingsId) Return the first ChildUsersettings filtered by the settingsId column
 * @method     ChildUsersettings findOneBySettingsUser(int $user) Return the first ChildUsersettings filtered by the user column
 * @method     ChildUsersettings findOneByPhoneok(boolean $phoneOk) Return the first ChildUsersettings filtered by the phoneOk column
 * @method     ChildUsersettings findOneByTextok(boolean $textOk) Return the first ChildUsersettings filtered by the textOk column
 * @method     ChildUsersettings findOneByEmailok(boolean $emailOk) Return the first ChildUsersettings filtered by the emailOk column
 * @method     ChildUsersettings findOneByMondaystart(string $mondayStart) Return the first ChildUsersettings filtered by the mondayStart column
 * @method     ChildUsersettings findOneByMondayend(string $mondayEnd) Return the first ChildUsersettings filtered by the mondayEnd column
 * @method     ChildUsersettings findOneByTuesdaystart(string $tuesdayStart) Return the first ChildUsersettings filtered by the tuesdayStart column
 * @method     ChildUsersettings findOneByTuesdayend(string $tuesdayEnd) Return the first ChildUsersettings filtered by the tuesdayEnd column
 * @method     ChildUsersettings findOneByWednesdaystart(string $wednesdayStart) Return the first ChildUsersettings filtered by the wednesdayStart column
 * @method     ChildUsersettings findOneByWednesdayend(string $wednesdayEnd) Return the first ChildUsersettings filtered by the wednesdayEnd column
 * @method     ChildUsersettings findOneByThursdaystart(string $thursdayStart) Return the first ChildUsersettings filtered by the thursdayStart column
 * @method     ChildUsersettings findOneByThursdayend(string $thursdayEnd) Return the first ChildUsersettings filtered by the thursdayEnd column
 * @method     ChildUsersettings findOneByFridaystart(string $fridayStart) Return the first ChildUsersettings filtered by the fridayStart column
 * @method     ChildUsersettings findOneByFridayend(string $fridayEnd) Return the first ChildUsersettings filtered by the fridayEnd column
 * @method     ChildUsersettings findOneBySaturdaystart(string $saturdayStart) Return the first ChildUsersettings filtered by the saturdayStart column
 * @method     ChildUsersettings findOneBySaturdayend(string $saturdayEnd) Return the first ChildUsersettings filtered by the saturdayEnd column
 * @method     ChildUsersettings findOneBySundaystart(string $sundayStart) Return the first ChildUsersettings filtered by the sundayStart column
 * @method     ChildUsersettings findOneBySundayend(string $sundayEnd) Return the first ChildUsersettings filtered by the sundayEnd column
 * @method     ChildUsersettings findOneByCreatedAt(string $created_at) Return the first ChildUsersettings filtered by the created_at column
 * @method     ChildUsersettings findOneByUpdatedAt(string $updated_at) Return the first ChildUsersettings filtered by the updated_at column *

 * @method     ChildUsersettings requirePk($key, ConnectionInterface $con = null) Return the ChildUsersettings by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsersettings requireOne(ConnectionInterface $con = null) Return the first ChildUsersettings matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildUsersettings requireOneBySettingsid(int $settingsId) Return the first ChildUsersettings filtered by the settingsId column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsersettings requireOneBySettingsUser(int $user) Return the first ChildUsersettings filtered by the user column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsersettings requireOneByPhoneok(boolean $phoneOk) Return the first ChildUsersettings filtered by the phoneOk column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsersettings requireOneByTextok(boolean $textOk) Return the first ChildUsersettings filtered by the textOk column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsersettings requireOneByEmailok(boolean $emailOk) Return the first ChildUsersettings filtered by the emailOk column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsersettings requireOneByMondaystart(string $mondayStart) Return the first ChildUsersettings filtered by the mondayStart column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsersettings requireOneByMondayend(string $mondayEnd) Return the first ChildUsersettings filtered by the mondayEnd column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsersettings requireOneByTuesdaystart(string $tuesdayStart) Return the first ChildUsersettings filtered by the tuesdayStart column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsersettings requireOneByTuesdayend(string $tuesdayEnd) Return the first ChildUsersettings filtered by the tuesdayEnd column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsersettings requireOneByWednesdaystart(string $wednesdayStart) Return the first ChildUsersettings filtered by the wednesdayStart column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsersettings requireOneByWednesdayend(string $wednesdayEnd) Return the first ChildUsersettings filtered by the wednesdayEnd column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsersettings requireOneByThursdaystart(string $thursdayStart) Return the first ChildUsersettings filtered by the thursdayStart column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsersettings requireOneByThursdayend(string $thursdayEnd) Return the first ChildUsersettings filtered by the thursdayEnd column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsersettings requireOneByFridaystart(string $fridayStart) Return the first ChildUsersettings filtered by the fridayStart column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsersettings requireOneByFridayend(string $fridayEnd) Return the first ChildUsersettings filtered by the fridayEnd column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsersettings requireOneBySaturdaystart(string $saturdayStart) Return the first ChildUsersettings filtered by the saturdayStart column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsersettings requireOneBySaturdayend(string $saturdayEnd) Return the first ChildUsersettings filtered by the saturdayEnd column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsersettings requireOneBySundaystart(string $sundayStart) Return the first ChildUsersettings filtered by the sundayStart column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsersettings requireOneBySundayend(string $sundayEnd) Return the first ChildUsersettings filtered by the sundayEnd column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsersettings requireOneByCreatedAt(string $created_at) Return the first ChildUsersettings filtered by the created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsersettings requireOneByUpdatedAt(string $updated_at) Return the first ChildUsersettings filtered by the updated_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildUsersettings[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildUsersettings objects based on current ModelCriteria
 * @method     ChildUsersettings[]|ObjectCollection findBySettingsid(int $settingsId) Return ChildUsersettings objects filtered by the settingsId column
 * @method     ChildUsersettings[]|ObjectCollection findBySettingsUser(int $user) Return ChildUsersettings objects filtered by the user column
 * @method     ChildUsersettings[]|ObjectCollection findByPhoneok(boolean $phoneOk) Return ChildUsersettings objects filtered by the phoneOk column
 * @method     ChildUsersettings[]|ObjectCollection findByTextok(boolean $textOk) Return ChildUsersettings objects filtered by the textOk column
 * @method     ChildUsersettings[]|ObjectCollection findByEmailok(boolean $emailOk) Return ChildUsersettings objects filtered by the emailOk column
 * @method     ChildUsersettings[]|ObjectCollection findByMondaystart(string $mondayStart) Return ChildUsersettings objects filtered by the mondayStart column
 * @method     ChildUsersettings[]|ObjectCollection findByMondayend(string $mondayEnd) Return ChildUsersettings objects filtered by the mondayEnd column
 * @method     ChildUsersettings[]|ObjectCollection findByTuesdaystart(string $tuesdayStart) Return ChildUsersettings objects filtered by the tuesdayStart column
 * @method     ChildUsersettings[]|ObjectCollection findByTuesdayend(string $tuesdayEnd) Return ChildUsersettings objects filtered by the tuesdayEnd column
 * @method     ChildUsersettings[]|ObjectCollection findByWednesdaystart(string $wednesdayStart) Return ChildUsersettings objects filtered by the wednesdayStart column
 * @method     ChildUsersettings[]|ObjectCollection findByWednesdayend(string $wednesdayEnd) Return ChildUsersettings objects filtered by the wednesdayEnd column
 * @method     ChildUsersettings[]|ObjectCollection findByThursdaystart(string $thursdayStart) Return ChildUsersettings objects filtered by the thursdayStart column
 * @method     ChildUsersettings[]|ObjectCollection findByThursdayend(string $thursdayEnd) Return ChildUsersettings objects filtered by the thursdayEnd column
 * @method     ChildUsersettings[]|ObjectCollection findByFridaystart(string $fridayStart) Return ChildUsersettings objects filtered by the fridayStart column
 * @method     ChildUsersettings[]|ObjectCollection findByFridayend(string $fridayEnd) Return ChildUsersettings objects filtered by the fridayEnd column
 * @method     ChildUsersettings[]|ObjectCollection findBySaturdaystart(string $saturdayStart) Return ChildUsersettings objects filtered by the saturdayStart column
 * @method     ChildUsersettings[]|ObjectCollection findBySaturdayend(string $saturdayEnd) Return ChildUsersettings objects filtered by the saturdayEnd column
 * @method     ChildUsersettings[]|ObjectCollection findBySundaystart(string $sundayStart) Return ChildUsersettings objects filtered by the sundayStart column
 * @method     ChildUsersettings[]|ObjectCollection findBySundayend(string $sundayEnd) Return ChildUsersettings objects filtered by the sundayEnd column
 * @method     ChildUsersettings[]|ObjectCollection findByCreatedAt(string $created_at) Return ChildUsersettings objects filtered by the created_at column
 * @method     ChildUsersettings[]|ObjectCollection findByUpdatedAt(string $updated_at) Return ChildUsersettings objects filtered by the updated_at column
 * @method     ChildUsersettings[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class UsersettingsQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\UsersettingsQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\Usersettings', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildUsersettingsQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildUsersettingsQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildUsersettingsQuery) {
            return $criteria;
        }
        $query = new ChildUsersettingsQuery();
        if (null !== $modelAlias) {
            $query->setModelAlias($modelAlias);
        }
        if ($criteria instanceof Criteria) {
            $query->mergeWith($criteria);
        }

        return $query;
    }

    /**
     * Find object by primary key.
     * Propel uses the instance pool to skip the database if the object exists.
     * Go fast if the query is untouched.
     *
     * <code>
     * $obj  = $c->findPk(12, $con);
     * </code>
     *
     * @param mixed $key Primary key to use for the query
     * @param ConnectionInterface $con an optional connection object
     *
     * @return ChildUsersettings|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = UsersettingsTableMap::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(UsersettingsTableMap::DATABASE_NAME);
        }
        $this->basePreSelect($con);
        if ($this->formatter || $this->modelAlias || $this->with || $this->select
         || $this->selectColumns || $this->asColumns || $this->selectModifiers
         || $this->map || $this->having || $this->joins) {
            return $this->findPkComplex($key, $con);
        } else {
            return $this->findPkSimple($key, $con);
        }
    }

    /**
     * Find object by primary key using raw SQL to go fast.
     * Bypass doSelect() and the object formatter by using generated code.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     ConnectionInterface $con A connection object
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildUsersettings A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT settingsId, user, phoneOk, textOk, emailOk, mondayStart, mondayEnd, tuesdayStart, tuesdayEnd, wednesdayStart, wednesdayEnd, thursdayStart, thursdayEnd, fridayStart, fridayEnd, saturdayStart, saturdayEnd, sundayStart, sundayEnd, created_at, updated_at FROM userSettings WHERE settingsId = :p0';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key, PDO::PARAM_INT);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), 0, $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(\PDO::FETCH_NUM)) {
            /** @var ChildUsersettings $obj */
            $obj = new ChildUsersettings();
            $obj->hydrate($row);
            UsersettingsTableMap::addInstanceToPool($obj, (string) $key);
        }
        $stmt->closeCursor();

        return $obj;
    }

    /**
     * Find object by primary key.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     ConnectionInterface $con A connection object
     *
     * @return ChildUsersettings|array|mixed the result, formatted by the current formatter
     */
    protected function findPkComplex($key, ConnectionInterface $con)
    {
        // As the query uses a PK condition, no limit(1) is necessary.
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKey($key)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->formatOne($dataFetcher);
    }

    /**
     * Find objects by primary key
     * <code>
     * $objs = $c->findPks(array(12, 56, 832), $con);
     * </code>
     * @param     array $keys Primary keys to use for the query
     * @param     ConnectionInterface $con an optional connection object
     *
     * @return ObjectCollection|array|mixed the list of results, formatted by the current formatter
     */
    public function findPks($keys, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getReadConnection($this->getDbName());
        }
        $this->basePreSelect($con);
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKeys($keys)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->format($dataFetcher);
    }

    /**
     * Filter the query by primary key
     *
     * @param     mixed $key Primary key to use for the query
     *
     * @return $this|ChildUsersettingsQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(UsersettingsTableMap::COL_SETTINGSID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildUsersettingsQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(UsersettingsTableMap::COL_SETTINGSID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the settingsId column
     *
     * Example usage:
     * <code>
     * $query->filterBySettingsid(1234); // WHERE settingsId = 1234
     * $query->filterBySettingsid(array(12, 34)); // WHERE settingsId IN (12, 34)
     * $query->filterBySettingsid(array('min' => 12)); // WHERE settingsId > 12
     * </code>
     *
     * @param     mixed $settingsid The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUsersettingsQuery The current query, for fluid interface
     */
    public function filterBySettingsid($settingsid = null, $comparison = null)
    {
        if (is_array($settingsid)) {
            $useMinMax = false;
            if (isset($settingsid['min'])) {
                $this->addUsingAlias(UsersettingsTableMap::COL_SETTINGSID, $settingsid['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($settingsid['max'])) {
                $this->addUsingAlias(UsersettingsTableMap::COL_SETTINGSID, $settingsid['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UsersettingsTableMap::COL_SETTINGSID, $settingsid, $comparison);
    }

    /**
     * Filter the query on the user column
     *
     * Example usage:
     * <code>
     * $query->filterBySettingsUser(1234); // WHERE user = 1234
     * $query->filterBySettingsUser(array(12, 34)); // WHERE user IN (12, 34)
     * $query->filterBySettingsUser(array('min' => 12)); // WHERE user > 12
     * </code>
     *
     * @see       filterByUser()
     *
     * @param     mixed $settingsUser The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUsersettingsQuery The current query, for fluid interface
     */
    public function filterBySettingsUser($settingsUser = null, $comparison = null)
    {
        if (is_array($settingsUser)) {
            $useMinMax = false;
            if (isset($settingsUser['min'])) {
                $this->addUsingAlias(UsersettingsTableMap::COL_USER, $settingsUser['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($settingsUser['max'])) {
                $this->addUsingAlias(UsersettingsTableMap::COL_USER, $settingsUser['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UsersettingsTableMap::COL_USER, $settingsUser, $comparison);
    }

    /**
     * Filter the query on the phoneOk column
     *
     * Example usage:
     * <code>
     * $query->filterByPhoneok(true); // WHERE phoneOk = true
     * $query->filterByPhoneok('yes'); // WHERE phoneOk = true
     * </code>
     *
     * @param     boolean|string $phoneok The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUsersettingsQuery The current query, for fluid interface
     */
    public function filterByPhoneok($phoneok = null, $comparison = null)
    {
        if (is_string($phoneok)) {
            $phoneok = in_array(strtolower($phoneok), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(UsersettingsTableMap::COL_PHONEOK, $phoneok, $comparison);
    }

    /**
     * Filter the query on the textOk column
     *
     * Example usage:
     * <code>
     * $query->filterByTextok(true); // WHERE textOk = true
     * $query->filterByTextok('yes'); // WHERE textOk = true
     * </code>
     *
     * @param     boolean|string $textok The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUsersettingsQuery The current query, for fluid interface
     */
    public function filterByTextok($textok = null, $comparison = null)
    {
        if (is_string($textok)) {
            $textok = in_array(strtolower($textok), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(UsersettingsTableMap::COL_TEXTOK, $textok, $comparison);
    }

    /**
     * Filter the query on the emailOk column
     *
     * Example usage:
     * <code>
     * $query->filterByEmailok(true); // WHERE emailOk = true
     * $query->filterByEmailok('yes'); // WHERE emailOk = true
     * </code>
     *
     * @param     boolean|string $emailok The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUsersettingsQuery The current query, for fluid interface
     */
    public function filterByEmailok($emailok = null, $comparison = null)
    {
        if (is_string($emailok)) {
            $emailok = in_array(strtolower($emailok), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(UsersettingsTableMap::COL_EMAILOK, $emailok, $comparison);
    }

    /**
     * Filter the query on the mondayStart column
     *
     * Example usage:
     * <code>
     * $query->filterByMondaystart('2011-03-14'); // WHERE mondayStart = '2011-03-14'
     * $query->filterByMondaystart('now'); // WHERE mondayStart = '2011-03-14'
     * $query->filterByMondaystart(array('max' => 'yesterday')); // WHERE mondayStart > '2011-03-13'
     * </code>
     *
     * @param     mixed $mondaystart The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUsersettingsQuery The current query, for fluid interface
     */
    public function filterByMondaystart($mondaystart = null, $comparison = null)
    {
        if (is_array($mondaystart)) {
            $useMinMax = false;
            if (isset($mondaystart['min'])) {
                $this->addUsingAlias(UsersettingsTableMap::COL_MONDAYSTART, $mondaystart['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($mondaystart['max'])) {
                $this->addUsingAlias(UsersettingsTableMap::COL_MONDAYSTART, $mondaystart['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UsersettingsTableMap::COL_MONDAYSTART, $mondaystart, $comparison);
    }

    /**
     * Filter the query on the mondayEnd column
     *
     * Example usage:
     * <code>
     * $query->filterByMondayend('2011-03-14'); // WHERE mondayEnd = '2011-03-14'
     * $query->filterByMondayend('now'); // WHERE mondayEnd = '2011-03-14'
     * $query->filterByMondayend(array('max' => 'yesterday')); // WHERE mondayEnd > '2011-03-13'
     * </code>
     *
     * @param     mixed $mondayend The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUsersettingsQuery The current query, for fluid interface
     */
    public function filterByMondayend($mondayend = null, $comparison = null)
    {
        if (is_array($mondayend)) {
            $useMinMax = false;
            if (isset($mondayend['min'])) {
                $this->addUsingAlias(UsersettingsTableMap::COL_MONDAYEND, $mondayend['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($mondayend['max'])) {
                $this->addUsingAlias(UsersettingsTableMap::COL_MONDAYEND, $mondayend['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UsersettingsTableMap::COL_MONDAYEND, $mondayend, $comparison);
    }

    /**
     * Filter the query on the tuesdayStart column
     *
     * Example usage:
     * <code>
     * $query->filterByTuesdaystart('2011-03-14'); // WHERE tuesdayStart = '2011-03-14'
     * $query->filterByTuesdaystart('now'); // WHERE tuesdayStart = '2011-03-14'
     * $query->filterByTuesdaystart(array('max' => 'yesterday')); // WHERE tuesdayStart > '2011-03-13'
     * </code>
     *
     * @param     mixed $tuesdaystart The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUsersettingsQuery The current query, for fluid interface
     */
    public function filterByTuesdaystart($tuesdaystart = null, $comparison = null)
    {
        if (is_array($tuesdaystart)) {
            $useMinMax = false;
            if (isset($tuesdaystart['min'])) {
                $this->addUsingAlias(UsersettingsTableMap::COL_TUESDAYSTART, $tuesdaystart['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($tuesdaystart['max'])) {
                $this->addUsingAlias(UsersettingsTableMap::COL_TUESDAYSTART, $tuesdaystart['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UsersettingsTableMap::COL_TUESDAYSTART, $tuesdaystart, $comparison);
    }

    /**
     * Filter the query on the tuesdayEnd column
     *
     * Example usage:
     * <code>
     * $query->filterByTuesdayend('2011-03-14'); // WHERE tuesdayEnd = '2011-03-14'
     * $query->filterByTuesdayend('now'); // WHERE tuesdayEnd = '2011-03-14'
     * $query->filterByTuesdayend(array('max' => 'yesterday')); // WHERE tuesdayEnd > '2011-03-13'
     * </code>
     *
     * @param     mixed $tuesdayend The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUsersettingsQuery The current query, for fluid interface
     */
    public function filterByTuesdayend($tuesdayend = null, $comparison = null)
    {
        if (is_array($tuesdayend)) {
            $useMinMax = false;
            if (isset($tuesdayend['min'])) {
                $this->addUsingAlias(UsersettingsTableMap::COL_TUESDAYEND, $tuesdayend['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($tuesdayend['max'])) {
                $this->addUsingAlias(UsersettingsTableMap::COL_TUESDAYEND, $tuesdayend['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UsersettingsTableMap::COL_TUESDAYEND, $tuesdayend, $comparison);
    }

    /**
     * Filter the query on the wednesdayStart column
     *
     * Example usage:
     * <code>
     * $query->filterByWednesdaystart('2011-03-14'); // WHERE wednesdayStart = '2011-03-14'
     * $query->filterByWednesdaystart('now'); // WHERE wednesdayStart = '2011-03-14'
     * $query->filterByWednesdaystart(array('max' => 'yesterday')); // WHERE wednesdayStart > '2011-03-13'
     * </code>
     *
     * @param     mixed $wednesdaystart The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUsersettingsQuery The current query, for fluid interface
     */
    public function filterByWednesdaystart($wednesdaystart = null, $comparison = null)
    {
        if (is_array($wednesdaystart)) {
            $useMinMax = false;
            if (isset($wednesdaystart['min'])) {
                $this->addUsingAlias(UsersettingsTableMap::COL_WEDNESDAYSTART, $wednesdaystart['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($wednesdaystart['max'])) {
                $this->addUsingAlias(UsersettingsTableMap::COL_WEDNESDAYSTART, $wednesdaystart['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UsersettingsTableMap::COL_WEDNESDAYSTART, $wednesdaystart, $comparison);
    }

    /**
     * Filter the query on the wednesdayEnd column
     *
     * Example usage:
     * <code>
     * $query->filterByWednesdayend('2011-03-14'); // WHERE wednesdayEnd = '2011-03-14'
     * $query->filterByWednesdayend('now'); // WHERE wednesdayEnd = '2011-03-14'
     * $query->filterByWednesdayend(array('max' => 'yesterday')); // WHERE wednesdayEnd > '2011-03-13'
     * </code>
     *
     * @param     mixed $wednesdayend The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUsersettingsQuery The current query, for fluid interface
     */
    public function filterByWednesdayend($wednesdayend = null, $comparison = null)
    {
        if (is_array($wednesdayend)) {
            $useMinMax = false;
            if (isset($wednesdayend['min'])) {
                $this->addUsingAlias(UsersettingsTableMap::COL_WEDNESDAYEND, $wednesdayend['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($wednesdayend['max'])) {
                $this->addUsingAlias(UsersettingsTableMap::COL_WEDNESDAYEND, $wednesdayend['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UsersettingsTableMap::COL_WEDNESDAYEND, $wednesdayend, $comparison);
    }

    /**
     * Filter the query on the thursdayStart column
     *
     * Example usage:
     * <code>
     * $query->filterByThursdaystart('2011-03-14'); // WHERE thursdayStart = '2011-03-14'
     * $query->filterByThursdaystart('now'); // WHERE thursdayStart = '2011-03-14'
     * $query->filterByThursdaystart(array('max' => 'yesterday')); // WHERE thursdayStart > '2011-03-13'
     * </code>
     *
     * @param     mixed $thursdaystart The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUsersettingsQuery The current query, for fluid interface
     */
    public function filterByThursdaystart($thursdaystart = null, $comparison = null)
    {
        if (is_array($thursdaystart)) {
            $useMinMax = false;
            if (isset($thursdaystart['min'])) {
                $this->addUsingAlias(UsersettingsTableMap::COL_THURSDAYSTART, $thursdaystart['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($thursdaystart['max'])) {
                $this->addUsingAlias(UsersettingsTableMap::COL_THURSDAYSTART, $thursdaystart['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UsersettingsTableMap::COL_THURSDAYSTART, $thursdaystart, $comparison);
    }

    /**
     * Filter the query on the thursdayEnd column
     *
     * Example usage:
     * <code>
     * $query->filterByThursdayend('2011-03-14'); // WHERE thursdayEnd = '2011-03-14'
     * $query->filterByThursdayend('now'); // WHERE thursdayEnd = '2011-03-14'
     * $query->filterByThursdayend(array('max' => 'yesterday')); // WHERE thursdayEnd > '2011-03-13'
     * </code>
     *
     * @param     mixed $thursdayend The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUsersettingsQuery The current query, for fluid interface
     */
    public function filterByThursdayend($thursdayend = null, $comparison = null)
    {
        if (is_array($thursdayend)) {
            $useMinMax = false;
            if (isset($thursdayend['min'])) {
                $this->addUsingAlias(UsersettingsTableMap::COL_THURSDAYEND, $thursdayend['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($thursdayend['max'])) {
                $this->addUsingAlias(UsersettingsTableMap::COL_THURSDAYEND, $thursdayend['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UsersettingsTableMap::COL_THURSDAYEND, $thursdayend, $comparison);
    }

    /**
     * Filter the query on the fridayStart column
     *
     * Example usage:
     * <code>
     * $query->filterByFridaystart('2011-03-14'); // WHERE fridayStart = '2011-03-14'
     * $query->filterByFridaystart('now'); // WHERE fridayStart = '2011-03-14'
     * $query->filterByFridaystart(array('max' => 'yesterday')); // WHERE fridayStart > '2011-03-13'
     * </code>
     *
     * @param     mixed $fridaystart The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUsersettingsQuery The current query, for fluid interface
     */
    public function filterByFridaystart($fridaystart = null, $comparison = null)
    {
        if (is_array($fridaystart)) {
            $useMinMax = false;
            if (isset($fridaystart['min'])) {
                $this->addUsingAlias(UsersettingsTableMap::COL_FRIDAYSTART, $fridaystart['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($fridaystart['max'])) {
                $this->addUsingAlias(UsersettingsTableMap::COL_FRIDAYSTART, $fridaystart['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UsersettingsTableMap::COL_FRIDAYSTART, $fridaystart, $comparison);
    }

    /**
     * Filter the query on the fridayEnd column
     *
     * Example usage:
     * <code>
     * $query->filterByFridayend('2011-03-14'); // WHERE fridayEnd = '2011-03-14'
     * $query->filterByFridayend('now'); // WHERE fridayEnd = '2011-03-14'
     * $query->filterByFridayend(array('max' => 'yesterday')); // WHERE fridayEnd > '2011-03-13'
     * </code>
     *
     * @param     mixed $fridayend The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUsersettingsQuery The current query, for fluid interface
     */
    public function filterByFridayend($fridayend = null, $comparison = null)
    {
        if (is_array($fridayend)) {
            $useMinMax = false;
            if (isset($fridayend['min'])) {
                $this->addUsingAlias(UsersettingsTableMap::COL_FRIDAYEND, $fridayend['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($fridayend['max'])) {
                $this->addUsingAlias(UsersettingsTableMap::COL_FRIDAYEND, $fridayend['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UsersettingsTableMap::COL_FRIDAYEND, $fridayend, $comparison);
    }

    /**
     * Filter the query on the saturdayStart column
     *
     * Example usage:
     * <code>
     * $query->filterBySaturdaystart('2011-03-14'); // WHERE saturdayStart = '2011-03-14'
     * $query->filterBySaturdaystart('now'); // WHERE saturdayStart = '2011-03-14'
     * $query->filterBySaturdaystart(array('max' => 'yesterday')); // WHERE saturdayStart > '2011-03-13'
     * </code>
     *
     * @param     mixed $saturdaystart The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUsersettingsQuery The current query, for fluid interface
     */
    public function filterBySaturdaystart($saturdaystart = null, $comparison = null)
    {
        if (is_array($saturdaystart)) {
            $useMinMax = false;
            if (isset($saturdaystart['min'])) {
                $this->addUsingAlias(UsersettingsTableMap::COL_SATURDAYSTART, $saturdaystart['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($saturdaystart['max'])) {
                $this->addUsingAlias(UsersettingsTableMap::COL_SATURDAYSTART, $saturdaystart['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UsersettingsTableMap::COL_SATURDAYSTART, $saturdaystart, $comparison);
    }

    /**
     * Filter the query on the saturdayEnd column
     *
     * Example usage:
     * <code>
     * $query->filterBySaturdayend('2011-03-14'); // WHERE saturdayEnd = '2011-03-14'
     * $query->filterBySaturdayend('now'); // WHERE saturdayEnd = '2011-03-14'
     * $query->filterBySaturdayend(array('max' => 'yesterday')); // WHERE saturdayEnd > '2011-03-13'
     * </code>
     *
     * @param     mixed $saturdayend The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUsersettingsQuery The current query, for fluid interface
     */
    public function filterBySaturdayend($saturdayend = null, $comparison = null)
    {
        if (is_array($saturdayend)) {
            $useMinMax = false;
            if (isset($saturdayend['min'])) {
                $this->addUsingAlias(UsersettingsTableMap::COL_SATURDAYEND, $saturdayend['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($saturdayend['max'])) {
                $this->addUsingAlias(UsersettingsTableMap::COL_SATURDAYEND, $saturdayend['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UsersettingsTableMap::COL_SATURDAYEND, $saturdayend, $comparison);
    }

    /**
     * Filter the query on the sundayStart column
     *
     * Example usage:
     * <code>
     * $query->filterBySundaystart('2011-03-14'); // WHERE sundayStart = '2011-03-14'
     * $query->filterBySundaystart('now'); // WHERE sundayStart = '2011-03-14'
     * $query->filterBySundaystart(array('max' => 'yesterday')); // WHERE sundayStart > '2011-03-13'
     * </code>
     *
     * @param     mixed $sundaystart The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUsersettingsQuery The current query, for fluid interface
     */
    public function filterBySundaystart($sundaystart = null, $comparison = null)
    {
        if (is_array($sundaystart)) {
            $useMinMax = false;
            if (isset($sundaystart['min'])) {
                $this->addUsingAlias(UsersettingsTableMap::COL_SUNDAYSTART, $sundaystart['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($sundaystart['max'])) {
                $this->addUsingAlias(UsersettingsTableMap::COL_SUNDAYSTART, $sundaystart['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UsersettingsTableMap::COL_SUNDAYSTART, $sundaystart, $comparison);
    }

    /**
     * Filter the query on the sundayEnd column
     *
     * Example usage:
     * <code>
     * $query->filterBySundayend('2011-03-14'); // WHERE sundayEnd = '2011-03-14'
     * $query->filterBySundayend('now'); // WHERE sundayEnd = '2011-03-14'
     * $query->filterBySundayend(array('max' => 'yesterday')); // WHERE sundayEnd > '2011-03-13'
     * </code>
     *
     * @param     mixed $sundayend The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUsersettingsQuery The current query, for fluid interface
     */
    public function filterBySundayend($sundayend = null, $comparison = null)
    {
        if (is_array($sundayend)) {
            $useMinMax = false;
            if (isset($sundayend['min'])) {
                $this->addUsingAlias(UsersettingsTableMap::COL_SUNDAYEND, $sundayend['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($sundayend['max'])) {
                $this->addUsingAlias(UsersettingsTableMap::COL_SUNDAYEND, $sundayend['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UsersettingsTableMap::COL_SUNDAYEND, $sundayend, $comparison);
    }

    /**
     * Filter the query on the created_at column
     *
     * Example usage:
     * <code>
     * $query->filterByCreatedAt('2011-03-14'); // WHERE created_at = '2011-03-14'
     * $query->filterByCreatedAt('now'); // WHERE created_at = '2011-03-14'
     * $query->filterByCreatedAt(array('max' => 'yesterday')); // WHERE created_at > '2011-03-13'
     * </code>
     *
     * @param     mixed $createdAt The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUsersettingsQuery The current query, for fluid interface
     */
    public function filterByCreatedAt($createdAt = null, $comparison = null)
    {
        if (is_array($createdAt)) {
            $useMinMax = false;
            if (isset($createdAt['min'])) {
                $this->addUsingAlias(UsersettingsTableMap::COL_CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(UsersettingsTableMap::COL_CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UsersettingsTableMap::COL_CREATED_AT, $createdAt, $comparison);
    }

    /**
     * Filter the query on the updated_at column
     *
     * Example usage:
     * <code>
     * $query->filterByUpdatedAt('2011-03-14'); // WHERE updated_at = '2011-03-14'
     * $query->filterByUpdatedAt('now'); // WHERE updated_at = '2011-03-14'
     * $query->filterByUpdatedAt(array('max' => 'yesterday')); // WHERE updated_at > '2011-03-13'
     * </code>
     *
     * @param     mixed $updatedAt The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUsersettingsQuery The current query, for fluid interface
     */
    public function filterByUpdatedAt($updatedAt = null, $comparison = null)
    {
        if (is_array($updatedAt)) {
            $useMinMax = false;
            if (isset($updatedAt['min'])) {
                $this->addUsingAlias(UsersettingsTableMap::COL_UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(UsersettingsTableMap::COL_UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UsersettingsTableMap::COL_UPDATED_AT, $updatedAt, $comparison);
    }

    /**
     * Filter the query by a related \User object
     *
     * @param \User|ObjectCollection $user The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildUsersettingsQuery The current query, for fluid interface
     */
    public function filterByUser($user, $comparison = null)
    {
        if ($user instanceof \User) {
            return $this
                ->addUsingAlias(UsersettingsTableMap::COL_USER, $user->getUserid(), $comparison);
        } elseif ($user instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(UsersettingsTableMap::COL_USER, $user->toKeyValue('PrimaryKey', 'Userid'), $comparison);
        } else {
            throw new PropelException('filterByUser() only accepts arguments of type \User or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the User relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildUsersettingsQuery The current query, for fluid interface
     */
    public function joinUser($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('User');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'User');
        }

        return $this;
    }

    /**
     * Use the User relation User object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \UserQuery A secondary query class using the current class as primary query
     */
    public function useUserQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinUser($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'User', '\UserQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildUsersettings $usersettings Object to remove from the list of results
     *
     * @return $this|ChildUsersettingsQuery The current query, for fluid interface
     */
    public function prune($usersettings = null)
    {
        if ($usersettings) {
            $this->addUsingAlias(UsersettingsTableMap::COL_SETTINGSID, $usersettings->getSettingsid(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the userSettings table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(UsersettingsTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            UsersettingsTableMap::clearInstancePool();
            UsersettingsTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

    /**
     * Performs a DELETE on the database based on the current ModelCriteria
     *
     * @param ConnectionInterface $con the connection to use
     * @return int             The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                         if supported by native driver or if emulated using Propel.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public function delete(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(UsersettingsTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(UsersettingsTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            UsersettingsTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            UsersettingsTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

    // timestampable behavior

    /**
     * Filter by the latest updated
     *
     * @param      int $nbDays Maximum age of the latest update in days
     *
     * @return     $this|ChildUsersettingsQuery The current query, for fluid interface
     */
    public function recentlyUpdated($nbDays = 7)
    {
        return $this->addUsingAlias(UsersettingsTableMap::COL_UPDATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);
    }

    /**
     * Order by update date desc
     *
     * @return     $this|ChildUsersettingsQuery The current query, for fluid interface
     */
    public function lastUpdatedFirst()
    {
        return $this->addDescendingOrderByColumn(UsersettingsTableMap::COL_UPDATED_AT);
    }

    /**
     * Order by update date asc
     *
     * @return     $this|ChildUsersettingsQuery The current query, for fluid interface
     */
    public function firstUpdatedFirst()
    {
        return $this->addAscendingOrderByColumn(UsersettingsTableMap::COL_UPDATED_AT);
    }

    /**
     * Order by create date desc
     *
     * @return     $this|ChildUsersettingsQuery The current query, for fluid interface
     */
    public function lastCreatedFirst()
    {
        return $this->addDescendingOrderByColumn(UsersettingsTableMap::COL_CREATED_AT);
    }

    /**
     * Filter by the latest created
     *
     * @param      int $nbDays Maximum age of in days
     *
     * @return     $this|ChildUsersettingsQuery The current query, for fluid interface
     */
    public function recentlyCreated($nbDays = 7)
    {
        return $this->addUsingAlias(UsersettingsTableMap::COL_CREATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);
    }

    /**
     * Order by create date asc
     *
     * @return     $this|ChildUsersettingsQuery The current query, for fluid interface
     */
    public function firstCreatedFirst()
    {
        return $this->addAscendingOrderByColumn(UsersettingsTableMap::COL_CREATED_AT);
    }

} // UsersettingsQuery
