<?php

namespace Base;

use \Service as ChildService;
use \ServiceQuery as ChildServiceQuery;
use \Exception;
use \PDO;
use Map\ServiceTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'service' table.
 *
 *
 *
 * @method     ChildServiceQuery orderByServiceid($order = Criteria::ASC) Order by the serviceId column
 * @method     ChildServiceQuery orderByDescription($order = Criteria::ASC) Order by the description column
 *
 * @method     ChildServiceQuery groupByServiceid() Group by the serviceId column
 * @method     ChildServiceQuery groupByDescription() Group by the description column
 *
 * @method     ChildServiceQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildServiceQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildServiceQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildServiceQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildServiceQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildServiceQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildServiceQuery leftJoinLicense($relationAlias = null) Adds a LEFT JOIN clause to the query using the License relation
 * @method     ChildServiceQuery rightJoinLicense($relationAlias = null) Adds a RIGHT JOIN clause to the query using the License relation
 * @method     ChildServiceQuery innerJoinLicense($relationAlias = null) Adds a INNER JOIN clause to the query using the License relation
 *
 * @method     ChildServiceQuery joinWithLicense($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the License relation
 *
 * @method     ChildServiceQuery leftJoinWithLicense() Adds a LEFT JOIN clause and with to the query using the License relation
 * @method     ChildServiceQuery rightJoinWithLicense() Adds a RIGHT JOIN clause and with to the query using the License relation
 * @method     ChildServiceQuery innerJoinWithLicense() Adds a INNER JOIN clause and with to the query using the License relation
 *
 * @method     \LicenseQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildService findOne(ConnectionInterface $con = null) Return the first ChildService matching the query
 * @method     ChildService findOneOrCreate(ConnectionInterface $con = null) Return the first ChildService matching the query, or a new ChildService object populated from the query conditions when no match is found
 *
 * @method     ChildService findOneByServiceid(int $serviceId) Return the first ChildService filtered by the serviceId column
 * @method     ChildService findOneByDescription(string $description) Return the first ChildService filtered by the description column *

 * @method     ChildService requirePk($key, ConnectionInterface $con = null) Return the ChildService by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildService requireOne(ConnectionInterface $con = null) Return the first ChildService matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildService requireOneByServiceid(int $serviceId) Return the first ChildService filtered by the serviceId column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildService requireOneByDescription(string $description) Return the first ChildService filtered by the description column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildService[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildService objects based on current ModelCriteria
 * @method     ChildService[]|ObjectCollection findByServiceid(int $serviceId) Return ChildService objects filtered by the serviceId column
 * @method     ChildService[]|ObjectCollection findByDescription(string $description) Return ChildService objects filtered by the description column
 * @method     ChildService[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class ServiceQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\ServiceQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\Service', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildServiceQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildServiceQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildServiceQuery) {
            return $criteria;
        }
        $query = new ChildServiceQuery();
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
     * @return ChildService|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = ServiceTableMap::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(ServiceTableMap::DATABASE_NAME);
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
     * @return ChildService A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT serviceId, description FROM service WHERE serviceId = :p0';
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
            /** @var ChildService $obj */
            $obj = new ChildService();
            $obj->hydrate($row);
            ServiceTableMap::addInstanceToPool($obj, (string) $key);
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
     * @return ChildService|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildServiceQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(ServiceTableMap::COL_SERVICEID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildServiceQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(ServiceTableMap::COL_SERVICEID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the serviceId column
     *
     * Example usage:
     * <code>
     * $query->filterByServiceid(1234); // WHERE serviceId = 1234
     * $query->filterByServiceid(array(12, 34)); // WHERE serviceId IN (12, 34)
     * $query->filterByServiceid(array('min' => 12)); // WHERE serviceId > 12
     * </code>
     *
     * @param     mixed $serviceid The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildServiceQuery The current query, for fluid interface
     */
    public function filterByServiceid($serviceid = null, $comparison = null)
    {
        if (is_array($serviceid)) {
            $useMinMax = false;
            if (isset($serviceid['min'])) {
                $this->addUsingAlias(ServiceTableMap::COL_SERVICEID, $serviceid['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($serviceid['max'])) {
                $this->addUsingAlias(ServiceTableMap::COL_SERVICEID, $serviceid['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ServiceTableMap::COL_SERVICEID, $serviceid, $comparison);
    }

    /**
     * Filter the query on the description column
     *
     * Example usage:
     * <code>
     * $query->filterByDescription('fooValue');   // WHERE description = 'fooValue'
     * $query->filterByDescription('%fooValue%'); // WHERE description LIKE '%fooValue%'
     * </code>
     *
     * @param     string $description The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildServiceQuery The current query, for fluid interface
     */
    public function filterByDescription($description = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($description)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $description)) {
                $description = str_replace('*', '%', $description);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ServiceTableMap::COL_DESCRIPTION, $description, $comparison);
    }

    /**
     * Filter the query by a related \License object
     *
     * @param \License|ObjectCollection $license the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildServiceQuery The current query, for fluid interface
     */
    public function filterByLicense($license, $comparison = null)
    {
        if ($license instanceof \License) {
            return $this
                ->addUsingAlias(ServiceTableMap::COL_SERVICEID, $license->getLicenseService(), $comparison);
        } elseif ($license instanceof ObjectCollection) {
            return $this
                ->useLicenseQuery()
                ->filterByPrimaryKeys($license->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByLicense() only accepts arguments of type \License or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the License relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildServiceQuery The current query, for fluid interface
     */
    public function joinLicense($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('License');

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
            $this->addJoinObject($join, 'License');
        }

        return $this;
    }

    /**
     * Use the License relation License object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \LicenseQuery A secondary query class using the current class as primary query
     */
    public function useLicenseQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinLicense($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'License', '\LicenseQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildService $service Object to remove from the list of results
     *
     * @return $this|ChildServiceQuery The current query, for fluid interface
     */
    public function prune($service = null)
    {
        if ($service) {
            $this->addUsingAlias(ServiceTableMap::COL_SERVICEID, $service->getServiceid(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the service table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ServiceTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            ServiceTableMap::clearInstancePool();
            ServiceTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(ServiceTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(ServiceTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            ServiceTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            ServiceTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // ServiceQuery
