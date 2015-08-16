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
 * @method     ChildUserQuery orderByIsprovider($order = Criteria::ASC) Order by the isProvider column
 * @method     ChildUserQuery orderByUsername($order = Criteria::ASC) Order by the userName column
 * @method     ChildUserQuery orderByFirstname($order = Criteria::ASC) Order by the firstName column
 * @method     ChildUserQuery orderByLastname($order = Criteria::ASC) Order by the lastName column
 * @method     ChildUserQuery orderBySuffix($order = Criteria::ASC) Order by the suffix column
 * @method     ChildUserQuery orderByAddress($order = Criteria::ASC) Order by the address column
 * @method     ChildUserQuery orderByPhonenumber($order = Criteria::ASC) Order by the phoneNumber column
 * @method     ChildUserQuery orderByEmail($order = Criteria::ASC) Order by the email column
 * @method     ChildUserQuery orderByLastupdate($order = Criteria::ASC) Order by the lastUpdate column
 *
 * @method     ChildUserQuery groupByUserid() Group by the userId column
 * @method     ChildUserQuery groupByIsprovider() Group by the isProvider column
 * @method     ChildUserQuery groupByUsername() Group by the userName column
 * @method     ChildUserQuery groupByFirstname() Group by the firstName column
 * @method     ChildUserQuery groupByLastname() Group by the lastName column
 * @method     ChildUserQuery groupBySuffix() Group by the suffix column
 * @method     ChildUserQuery groupByAddress() Group by the address column
 * @method     ChildUserQuery groupByPhonenumber() Group by the phoneNumber column
 * @method     ChildUserQuery groupByEmail() Group by the email column
 * @method     ChildUserQuery groupByLastupdate() Group by the lastUpdate column
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
 * @method     ChildUserQuery leftJoinUsersettings($relationAlias = null) Adds a LEFT JOIN clause to the query using the Usersettings relation
 * @method     ChildUserQuery rightJoinUsersettings($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Usersettings relation
 * @method     ChildUserQuery innerJoinUsersettings($relationAlias = null) Adds a INNER JOIN clause to the query using the Usersettings relation
 *
 * @method     ChildUserQuery joinWithUsersettings($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Usersettings relation
 *
 * @method     ChildUserQuery leftJoinWithUsersettings() Adds a LEFT JOIN clause and with to the query using the Usersettings relation
 * @method     ChildUserQuery rightJoinWithUsersettings() Adds a RIGHT JOIN clause and with to the query using the Usersettings relation
 * @method     ChildUserQuery innerJoinWithUsersettings() Adds a INNER JOIN clause and with to the query using the Usersettings relation
 *
 * @method     \LicenseQuery|\LocationQuery|\UsersettingsQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildUser findOne(ConnectionInterface $con = null) Return the first ChildUser matching the query
 * @method     ChildUser findOneOrCreate(ConnectionInterface $con = null) Return the first ChildUser matching the query, or a new ChildUser object populated from the query conditions when no match is found
 *
 * @method     ChildUser findOneByUserid(int $userId) Return the first ChildUser filtered by the userId column
 * @method     ChildUser findOneByIsprovider(boolean $isProvider) Return the first ChildUser filtered by the isProvider column
 * @method     ChildUser findOneByUsername(string $userName) Return the first ChildUser filtered by the userName column
 * @method     ChildUser findOneByFirstname(string $firstName) Return the first ChildUser filtered by the firstName column
 * @method     ChildUser findOneByLastname(string $lastName) Return the first ChildUser filtered by the lastName column
 * @method     ChildUser findOneBySuffix(string $suffix) Return the first ChildUser filtered by the suffix column
 * @method     ChildUser findOneByAddress(string $address) Return the first ChildUser filtered by the address column
 * @method     ChildUser findOneByPhonenumber(string $phoneNumber) Return the first ChildUser filtered by the phoneNumber column
 * @method     ChildUser findOneByEmail(string $email) Return the first ChildUser filtered by the email column
 * @method     ChildUser findOneByLastupdate(string $lastUpdate) Return the first ChildUser filtered by the lastUpdate column *

 * @method     ChildUser requirePk($key, ConnectionInterface $con = null) Return the ChildUser by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUser requireOne(ConnectionInterface $con = null) Return the first ChildUser matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildUser requireOneByUserid(int $userId) Return the first ChildUser filtered by the userId column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUser requireOneByIsprovider(boolean $isProvider) Return the first ChildUser filtered by the isProvider column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUser requireOneByUsername(string $userName) Return the first ChildUser filtered by the userName column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUser requireOneByFirstname(string $firstName) Return the first ChildUser filtered by the firstName column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUser requireOneByLastname(string $lastName) Return the first ChildUser filtered by the lastName column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUser requireOneBySuffix(string $suffix) Return the first ChildUser filtered by the suffix column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUser requireOneByAddress(string $address) Return the first ChildUser filtered by the address column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUser requireOneByPhonenumber(string $phoneNumber) Return the first ChildUser filtered by the phoneNumber column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUser requireOneByEmail(string $email) Return the first ChildUser filtered by the email column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUser requireOneByLastupdate(string $lastUpdate) Return the first ChildUser filtered by the lastUpdate column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildUser[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildUser objects based on current ModelCriteria
 * @method     ChildUser[]|ObjectCollection findByUserid(int $userId) Return ChildUser objects filtered by the userId column
 * @method     ChildUser[]|ObjectCollection findByIsprovider(boolean $isProvider) Return ChildUser objects filtered by the isProvider column
 * @method     ChildUser[]|ObjectCollection findByUsername(string $userName) Return ChildUser objects filtered by the userName column
 * @method     ChildUser[]|ObjectCollection findByFirstname(string $firstName) Return ChildUser objects filtered by the firstName column
 * @method     ChildUser[]|ObjectCollection findByLastname(string $lastName) Return ChildUser objects filtered by the lastName column
 * @method     ChildUser[]|ObjectCollection findBySuffix(string $suffix) Return ChildUser objects filtered by the suffix column
 * @method     ChildUser[]|ObjectCollection findByAddress(string $address) Return ChildUser objects filtered by the address column
 * @method     ChildUser[]|ObjectCollection findByPhonenumber(string $phoneNumber) Return ChildUser objects filtered by the phoneNumber column
 * @method     ChildUser[]|ObjectCollection findByEmail(string $email) Return ChildUser objects filtered by the email column
 * @method     ChildUser[]|ObjectCollection findByLastupdate(string $lastUpdate) Return ChildUser objects filtered by the lastUpdate column
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
        $sql = 'SELECT userId, isProvider, userName, firstName, lastName, suffix, address, phoneNumber, email, lastUpdate FROM user WHERE userId = :p0';
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
     * Filter the query on the userName column
     *
     * Example usage:
     * <code>
     * $query->filterByUsername('fooValue');   // WHERE userName = 'fooValue'
     * $query->filterByUsername('%fooValue%'); // WHERE userName LIKE '%fooValue%'
     * </code>
     *
     * @param     string $username The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUserQuery The current query, for fluid interface
     */
    public function filterByUsername($username = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($username)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $username)) {
                $username = str_replace('*', '%', $username);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(UserTableMap::COL_USERNAME, $username, $comparison);
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
     * Filter the query on the lastUpdate column
     *
     * Example usage:
     * <code>
     * $query->filterByLastupdate('2011-03-14'); // WHERE lastUpdate = '2011-03-14'
     * $query->filterByLastupdate('now'); // WHERE lastUpdate = '2011-03-14'
     * $query->filterByLastupdate(array('max' => 'yesterday')); // WHERE lastUpdate > '2011-03-13'
     * </code>
     *
     * @param     mixed $lastupdate The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUserQuery The current query, for fluid interface
     */
    public function filterByLastupdate($lastupdate = null, $comparison = null)
    {
        if (is_array($lastupdate)) {
            $useMinMax = false;
            if (isset($lastupdate['min'])) {
                $this->addUsingAlias(UserTableMap::COL_LASTUPDATE, $lastupdate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($lastupdate['max'])) {
                $this->addUsingAlias(UserTableMap::COL_LASTUPDATE, $lastupdate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UserTableMap::COL_LASTUPDATE, $lastupdate, $comparison);
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
     * Filter the query by a related \Usersettings object
     *
     * @param \Usersettings|ObjectCollection $usersettings the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildUserQuery The current query, for fluid interface
     */
    public function filterByUsersettings($usersettings, $comparison = null)
    {
        if ($usersettings instanceof \Usersettings) {
            return $this
                ->addUsingAlias(UserTableMap::COL_USERID, $usersettings->getSettingsUser(), $comparison);
        } elseif ($usersettings instanceof ObjectCollection) {
            return $this
                ->useUsersettingsQuery()
                ->filterByPrimaryKeys($usersettings->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByUsersettings() only accepts arguments of type \Usersettings or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Usersettings relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildUserQuery The current query, for fluid interface
     */
    public function joinUsersettings($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Usersettings');

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
            $this->addJoinObject($join, 'Usersettings');
        }

        return $this;
    }

    /**
     * Use the Usersettings relation Usersettings object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \UsersettingsQuery A secondary query class using the current class as primary query
     */
    public function useUsersettingsQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinUsersettings($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Usersettings', '\UsersettingsQuery');
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

} // UserQuery
