<?php

namespace Base;

use \UserEthnicity as ChildUserEthnicity;
use \UserEthnicityQuery as ChildUserEthnicityQuery;
use \Exception;
use Map\UserEthnicityTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\LogicException;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'user_ethnicities' table.
 *
 *
 *
 * @method     ChildUserEthnicityQuery orderByUserId($order = Criteria::ASC) Order by the user_id column
 * @method     ChildUserEthnicityQuery orderByEthnicity($order = Criteria::ASC) Order by the ethnicity column
 * @method     ChildUserEthnicityQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ChildUserEthnicityQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 *
 * @method     ChildUserEthnicityQuery groupByUserId() Group by the user_id column
 * @method     ChildUserEthnicityQuery groupByEthnicity() Group by the ethnicity column
 * @method     ChildUserEthnicityQuery groupByCreatedAt() Group by the created_at column
 * @method     ChildUserEthnicityQuery groupByUpdatedAt() Group by the updated_at column
 *
 * @method     ChildUserEthnicityQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildUserEthnicityQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildUserEthnicityQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildUserEthnicityQuery leftJoinUser($relationAlias = null) Adds a LEFT JOIN clause to the query using the User relation
 * @method     ChildUserEthnicityQuery rightJoinUser($relationAlias = null) Adds a RIGHT JOIN clause to the query using the User relation
 * @method     ChildUserEthnicityQuery innerJoinUser($relationAlias = null) Adds a INNER JOIN clause to the query using the User relation
 *
 * @method     ChildUserEthnicityQuery leftJoinuserEthnicity($relationAlias = null) Adds a LEFT JOIN clause to the query using the userEthnicity relation
 * @method     ChildUserEthnicityQuery rightJoinuserEthnicity($relationAlias = null) Adds a RIGHT JOIN clause to the query using the userEthnicity relation
 * @method     ChildUserEthnicityQuery innerJoinuserEthnicity($relationAlias = null) Adds a INNER JOIN clause to the query using the userEthnicity relation
 *
 * @method     \UserQuery|\EthnicityQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildUserEthnicity findOne(ConnectionInterface $con = null) Return the first ChildUserEthnicity matching the query
 * @method     ChildUserEthnicity findOneOrCreate(ConnectionInterface $con = null) Return the first ChildUserEthnicity matching the query, or a new ChildUserEthnicity object populated from the query conditions when no match is found
 *
 * @method     ChildUserEthnicity findOneByUserId(int $user_id) Return the first ChildUserEthnicity filtered by the user_id column
 * @method     ChildUserEthnicity findOneByEthnicity(string $ethnicity) Return the first ChildUserEthnicity filtered by the ethnicity column
 * @method     ChildUserEthnicity findOneByCreatedAt(string $created_at) Return the first ChildUserEthnicity filtered by the created_at column
 * @method     ChildUserEthnicity findOneByUpdatedAt(string $updated_at) Return the first ChildUserEthnicity filtered by the updated_at column *

 * @method     ChildUserEthnicity requirePk($key, ConnectionInterface $con = null) Return the ChildUserEthnicity by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUserEthnicity requireOne(ConnectionInterface $con = null) Return the first ChildUserEthnicity matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildUserEthnicity requireOneByUserId(int $user_id) Return the first ChildUserEthnicity filtered by the user_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUserEthnicity requireOneByEthnicity(string $ethnicity) Return the first ChildUserEthnicity filtered by the ethnicity column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUserEthnicity requireOneByCreatedAt(string $created_at) Return the first ChildUserEthnicity filtered by the created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUserEthnicity requireOneByUpdatedAt(string $updated_at) Return the first ChildUserEthnicity filtered by the updated_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildUserEthnicity[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildUserEthnicity objects based on current ModelCriteria
 * @method     ChildUserEthnicity[]|ObjectCollection findByUserId(int $user_id) Return ChildUserEthnicity objects filtered by the user_id column
 * @method     ChildUserEthnicity[]|ObjectCollection findByEthnicity(string $ethnicity) Return ChildUserEthnicity objects filtered by the ethnicity column
 * @method     ChildUserEthnicity[]|ObjectCollection findByCreatedAt(string $created_at) Return ChildUserEthnicity objects filtered by the created_at column
 * @method     ChildUserEthnicity[]|ObjectCollection findByUpdatedAt(string $updated_at) Return ChildUserEthnicity objects filtered by the updated_at column
 * @method     ChildUserEthnicity[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class UserEthnicityQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\UserEthnicityQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'main', $modelName = '\\UserEthnicity', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildUserEthnicityQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildUserEthnicityQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildUserEthnicityQuery) {
            return $criteria;
        }
        $query = new ChildUserEthnicityQuery();
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
     * @return ChildUserEthnicity|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        throw new LogicException('The UserEthnicity object has no primary key');
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
        throw new LogicException('The UserEthnicity object has no primary key');
    }

    /**
     * Filter the query by primary key
     *
     * @param     mixed $key Primary key to use for the query
     *
     * @return $this|ChildUserEthnicityQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {
        throw new LogicException('The UserEthnicity object has no primary key');
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildUserEthnicityQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {
        throw new LogicException('The UserEthnicity object has no primary key');
    }

    /**
     * Filter the query on the user_id column
     *
     * Example usage:
     * <code>
     * $query->filterByUserId(1234); // WHERE user_id = 1234
     * $query->filterByUserId(array(12, 34)); // WHERE user_id IN (12, 34)
     * $query->filterByUserId(array('min' => 12)); // WHERE user_id > 12
     * </code>
     *
     * @see       filterByUser()
     *
     * @param     mixed $userId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUserEthnicityQuery The current query, for fluid interface
     */
    public function filterByUserId($userId = null, $comparison = null)
    {
        if (is_array($userId)) {
            $useMinMax = false;
            if (isset($userId['min'])) {
                $this->addUsingAlias(UserEthnicityTableMap::COL_USER_ID, $userId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($userId['max'])) {
                $this->addUsingAlias(UserEthnicityTableMap::COL_USER_ID, $userId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UserEthnicityTableMap::COL_USER_ID, $userId, $comparison);
    }

    /**
     * Filter the query on the ethnicity column
     *
     * Example usage:
     * <code>
     * $query->filterByEthnicity('fooValue');   // WHERE ethnicity = 'fooValue'
     * $query->filterByEthnicity('%fooValue%'); // WHERE ethnicity LIKE '%fooValue%'
     * </code>
     *
     * @param     string $ethnicity The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUserEthnicityQuery The current query, for fluid interface
     */
    public function filterByEthnicity($ethnicity = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($ethnicity)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $ethnicity)) {
                $ethnicity = str_replace('*', '%', $ethnicity);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(UserEthnicityTableMap::COL_ETHNICITY, $ethnicity, $comparison);
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
     * @return $this|ChildUserEthnicityQuery The current query, for fluid interface
     */
    public function filterByCreatedAt($createdAt = null, $comparison = null)
    {
        if (is_array($createdAt)) {
            $useMinMax = false;
            if (isset($createdAt['min'])) {
                $this->addUsingAlias(UserEthnicityTableMap::COL_CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(UserEthnicityTableMap::COL_CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UserEthnicityTableMap::COL_CREATED_AT, $createdAt, $comparison);
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
     * @return $this|ChildUserEthnicityQuery The current query, for fluid interface
     */
    public function filterByUpdatedAt($updatedAt = null, $comparison = null)
    {
        if (is_array($updatedAt)) {
            $useMinMax = false;
            if (isset($updatedAt['min'])) {
                $this->addUsingAlias(UserEthnicityTableMap::COL_UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(UserEthnicityTableMap::COL_UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UserEthnicityTableMap::COL_UPDATED_AT, $updatedAt, $comparison);
    }

    /**
     * Filter the query by a related \User object
     *
     * @param \User|ObjectCollection $user The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildUserEthnicityQuery The current query, for fluid interface
     */
    public function filterByUser($user, $comparison = null)
    {
        if ($user instanceof \User) {
            return $this
                ->addUsingAlias(UserEthnicityTableMap::COL_USER_ID, $user->getId(), $comparison);
        } elseif ($user instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(UserEthnicityTableMap::COL_USER_ID, $user->toKeyValue('Id', 'Id'), $comparison);
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
     * @return $this|ChildUserEthnicityQuery The current query, for fluid interface
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
     * Filter the query by a related \Ethnicity object
     *
     * @param \Ethnicity|ObjectCollection $ethnicity The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildUserEthnicityQuery The current query, for fluid interface
     */
    public function filterByuserEthnicity($ethnicity, $comparison = null)
    {
        if ($ethnicity instanceof \Ethnicity) {
            return $this
                ->addUsingAlias(UserEthnicityTableMap::COL_ETHNICITY, $ethnicity->getIdentity(), $comparison);
        } elseif ($ethnicity instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(UserEthnicityTableMap::COL_ETHNICITY, $ethnicity->toKeyValue('PrimaryKey', 'Identity'), $comparison);
        } else {
            throw new PropelException('filterByuserEthnicity() only accepts arguments of type \Ethnicity or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the userEthnicity relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildUserEthnicityQuery The current query, for fluid interface
     */
    public function joinuserEthnicity($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('userEthnicity');

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
            $this->addJoinObject($join, 'userEthnicity');
        }

        return $this;
    }

    /**
     * Use the userEthnicity relation Ethnicity object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \EthnicityQuery A secondary query class using the current class as primary query
     */
    public function useuserEthnicityQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinuserEthnicity($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'userEthnicity', '\EthnicityQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildUserEthnicity $userEthnicity Object to remove from the list of results
     *
     * @return $this|ChildUserEthnicityQuery The current query, for fluid interface
     */
    public function prune($userEthnicity = null)
    {
        if ($userEthnicity) {
            throw new LogicException('UserEthnicity object has no primary key');

        }

        return $this;
    }

    /**
     * Deletes all rows from the user_ethnicities table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(UserEthnicityTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            UserEthnicityTableMap::clearInstancePool();
            UserEthnicityTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(UserEthnicityTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(UserEthnicityTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            UserEthnicityTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            UserEthnicityTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

    // timestampable behavior

    /**
     * Filter by the latest updated
     *
     * @param      int $nbDays Maximum age of the latest update in days
     *
     * @return     $this|ChildUserEthnicityQuery The current query, for fluid interface
     */
    public function recentlyUpdated($nbDays = 7)
    {
        return $this->addUsingAlias(UserEthnicityTableMap::COL_UPDATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);
    }

    /**
     * Order by update date desc
     *
     * @return     $this|ChildUserEthnicityQuery The current query, for fluid interface
     */
    public function lastUpdatedFirst()
    {
        return $this->addDescendingOrderByColumn(UserEthnicityTableMap::COL_UPDATED_AT);
    }

    /**
     * Order by update date asc
     *
     * @return     $this|ChildUserEthnicityQuery The current query, for fluid interface
     */
    public function firstUpdatedFirst()
    {
        return $this->addAscendingOrderByColumn(UserEthnicityTableMap::COL_UPDATED_AT);
    }

    /**
     * Order by create date desc
     *
     * @return     $this|ChildUserEthnicityQuery The current query, for fluid interface
     */
    public function lastCreatedFirst()
    {
        return $this->addDescendingOrderByColumn(UserEthnicityTableMap::COL_CREATED_AT);
    }

    /**
     * Filter by the latest created
     *
     * @param      int $nbDays Maximum age of in days
     *
     * @return     $this|ChildUserEthnicityQuery The current query, for fluid interface
     */
    public function recentlyCreated($nbDays = 7)
    {
        return $this->addUsingAlias(UserEthnicityTableMap::COL_CREATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);
    }

    /**
     * Order by create date asc
     *
     * @return     $this|ChildUserEthnicityQuery The current query, for fluid interface
     */
    public function firstCreatedFirst()
    {
        return $this->addAscendingOrderByColumn(UserEthnicityTableMap::COL_CREATED_AT);
    }

} // UserEthnicityQuery
