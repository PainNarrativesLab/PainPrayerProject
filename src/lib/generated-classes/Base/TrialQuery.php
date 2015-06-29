<?php

namespace Base;

use \Trial as ChildTrial;
use \TrialQuery as ChildTrialQuery;
use \Exception;
use \PDO;
use Map\TrialTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'trials' table.
 *
 *
 *
 * @method     ChildTrialQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildTrialQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ChildTrialQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 *
 * @method     ChildTrialQuery groupById() Group by the id column
 * @method     ChildTrialQuery groupByCreatedAt() Group by the created_at column
 * @method     ChildTrialQuery groupByUpdatedAt() Group by the updated_at column
 *
 * @method     ChildTrialQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildTrialQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildTrialQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildTrialQuery leftJoinTrialPrayerAssociation($relationAlias = null) Adds a LEFT JOIN clause to the query using the TrialPrayerAssociation relation
 * @method     ChildTrialQuery rightJoinTrialPrayerAssociation($relationAlias = null) Adds a RIGHT JOIN clause to the query using the TrialPrayerAssociation relation
 * @method     ChildTrialQuery innerJoinTrialPrayerAssociation($relationAlias = null) Adds a INNER JOIN clause to the query using the TrialPrayerAssociation relation
 *
 * @method     ChildTrialQuery leftJoinTrialPainRatingAssociation($relationAlias = null) Adds a LEFT JOIN clause to the query using the TrialPainRatingAssociation relation
 * @method     ChildTrialQuery rightJoinTrialPainRatingAssociation($relationAlias = null) Adds a RIGHT JOIN clause to the query using the TrialPainRatingAssociation relation
 * @method     ChildTrialQuery innerJoinTrialPainRatingAssociation($relationAlias = null) Adds a INNER JOIN clause to the query using the TrialPainRatingAssociation relation
 *
 * @method     \TrialPrayerAssociationQuery|\TrialPainRatingAssociationQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildTrial findOne(ConnectionInterface $con = null) Return the first ChildTrial matching the query
 * @method     ChildTrial findOneOrCreate(ConnectionInterface $con = null) Return the first ChildTrial matching the query, or a new ChildTrial object populated from the query conditions when no match is found
 *
 * @method     ChildTrial findOneById(int $id) Return the first ChildTrial filtered by the id column
 * @method     ChildTrial findOneByCreatedAt(string $created_at) Return the first ChildTrial filtered by the created_at column
 * @method     ChildTrial findOneByUpdatedAt(string $updated_at) Return the first ChildTrial filtered by the updated_at column *

 * @method     ChildTrial requirePk($key, ConnectionInterface $con = null) Return the ChildTrial by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTrial requireOne(ConnectionInterface $con = null) Return the first ChildTrial matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildTrial requireOneById(int $id) Return the first ChildTrial filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTrial requireOneByCreatedAt(string $created_at) Return the first ChildTrial filtered by the created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTrial requireOneByUpdatedAt(string $updated_at) Return the first ChildTrial filtered by the updated_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildTrial[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildTrial objects based on current ModelCriteria
 * @method     ChildTrial[]|ObjectCollection findById(int $id) Return ChildTrial objects filtered by the id column
 * @method     ChildTrial[]|ObjectCollection findByCreatedAt(string $created_at) Return ChildTrial objects filtered by the created_at column
 * @method     ChildTrial[]|ObjectCollection findByUpdatedAt(string $updated_at) Return ChildTrial objects filtered by the updated_at column
 * @method     ChildTrial[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class TrialQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\TrialQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'main', $modelName = '\\Trial', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildTrialQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildTrialQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildTrialQuery) {
            return $criteria;
        }
        $query = new ChildTrialQuery();
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
     * @return ChildTrial|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = TrialTableMap::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(TrialTableMap::DATABASE_NAME);
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
     * @return ChildTrial A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, created_at, updated_at FROM trials WHERE id = :p0';
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
            /** @var ChildTrial $obj */
            $obj = new ChildTrial();
            $obj->hydrate($row);
            TrialTableMap::addInstanceToPool($obj, (string) $key);
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
     * @return ChildTrial|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildTrialQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(TrialTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildTrialQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(TrialTableMap::COL_ID, $keys, Criteria::IN);
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
     * @return $this|ChildTrialQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(TrialTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(TrialTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(TrialTableMap::COL_ID, $id, $comparison);
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
     * @return $this|ChildTrialQuery The current query, for fluid interface
     */
    public function filterByCreatedAt($createdAt = null, $comparison = null)
    {
        if (is_array($createdAt)) {
            $useMinMax = false;
            if (isset($createdAt['min'])) {
                $this->addUsingAlias(TrialTableMap::COL_CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(TrialTableMap::COL_CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(TrialTableMap::COL_CREATED_AT, $createdAt, $comparison);
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
     * @return $this|ChildTrialQuery The current query, for fluid interface
     */
    public function filterByUpdatedAt($updatedAt = null, $comparison = null)
    {
        if (is_array($updatedAt)) {
            $useMinMax = false;
            if (isset($updatedAt['min'])) {
                $this->addUsingAlias(TrialTableMap::COL_UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(TrialTableMap::COL_UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(TrialTableMap::COL_UPDATED_AT, $updatedAt, $comparison);
    }

    /**
     * Filter the query by a related \TrialPrayerAssociation object
     *
     * @param \TrialPrayerAssociation|ObjectCollection $trialPrayerAssociation the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildTrialQuery The current query, for fluid interface
     */
    public function filterByTrialPrayerAssociation($trialPrayerAssociation, $comparison = null)
    {
        if ($trialPrayerAssociation instanceof \TrialPrayerAssociation) {
            return $this
                ->addUsingAlias(TrialTableMap::COL_ID, $trialPrayerAssociation->getTrialId(), $comparison);
        } elseif ($trialPrayerAssociation instanceof ObjectCollection) {
            return $this
                ->useTrialPrayerAssociationQuery()
                ->filterByPrimaryKeys($trialPrayerAssociation->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByTrialPrayerAssociation() only accepts arguments of type \TrialPrayerAssociation or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the TrialPrayerAssociation relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildTrialQuery The current query, for fluid interface
     */
    public function joinTrialPrayerAssociation($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('TrialPrayerAssociation');

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
            $this->addJoinObject($join, 'TrialPrayerAssociation');
        }

        return $this;
    }

    /**
     * Use the TrialPrayerAssociation relation TrialPrayerAssociation object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \TrialPrayerAssociationQuery A secondary query class using the current class as primary query
     */
    public function useTrialPrayerAssociationQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinTrialPrayerAssociation($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'TrialPrayerAssociation', '\TrialPrayerAssociationQuery');
    }

    /**
     * Filter the query by a related \TrialPainRatingAssociation object
     *
     * @param \TrialPainRatingAssociation|ObjectCollection $trialPainRatingAssociation the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildTrialQuery The current query, for fluid interface
     */
    public function filterByTrialPainRatingAssociation($trialPainRatingAssociation, $comparison = null)
    {
        if ($trialPainRatingAssociation instanceof \TrialPainRatingAssociation) {
            return $this
                ->addUsingAlias(TrialTableMap::COL_ID, $trialPainRatingAssociation->getTrialId(), $comparison);
        } elseif ($trialPainRatingAssociation instanceof ObjectCollection) {
            return $this
                ->useTrialPainRatingAssociationQuery()
                ->filterByPrimaryKeys($trialPainRatingAssociation->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByTrialPainRatingAssociation() only accepts arguments of type \TrialPainRatingAssociation or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the TrialPainRatingAssociation relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildTrialQuery The current query, for fluid interface
     */
    public function joinTrialPainRatingAssociation($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('TrialPainRatingAssociation');

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
            $this->addJoinObject($join, 'TrialPainRatingAssociation');
        }

        return $this;
    }

    /**
     * Use the TrialPainRatingAssociation relation TrialPainRatingAssociation object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \TrialPainRatingAssociationQuery A secondary query class using the current class as primary query
     */
    public function useTrialPainRatingAssociationQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinTrialPainRatingAssociation($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'TrialPainRatingAssociation', '\TrialPainRatingAssociationQuery');
    }

    /**
     * Filter the query by a related Prayer object
     * using the trialsXprayers table as cross reference
     *
     * @param Prayer $prayer the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildTrialQuery The current query, for fluid interface
     */
    public function filterByPrayer($prayer, $comparison = Criteria::EQUAL)
    {
        return $this
            ->useTrialPrayerAssociationQuery()
            ->filterByPrayer($prayer, $comparison)
            ->endUse();
    }

    /**
     * Filter the query by a related PainAssessmentItem object
     * using the trialsXpain_items table as cross reference
     *
     * @param PainAssessmentItem $painAssessmentItem the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildTrialQuery The current query, for fluid interface
     */
    public function filterByPainAssessmentItem($painAssessmentItem, $comparison = Criteria::EQUAL)
    {
        return $this
            ->useTrialPainRatingAssociationQuery()
            ->filterByPainAssessmentItem($painAssessmentItem, $comparison)
            ->endUse();
    }

    /**
     * Exclude object from result
     *
     * @param   ChildTrial $trial Object to remove from the list of results
     *
     * @return $this|ChildTrialQuery The current query, for fluid interface
     */
    public function prune($trial = null)
    {
        if ($trial) {
            $this->addUsingAlias(TrialTableMap::COL_ID, $trial->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the trials table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(TrialTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            TrialTableMap::clearInstancePool();
            TrialTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(TrialTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(TrialTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            TrialTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            TrialTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

    // timestampable behavior

    /**
     * Filter by the latest updated
     *
     * @param      int $nbDays Maximum age of the latest update in days
     *
     * @return     $this|ChildTrialQuery The current query, for fluid interface
     */
    public function recentlyUpdated($nbDays = 7)
    {
        return $this->addUsingAlias(TrialTableMap::COL_UPDATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);
    }

    /**
     * Order by update date desc
     *
     * @return     $this|ChildTrialQuery The current query, for fluid interface
     */
    public function lastUpdatedFirst()
    {
        return $this->addDescendingOrderByColumn(TrialTableMap::COL_UPDATED_AT);
    }

    /**
     * Order by update date asc
     *
     * @return     $this|ChildTrialQuery The current query, for fluid interface
     */
    public function firstUpdatedFirst()
    {
        return $this->addAscendingOrderByColumn(TrialTableMap::COL_UPDATED_AT);
    }

    /**
     * Order by create date desc
     *
     * @return     $this|ChildTrialQuery The current query, for fluid interface
     */
    public function lastCreatedFirst()
    {
        return $this->addDescendingOrderByColumn(TrialTableMap::COL_CREATED_AT);
    }

    /**
     * Filter by the latest created
     *
     * @param      int $nbDays Maximum age of in days
     *
     * @return     $this|ChildTrialQuery The current query, for fluid interface
     */
    public function recentlyCreated($nbDays = 7)
    {
        return $this->addUsingAlias(TrialTableMap::COL_CREATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);
    }

    /**
     * Order by create date asc
     *
     * @return     $this|ChildTrialQuery The current query, for fluid interface
     */
    public function firstCreatedFirst()
    {
        return $this->addAscendingOrderByColumn(TrialTableMap::COL_CREATED_AT);
    }

} // TrialQuery
