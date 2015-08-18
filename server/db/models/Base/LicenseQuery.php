<?php

namespace Base;

use \License as ChildLicense;
use \LicenseQuery as ChildLicenseQuery;
use \Exception;
use \PDO;
use Map\LicenseTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'license' table.
 *
 *
 *
 * @method     ChildLicenseQuery orderByLicenseid($order = Criteria::ASC) Order by the licenseId column
 * @method     ChildLicenseQuery orderByLicensenumber($order = Criteria::ASC) Order by the licenseNumber column
 * @method     ChildLicenseQuery orderByLicenseService($order = Criteria::ASC) Order by the service column
 * @method     ChildLicenseQuery orderByLicenseUser($order = Criteria::ASC) Order by the user column
 * @method     ChildLicenseQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ChildLicenseQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 *
 * @method     ChildLicenseQuery groupByLicenseid() Group by the licenseId column
 * @method     ChildLicenseQuery groupByLicensenumber() Group by the licenseNumber column
 * @method     ChildLicenseQuery groupByLicenseService() Group by the service column
 * @method     ChildLicenseQuery groupByLicenseUser() Group by the user column
 * @method     ChildLicenseQuery groupByCreatedAt() Group by the created_at column
 * @method     ChildLicenseQuery groupByUpdatedAt() Group by the updated_at column
 *
 * @method     ChildLicenseQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildLicenseQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildLicenseQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildLicenseQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildLicenseQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildLicenseQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildLicenseQuery leftJoinUser($relationAlias = null) Adds a LEFT JOIN clause to the query using the User relation
 * @method     ChildLicenseQuery rightJoinUser($relationAlias = null) Adds a RIGHT JOIN clause to the query using the User relation
 * @method     ChildLicenseQuery innerJoinUser($relationAlias = null) Adds a INNER JOIN clause to the query using the User relation
 *
 * @method     ChildLicenseQuery joinWithUser($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the User relation
 *
 * @method     ChildLicenseQuery leftJoinWithUser() Adds a LEFT JOIN clause and with to the query using the User relation
 * @method     ChildLicenseQuery rightJoinWithUser() Adds a RIGHT JOIN clause and with to the query using the User relation
 * @method     ChildLicenseQuery innerJoinWithUser() Adds a INNER JOIN clause and with to the query using the User relation
 *
 * @method     ChildLicenseQuery leftJoinService($relationAlias = null) Adds a LEFT JOIN clause to the query using the Service relation
 * @method     ChildLicenseQuery rightJoinService($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Service relation
 * @method     ChildLicenseQuery innerJoinService($relationAlias = null) Adds a INNER JOIN clause to the query using the Service relation
 *
 * @method     ChildLicenseQuery joinWithService($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Service relation
 *
 * @method     ChildLicenseQuery leftJoinWithService() Adds a LEFT JOIN clause and with to the query using the Service relation
 * @method     ChildLicenseQuery rightJoinWithService() Adds a RIGHT JOIN clause and with to the query using the Service relation
 * @method     ChildLicenseQuery innerJoinWithService() Adds a INNER JOIN clause and with to the query using the Service relation
 *
 * @method     \UserQuery|\ServiceQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildLicense findOne(ConnectionInterface $con = null) Return the first ChildLicense matching the query
 * @method     ChildLicense findOneOrCreate(ConnectionInterface $con = null) Return the first ChildLicense matching the query, or a new ChildLicense object populated from the query conditions when no match is found
 *
 * @method     ChildLicense findOneByLicenseid(int $licenseId) Return the first ChildLicense filtered by the licenseId column
 * @method     ChildLicense findOneByLicensenumber(string $licenseNumber) Return the first ChildLicense filtered by the licenseNumber column
 * @method     ChildLicense findOneByLicenseService(int $service) Return the first ChildLicense filtered by the service column
 * @method     ChildLicense findOneByLicenseUser(int $user) Return the first ChildLicense filtered by the user column
 * @method     ChildLicense findOneByCreatedAt(string $created_at) Return the first ChildLicense filtered by the created_at column
 * @method     ChildLicense findOneByUpdatedAt(string $updated_at) Return the first ChildLicense filtered by the updated_at column *

 * @method     ChildLicense requirePk($key, ConnectionInterface $con = null) Return the ChildLicense by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLicense requireOne(ConnectionInterface $con = null) Return the first ChildLicense matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildLicense requireOneByLicenseid(int $licenseId) Return the first ChildLicense filtered by the licenseId column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLicense requireOneByLicensenumber(string $licenseNumber) Return the first ChildLicense filtered by the licenseNumber column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLicense requireOneByLicenseService(int $service) Return the first ChildLicense filtered by the service column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLicense requireOneByLicenseUser(int $user) Return the first ChildLicense filtered by the user column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLicense requireOneByCreatedAt(string $created_at) Return the first ChildLicense filtered by the created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLicense requireOneByUpdatedAt(string $updated_at) Return the first ChildLicense filtered by the updated_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildLicense[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildLicense objects based on current ModelCriteria
 * @method     ChildLicense[]|ObjectCollection findByLicenseid(int $licenseId) Return ChildLicense objects filtered by the licenseId column
 * @method     ChildLicense[]|ObjectCollection findByLicensenumber(string $licenseNumber) Return ChildLicense objects filtered by the licenseNumber column
 * @method     ChildLicense[]|ObjectCollection findByLicenseService(int $service) Return ChildLicense objects filtered by the service column
 * @method     ChildLicense[]|ObjectCollection findByLicenseUser(int $user) Return ChildLicense objects filtered by the user column
 * @method     ChildLicense[]|ObjectCollection findByCreatedAt(string $created_at) Return ChildLicense objects filtered by the created_at column
 * @method     ChildLicense[]|ObjectCollection findByUpdatedAt(string $updated_at) Return ChildLicense objects filtered by the updated_at column
 * @method     ChildLicense[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class LicenseQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\LicenseQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\License', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildLicenseQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildLicenseQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildLicenseQuery) {
            return $criteria;
        }
        $query = new ChildLicenseQuery();
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
     * @return ChildLicense|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = LicenseTableMap::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(LicenseTableMap::DATABASE_NAME);
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
     * @return ChildLicense A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT licenseId, licenseNumber, service, user, created_at, updated_at FROM license WHERE licenseId = :p0';
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
            /** @var ChildLicense $obj */
            $obj = new ChildLicense();
            $obj->hydrate($row);
            LicenseTableMap::addInstanceToPool($obj, (string) $key);
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
     * @return ChildLicense|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildLicenseQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(LicenseTableMap::COL_LICENSEID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildLicenseQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(LicenseTableMap::COL_LICENSEID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the licenseId column
     *
     * Example usage:
     * <code>
     * $query->filterByLicenseid(1234); // WHERE licenseId = 1234
     * $query->filterByLicenseid(array(12, 34)); // WHERE licenseId IN (12, 34)
     * $query->filterByLicenseid(array('min' => 12)); // WHERE licenseId > 12
     * </code>
     *
     * @param     mixed $licenseid The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildLicenseQuery The current query, for fluid interface
     */
    public function filterByLicenseid($licenseid = null, $comparison = null)
    {
        if (is_array($licenseid)) {
            $useMinMax = false;
            if (isset($licenseid['min'])) {
                $this->addUsingAlias(LicenseTableMap::COL_LICENSEID, $licenseid['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($licenseid['max'])) {
                $this->addUsingAlias(LicenseTableMap::COL_LICENSEID, $licenseid['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(LicenseTableMap::COL_LICENSEID, $licenseid, $comparison);
    }

    /**
     * Filter the query on the licenseNumber column
     *
     * Example usage:
     * <code>
     * $query->filterByLicensenumber('fooValue');   // WHERE licenseNumber = 'fooValue'
     * $query->filterByLicensenumber('%fooValue%'); // WHERE licenseNumber LIKE '%fooValue%'
     * </code>
     *
     * @param     string $licensenumber The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildLicenseQuery The current query, for fluid interface
     */
    public function filterByLicensenumber($licensenumber = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($licensenumber)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $licensenumber)) {
                $licensenumber = str_replace('*', '%', $licensenumber);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(LicenseTableMap::COL_LICENSENUMBER, $licensenumber, $comparison);
    }

    /**
     * Filter the query on the service column
     *
     * Example usage:
     * <code>
     * $query->filterByLicenseService(1234); // WHERE service = 1234
     * $query->filterByLicenseService(array(12, 34)); // WHERE service IN (12, 34)
     * $query->filterByLicenseService(array('min' => 12)); // WHERE service > 12
     * </code>
     *
     * @see       filterByService()
     *
     * @param     mixed $licenseService The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildLicenseQuery The current query, for fluid interface
     */
    public function filterByLicenseService($licenseService = null, $comparison = null)
    {
        if (is_array($licenseService)) {
            $useMinMax = false;
            if (isset($licenseService['min'])) {
                $this->addUsingAlias(LicenseTableMap::COL_SERVICE, $licenseService['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($licenseService['max'])) {
                $this->addUsingAlias(LicenseTableMap::COL_SERVICE, $licenseService['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(LicenseTableMap::COL_SERVICE, $licenseService, $comparison);
    }

    /**
     * Filter the query on the user column
     *
     * Example usage:
     * <code>
     * $query->filterByLicenseUser(1234); // WHERE user = 1234
     * $query->filterByLicenseUser(array(12, 34)); // WHERE user IN (12, 34)
     * $query->filterByLicenseUser(array('min' => 12)); // WHERE user > 12
     * </code>
     *
     * @see       filterByUser()
     *
     * @param     mixed $licenseUser The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildLicenseQuery The current query, for fluid interface
     */
    public function filterByLicenseUser($licenseUser = null, $comparison = null)
    {
        if (is_array($licenseUser)) {
            $useMinMax = false;
            if (isset($licenseUser['min'])) {
                $this->addUsingAlias(LicenseTableMap::COL_USER, $licenseUser['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($licenseUser['max'])) {
                $this->addUsingAlias(LicenseTableMap::COL_USER, $licenseUser['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(LicenseTableMap::COL_USER, $licenseUser, $comparison);
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
     * @return $this|ChildLicenseQuery The current query, for fluid interface
     */
    public function filterByCreatedAt($createdAt = null, $comparison = null)
    {
        if (is_array($createdAt)) {
            $useMinMax = false;
            if (isset($createdAt['min'])) {
                $this->addUsingAlias(LicenseTableMap::COL_CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(LicenseTableMap::COL_CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(LicenseTableMap::COL_CREATED_AT, $createdAt, $comparison);
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
     * @return $this|ChildLicenseQuery The current query, for fluid interface
     */
    public function filterByUpdatedAt($updatedAt = null, $comparison = null)
    {
        if (is_array($updatedAt)) {
            $useMinMax = false;
            if (isset($updatedAt['min'])) {
                $this->addUsingAlias(LicenseTableMap::COL_UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(LicenseTableMap::COL_UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(LicenseTableMap::COL_UPDATED_AT, $updatedAt, $comparison);
    }

    /**
     * Filter the query by a related \User object
     *
     * @param \User|ObjectCollection $user The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildLicenseQuery The current query, for fluid interface
     */
    public function filterByUser($user, $comparison = null)
    {
        if ($user instanceof \User) {
            return $this
                ->addUsingAlias(LicenseTableMap::COL_USER, $user->getUserid(), $comparison);
        } elseif ($user instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(LicenseTableMap::COL_USER, $user->toKeyValue('PrimaryKey', 'Userid'), $comparison);
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
     * @return $this|ChildLicenseQuery The current query, for fluid interface
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
     * Filter the query by a related \Service object
     *
     * @param \Service|ObjectCollection $service The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildLicenseQuery The current query, for fluid interface
     */
    public function filterByService($service, $comparison = null)
    {
        if ($service instanceof \Service) {
            return $this
                ->addUsingAlias(LicenseTableMap::COL_SERVICE, $service->getServiceid(), $comparison);
        } elseif ($service instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(LicenseTableMap::COL_SERVICE, $service->toKeyValue('PrimaryKey', 'Serviceid'), $comparison);
        } else {
            throw new PropelException('filterByService() only accepts arguments of type \Service or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Service relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildLicenseQuery The current query, for fluid interface
     */
    public function joinService($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Service');

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
            $this->addJoinObject($join, 'Service');
        }

        return $this;
    }

    /**
     * Use the Service relation Service object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \ServiceQuery A secondary query class using the current class as primary query
     */
    public function useServiceQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinService($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Service', '\ServiceQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildLicense $license Object to remove from the list of results
     *
     * @return $this|ChildLicenseQuery The current query, for fluid interface
     */
    public function prune($license = null)
    {
        if ($license) {
            $this->addUsingAlias(LicenseTableMap::COL_LICENSEID, $license->getLicenseid(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the license table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(LicenseTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            LicenseTableMap::clearInstancePool();
            LicenseTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(LicenseTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(LicenseTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            LicenseTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            LicenseTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

    // timestampable behavior

    /**
     * Filter by the latest updated
     *
     * @param      int $nbDays Maximum age of the latest update in days
     *
     * @return     $this|ChildLicenseQuery The current query, for fluid interface
     */
    public function recentlyUpdated($nbDays = 7)
    {
        return $this->addUsingAlias(LicenseTableMap::COL_UPDATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);
    }

    /**
     * Order by update date desc
     *
     * @return     $this|ChildLicenseQuery The current query, for fluid interface
     */
    public function lastUpdatedFirst()
    {
        return $this->addDescendingOrderByColumn(LicenseTableMap::COL_UPDATED_AT);
    }

    /**
     * Order by update date asc
     *
     * @return     $this|ChildLicenseQuery The current query, for fluid interface
     */
    public function firstUpdatedFirst()
    {
        return $this->addAscendingOrderByColumn(LicenseTableMap::COL_UPDATED_AT);
    }

    /**
     * Order by create date desc
     *
     * @return     $this|ChildLicenseQuery The current query, for fluid interface
     */
    public function lastCreatedFirst()
    {
        return $this->addDescendingOrderByColumn(LicenseTableMap::COL_CREATED_AT);
    }

    /**
     * Filter by the latest created
     *
     * @param      int $nbDays Maximum age of in days
     *
     * @return     $this|ChildLicenseQuery The current query, for fluid interface
     */
    public function recentlyCreated($nbDays = 7)
    {
        return $this->addUsingAlias(LicenseTableMap::COL_CREATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);
    }

    /**
     * Order by create date asc
     *
     * @return     $this|ChildLicenseQuery The current query, for fluid interface
     */
    public function firstCreatedFirst()
    {
        return $this->addAscendingOrderByColumn(LicenseTableMap::COL_CREATED_AT);
    }

} // LicenseQuery
