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
 * Base class that represents a query for the 'users' table.
 *
 *
 *
 * @method     ChildUserQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildUserQuery orderByNickname($order = Criteria::ASC) Order by the nickname column
 * @method     ChildUserQuery orderByEmail($order = Criteria::ASC) Order by the email column
 * @method     ChildUserQuery orderByAge($order = Criteria::ASC) Order by the age column
 * @method     ChildUserQuery orderBySex($order = Criteria::ASC) Order by the sex column
 * @method     ChildUserQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ChildUserQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 *
 * @method     ChildUserQuery groupById() Group by the id column
 * @method     ChildUserQuery groupByNickname() Group by the nickname column
 * @method     ChildUserQuery groupByEmail() Group by the email column
 * @method     ChildUserQuery groupByAge() Group by the age column
 * @method     ChildUserQuery groupBySex() Group by the sex column
 * @method     ChildUserQuery groupByCreatedAt() Group by the created_at column
 * @method     ChildUserQuery groupByUpdatedAt() Group by the updated_at column
 *
 * @method     ChildUserQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildUserQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildUserQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildUserQuery leftJoinUserAge($relationAlias = null) Adds a LEFT JOIN clause to the query using the UserAge relation
 * @method     ChildUserQuery rightJoinUserAge($relationAlias = null) Adds a RIGHT JOIN clause to the query using the UserAge relation
 * @method     ChildUserQuery innerJoinUserAge($relationAlias = null) Adds a INNER JOIN clause to the query using the UserAge relation
 *
 * @method     ChildUserQuery leftJoinAssignedPrayerRelatedByAgentId($relationAlias = null) Adds a LEFT JOIN clause to the query using the AssignedPrayerRelatedByAgentId relation
 * @method     ChildUserQuery rightJoinAssignedPrayerRelatedByAgentId($relationAlias = null) Adds a RIGHT JOIN clause to the query using the AssignedPrayerRelatedByAgentId relation
 * @method     ChildUserQuery innerJoinAssignedPrayerRelatedByAgentId($relationAlias = null) Adds a INNER JOIN clause to the query using the AssignedPrayerRelatedByAgentId relation
 *
 * @method     ChildUserQuery leftJoinAssignedPrayerRelatedByPatientId($relationAlias = null) Adds a LEFT JOIN clause to the query using the AssignedPrayerRelatedByPatientId relation
 * @method     ChildUserQuery rightJoinAssignedPrayerRelatedByPatientId($relationAlias = null) Adds a RIGHT JOIN clause to the query using the AssignedPrayerRelatedByPatientId relation
 * @method     ChildUserQuery innerJoinAssignedPrayerRelatedByPatientId($relationAlias = null) Adds a INNER JOIN clause to the query using the AssignedPrayerRelatedByPatientId relation
 *
 * @method     ChildUserQuery leftJoinPartnersRelatedByAgentId($relationAlias = null) Adds a LEFT JOIN clause to the query using the PartnersRelatedByAgentId relation
 * @method     ChildUserQuery rightJoinPartnersRelatedByAgentId($relationAlias = null) Adds a RIGHT JOIN clause to the query using the PartnersRelatedByAgentId relation
 * @method     ChildUserQuery innerJoinPartnersRelatedByAgentId($relationAlias = null) Adds a INNER JOIN clause to the query using the PartnersRelatedByAgentId relation
 *
 * @method     ChildUserQuery leftJoinPartnersRelatedByPatientId($relationAlias = null) Adds a LEFT JOIN clause to the query using the PartnersRelatedByPatientId relation
 * @method     ChildUserQuery rightJoinPartnersRelatedByPatientId($relationAlias = null) Adds a RIGHT JOIN clause to the query using the PartnersRelatedByPatientId relation
 * @method     ChildUserQuery innerJoinPartnersRelatedByPatientId($relationAlias = null) Adds a INNER JOIN clause to the query using the PartnersRelatedByPatientId relation
 *
 * @method     ChildUserQuery leftJoinPainRating($relationAlias = null) Adds a LEFT JOIN clause to the query using the PainRating relation
 * @method     ChildUserQuery rightJoinPainRating($relationAlias = null) Adds a RIGHT JOIN clause to the query using the PainRating relation
 * @method     ChildUserQuery innerJoinPainRating($relationAlias = null) Adds a INNER JOIN clause to the query using the PainRating relation
 *
 * @method     ChildUserQuery leftJoinUserDemos($relationAlias = null) Adds a LEFT JOIN clause to the query using the UserDemos relation
 * @method     ChildUserQuery rightJoinUserDemos($relationAlias = null) Adds a RIGHT JOIN clause to the query using the UserDemos relation
 * @method     ChildUserQuery innerJoinUserDemos($relationAlias = null) Adds a INNER JOIN clause to the query using the UserDemos relation
 *
 * @method     \AgeQuery|\AssignedPrayerQuery|\PartnersQuery|\PainRatingQuery|\UserDemosQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildUser findOne(ConnectionInterface $con = null) Return the first ChildUser matching the query
 * @method     ChildUser findOneOrCreate(ConnectionInterface $con = null) Return the first ChildUser matching the query, or a new ChildUser object populated from the query conditions when no match is found
 *
 * @method     ChildUser findOneById(int $id) Return the first ChildUser filtered by the id column
 * @method     ChildUser findOneByNickname(string $nickname) Return the first ChildUser filtered by the nickname column
 * @method     ChildUser findOneByEmail(string $email) Return the first ChildUser filtered by the email column
 * @method     ChildUser findOneByAge(string $age) Return the first ChildUser filtered by the age column
 * @method     ChildUser findOneBySex(string $sex) Return the first ChildUser filtered by the sex column
 * @method     ChildUser findOneByCreatedAt(string $created_at) Return the first ChildUser filtered by the created_at column
 * @method     ChildUser findOneByUpdatedAt(string $updated_at) Return the first ChildUser filtered by the updated_at column *

 * @method     ChildUser requirePk($key, ConnectionInterface $con = null) Return the ChildUser by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUser requireOne(ConnectionInterface $con = null) Return the first ChildUser matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildUser requireOneById(int $id) Return the first ChildUser filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUser requireOneByNickname(string $nickname) Return the first ChildUser filtered by the nickname column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUser requireOneByEmail(string $email) Return the first ChildUser filtered by the email column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUser requireOneByAge(string $age) Return the first ChildUser filtered by the age column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUser requireOneBySex(string $sex) Return the first ChildUser filtered by the sex column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUser requireOneByCreatedAt(string $created_at) Return the first ChildUser filtered by the created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUser requireOneByUpdatedAt(string $updated_at) Return the first ChildUser filtered by the updated_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildUser[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildUser objects based on current ModelCriteria
 * @method     ChildUser[]|ObjectCollection findById(int $id) Return ChildUser objects filtered by the id column
 * @method     ChildUser[]|ObjectCollection findByNickname(string $nickname) Return ChildUser objects filtered by the nickname column
 * @method     ChildUser[]|ObjectCollection findByEmail(string $email) Return ChildUser objects filtered by the email column
 * @method     ChildUser[]|ObjectCollection findByAge(string $age) Return ChildUser objects filtered by the age column
 * @method     ChildUser[]|ObjectCollection findBySex(string $sex) Return ChildUser objects filtered by the sex column
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
    public function __construct($dbName = 'main', $modelName = '\\User', $modelAlias = null)
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
     * $obj = $c->findPk(array(12, 34), $con);
     * </code>
     *
     * @param array[$id, $nickname] $key Primary key to use for the query
     * @param ConnectionInterface $con an optional connection object
     *
     * @return ChildUser|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = UserTableMap::getInstanceFromPool(serialize(array((string) $key[0], (string) $key[1]))))) && !$this->formatter) {
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
        $sql = 'SELECT id, nickname, email, age, sex, created_at, updated_at FROM users WHERE id = :p0 AND nickname = :p1';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key[0], PDO::PARAM_INT);
            $stmt->bindValue(':p1', $key[1], PDO::PARAM_STR);
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
            UserTableMap::addInstanceToPool($obj, serialize(array((string) $key[0], (string) $key[1])));
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
     * $objs = $c->findPks(array(array(12, 56), array(832, 123), array(123, 456)), $con);
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
        $this->addUsingAlias(UserTableMap::COL_ID, $key[0], Criteria::EQUAL);
        $this->addUsingAlias(UserTableMap::COL_NICKNAME, $key[1], Criteria::EQUAL);

        return $this;
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
        if (empty($keys)) {
            return $this->add(null, '1<>1', Criteria::CUSTOM);
        }
        foreach ($keys as $key) {
            $cton0 = $this->getNewCriterion(UserTableMap::COL_ID, $key[0], Criteria::EQUAL);
            $cton1 = $this->getNewCriterion(UserTableMap::COL_NICKNAME, $key[1], Criteria::EQUAL);
            $cton0->addAnd($cton1);
            $this->addOr($cton0);
        }

        return $this;
    }

    /**
     * Filter the query on the id column
     *
     * Example usage:
     * <code>
     * $query->filterById(1234); // WHERE id = 1234
     * $query->filterById(array(12, 34)); // WHERE id IN (12, 34)
     * $query->filterById(array('min' => 12)); // WHERE id > 12
     * </code>
     *
     * @param     mixed $id The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUserQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(UserTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(UserTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UserTableMap::COL_ID, $id, $comparison);
    }

    /**
     * Filter the query on the nickname column
     *
     * Example usage:
     * <code>
     * $query->filterByNickname('fooValue');   // WHERE nickname = 'fooValue'
     * $query->filterByNickname('%fooValue%'); // WHERE nickname LIKE '%fooValue%'
     * </code>
     *
     * @param     string $nickname The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUserQuery The current query, for fluid interface
     */
    public function filterByNickname($nickname = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($nickname)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $nickname)) {
                $nickname = str_replace('*', '%', $nickname);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(UserTableMap::COL_NICKNAME, $nickname, $comparison);
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
     * Filter the query on the age column
     *
     * Example usage:
     * <code>
     * $query->filterByAge('fooValue');   // WHERE age = 'fooValue'
     * $query->filterByAge('%fooValue%'); // WHERE age LIKE '%fooValue%'
     * </code>
     *
     * @param     string $age The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUserQuery The current query, for fluid interface
     */
    public function filterByAge($age = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($age)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $age)) {
                $age = str_replace('*', '%', $age);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(UserTableMap::COL_AGE, $age, $comparison);
    }

    /**
     * Filter the query on the sex column
     *
     * Example usage:
     * <code>
     * $query->filterBySex('fooValue');   // WHERE sex = 'fooValue'
     * $query->filterBySex('%fooValue%'); // WHERE sex LIKE '%fooValue%'
     * </code>
     *
     * @param     string $sex The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUserQuery The current query, for fluid interface
     */
    public function filterBySex($sex = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($sex)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $sex)) {
                $sex = str_replace('*', '%', $sex);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(UserTableMap::COL_SEX, $sex, $comparison);
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
     * Filter the query by a related \Age object
     *
     * @param \Age|ObjectCollection $age The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildUserQuery The current query, for fluid interface
     */
    public function filterByUserAge($age, $comparison = null)
    {
        if ($age instanceof \Age) {
            return $this
                ->addUsingAlias(UserTableMap::COL_AGE, $age->getAge(), $comparison);
        } elseif ($age instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(UserTableMap::COL_AGE, $age->toKeyValue('PrimaryKey', 'Age'), $comparison);
        } else {
            throw new PropelException('filterByUserAge() only accepts arguments of type \Age or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the UserAge relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildUserQuery The current query, for fluid interface
     */
    public function joinUserAge($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('UserAge');

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
            $this->addJoinObject($join, 'UserAge');
        }

        return $this;
    }

    /**
     * Use the UserAge relation Age object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \AgeQuery A secondary query class using the current class as primary query
     */
    public function useUserAgeQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinUserAge($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'UserAge', '\AgeQuery');
    }

    /**
     * Filter the query by a related \AssignedPrayer object
     *
     * @param \AssignedPrayer|ObjectCollection $assignedPrayer the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildUserQuery The current query, for fluid interface
     */
    public function filterByAssignedPrayerRelatedByAgentId($assignedPrayer, $comparison = null)
    {
        if ($assignedPrayer instanceof \AssignedPrayer) {
            return $this
                ->addUsingAlias(UserTableMap::COL_ID, $assignedPrayer->getAgentId(), $comparison);
        } elseif ($assignedPrayer instanceof ObjectCollection) {
            return $this
                ->useAssignedPrayerRelatedByAgentIdQuery()
                ->filterByPrimaryKeys($assignedPrayer->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByAssignedPrayerRelatedByAgentId() only accepts arguments of type \AssignedPrayer or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the AssignedPrayerRelatedByAgentId relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildUserQuery The current query, for fluid interface
     */
    public function joinAssignedPrayerRelatedByAgentId($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('AssignedPrayerRelatedByAgentId');

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
            $this->addJoinObject($join, 'AssignedPrayerRelatedByAgentId');
        }

        return $this;
    }

    /**
     * Use the AssignedPrayerRelatedByAgentId relation AssignedPrayer object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \AssignedPrayerQuery A secondary query class using the current class as primary query
     */
    public function useAssignedPrayerRelatedByAgentIdQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinAssignedPrayerRelatedByAgentId($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'AssignedPrayerRelatedByAgentId', '\AssignedPrayerQuery');
    }

    /**
     * Filter the query by a related \AssignedPrayer object
     *
     * @param \AssignedPrayer|ObjectCollection $assignedPrayer the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildUserQuery The current query, for fluid interface
     */
    public function filterByAssignedPrayerRelatedByPatientId($assignedPrayer, $comparison = null)
    {
        if ($assignedPrayer instanceof \AssignedPrayer) {
            return $this
                ->addUsingAlias(UserTableMap::COL_ID, $assignedPrayer->getPatientId(), $comparison);
        } elseif ($assignedPrayer instanceof ObjectCollection) {
            return $this
                ->useAssignedPrayerRelatedByPatientIdQuery()
                ->filterByPrimaryKeys($assignedPrayer->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByAssignedPrayerRelatedByPatientId() only accepts arguments of type \AssignedPrayer or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the AssignedPrayerRelatedByPatientId relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildUserQuery The current query, for fluid interface
     */
    public function joinAssignedPrayerRelatedByPatientId($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('AssignedPrayerRelatedByPatientId');

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
            $this->addJoinObject($join, 'AssignedPrayerRelatedByPatientId');
        }

        return $this;
    }

    /**
     * Use the AssignedPrayerRelatedByPatientId relation AssignedPrayer object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \AssignedPrayerQuery A secondary query class using the current class as primary query
     */
    public function useAssignedPrayerRelatedByPatientIdQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinAssignedPrayerRelatedByPatientId($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'AssignedPrayerRelatedByPatientId', '\AssignedPrayerQuery');
    }

    /**
     * Filter the query by a related \Partners object
     *
     * @param \Partners|ObjectCollection $partners the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildUserQuery The current query, for fluid interface
     */
    public function filterByPartnersRelatedByAgentId($partners, $comparison = null)
    {
        if ($partners instanceof \Partners) {
            return $this
                ->addUsingAlias(UserTableMap::COL_ID, $partners->getAgentId(), $comparison);
        } elseif ($partners instanceof ObjectCollection) {
            return $this
                ->usePartnersRelatedByAgentIdQuery()
                ->filterByPrimaryKeys($partners->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByPartnersRelatedByAgentId() only accepts arguments of type \Partners or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the PartnersRelatedByAgentId relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildUserQuery The current query, for fluid interface
     */
    public function joinPartnersRelatedByAgentId($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('PartnersRelatedByAgentId');

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
            $this->addJoinObject($join, 'PartnersRelatedByAgentId');
        }

        return $this;
    }

    /**
     * Use the PartnersRelatedByAgentId relation Partners object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \PartnersQuery A secondary query class using the current class as primary query
     */
    public function usePartnersRelatedByAgentIdQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinPartnersRelatedByAgentId($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'PartnersRelatedByAgentId', '\PartnersQuery');
    }

    /**
     * Filter the query by a related \Partners object
     *
     * @param \Partners|ObjectCollection $partners the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildUserQuery The current query, for fluid interface
     */
    public function filterByPartnersRelatedByPatientId($partners, $comparison = null)
    {
        if ($partners instanceof \Partners) {
            return $this
                ->addUsingAlias(UserTableMap::COL_ID, $partners->getPatientId(), $comparison);
        } elseif ($partners instanceof ObjectCollection) {
            return $this
                ->usePartnersRelatedByPatientIdQuery()
                ->filterByPrimaryKeys($partners->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByPartnersRelatedByPatientId() only accepts arguments of type \Partners or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the PartnersRelatedByPatientId relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildUserQuery The current query, for fluid interface
     */
    public function joinPartnersRelatedByPatientId($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('PartnersRelatedByPatientId');

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
            $this->addJoinObject($join, 'PartnersRelatedByPatientId');
        }

        return $this;
    }

    /**
     * Use the PartnersRelatedByPatientId relation Partners object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \PartnersQuery A secondary query class using the current class as primary query
     */
    public function usePartnersRelatedByPatientIdQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinPartnersRelatedByPatientId($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'PartnersRelatedByPatientId', '\PartnersQuery');
    }

    /**
     * Filter the query by a related \PainRating object
     *
     * @param \PainRating|ObjectCollection $painRating the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildUserQuery The current query, for fluid interface
     */
    public function filterByPainRating($painRating, $comparison = null)
    {
        if ($painRating instanceof \PainRating) {
            return $this
                ->addUsingAlias(UserTableMap::COL_ID, $painRating->getUserId(), $comparison);
        } elseif ($painRating instanceof ObjectCollection) {
            return $this
                ->usePainRatingQuery()
                ->filterByPrimaryKeys($painRating->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByPainRating() only accepts arguments of type \PainRating or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the PainRating relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildUserQuery The current query, for fluid interface
     */
    public function joinPainRating($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('PainRating');

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
            $this->addJoinObject($join, 'PainRating');
        }

        return $this;
    }

    /**
     * Use the PainRating relation PainRating object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \PainRatingQuery A secondary query class using the current class as primary query
     */
    public function usePainRatingQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinPainRating($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'PainRating', '\PainRatingQuery');
    }

    /**
     * Filter the query by a related \UserDemos object
     *
     * @param \UserDemos|ObjectCollection $userDemos the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildUserQuery The current query, for fluid interface
     */
    public function filterByUserDemos($userDemos, $comparison = null)
    {
        if ($userDemos instanceof \UserDemos) {
            return $this
                ->addUsingAlias(UserTableMap::COL_ID, $userDemos->getUserId(), $comparison);
        } elseif ($userDemos instanceof ObjectCollection) {
            return $this
                ->useUserDemosQuery()
                ->filterByPrimaryKeys($userDemos->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByUserDemos() only accepts arguments of type \UserDemos or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the UserDemos relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildUserQuery The current query, for fluid interface
     */
    public function joinUserDemos($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('UserDemos');

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
            $this->addJoinObject($join, 'UserDemos');
        }

        return $this;
    }

    /**
     * Use the UserDemos relation UserDemos object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \UserDemosQuery A secondary query class using the current class as primary query
     */
    public function useUserDemosQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinUserDemos($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'UserDemos', '\UserDemosQuery');
    }

    /**
     * Filter the query by a related User object
     * using the partners table as cross reference
     *
     * @param User $user the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildUserQuery The current query, for fluid interface
     */
    public function filterByPatient($user, $comparison = Criteria::EQUAL)
    {
        return $this
            ->usePartnersRelatedByAgentIdQuery()
            ->filterByPatient($user, $comparison)
            ->endUse();
    }

    /**
     * Filter the query by a related User object
     * using the partners table as cross reference
     *
     * @param User $user the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildUserQuery The current query, for fluid interface
     */
    public function filterByAgent($user, $comparison = Criteria::EQUAL)
    {
        return $this
            ->usePartnersRelatedByPatientIdQuery()
            ->filterByAgent($user, $comparison)
            ->endUse();
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
            $this->addCond('pruneCond0', $this->getAliasedColName(UserTableMap::COL_ID), $user->getId(), Criteria::NOT_EQUAL);
            $this->addCond('pruneCond1', $this->getAliasedColName(UserTableMap::COL_NICKNAME), $user->getNickname(), Criteria::NOT_EQUAL);
            $this->combine(array('pruneCond0', 'pruneCond1'), Criteria::LOGICAL_OR);
        }

        return $this;
    }

    /**
     * Deletes all rows from the users table.
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
