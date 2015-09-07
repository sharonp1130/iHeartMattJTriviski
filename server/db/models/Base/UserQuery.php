<?php

namespace Base;

use \User as ChildUser;
use \UserQuery as ChildUserQuery;
use \Exception;
use \PDO;
use Map\UserTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'user' table.
 *
 *
 *
 * @method     ChildUserQuery orderByUserid($order = Criteria::ASC) Order by the userId column
 * @method     ChildUserQuery orderByEmail($order = Criteria::ASC) Order by the email column
 * @method     ChildUserQuery orderByIsprovider($order = Criteria::ASC) Order by the isProvider column
 * @method     ChildUserQuery orderByFirstname($order = Criteria::ASC) Order by the firstName column
 * @method     ChildUserQuery orderByLastname($order = Criteria::ASC) Order by the lastName column
 * @method     ChildUserQuery orderBySuffix($order = Criteria::ASC) Order by the suffix column
 * @method     ChildUserQuery orderByAddress($order = Criteria::ASC) Order by the address column
 * @method     ChildUserQuery orderByCity($order = Criteria::ASC) Order by the city column
 * @method     ChildUserQuery orderByZipcode($order = Criteria::ASC) Order by the zipcode column
 * @method     ChildUserQuery orderByPhonenumber($order = Criteria::ASC) Order by the phoneNumber column
 * @method     ChildUserQuery orderByPhoneok($order = Criteria::ASC) Order by the phoneOk column
 * @method     ChildUserQuery orderByTextok($order = Criteria::ASC) Order by the textOk column
 * @method     ChildUserQuery orderByEmailok($order = Criteria::ASC) Order by the emailOk column
 * @method     ChildUserQuery orderByMondaystart($order = Criteria::ASC) Order by the mondayStart column
 * @method     ChildUserQuery orderByMondayend($order = Criteria::ASC) Order by the mondayEnd column
 * @method     ChildUserQuery orderByTuesdaystart($order = Criteria::ASC) Order by the tuesdayStart column
 * @method     ChildUserQuery orderByTuesdayend($order = Criteria::ASC) Order by the tuesdayEnd column
 * @method     ChildUserQuery orderByWednesdaystart($order = Criteria::ASC) Order by the wednesdayStart column
 * @method     ChildUserQuery orderByWednesdayend($order = Criteria::ASC) Order by the wednesdayEnd column
 * @method     ChildUserQuery orderByThursdaystart($order = Criteria::ASC) Order by the thursdayStart column
 * @method     ChildUserQuery orderByThursdayend($order = Criteria::ASC) Order by the thursdayEnd column
 * @method     ChildUserQuery orderByFridaystart($order = Criteria::ASC) Order by the fridayStart column
 * @method     ChildUserQuery orderByFridayend($order = Criteria::ASC) Order by the fridayEnd column
 * @method     ChildUserQuery orderBySaturdaystart($order = Criteria::ASC) Order by the saturdayStart column
 * @method     ChildUserQuery orderBySaturdayend($order = Criteria::ASC) Order by the saturdayEnd column
 * @method     ChildUserQuery orderBySundaystart($order = Criteria::ASC) Order by the sundayStart column
 * @method     ChildUserQuery orderBySundayend($order = Criteria::ASC) Order by the sundayEnd column
 * @method     ChildUserQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ChildUserQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 *
 * @method     ChildUserQuery groupByUserid() Group by the userId column
 * @method     ChildUserQuery groupByEmail() Group by the email column
 * @method     ChildUserQuery groupByIsprovider() Group by the isProvider column
 * @method     ChildUserQuery groupByFirstname() Group by the firstName column
 * @method     ChildUserQuery groupByLastname() Group by the lastName column
 * @method     ChildUserQuery groupBySuffix() Group by the suffix column
 * @method     ChildUserQuery groupByAddress() Group by the address column
 * @method     ChildUserQuery groupByCity() Group by the city column
 * @method     ChildUserQuery groupByZipcode() Group by the zipcode column
 * @method     ChildUserQuery groupByPhonenumber() Group by the phoneNumber column
 * @method     ChildUserQuery groupByPhoneok() Group by the phoneOk column
 * @method     ChildUserQuery groupByTextok() Group by the textOk column
 * @method     ChildUserQuery groupByEmailok() Group by the emailOk column
 * @method     ChildUserQuery groupByMondaystart() Group by the mondayStart column
 * @method     ChildUserQuery groupByMondayend() Group by the mondayEnd column
 * @method     ChildUserQuery groupByTuesdaystart() Group by the tuesdayStart column
 * @method     ChildUserQuery groupByTuesdayend() Group by the tuesdayEnd column
 * @method     ChildUserQuery groupByWednesdaystart() Group by the wednesdayStart column
 * @method     ChildUserQuery groupByWednesdayend() Group by the wednesdayEnd column
 * @method     ChildUserQuery groupByThursdaystart() Group by the thursdayStart column
 * @method     ChildUserQuery groupByThursdayend() Group by the thursdayEnd column
 * @method     ChildUserQuery groupByFridaystart() Group by the fridayStart column
 * @method     ChildUserQuery groupByFridayend() Group by the fridayEnd column
 * @method     ChildUserQuery groupBySaturdaystart() Group by the saturdayStart column
 * @method     ChildUserQuery groupBySaturdayend() Group by the saturdayEnd column
 * @method     ChildUserQuery groupBySundaystart() Group by the sundayStart column
 * @method     ChildUserQuery groupBySundayend() Group by the sundayEnd column
 * @method     ChildUserQuery groupByCreatedAt() Group by the created_at column
 * @method     ChildUserQuery groupByUpdatedAt() Group by the updated_at column
 *
 * @method     ChildUserQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildUserQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildUserQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildUserQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildUserQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildUserQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildUserQuery leftJoinLicense($relationAlias = null) Adds a LEFT JOIN clause to the query using the License relation
 * @method     ChildUserQuery rightJoinLicense($relationAlias = null) Adds a RIGHT JOIN clause to the query using the License relation
 * @method     ChildUserQuery innerJoinLicense($relationAlias = null) Adds a INNER JOIN clause to the query using the License relation
 *
 * @method     ChildUserQuery joinWithLicense($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the License relation
 *
 * @method     ChildUserQuery leftJoinWithLicense() Adds a LEFT JOIN clause and with to the query using the License relation
 * @method     ChildUserQuery rightJoinWithLicense() Adds a RIGHT JOIN clause and with to the query using the License relation
 * @method     ChildUserQuery innerJoinWithLicense() Adds a INNER JOIN clause and with to the query using the License relation
 *
 * @method     ChildUserQuery leftJoinLocation($relationAlias = null) Adds a LEFT JOIN clause to the query using the Location relation
 * @method     ChildUserQuery rightJoinLocation($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Location relation
 * @method     ChildUserQuery innerJoinLocation($relationAlias = null) Adds a INNER JOIN clause to the query using the Location relation
 *
 * @method     ChildUserQuery joinWithLocation($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Location relation
 *
 * @method     ChildUserQuery leftJoinWithLocation() Adds a LEFT JOIN clause and with to the query using the Location relation
 * @method     ChildUserQuery rightJoinWithLocation() Adds a RIGHT JOIN clause and with to the query using the Location relation
 * @method     ChildUserQuery innerJoinWithLocation() Adds a INNER JOIN clause and with to the query using the Location relation
 *
 * @method     \LicenseQuery|\LocationQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildUser findOne(ConnectionInterface $con = null) Return the first ChildUser matching the query
 * @method     ChildUser findOneOrCreate(ConnectionInterface $con = null) Return the first ChildUser matching the query, or a new ChildUser object populated from the query conditions when no match is found
 *
 * @method     ChildUser findOneByUserid(int $userId) Return the first ChildUser filtered by the userId column
 * @method     ChildUser findOneByEmail(string $email) Return the first ChildUser filtered by the email column
 * @method     ChildUser findOneByIsprovider(boolean $isProvider) Return the first ChildUser filtered by the isProvider column
 * @method     ChildUser findOneByFirstname(string $firstName) Return the first ChildUser filtered by the firstName column
 * @method     ChildUser findOneByLastname(string $lastName) Return the first ChildUser filtered by the lastName column
 * @method     ChildUser findOneBySuffix(string $suffix) Return the first ChildUser filtered by the suffix column
 * @method     ChildUser findOneByAddress(string $address) Return the first ChildUser filtered by the address column
 * @method     ChildUser findOneByCity(string $city) Return the first ChildUser filtered by the city column
 * @method     ChildUser findOneByZipcode(string $zipcode) Return the first ChildUser filtered by the zipcode column
 * @method     ChildUser findOneByPhonenumber(string $phoneNumber) Return the first ChildUser filtered by the phoneNumber column
 * @method     ChildUser findOneByPhoneok(boolean $phoneOk) Return the first ChildUser filtered by the phoneOk column
 * @method     ChildUser findOneByTextok(boolean $textOk) Return the first ChildUser filtered by the textOk column
 * @method     ChildUser findOneByEmailok(boolean $emailOk) Return the first ChildUser filtered by the emailOk column
 * @method     ChildUser findOneByMondaystart(string $mondayStart) Return the first ChildUser filtered by the mondayStart column
 * @method     ChildUser findOneByMondayend(string $mondayEnd) Return the first ChildUser filtered by the mondayEnd column
 * @method     ChildUser findOneByTuesdaystart(string $tuesdayStart) Return the first ChildUser filtered by the tuesdayStart column
 * @method     ChildUser findOneByTuesdayend(string $tuesdayEnd) Return the first ChildUser filtered by the tuesdayEnd column
 * @method     ChildUser findOneByWednesdaystart(string $wednesdayStart) Return the first ChildUser filtered by the wednesdayStart column
 * @method     ChildUser findOneByWednesdayend(string $wednesdayEnd) Return the first ChildUser filtered by the wednesdayEnd column
 * @method     ChildUser findOneByThursdaystart(string $thursdayStart) Return the first ChildUser filtered by the thursdayStart column
 * @method     ChildUser findOneByThursdayend(string $thursdayEnd) Return the first ChildUser filtered by the thursdayEnd column
 * @method     ChildUser findOneByFridaystart(string $fridayStart) Return the first ChildUser filtered by the fridayStart column
 * @method     ChildUser findOneByFridayend(string $fridayEnd) Return the first ChildUser filtered by the fridayEnd column
 * @method     ChildUser findOneBySaturdaystart(string $saturdayStart) Return the first ChildUser filtered by the saturdayStart column
 * @method     ChildUser findOneBySaturdayend(string $saturdayEnd) Return the first ChildUser filtered by the saturdayEnd column
 * @method     ChildUser findOneBySundaystart(string $sundayStart) Return the first ChildUser filtered by the sundayStart column
 * @method     ChildUser findOneBySundayend(string $sundayEnd) Return the first ChildUser filtered by the sundayEnd column
 * @method     ChildUser findOneByCreatedAt(string $created_at) Return the first ChildUser filtered by the created_at column
 * @method     ChildUser findOneByUpdatedAt(string $updated_at) Return the first ChildUser filtered by the updated_at column *

 * @method     ChildUser requirePk($key, ConnectionInterface $con = null) Return the ChildUser by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUser requireOne(ConnectionInterface $con = null) Return the first ChildUser matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildUser requireOneByUserid(int $userId) Return the first ChildUser filtered by the userId column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUser requireOneByEmail(string $email) Return the first ChildUser filtered by the email column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUser requireOneByIsprovider(boolean $isProvider) Return the first ChildUser filtered by the isProvider column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUser requireOneByFirstname(string $firstName) Return the first ChildUser filtered by the firstName column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUser requireOneByLastname(string $lastName) Return the first ChildUser filtered by the lastName column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUser requireOneBySuffix(string $suffix) Return the first ChildUser filtered by the suffix column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUser requireOneByAddress(string $address) Return the first ChildUser filtered by the address column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUser requireOneByCity(string $city) Return the first ChildUser filtered by the city column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUser requireOneByZipcode(string $zipcode) Return the first ChildUser filtered by the zipcode column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUser requireOneByPhonenumber(string $phoneNumber) Return the first ChildUser filtered by the phoneNumber column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUser requireOneByPhoneok(boolean $phoneOk) Return the first ChildUser filtered by the phoneOk column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUser requireOneByTextok(boolean $textOk) Return the first ChildUser filtered by the textOk column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUser requireOneByEmailok(boolean $emailOk) Return the first ChildUser filtered by the emailOk column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUser requireOneByMondaystart(string $mondayStart) Return the first ChildUser filtered by the mondayStart column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUser requireOneByMondayend(string $mondayEnd) Return the first ChildUser filtered by the mondayEnd column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUser requireOneByTuesdaystart(string $tuesdayStart) Return the first ChildUser filtered by the tuesdayStart column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUser requireOneByTuesdayend(string $tuesdayEnd) Return the first ChildUser filtered by the tuesdayEnd column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUser requireOneByWednesdaystart(string $wednesdayStart) Return the first ChildUser filtered by the wednesdayStart column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUser requireOneByWednesdayend(string $wednesdayEnd) Return the first ChildUser filtered by the wednesdayEnd column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUser requireOneByThursdaystart(string $thursdayStart) Return the first ChildUser filtered by the thursdayStart column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUser requireOneByThursdayend(string $thursdayEnd) Return the first ChildUser filtered by the thursdayEnd column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUser requireOneByFridaystart(string $fridayStart) Return the first ChildUser filtered by the fridayStart column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUser requireOneByFridayend(string $fridayEnd) Return the first ChildUser filtered by the fridayEnd column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUser requireOneBySaturdaystart(string $saturdayStart) Return the first ChildUser filtered by the saturdayStart column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUser requireOneBySaturdayend(string $saturdayEnd) Return the first ChildUser filtered by the saturdayEnd column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUser requireOneBySundaystart(string $sundayStart) Return the first ChildUser filtered by the sundayStart column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUser requireOneBySundayend(string $sundayEnd) Return the first ChildUser filtered by the sundayEnd column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUser requireOneByCreatedAt(string $created_at) Return the first ChildUser filtered by the created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUser requireOneByUpdatedAt(string $updated_at) Return the first ChildUser filtered by the updated_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildUser[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildUser objects based on current ModelCriteria
 * @method     ChildUser[]|ObjectCollection findByUserid(int $userId) Return ChildUser objects filtered by the userId column
 * @method     ChildUser[]|ObjectCollection findByEmail(string $email) Return ChildUser objects filtered by the email column
 * @method     ChildUser[]|ObjectCollection findByIsprovider(boolean $isProvider) Return ChildUser objects filtered by the isProvider column
 * @method     ChildUser[]|ObjectCollection findByFirstname(string $firstName) Return ChildUser objects filtered by the firstName column
 * @method     ChildUser[]|ObjectCollection findByLastname(string $lastName) Return ChildUser objects filtered by the lastName column
 * @method     ChildUser[]|ObjectCollection findBySuffix(string $suffix) Return ChildUser objects filtered by the suffix column
 * @method     ChildUser[]|ObjectCollection findByAddress(string $address) Return ChildUser objects filtered by the address column
 * @method     ChildUser[]|ObjectCollection findByCity(string $city) Return ChildUser objects filtered by the city column
 * @method     ChildUser[]|ObjectCollection findByZipcode(string $zipcode) Return ChildUser objects filtered by the zipcode column
 * @method     ChildUser[]|ObjectCollection findByPhonenumber(string $phoneNumber) Return ChildUser objects filtered by the phoneNumber column
 * @method     ChildUser[]|ObjectCollection findByPhoneok(boolean $phoneOk) Return ChildUser objects filtered by the phoneOk column
 * @method     ChildUser[]|ObjectCollection findByTextok(boolean $textOk) Return ChildUser objects filtered by the textOk column
 * @method     ChildUser[]|ObjectCollection findByEmailok(boolean $emailOk) Return ChildUser objects filtered by the emailOk column
 * @method     ChildUser[]|ObjectCollection findByMondaystart(string $mondayStart) Return ChildUser objects filtered by the mondayStart column
 * @method     ChildUser[]|ObjectCollection findByMondayend(string $mondayEnd) Return ChildUser objects filtered by the mondayEnd column
 * @method     ChildUser[]|ObjectCollection findByTuesdaystart(string $tuesdayStart) Return ChildUser objects filtered by the tuesdayStart column
 * @method     ChildUser[]|ObjectCollection findByTuesdayend(string $tuesdayEnd) Return ChildUser objects filtered by the tuesdayEnd column
 * @method     ChildUser[]|ObjectCollection findByWednesdaystart(string $wednesdayStart) Return ChildUser objects filtered by the wednesdayStart column
 * @method     ChildUser[]|ObjectCollection findByWednesdayend(string $wednesdayEnd) Return ChildUser objects filtered by the wednesdayEnd column
 * @method     ChildUser[]|ObjectCollection findByThursdaystart(string $thursdayStart) Return ChildUser objects filtered by the thursdayStart column
 * @method     ChildUser[]|ObjectCollection findByThursdayend(string $thursdayEnd) Return ChildUser objects filtered by the thursdayEnd column
 * @method     ChildUser[]|ObjectCollection findByFridaystart(string $fridayStart) Return ChildUser objects filtered by the fridayStart column
 * @method     ChildUser[]|ObjectCollection findByFridayend(string $fridayEnd) Return ChildUser objects filtered by the fridayEnd column
 * @method     ChildUser[]|ObjectCollection findBySaturdaystart(string $saturdayStart) Return ChildUser objects filtered by the saturdayStart column
 * @method     ChildUser[]|ObjectCollection findBySaturdayend(string $saturdayEnd) Return ChildUser objects filtered by the saturdayEnd column
 * @method     ChildUser[]|ObjectCollection findBySundaystart(string $sundayStart) Return ChildUser objects filtered by the sundayStart column
 * @method     ChildUser[]|ObjectCollection findBySundayend(string $sundayEnd) Return ChildUser objects filtered by the sundayEnd column
 * @method     ChildUser[]|ObjectCollection findByCreatedAt(string $created_at) Return ChildUser objects filtered by the created_at column
 * @method     ChildUser[]|ObjectCollection findByUpdatedAt(string $updated_at) Return ChildUser objects filtered by the updated_at column
 * @method     ChildUser[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class UserQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\UserQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\User', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildUserQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildUserQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildUserQuery) {
            return $criteria;
        }
        $query = new ChildUserQuery();
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
     * @return ChildUser|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = UserTableMap::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(UserTableMap::DATABASE_NAME);
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
     * @return ChildUser A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT userId, email, isProvider, firstName, lastName, suffix, address, city, zipcode, phoneNumber, phoneOk, textOk, emailOk, mondayStart, mondayEnd, tuesdayStart, tuesdayEnd, wednesdayStart, wednesdayEnd, thursdayStart, thursdayEnd, fridayStart, fridayEnd, saturdayStart, saturdayEnd, sundayStart, sundayEnd, created_at, updated_at FROM user WHERE userId = :p0';
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
            /** @var ChildUser $obj */
            $obj = new ChildUser();
            $obj->hydrate($row);
            UserTableMap::addInstanceToPool($obj, (string) $key);
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
     * @return ChildUser|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildUserQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(UserTableMap::COL_USERID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildUserQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(UserTableMap::COL_USERID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the userId column
     *
     * Example usage:
     * <code>
     * $query->filterByUserid(1234); // WHERE userId = 1234
     * $query->filterByUserid(array(12, 34)); // WHERE userId IN (12, 34)
     * $query->filterByUserid(array('min' => 12)); // WHERE userId > 12
     * </code>
     *
     * @param     mixed $userid The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUserQuery The current query, for fluid interface
     */
    public function filterByUserid($userid = null, $comparison = null)
    {
        if (is_array($userid)) {
            $useMinMax = false;
            if (isset($userid['min'])) {
                $this->addUsingAlias(UserTableMap::COL_USERID, $userid['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($userid['max'])) {
                $this->addUsingAlias(UserTableMap::COL_USERID, $userid['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UserTableMap::COL_USERID, $userid, $comparison);
    }

    /**
     * Filter the query on the email column
     *
     * Example usage:
     * <code>
     * $query->filterByEmail('fooValue');   // WHERE email = 'fooValue'
     * $query->filterByEmail('%fooValue%'); // WHERE email LIKE '%fooValue%'
     * </code>
     *
     * @param     string $email The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUserQuery The current query, for fluid interface
     */
    public function filterByEmail($email = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($email)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $email)) {
                $email = str_replace('*', '%', $email);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(UserTableMap::COL_EMAIL, $email, $comparison);
    }

    /**
     * Filter the query on the isProvider column
     *
     * Example usage:
     * <code>
     * $query->filterByIsprovider(true); // WHERE isProvider = true
     * $query->filterByIsprovider('yes'); // WHERE isProvider = true
     * </code>
     *
     * @param     boolean|string $isprovider The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUserQuery The current query, for fluid interface
     */
    public function filterByIsprovider($isprovider = null, $comparison = null)
    {
        if (is_string($isprovider)) {
            $isprovider = in_array(strtolower($isprovider), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(UserTableMap::COL_ISPROVIDER, $isprovider, $comparison);
    }

    /**
     * Filter the query on the firstName column
     *
     * Example usage:
     * <code>
     * $query->filterByFirstname('fooValue');   // WHERE firstName = 'fooValue'
     * $query->filterByFirstname('%fooValue%'); // WHERE firstName LIKE '%fooValue%'
     * </code>
     *
     * @param     string $firstname The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUserQuery The current query, for fluid interface
     */
    public function filterByFirstname($firstname = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($firstname)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $firstname)) {
                $firstname = str_replace('*', '%', $firstname);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(UserTableMap::COL_FIRSTNAME, $firstname, $comparison);
    }

    /**
     * Filter the query on the lastName column
     *
     * Example usage:
     * <code>
     * $query->filterByLastname('fooValue');   // WHERE lastName = 'fooValue'
     * $query->filterByLastname('%fooValue%'); // WHERE lastName LIKE '%fooValue%'
     * </code>
     *
     * @param     string $lastname The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUserQuery The current query, for fluid interface
     */
    public function filterByLastname($lastname = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($lastname)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $lastname)) {
                $lastname = str_replace('*', '%', $lastname);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(UserTableMap::COL_LASTNAME, $lastname, $comparison);
    }

    /**
     * Filter the query on the suffix column
     *
     * Example usage:
     * <code>
     * $query->filterBySuffix('fooValue');   // WHERE suffix = 'fooValue'
     * $query->filterBySuffix('%fooValue%'); // WHERE suffix LIKE '%fooValue%'
     * </code>
     *
     * @param     string $suffix The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUserQuery The current query, for fluid interface
     */
    public function filterBySuffix($suffix = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($suffix)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $suffix)) {
                $suffix = str_replace('*', '%', $suffix);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(UserTableMap::COL_SUFFIX, $suffix, $comparison);
    }

    /**
     * Filter the query on the address column
     *
     * Example usage:
     * <code>
     * $query->filterByAddress('fooValue');   // WHERE address = 'fooValue'
     * $query->filterByAddress('%fooValue%'); // WHERE address LIKE '%fooValue%'
     * </code>
     *
     * @param     string $address The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUserQuery The current query, for fluid interface
     */
    public function filterByAddress($address = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($address)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $address)) {
                $address = str_replace('*', '%', $address);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(UserTableMap::COL_ADDRESS, $address, $comparison);
    }

    /**
     * Filter the query on the city column
     *
     * Example usage:
     * <code>
     * $query->filterByCity('fooValue');   // WHERE city = 'fooValue'
     * $query->filterByCity('%fooValue%'); // WHERE city LIKE '%fooValue%'
     * </code>
     *
     * @param     string $city The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUserQuery The current query, for fluid interface
     */
    public function filterByCity($city = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($city)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $city)) {
                $city = str_replace('*', '%', $city);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(UserTableMap::COL_CITY, $city, $comparison);
    }

    /**
     * Filter the query on the zipcode column
     *
     * Example usage:
     * <code>
     * $query->filterByZipcode('fooValue');   // WHERE zipcode = 'fooValue'
     * $query->filterByZipcode('%fooValue%'); // WHERE zipcode LIKE '%fooValue%'
     * </code>
     *
     * @param     string $zipcode The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUserQuery The current query, for fluid interface
     */
    public function filterByZipcode($zipcode = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($zipcode)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $zipcode)) {
                $zipcode = str_replace('*', '%', $zipcode);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(UserTableMap::COL_ZIPCODE, $zipcode, $comparison);
    }

    /**
     * Filter the query on the phoneNumber column
     *
     * Example usage:
     * <code>
     * $query->filterByPhonenumber('fooValue');   // WHERE phoneNumber = 'fooValue'
     * $query->filterByPhonenumber('%fooValue%'); // WHERE phoneNumber LIKE '%fooValue%'
     * </code>
     *
     * @param     string $phonenumber The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUserQuery The current query, for fluid interface
     */
    public function filterByPhonenumber($phonenumber = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($phonenumber)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $phonenumber)) {
                $phonenumber = str_replace('*', '%', $phonenumber);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(UserTableMap::COL_PHONENUMBER, $phonenumber, $comparison);
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
     * @return $this|ChildUserQuery The current query, for fluid interface
     */
    public function filterByPhoneok($phoneok = null, $comparison = null)
    {
        if (is_string($phoneok)) {
            $phoneok = in_array(strtolower($phoneok), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(UserTableMap::COL_PHONEOK, $phoneok, $comparison);
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
     * @return $this|ChildUserQuery The current query, for fluid interface
     */
    public function filterByTextok($textok = null, $comparison = null)
    {
        if (is_string($textok)) {
            $textok = in_array(strtolower($textok), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(UserTableMap::COL_TEXTOK, $textok, $comparison);
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
     * @return $this|ChildUserQuery The current query, for fluid interface
     */
    public function filterByEmailok($emailok = null, $comparison = null)
    {
        if (is_string($emailok)) {
            $emailok = in_array(strtolower($emailok), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(UserTableMap::COL_EMAILOK, $emailok, $comparison);
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
     * @return $this|ChildUserQuery The current query, for fluid interface
     */
    public function filterByMondaystart($mondaystart = null, $comparison = null)
    {
        if (is_array($mondaystart)) {
            $useMinMax = false;
            if (isset($mondaystart['min'])) {
                $this->addUsingAlias(UserTableMap::COL_MONDAYSTART, $mondaystart['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($mondaystart['max'])) {
                $this->addUsingAlias(UserTableMap::COL_MONDAYSTART, $mondaystart['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UserTableMap::COL_MONDAYSTART, $mondaystart, $comparison);
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
     * @return $this|ChildUserQuery The current query, for fluid interface
     */
    public function filterByMondayend($mondayend = null, $comparison = null)
    {
        if (is_array($mondayend)) {
            $useMinMax = false;
            if (isset($mondayend['min'])) {
                $this->addUsingAlias(UserTableMap::COL_MONDAYEND, $mondayend['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($mondayend['max'])) {
                $this->addUsingAlias(UserTableMap::COL_MONDAYEND, $mondayend['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UserTableMap::COL_MONDAYEND, $mondayend, $comparison);
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
     * @return $this|ChildUserQuery The current query, for fluid interface
     */
    public function filterByTuesdaystart($tuesdaystart = null, $comparison = null)
    {
        if (is_array($tuesdaystart)) {
            $useMinMax = false;
            if (isset($tuesdaystart['min'])) {
                $this->addUsingAlias(UserTableMap::COL_TUESDAYSTART, $tuesdaystart['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($tuesdaystart['max'])) {
                $this->addUsingAlias(UserTableMap::COL_TUESDAYSTART, $tuesdaystart['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UserTableMap::COL_TUESDAYSTART, $tuesdaystart, $comparison);
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
     * @return $this|ChildUserQuery The current query, for fluid interface
     */
    public function filterByTuesdayend($tuesdayend = null, $comparison = null)
    {
        if (is_array($tuesdayend)) {
            $useMinMax = false;
            if (isset($tuesdayend['min'])) {
                $this->addUsingAlias(UserTableMap::COL_TUESDAYEND, $tuesdayend['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($tuesdayend['max'])) {
                $this->addUsingAlias(UserTableMap::COL_TUESDAYEND, $tuesdayend['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UserTableMap::COL_TUESDAYEND, $tuesdayend, $comparison);
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
     * @return $this|ChildUserQuery The current query, for fluid interface
     */
    public function filterByWednesdaystart($wednesdaystart = null, $comparison = null)
    {
        if (is_array($wednesdaystart)) {
            $useMinMax = false;
            if (isset($wednesdaystart['min'])) {
                $this->addUsingAlias(UserTableMap::COL_WEDNESDAYSTART, $wednesdaystart['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($wednesdaystart['max'])) {
                $this->addUsingAlias(UserTableMap::COL_WEDNESDAYSTART, $wednesdaystart['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UserTableMap::COL_WEDNESDAYSTART, $wednesdaystart, $comparison);
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
     * @return $this|ChildUserQuery The current query, for fluid interface
     */
    public function filterByWednesdayend($wednesdayend = null, $comparison = null)
    {
        if (is_array($wednesdayend)) {
            $useMinMax = false;
            if (isset($wednesdayend['min'])) {
                $this->addUsingAlias(UserTableMap::COL_WEDNESDAYEND, $wednesdayend['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($wednesdayend['max'])) {
                $this->addUsingAlias(UserTableMap::COL_WEDNESDAYEND, $wednesdayend['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UserTableMap::COL_WEDNESDAYEND, $wednesdayend, $comparison);
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
     * @return $this|ChildUserQuery The current query, for fluid interface
     */
    public function filterByThursdaystart($thursdaystart = null, $comparison = null)
    {
        if (is_array($thursdaystart)) {
            $useMinMax = false;
            if (isset($thursdaystart['min'])) {
                $this->addUsingAlias(UserTableMap::COL_THURSDAYSTART, $thursdaystart['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($thursdaystart['max'])) {
                $this->addUsingAlias(UserTableMap::COL_THURSDAYSTART, $thursdaystart['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UserTableMap::COL_THURSDAYSTART, $thursdaystart, $comparison);
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
     * @return $this|ChildUserQuery The current query, for fluid interface
     */
    public function filterByThursdayend($thursdayend = null, $comparison = null)
    {
        if (is_array($thursdayend)) {
            $useMinMax = false;
            if (isset($thursdayend['min'])) {
                $this->addUsingAlias(UserTableMap::COL_THURSDAYEND, $thursdayend['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($thursdayend['max'])) {
                $this->addUsingAlias(UserTableMap::COL_THURSDAYEND, $thursdayend['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UserTableMap::COL_THURSDAYEND, $thursdayend, $comparison);
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
     * @return $this|ChildUserQuery The current query, for fluid interface
     */
    public function filterByFridaystart($fridaystart = null, $comparison = null)
    {
        if (is_array($fridaystart)) {
            $useMinMax = false;
            if (isset($fridaystart['min'])) {
                $this->addUsingAlias(UserTableMap::COL_FRIDAYSTART, $fridaystart['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($fridaystart['max'])) {
                $this->addUsingAlias(UserTableMap::COL_FRIDAYSTART, $fridaystart['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UserTableMap::COL_FRIDAYSTART, $fridaystart, $comparison);
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
     * @return $this|ChildUserQuery The current query, for fluid interface
     */
    public function filterByFridayend($fridayend = null, $comparison = null)
    {
        if (is_array($fridayend)) {
            $useMinMax = false;
            if (isset($fridayend['min'])) {
                $this->addUsingAlias(UserTableMap::COL_FRIDAYEND, $fridayend['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($fridayend['max'])) {
                $this->addUsingAlias(UserTableMap::COL_FRIDAYEND, $fridayend['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UserTableMap::COL_FRIDAYEND, $fridayend, $comparison);
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
     * @return $this|ChildUserQuery The current query, for fluid interface
     */
    public function filterBySaturdaystart($saturdaystart = null, $comparison = null)
    {
        if (is_array($saturdaystart)) {
            $useMinMax = false;
            if (isset($saturdaystart['min'])) {
                $this->addUsingAlias(UserTableMap::COL_SATURDAYSTART, $saturdaystart['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($saturdaystart['max'])) {
                $this->addUsingAlias(UserTableMap::COL_SATURDAYSTART, $saturdaystart['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UserTableMap::COL_SATURDAYSTART, $saturdaystart, $comparison);
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
     * @return $this|ChildUserQuery The current query, for fluid interface
     */
    public function filterBySaturdayend($saturdayend = null, $comparison = null)
    {
        if (is_array($saturdayend)) {
            $useMinMax = false;
            if (isset($saturdayend['min'])) {
                $this->addUsingAlias(UserTableMap::COL_SATURDAYEND, $saturdayend['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($saturdayend['max'])) {
                $this->addUsingAlias(UserTableMap::COL_SATURDAYEND, $saturdayend['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UserTableMap::COL_SATURDAYEND, $saturdayend, $comparison);
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
     * @return $this|ChildUserQuery The current query, for fluid interface
     */
    public function filterBySundaystart($sundaystart = null, $comparison = null)
    {
        if (is_array($sundaystart)) {
            $useMinMax = false;
            if (isset($sundaystart['min'])) {
                $this->addUsingAlias(UserTableMap::COL_SUNDAYSTART, $sundaystart['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($sundaystart['max'])) {
                $this->addUsingAlias(UserTableMap::COL_SUNDAYSTART, $sundaystart['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UserTableMap::COL_SUNDAYSTART, $sundaystart, $comparison);
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
     * @return $this|ChildUserQuery The current query, for fluid interface
     */
    public function filterBySundayend($sundayend = null, $comparison = null)
    {
        if (is_array($sundayend)) {
            $useMinMax = false;
            if (isset($sundayend['min'])) {
                $this->addUsingAlias(UserTableMap::COL_SUNDAYEND, $sundayend['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($sundayend['max'])) {
                $this->addUsingAlias(UserTableMap::COL_SUNDAYEND, $sundayend['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UserTableMap::COL_SUNDAYEND, $sundayend, $comparison);
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
     * @return $this|ChildUserQuery The current query, for fluid interface
     */
    public function filterByCreatedAt($createdAt = null, $comparison = null)
    {
        if (is_array($createdAt)) {
            $useMinMax = false;
            if (isset($createdAt['min'])) {
                $this->addUsingAlias(UserTableMap::COL_CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(UserTableMap::COL_CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UserTableMap::COL_CREATED_AT, $createdAt, $comparison);
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
     * @return $this|ChildUserQuery The current query, for fluid interface
     */
    public function filterByUpdatedAt($updatedAt = null, $comparison = null)
    {
        if (is_array($updatedAt)) {
            $useMinMax = false;
            if (isset($updatedAt['min'])) {
                $this->addUsingAlias(UserTableMap::COL_UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(UserTableMap::COL_UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UserTableMap::COL_UPDATED_AT, $updatedAt, $comparison);
    }

    /**
     * Filter the query by a related \License object
     *
     * @param \License|ObjectCollection $license the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildUserQuery The current query, for fluid interface
     */
    public function filterByLicense($license, $comparison = null)
    {
        if ($license instanceof \License) {
            return $this
                ->addUsingAlias(UserTableMap::COL_USERID, $license->getLicenseUser(), $comparison);
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
     * @return $this|ChildUserQuery The current query, for fluid interface
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
     * Filter the query by a related \Location object
     *
     * @param \Location|ObjectCollection $location the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildUserQuery The current query, for fluid interface
     */
    public function filterByLocation($location, $comparison = null)
    {
        if ($location instanceof \Location) {
            return $this
                ->addUsingAlias(UserTableMap::COL_USERID, $location->getLocationUser(), $comparison);
        } elseif ($location instanceof ObjectCollection) {
            return $this
                ->useLocationQuery()
                ->filterByPrimaryKeys($location->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByLocation() only accepts arguments of type \Location or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Location relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildUserQuery The current query, for fluid interface
     */
    public function joinLocation($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Location');

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
            $this->addJoinObject($join, 'Location');
        }

        return $this;
    }

    /**
     * Use the Location relation Location object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \LocationQuery A secondary query class using the current class as primary query
     */
    public function useLocationQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinLocation($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Location', '\LocationQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildUser $user Object to remove from the list of results
     *
     * @return $this|ChildUserQuery The current query, for fluid interface
     */
    public function prune($user = null)
    {
        if ($user) {
            $this->addUsingAlias(UserTableMap::COL_USERID, $user->getUserid(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the user table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(UserTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            UserTableMap::clearInstancePool();
            UserTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(UserTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(UserTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            UserTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            UserTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

    // timestampable behavior

    /**
     * Filter by the latest updated
     *
     * @param      int $nbDays Maximum age of the latest update in days
     *
     * @return     $this|ChildUserQuery The current query, for fluid interface
     */
    public function recentlyUpdated($nbDays = 7)
    {
        return $this->addUsingAlias(UserTableMap::COL_UPDATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);
    }

    /**
     * Order by update date desc
     *
     * @return     $this|ChildUserQuery The current query, for fluid interface
     */
    public function lastUpdatedFirst()
    {
        return $this->addDescendingOrderByColumn(UserTableMap::COL_UPDATED_AT);
    }

    /**
     * Order by update date asc
     *
     * @return     $this|ChildUserQuery The current query, for fluid interface
     */
    public function firstUpdatedFirst()
    {
        return $this->addAscendingOrderByColumn(UserTableMap::COL_UPDATED_AT);
    }

    /**
     * Order by create date desc
     *
     * @return     $this|ChildUserQuery The current query, for fluid interface
     */
    public function lastCreatedFirst()
    {
        return $this->addDescendingOrderByColumn(UserTableMap::COL_CREATED_AT);
    }

    /**
     * Filter by the latest created
     *
     * @param      int $nbDays Maximum age of in days
     *
     * @return     $this|ChildUserQuery The current query, for fluid interface
     */
    public function recentlyCreated($nbDays = 7)
    {
        return $this->addUsingAlias(UserTableMap::COL_CREATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);
    }

    /**
     * Order by create date asc
     *
     * @return     $this|ChildUserQuery The current query, for fluid interface
     */
    public function firstCreatedFirst()
    {
        return $this->addAscendingOrderByColumn(UserTableMap::COL_CREATED_AT);
    }

} // UserQuery
