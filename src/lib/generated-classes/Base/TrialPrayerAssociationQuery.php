<?php

namespace Base;

use \TrialPrayerAssociation as ChildTrialPrayerAssociation;
use \TrialPrayerAssociationQuery as ChildTrialPrayerAssociationQuery;
use \Exception;
use \PDO;
use Map\TrialPrayerAssociationTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'trialsXprayers' table.
 *
 *
 *
 * @method     ChildTrialPrayerAssociationQuery orderByTrialId($order = Criteria::ASC) Order by the trial_id column
 * @method     ChildTrialPrayerAssociationQuery orderByPrayerId($order = Criteria::ASC) Order by the prayer_id column
 * @method     ChildTrialPrayerAssociationQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ChildTrialPrayerAssociationQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 *
 * @method     ChildTrialPrayerAssociationQuery groupByTrialId() Group by the trial_id column
 * @method     ChildTrialPrayerAssociationQuery groupByPrayerId() Group by the prayer_id column
 * @method     ChildTrialPrayerAssociationQuery groupByCreatedAt() Group by the created_at column
 * @method     ChildTrialPrayerAssociationQuery groupByUpdatedAt() Group by the updated_at column
 *
 * @method     ChildTrialPrayerAssociationQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildTrialPrayerAssociationQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildTrialPrayerAssociationQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildTrialPrayerAssociationQuery leftJoinTrial($relationAlias = null) Adds a LEFT JOIN clause to the query using the Trial relation
 * @method     ChildTrialPrayerAssociationQuery rightJoinTrial($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Trial relation
 * @method     ChildTrialPrayerAssociationQuery innerJoinTrial($relationAlias = null) Adds a INNER JOIN clause to the query using the Trial relation
 *
 * @method     ChildTrialPrayerAssociationQuery leftJoinPrayer($relationAlias = null) Adds a LEFT JOIN clause to the query using the Prayer relation
 * @method     ChildTrialPrayerAssociationQuery rightJoinPrayer($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Prayer relation
 * @method     ChildTrialPrayerAssociationQuery innerJoinPrayer($relationAlias = null) Adds a INNER JOIN clause to the query using the Prayer relation
 *
 * @method     \TrialQuery|\PrayerQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildTrialPrayerAssociation findOne(ConnectionInterface $con = null) Return the first ChildTrialPrayerAssociation matching the query
 * @method     ChildTrialPrayerAssociation findOneOrCreate(ConnectionInterface $con = null) Return the first ChildTrialPrayerAssociation matching the query, or a new ChildTrialPrayerAssociation object populated from the query conditions when no match is found
 *
 * @method     ChildTrialPrayerAssociation findOneByTrialId(int $trial_id) Return the first ChildTrialPrayerAssociation filtered by the trial_id column
 * @method     ChildTrialPrayerAssociation findOneByPrayerId(int $prayer_id) Return the first ChildTrialPrayerAssociation filtered by the prayer_id column
 * @method     ChildTrialPrayerAssociation findOneByCreatedAt(string $created_at) Return the first ChildTrialPrayerAssociation filtered by the created_at column
 * @method     ChildTrialPrayerAssociation findOneByUpdatedAt(string $updated_at) Return the first ChildTrialPrayerAssociation filtered by the updated_at column *

 * @method     ChildTrialPrayerAssociation requirePk($key, ConnectionInterface $con = null) Return the ChildTrialPrayerAssociation by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTrialPrayerAssociation requireOne(ConnectionInterface $con = null) Return the first ChildTrialPrayerAssociation matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildTrialPrayerAssociation requireOneByTrialId(int $trial_id) Return the first ChildTrialPrayerAssociation filtered by the trial_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTrialPrayerAssociation requireOneByPrayerId(int $prayer_id) Return the first ChildTrialPrayerAssociation filtered by the prayer_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTrialPrayerAssociation requireOneByCreatedAt(string $created_at) Return the first ChildTrialPrayerAssociation filtered by the created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTrialPrayerAssociation requireOneByUpdatedAt(string $updated_at) Return the first ChildTrialPrayerAssociation filtered by the updated_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildTrialPrayerAssociation[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildTrialPrayerAssociation objects based on current ModelCriteria
 * @method     ChildTrialPrayerAssociation[]|ObjectCollection findByTrialId(int $trial_id) Return ChildTrialPrayerAssociation objects filtered by the trial_id column
 * @method     ChildTrialPrayerAssociation[]|ObjectCollection findByPrayerId(int $prayer_id) Return ChildTrialPrayerAssociation objects filtered by the prayer_id column
 * @method     ChildTrialPrayerAssociation[]|ObjectCollection findByCreatedAt(string $created_at) Return ChildTrialPrayerAssociation objects filtered by the created_at column
 * @method     ChildTrialPrayerAssociation[]|ObjectCollection findByUpdatedAt(string $updated_at) Return ChildTrialPrayerAssociation objects filtered by the updated_at column
 * @method     ChildTrialPrayerAssociation[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class TrialPrayerAssociationQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\TrialPrayerAssociationQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'main', $modelName = '\\TrialPrayerAssociation', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildTrialPrayerAssociationQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildTrialPrayerAssociationQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildTrialPrayerAssociationQuery) {
            return $criteria;
        }
        $query = new ChildTrialPrayerAssociationQuery();
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
     * @param array[$trial_id, $prayer_id] $key Primary key to use for the query
     * @param ConnectionInterface $con an optional connection object
     *
     * @return ChildTrialPrayerAssociation|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = TrialPrayerAssociationTableMap::getInstanceFromPool(serialize(array((string) $key[0], (string) $key[1]))))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(TrialPrayerAssociationTableMap::DATABASE_NAME);
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
     * @return ChildTrialPrayerAssociation A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT trial_id, prayer_id, created_at, updated_at FROM trialsXprayers WHERE trial_id = :p0 AND prayer_id = :p1';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key[0], PDO::PARAM_INT);
            $stmt->bindValue(':p1', $key[1], PDO::PARAM_INT);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), 0, $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(\PDO::FETCH_NUM)) {
            /** @var ChildTrialPrayerAssociation $obj */
            $obj = new ChildTrialPrayerAssociation();
            $obj->hydrate($row);
            TrialPrayerAssociationTableMap::addInstanceToPool($obj, serialize(array((string) $key[0], (string) $key[1])));
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
     * @return ChildTrialPrayerAssociation|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildTrialPrayerAssociationQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {
        $this->addUsingAlias(TrialPrayerAssociationTableMap::COL_TRIAL_ID, $key[0], Criteria::EQUAL);
        $this->addUsingAlias(TrialPrayerAssociationTableMap::COL_PRAYER_ID, $key[1], Criteria::EQUAL);

        return $this;
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildTrialPrayerAssociationQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {
        if (empty($keys)) {
            return $this->add(null, '1<>1', Criteria::CUSTOM);
        }
        foreach ($keys as $key) {
            $cton0 = $this->getNewCriterion(TrialPrayerAssociationTableMap::COL_TRIAL_ID, $key[0], Criteria::EQUAL);
            $cton1 = $this->getNewCriterion(TrialPrayerAssociationTableMap::COL_PRAYER_ID, $key[1], Criteria::EQUAL);
            $cton0->addAnd($cton1);
            $this->addOr($cton0);
        }

        return $this;
    }

    /**
     * Filter the query on the trial_id column
     *
     * Example usage:
     * <code>
     * $query->filterByTrialId(1234); // WHERE trial_id = 1234
     * $query->filterByTrialId(array(12, 34)); // WHERE trial_id IN (12, 34)
     * $query->filterByTrialId(array('min' => 12)); // WHERE trial_id > 12
     * </code>
     *
     * @see       filterByTrial()
     *
     * @param     mixed $trialId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildTrialPrayerAssociationQuery The current query, for fluid interface
     */
    public function filterByTrialId($trialId = null, $comparison = null)
    {
        if (is_array($trialId)) {
            $useMinMax = false;
            if (isset($trialId['min'])) {
                $this->addUsingAlias(TrialPrayerAssociationTableMap::COL_TRIAL_ID, $trialId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($trialId['max'])) {
                $this->addUsingAlias(TrialPrayerAssociationTableMap::COL_TRIAL_ID, $trialId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(TrialPrayerAssociationTableMap::COL_TRIAL_ID, $trialId, $comparison);
    }

    /**
     * Filter the query on the prayer_id column
     *
     * Example usage:
     * <code>
     * $query->filterByPrayerId(1234); // WHERE prayer_id = 1234
     * $query->filterByPrayerId(array(12, 34)); // WHERE prayer_id IN (12, 34)
     * $query->filterByPrayerId(array('min' => 12)); // WHERE prayer_id > 12
     * </code>
     *
     * @see       filterByPrayer()
     *
     * @param     mixed $prayerId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildTrialPrayerAssociationQuery The current query, for fluid interface
     */
    public function filterByPrayerId($prayerId = null, $comparison = null)
    {
        if (is_array($prayerId)) {
            $useMinMax = false;
            if (isset($prayerId['min'])) {
                $this->addUsingAlias(TrialPrayerAssociationTableMap::COL_PRAYER_ID, $prayerId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($prayerId['max'])) {
                $this->addUsingAlias(TrialPrayerAssociationTableMap::COL_PRAYER_ID, $prayerId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(TrialPrayerAssociationTableMap::COL_PRAYER_ID, $prayerId, $comparison);
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
     * @return $this|ChildTrialPrayerAssociationQuery The current query, for fluid interface
     */
    public function filterByCreatedAt($createdAt = null, $comparison = null)
    {
        if (is_array($createdAt)) {
            $useMinMax = false;
            if (isset($createdAt['min'])) {
                $this->addUsingAlias(TrialPrayerAssociationTableMap::COL_CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(TrialPrayerAssociationTableMap::COL_CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(TrialPrayerAssociationTableMap::COL_CREATED_AT, $createdAt, $comparison);
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
     * @return $this|ChildTrialPrayerAssociationQuery The current query, for fluid interface
     */
    public function filterByUpdatedAt($updatedAt = null, $comparison = null)
    {
        if (is_array($updatedAt)) {
            $useMinMax = false;
            if (isset($updatedAt['min'])) {
                $this->addUsingAlias(TrialPrayerAssociationTableMap::COL_UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(TrialPrayerAssociationTableMap::COL_UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(TrialPrayerAssociationTableMap::COL_UPDATED_AT, $updatedAt, $comparison);
    }

    /**
     * Filter the query by a related \Trial object
     *
     * @param \Trial|ObjectCollection $trial The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildTrialPrayerAssociationQuery The current query, for fluid interface
     */
    public function filterByTrial($trial, $comparison = null)
    {
        if ($trial instanceof \Trial) {
            return $this
                ->addUsingAlias(TrialPrayerAssociationTableMap::COL_TRIAL_ID, $trial->getId(), $comparison);
        } elseif ($trial instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(TrialPrayerAssociationTableMap::COL_TRIAL_ID, $trial->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByTrial() only accepts arguments of type \Trial or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Trial relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildTrialPrayerAssociationQuery The current query, for fluid interface
     */
    public function joinTrial($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Trial');

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
            $this->addJoinObject($join, 'Trial');
        }

        return $this;
    }

    /**
     * Use the Trial relation Trial object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \TrialQuery A secondary query class using the current class as primary query
     */
    public function useTrialQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinTrial($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Trial', '\TrialQuery');
    }

    /**
     * Filter the query by a related \Prayer object
     *
     * @param \Prayer|ObjectCollection $prayer The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildTrialPrayerAssociationQuery The current query, for fluid interface
     */
    public function filterByPrayer($prayer, $comparison = null)
    {
        if ($prayer instanceof \Prayer) {
            return $this
                ->addUsingAlias(TrialPrayerAssociationTableMap::COL_PRAYER_ID, $prayer->getId(), $comparison);
        } elseif ($prayer instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(TrialPrayerAssociationTableMap::COL_PRAYER_ID, $prayer->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByPrayer() only accepts arguments of type \Prayer or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Prayer relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildTrialPrayerAssociationQuery The current query, for fluid interface
     */
    public function joinPrayer($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Prayer');

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
            $this->addJoinObject($join, 'Prayer');
        }

        return $this;
    }

    /**
     * Use the Prayer relation Prayer object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \PrayerQuery A secondary query class using the current class as primary query
     */
    public function usePrayerQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinPrayer($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Prayer', '\PrayerQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildTrialPrayerAssociation $trialPrayerAssociation Object to remove from the list of results
     *
     * @return $this|ChildTrialPrayerAssociationQuery The current query, for fluid interface
     */
    public function prune($trialPrayerAssociation = null)
    {
        if ($trialPrayerAssociation) {
            $this->addCond('pruneCond0', $this->getAliasedColName(TrialPrayerAssociationTableMap::COL_TRIAL_ID), $trialPrayerAssociation->getTrialId(), Criteria::NOT_EQUAL);
            $this->addCond('pruneCond1', $this->getAliasedColName(TrialPrayerAssociationTableMap::COL_PRAYER_ID), $trialPrayerAssociation->getPrayerId(), Criteria::NOT_EQUAL);
            $this->combine(array('pruneCond0', 'pruneCond1'), Criteria::LOGICAL_OR);
        }

        return $this;
    }

    /**
     * Deletes all rows from the trialsXprayers table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(TrialPrayerAssociationTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            TrialPrayerAssociationTableMap::clearInstancePool();
            TrialPrayerAssociationTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(TrialPrayerAssociationTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(TrialPrayerAssociationTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            TrialPrayerAssociationTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            TrialPrayerAssociationTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

    // timestampable behavior

    /**
     * Filter by the latest updated
     *
     * @param      int $nbDays Maximum age of the latest update in days
     *
     * @return     $this|ChildTrialPrayerAssociationQuery The current query, for fluid interface
     */
    public function recentlyUpdated($nbDays = 7)
    {
        return $this->addUsingAlias(TrialPrayerAssociationTableMap::COL_UPDATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);
    }

    /**
     * Order by update date desc
     *
     * @return     $this|ChildTrialPrayerAssociationQuery The current query, for fluid interface
     */
    public function lastUpdatedFirst()
    {
        return $this->addDescendingOrderByColumn(TrialPrayerAssociationTableMap::COL_UPDATED_AT);
    }

    /**
     * Order by update date asc
     *
     * @return     $this|ChildTrialPrayerAssociationQuery The current query, for fluid interface
     */
    public function firstUpdatedFirst()
    {
        return $this->addAscendingOrderByColumn(TrialPrayerAssociationTableMap::COL_UPDATED_AT);
    }

    /**
     * Order by create date desc
     *
     * @return     $this|ChildTrialPrayerAssociationQuery The current query, for fluid interface
     */
    public function lastCreatedFirst()
    {
        return $this->addDescendingOrderByColumn(TrialPrayerAssociationTableMap::COL_CREATED_AT);
    }

    /**
     * Filter by the latest created
     *
     * @param      int $nbDays Maximum age of in days
     *
     * @return     $this|ChildTrialPrayerAssociationQuery The current query, for fluid interface
     */
    public function recentlyCreated($nbDays = 7)
    {
        return $this->addUsingAlias(TrialPrayerAssociationTableMap::COL_CREATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);
    }

    /**
     * Order by create date asc
     *
     * @return     $this|ChildTrialPrayerAssociationQuery The current query, for fluid interface
     */
    public function firstCreatedFirst()
    {
        return $this->addAscendingOrderByColumn(TrialPrayerAssociationTableMap::COL_CREATED_AT);
    }

} // TrialPrayerAssociationQuery
