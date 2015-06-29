<?php

namespace Base;

use \TrialPainRatingAssociation as ChildTrialPainRatingAssociation;
use \TrialPainRatingAssociationQuery as ChildTrialPainRatingAssociationQuery;
use \Exception;
use \PDO;
use Map\TrialPainRatingAssociationTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'trialsXpain_items' table.
 *
 *
 *
 * @method     ChildTrialPainRatingAssociationQuery orderByTrialId($order = Criteria::ASC) Order by the trial_id column
 * @method     ChildTrialPainRatingAssociationQuery orderByItemId($order = Criteria::ASC) Order by the item_id column
 * @method     ChildTrialPainRatingAssociationQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ChildTrialPainRatingAssociationQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 *
 * @method     ChildTrialPainRatingAssociationQuery groupByTrialId() Group by the trial_id column
 * @method     ChildTrialPainRatingAssociationQuery groupByItemId() Group by the item_id column
 * @method     ChildTrialPainRatingAssociationQuery groupByCreatedAt() Group by the created_at column
 * @method     ChildTrialPainRatingAssociationQuery groupByUpdatedAt() Group by the updated_at column
 *
 * @method     ChildTrialPainRatingAssociationQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildTrialPainRatingAssociationQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildTrialPainRatingAssociationQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildTrialPainRatingAssociationQuery leftJoinTrial($relationAlias = null) Adds a LEFT JOIN clause to the query using the Trial relation
 * @method     ChildTrialPainRatingAssociationQuery rightJoinTrial($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Trial relation
 * @method     ChildTrialPainRatingAssociationQuery innerJoinTrial($relationAlias = null) Adds a INNER JOIN clause to the query using the Trial relation
 *
 * @method     ChildTrialPainRatingAssociationQuery leftJoinPainAssessmentItem($relationAlias = null) Adds a LEFT JOIN clause to the query using the PainAssessmentItem relation
 * @method     ChildTrialPainRatingAssociationQuery rightJoinPainAssessmentItem($relationAlias = null) Adds a RIGHT JOIN clause to the query using the PainAssessmentItem relation
 * @method     ChildTrialPainRatingAssociationQuery innerJoinPainAssessmentItem($relationAlias = null) Adds a INNER JOIN clause to the query using the PainAssessmentItem relation
 *
 * @method     \TrialQuery|\PainAssessmentItemQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildTrialPainRatingAssociation findOne(ConnectionInterface $con = null) Return the first ChildTrialPainRatingAssociation matching the query
 * @method     ChildTrialPainRatingAssociation findOneOrCreate(ConnectionInterface $con = null) Return the first ChildTrialPainRatingAssociation matching the query, or a new ChildTrialPainRatingAssociation object populated from the query conditions when no match is found
 *
 * @method     ChildTrialPainRatingAssociation findOneByTrialId(int $trial_id) Return the first ChildTrialPainRatingAssociation filtered by the trial_id column
 * @method     ChildTrialPainRatingAssociation findOneByItemId(int $item_id) Return the first ChildTrialPainRatingAssociation filtered by the item_id column
 * @method     ChildTrialPainRatingAssociation findOneByCreatedAt(string $created_at) Return the first ChildTrialPainRatingAssociation filtered by the created_at column
 * @method     ChildTrialPainRatingAssociation findOneByUpdatedAt(string $updated_at) Return the first ChildTrialPainRatingAssociation filtered by the updated_at column *

 * @method     ChildTrialPainRatingAssociation requirePk($key, ConnectionInterface $con = null) Return the ChildTrialPainRatingAssociation by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTrialPainRatingAssociation requireOne(ConnectionInterface $con = null) Return the first ChildTrialPainRatingAssociation matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildTrialPainRatingAssociation requireOneByTrialId(int $trial_id) Return the first ChildTrialPainRatingAssociation filtered by the trial_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTrialPainRatingAssociation requireOneByItemId(int $item_id) Return the first ChildTrialPainRatingAssociation filtered by the item_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTrialPainRatingAssociation requireOneByCreatedAt(string $created_at) Return the first ChildTrialPainRatingAssociation filtered by the created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTrialPainRatingAssociation requireOneByUpdatedAt(string $updated_at) Return the first ChildTrialPainRatingAssociation filtered by the updated_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildTrialPainRatingAssociation[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildTrialPainRatingAssociation objects based on current ModelCriteria
 * @method     ChildTrialPainRatingAssociation[]|ObjectCollection findByTrialId(int $trial_id) Return ChildTrialPainRatingAssociation objects filtered by the trial_id column
 * @method     ChildTrialPainRatingAssociation[]|ObjectCollection findByItemId(int $item_id) Return ChildTrialPainRatingAssociation objects filtered by the item_id column
 * @method     ChildTrialPainRatingAssociation[]|ObjectCollection findByCreatedAt(string $created_at) Return ChildTrialPainRatingAssociation objects filtered by the created_at column
 * @method     ChildTrialPainRatingAssociation[]|ObjectCollection findByUpdatedAt(string $updated_at) Return ChildTrialPainRatingAssociation objects filtered by the updated_at column
 * @method     ChildTrialPainRatingAssociation[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class TrialPainRatingAssociationQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\TrialPainRatingAssociationQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'main', $modelName = '\\TrialPainRatingAssociation', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildTrialPainRatingAssociationQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildTrialPainRatingAssociationQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildTrialPainRatingAssociationQuery) {
            return $criteria;
        }
        $query = new ChildTrialPainRatingAssociationQuery();
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
     * @param array[$trial_id, $item_id] $key Primary key to use for the query
     * @param ConnectionInterface $con an optional connection object
     *
     * @return ChildTrialPainRatingAssociation|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = TrialPainRatingAssociationTableMap::getInstanceFromPool(serialize(array((string) $key[0], (string) $key[1]))))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(TrialPainRatingAssociationTableMap::DATABASE_NAME);
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
     * @return ChildTrialPainRatingAssociation A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT trial_id, item_id, created_at, updated_at FROM trialsXpain_items WHERE trial_id = :p0 AND item_id = :p1';
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
            /** @var ChildTrialPainRatingAssociation $obj */
            $obj = new ChildTrialPainRatingAssociation();
            $obj->hydrate($row);
            TrialPainRatingAssociationTableMap::addInstanceToPool($obj, serialize(array((string) $key[0], (string) $key[1])));
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
     * @return ChildTrialPainRatingAssociation|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildTrialPainRatingAssociationQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {
        $this->addUsingAlias(TrialPainRatingAssociationTableMap::COL_TRIAL_ID, $key[0], Criteria::EQUAL);
        $this->addUsingAlias(TrialPainRatingAssociationTableMap::COL_ITEM_ID, $key[1], Criteria::EQUAL);

        return $this;
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildTrialPainRatingAssociationQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {
        if (empty($keys)) {
            return $this->add(null, '1<>1', Criteria::CUSTOM);
        }
        foreach ($keys as $key) {
            $cton0 = $this->getNewCriterion(TrialPainRatingAssociationTableMap::COL_TRIAL_ID, $key[0], Criteria::EQUAL);
            $cton1 = $this->getNewCriterion(TrialPainRatingAssociationTableMap::COL_ITEM_ID, $key[1], Criteria::EQUAL);
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
     * @return $this|ChildTrialPainRatingAssociationQuery The current query, for fluid interface
     */
    public function filterByTrialId($trialId = null, $comparison = null)
    {
        if (is_array($trialId)) {
            $useMinMax = false;
            if (isset($trialId['min'])) {
                $this->addUsingAlias(TrialPainRatingAssociationTableMap::COL_TRIAL_ID, $trialId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($trialId['max'])) {
                $this->addUsingAlias(TrialPainRatingAssociationTableMap::COL_TRIAL_ID, $trialId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(TrialPainRatingAssociationTableMap::COL_TRIAL_ID, $trialId, $comparison);
    }

    /**
     * Filter the query on the item_id column
     *
     * Example usage:
     * <code>
     * $query->filterByItemId(1234); // WHERE item_id = 1234
     * $query->filterByItemId(array(12, 34)); // WHERE item_id IN (12, 34)
     * $query->filterByItemId(array('min' => 12)); // WHERE item_id > 12
     * </code>
     *
     * @see       filterByPainAssessmentItem()
     *
     * @param     mixed $itemId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildTrialPainRatingAssociationQuery The current query, for fluid interface
     */
    public function filterByItemId($itemId = null, $comparison = null)
    {
        if (is_array($itemId)) {
            $useMinMax = false;
            if (isset($itemId['min'])) {
                $this->addUsingAlias(TrialPainRatingAssociationTableMap::COL_ITEM_ID, $itemId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($itemId['max'])) {
                $this->addUsingAlias(TrialPainRatingAssociationTableMap::COL_ITEM_ID, $itemId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(TrialPainRatingAssociationTableMap::COL_ITEM_ID, $itemId, $comparison);
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
     * @return $this|ChildTrialPainRatingAssociationQuery The current query, for fluid interface
     */
    public function filterByCreatedAt($createdAt = null, $comparison = null)
    {
        if (is_array($createdAt)) {
            $useMinMax = false;
            if (isset($createdAt['min'])) {
                $this->addUsingAlias(TrialPainRatingAssociationTableMap::COL_CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(TrialPainRatingAssociationTableMap::COL_CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(TrialPainRatingAssociationTableMap::COL_CREATED_AT, $createdAt, $comparison);
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
     * @return $this|ChildTrialPainRatingAssociationQuery The current query, for fluid interface
     */
    public function filterByUpdatedAt($updatedAt = null, $comparison = null)
    {
        if (is_array($updatedAt)) {
            $useMinMax = false;
            if (isset($updatedAt['min'])) {
                $this->addUsingAlias(TrialPainRatingAssociationTableMap::COL_UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(TrialPainRatingAssociationTableMap::COL_UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(TrialPainRatingAssociationTableMap::COL_UPDATED_AT, $updatedAt, $comparison);
    }

    /**
     * Filter the query by a related \Trial object
     *
     * @param \Trial|ObjectCollection $trial The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildTrialPainRatingAssociationQuery The current query, for fluid interface
     */
    public function filterByTrial($trial, $comparison = null)
    {
        if ($trial instanceof \Trial) {
            return $this
                ->addUsingAlias(TrialPainRatingAssociationTableMap::COL_TRIAL_ID, $trial->getId(), $comparison);
        } elseif ($trial instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(TrialPainRatingAssociationTableMap::COL_TRIAL_ID, $trial->toKeyValue('PrimaryKey', 'Id'), $comparison);
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
     * @return $this|ChildTrialPainRatingAssociationQuery The current query, for fluid interface
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
     * Filter the query by a related \PainAssessmentItem object
     *
     * @param \PainAssessmentItem|ObjectCollection $painAssessmentItem The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildTrialPainRatingAssociationQuery The current query, for fluid interface
     */
    public function filterByPainAssessmentItem($painAssessmentItem, $comparison = null)
    {
        if ($painAssessmentItem instanceof \PainAssessmentItem) {
            return $this
                ->addUsingAlias(TrialPainRatingAssociationTableMap::COL_ITEM_ID, $painAssessmentItem->getId(), $comparison);
        } elseif ($painAssessmentItem instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(TrialPainRatingAssociationTableMap::COL_ITEM_ID, $painAssessmentItem->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByPainAssessmentItem() only accepts arguments of type \PainAssessmentItem or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the PainAssessmentItem relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildTrialPainRatingAssociationQuery The current query, for fluid interface
     */
    public function joinPainAssessmentItem($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('PainAssessmentItem');

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
            $this->addJoinObject($join, 'PainAssessmentItem');
        }

        return $this;
    }

    /**
     * Use the PainAssessmentItem relation PainAssessmentItem object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \PainAssessmentItemQuery A secondary query class using the current class as primary query
     */
    public function usePainAssessmentItemQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinPainAssessmentItem($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'PainAssessmentItem', '\PainAssessmentItemQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildTrialPainRatingAssociation $trialPainRatingAssociation Object to remove from the list of results
     *
     * @return $this|ChildTrialPainRatingAssociationQuery The current query, for fluid interface
     */
    public function prune($trialPainRatingAssociation = null)
    {
        if ($trialPainRatingAssociation) {
            $this->addCond('pruneCond0', $this->getAliasedColName(TrialPainRatingAssociationTableMap::COL_TRIAL_ID), $trialPainRatingAssociation->getTrialId(), Criteria::NOT_EQUAL);
            $this->addCond('pruneCond1', $this->getAliasedColName(TrialPainRatingAssociationTableMap::COL_ITEM_ID), $trialPainRatingAssociation->getItemId(), Criteria::NOT_EQUAL);
            $this->combine(array('pruneCond0', 'pruneCond1'), Criteria::LOGICAL_OR);
        }

        return $this;
    }

    /**
     * Deletes all rows from the trialsXpain_items table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(TrialPainRatingAssociationTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            TrialPainRatingAssociationTableMap::clearInstancePool();
            TrialPainRatingAssociationTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(TrialPainRatingAssociationTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(TrialPainRatingAssociationTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            TrialPainRatingAssociationTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            TrialPainRatingAssociationTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

    // timestampable behavior

    /**
     * Filter by the latest updated
     *
     * @param      int $nbDays Maximum age of the latest update in days
     *
     * @return     $this|ChildTrialPainRatingAssociationQuery The current query, for fluid interface
     */
    public function recentlyUpdated($nbDays = 7)
    {
        return $this->addUsingAlias(TrialPainRatingAssociationTableMap::COL_UPDATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);
    }

    /**
     * Order by update date desc
     *
     * @return     $this|ChildTrialPainRatingAssociationQuery The current query, for fluid interface
     */
    public function lastUpdatedFirst()
    {
        return $this->addDescendingOrderByColumn(TrialPainRatingAssociationTableMap::COL_UPDATED_AT);
    }

    /**
     * Order by update date asc
     *
     * @return     $this|ChildTrialPainRatingAssociationQuery The current query, for fluid interface
     */
    public function firstUpdatedFirst()
    {
        return $this->addAscendingOrderByColumn(TrialPainRatingAssociationTableMap::COL_UPDATED_AT);
    }

    /**
     * Order by create date desc
     *
     * @return     $this|ChildTrialPainRatingAssociationQuery The current query, for fluid interface
     */
    public function lastCreatedFirst()
    {
        return $this->addDescendingOrderByColumn(TrialPainRatingAssociationTableMap::COL_CREATED_AT);
    }

    /**
     * Filter by the latest created
     *
     * @param      int $nbDays Maximum age of in days
     *
     * @return     $this|ChildTrialPainRatingAssociationQuery The current query, for fluid interface
     */
    public function recentlyCreated($nbDays = 7)
    {
        return $this->addUsingAlias(TrialPainRatingAssociationTableMap::COL_CREATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);
    }

    /**
     * Order by create date asc
     *
     * @return     $this|ChildTrialPainRatingAssociationQuery The current query, for fluid interface
     */
    public function firstCreatedFirst()
    {
        return $this->addAscendingOrderByColumn(TrialPainRatingAssociationTableMap::COL_CREATED_AT);
    }

} // TrialPainRatingAssociationQuery
