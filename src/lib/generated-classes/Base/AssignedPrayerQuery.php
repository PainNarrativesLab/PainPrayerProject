<?php

namespace Base;

use \AssignedPrayer as ChildAssignedPrayer;
use \AssignedPrayerQuery as ChildAssignedPrayerQuery;
use \Exception;
use \PDO;
use Map\AssignedPrayerTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'assigned_prayer' table.
 *
 *
 *
 * @method     ChildAssignedPrayerQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildAssignedPrayerQuery orderByAgentId($order = Criteria::ASC) Order by the agent_id column
 * @method     ChildAssignedPrayerQuery orderByPatientId($order = Criteria::ASC) Order by the patient_id column
 * @method     ChildAssignedPrayerQuery orderByPrayerDate($order = Criteria::ASC) Order by the prayer_date column
 * @method     ChildAssignedPrayerQuery orderByAssignmenthash($order = Criteria::ASC) Order by the assignmentHash column
 * @method     ChildAssignedPrayerQuery orderByComplete($order = Criteria::ASC) Order by the complete column
 * @method     ChildAssignedPrayerQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ChildAssignedPrayerQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 *
 * @method     ChildAssignedPrayerQuery groupById() Group by the id column
 * @method     ChildAssignedPrayerQuery groupByAgentId() Group by the agent_id column
 * @method     ChildAssignedPrayerQuery groupByPatientId() Group by the patient_id column
 * @method     ChildAssignedPrayerQuery groupByPrayerDate() Group by the prayer_date column
 * @method     ChildAssignedPrayerQuery groupByAssignmenthash() Group by the assignmentHash column
 * @method     ChildAssignedPrayerQuery groupByComplete() Group by the complete column
 * @method     ChildAssignedPrayerQuery groupByCreatedAt() Group by the created_at column
 * @method     ChildAssignedPrayerQuery groupByUpdatedAt() Group by the updated_at column
 *
 * @method     ChildAssignedPrayerQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildAssignedPrayerQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildAssignedPrayerQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildAssignedPrayerQuery leftJoinAgent($relationAlias = null) Adds a LEFT JOIN clause to the query using the Agent relation
 * @method     ChildAssignedPrayerQuery rightJoinAgent($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Agent relation
 * @method     ChildAssignedPrayerQuery innerJoinAgent($relationAlias = null) Adds a INNER JOIN clause to the query using the Agent relation
 *
 * @method     ChildAssignedPrayerQuery leftJoinPatient($relationAlias = null) Adds a LEFT JOIN clause to the query using the Patient relation
 * @method     ChildAssignedPrayerQuery rightJoinPatient($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Patient relation
 * @method     ChildAssignedPrayerQuery innerJoinPatient($relationAlias = null) Adds a INNER JOIN clause to the query using the Patient relation
 *
 * @method     \UserQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildAssignedPrayer findOne(ConnectionInterface $con = null) Return the first ChildAssignedPrayer matching the query
 * @method     ChildAssignedPrayer findOneOrCreate(ConnectionInterface $con = null) Return the first ChildAssignedPrayer matching the query, or a new ChildAssignedPrayer object populated from the query conditions when no match is found
 *
 * @method     ChildAssignedPrayer findOneById(int $id) Return the first ChildAssignedPrayer filtered by the id column
 * @method     ChildAssignedPrayer findOneByAgentId(int $agent_id) Return the first ChildAssignedPrayer filtered by the agent_id column
 * @method     ChildAssignedPrayer findOneByPatientId(int $patient_id) Return the first ChildAssignedPrayer filtered by the patient_id column
 * @method     ChildAssignedPrayer findOneByPrayerDate(string $prayer_date) Return the first ChildAssignedPrayer filtered by the prayer_date column
 * @method     ChildAssignedPrayer findOneByAssignmenthash(string $assignmentHash) Return the first ChildAssignedPrayer filtered by the assignmentHash column
 * @method     ChildAssignedPrayer findOneByComplete(boolean $complete) Return the first ChildAssignedPrayer filtered by the complete column
 * @method     ChildAssignedPrayer findOneByCreatedAt(string $created_at) Return the first ChildAssignedPrayer filtered by the created_at column
 * @method     ChildAssignedPrayer findOneByUpdatedAt(string $updated_at) Return the first ChildAssignedPrayer filtered by the updated_at column *

 * @method     ChildAssignedPrayer requirePk($key, ConnectionInterface $con = null) Return the ChildAssignedPrayer by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAssignedPrayer requireOne(ConnectionInterface $con = null) Return the first ChildAssignedPrayer matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildAssignedPrayer requireOneById(int $id) Return the first ChildAssignedPrayer filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAssignedPrayer requireOneByAgentId(int $agent_id) Return the first ChildAssignedPrayer filtered by the agent_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAssignedPrayer requireOneByPatientId(int $patient_id) Return the first ChildAssignedPrayer filtered by the patient_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAssignedPrayer requireOneByPrayerDate(string $prayer_date) Return the first ChildAssignedPrayer filtered by the prayer_date column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAssignedPrayer requireOneByAssignmenthash(string $assignmentHash) Return the first ChildAssignedPrayer filtered by the assignmentHash column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAssignedPrayer requireOneByComplete(boolean $complete) Return the first ChildAssignedPrayer filtered by the complete column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAssignedPrayer requireOneByCreatedAt(string $created_at) Return the first ChildAssignedPrayer filtered by the created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAssignedPrayer requireOneByUpdatedAt(string $updated_at) Return the first ChildAssignedPrayer filtered by the updated_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildAssignedPrayer[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildAssignedPrayer objects based on current ModelCriteria
 * @method     ChildAssignedPrayer[]|ObjectCollection findById(int $id) Return ChildAssignedPrayer objects filtered by the id column
 * @method     ChildAssignedPrayer[]|ObjectCollection findByAgentId(int $agent_id) Return ChildAssignedPrayer objects filtered by the agent_id column
 * @method     ChildAssignedPrayer[]|ObjectCollection findByPatientId(int $patient_id) Return ChildAssignedPrayer objects filtered by the patient_id column
 * @method     ChildAssignedPrayer[]|ObjectCollection findByPrayerDate(string $prayer_date) Return ChildAssignedPrayer objects filtered by the prayer_date column
 * @method     ChildAssignedPrayer[]|ObjectCollection findByAssignmenthash(string $assignmentHash) Return ChildAssignedPrayer objects filtered by the assignmentHash column
 * @method     ChildAssignedPrayer[]|ObjectCollection findByComplete(boolean $complete) Return ChildAssignedPrayer objects filtered by the complete column
 * @method     ChildAssignedPrayer[]|ObjectCollection findByCreatedAt(string $created_at) Return ChildAssignedPrayer objects filtered by the created_at column
 * @method     ChildAssignedPrayer[]|ObjectCollection findByUpdatedAt(string $updated_at) Return ChildAssignedPrayer objects filtered by the updated_at column
 * @method     ChildAssignedPrayer[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class AssignedPrayerQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\AssignedPrayerQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'main', $modelName = '\\AssignedPrayer', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildAssignedPrayerQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildAssignedPrayerQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildAssignedPrayerQuery) {
            return $criteria;
        }
        $query = new ChildAssignedPrayerQuery();
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
     * @return ChildAssignedPrayer|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = AssignedPrayerTableMap::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(AssignedPrayerTableMap::DATABASE_NAME);
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
     * @return ChildAssignedPrayer A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, agent_id, patient_id, prayer_date, assignmentHash, complete, created_at, updated_at FROM assigned_prayer WHERE id = :p0';
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
            /** @var ChildAssignedPrayer $obj */
            $obj = new ChildAssignedPrayer();
            $obj->hydrate($row);
            AssignedPrayerTableMap::addInstanceToPool($obj, (string) $key);
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
     * @return ChildAssignedPrayer|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildAssignedPrayerQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(AssignedPrayerTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildAssignedPrayerQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(AssignedPrayerTableMap::COL_ID, $keys, Criteria::IN);
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
     * @return $this|ChildAssignedPrayerQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(AssignedPrayerTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(AssignedPrayerTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(AssignedPrayerTableMap::COL_ID, $id, $comparison);
    }

    /**
     * Filter the query on the agent_id column
     *
     * Example usage:
     * <code>
     * $query->filterByAgentId(1234); // WHERE agent_id = 1234
     * $query->filterByAgentId(array(12, 34)); // WHERE agent_id IN (12, 34)
     * $query->filterByAgentId(array('min' => 12)); // WHERE agent_id > 12
     * </code>
     *
     * @see       filterByAgent()
     *
     * @param     mixed $agentId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildAssignedPrayerQuery The current query, for fluid interface
     */
    public function filterByAgentId($agentId = null, $comparison = null)
    {
        if (is_array($agentId)) {
            $useMinMax = false;
            if (isset($agentId['min'])) {
                $this->addUsingAlias(AssignedPrayerTableMap::COL_AGENT_ID, $agentId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($agentId['max'])) {
                $this->addUsingAlias(AssignedPrayerTableMap::COL_AGENT_ID, $agentId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(AssignedPrayerTableMap::COL_AGENT_ID, $agentId, $comparison);
    }

    /**
     * Filter the query on the patient_id column
     *
     * Example usage:
     * <code>
     * $query->filterByPatientId(1234); // WHERE patient_id = 1234
     * $query->filterByPatientId(array(12, 34)); // WHERE patient_id IN (12, 34)
     * $query->filterByPatientId(array('min' => 12)); // WHERE patient_id > 12
     * </code>
     *
     * @see       filterByPatient()
     *
     * @param     mixed $patientId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildAssignedPrayerQuery The current query, for fluid interface
     */
    public function filterByPatientId($patientId = null, $comparison = null)
    {
        if (is_array($patientId)) {
            $useMinMax = false;
            if (isset($patientId['min'])) {
                $this->addUsingAlias(AssignedPrayerTableMap::COL_PATIENT_ID, $patientId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($patientId['max'])) {
                $this->addUsingAlias(AssignedPrayerTableMap::COL_PATIENT_ID, $patientId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(AssignedPrayerTableMap::COL_PATIENT_ID, $patientId, $comparison);
    }

    /**
     * Filter the query on the prayer_date column
     *
     * Example usage:
     * <code>
     * $query->filterByPrayerDate('2011-03-14'); // WHERE prayer_date = '2011-03-14'
     * $query->filterByPrayerDate('now'); // WHERE prayer_date = '2011-03-14'
     * $query->filterByPrayerDate(array('max' => 'yesterday')); // WHERE prayer_date > '2011-03-13'
     * </code>
     *
     * @param     mixed $prayerDate The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildAssignedPrayerQuery The current query, for fluid interface
     */
    public function filterByPrayerDate($prayerDate = null, $comparison = null)
    {
        if (is_array($prayerDate)) {
            $useMinMax = false;
            if (isset($prayerDate['min'])) {
                $this->addUsingAlias(AssignedPrayerTableMap::COL_PRAYER_DATE, $prayerDate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($prayerDate['max'])) {
                $this->addUsingAlias(AssignedPrayerTableMap::COL_PRAYER_DATE, $prayerDate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(AssignedPrayerTableMap::COL_PRAYER_DATE, $prayerDate, $comparison);
    }

    /**
     * Filter the query on the assignmentHash column
     *
     * Example usage:
     * <code>
     * $query->filterByAssignmenthash('fooValue');   // WHERE assignmentHash = 'fooValue'
     * $query->filterByAssignmenthash('%fooValue%'); // WHERE assignmentHash LIKE '%fooValue%'
     * </code>
     *
     * @param     string $assignmenthash The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildAssignedPrayerQuery The current query, for fluid interface
     */
    public function filterByAssignmenthash($assignmenthash = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($assignmenthash)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $assignmenthash)) {
                $assignmenthash = str_replace('*', '%', $assignmenthash);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(AssignedPrayerTableMap::COL_ASSIGNMENTHASH, $assignmenthash, $comparison);
    }

    /**
     * Filter the query on the complete column
     *
     * Example usage:
     * <code>
     * $query->filterByComplete(true); // WHERE complete = true
     * $query->filterByComplete('yes'); // WHERE complete = true
     * </code>
     *
     * @param     boolean|string $complete The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildAssignedPrayerQuery The current query, for fluid interface
     */
    public function filterByComplete($complete = null, $comparison = null)
    {
        if (is_string($complete)) {
            $complete = in_array(strtolower($complete), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(AssignedPrayerTableMap::COL_COMPLETE, $complete, $comparison);
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
     * @return $this|ChildAssignedPrayerQuery The current query, for fluid interface
     */
    public function filterByCreatedAt($createdAt = null, $comparison = null)
    {
        if (is_array($createdAt)) {
            $useMinMax = false;
            if (isset($createdAt['min'])) {
                $this->addUsingAlias(AssignedPrayerTableMap::COL_CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(AssignedPrayerTableMap::COL_CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(AssignedPrayerTableMap::COL_CREATED_AT, $createdAt, $comparison);
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
     * @return $this|ChildAssignedPrayerQuery The current query, for fluid interface
     */
    public function filterByUpdatedAt($updatedAt = null, $comparison = null)
    {
        if (is_array($updatedAt)) {
            $useMinMax = false;
            if (isset($updatedAt['min'])) {
                $this->addUsingAlias(AssignedPrayerTableMap::COL_UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(AssignedPrayerTableMap::COL_UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(AssignedPrayerTableMap::COL_UPDATED_AT, $updatedAt, $comparison);
    }

    /**
     * Filter the query by a related \User object
     *
     * @param \User|ObjectCollection $user The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildAssignedPrayerQuery The current query, for fluid interface
     */
    public function filterByAgent($user, $comparison = null)
    {
        if ($user instanceof \User) {
            return $this
                ->addUsingAlias(AssignedPrayerTableMap::COL_AGENT_ID, $user->getId(), $comparison);
        } elseif ($user instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(AssignedPrayerTableMap::COL_AGENT_ID, $user->toKeyValue('Id', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByAgent() only accepts arguments of type \User or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Agent relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildAssignedPrayerQuery The current query, for fluid interface
     */
    public function joinAgent($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Agent');

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
            $this->addJoinObject($join, 'Agent');
        }

        return $this;
    }

    /**
     * Use the Agent relation User object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \UserQuery A secondary query class using the current class as primary query
     */
    public function useAgentQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinAgent($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Agent', '\UserQuery');
    }

    /**
     * Filter the query by a related \User object
     *
     * @param \User|ObjectCollection $user The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildAssignedPrayerQuery The current query, for fluid interface
     */
    public function filterByPatient($user, $comparison = null)
    {
        if ($user instanceof \User) {
            return $this
                ->addUsingAlias(AssignedPrayerTableMap::COL_PATIENT_ID, $user->getId(), $comparison);
        } elseif ($user instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(AssignedPrayerTableMap::COL_PATIENT_ID, $user->toKeyValue('Id', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByPatient() only accepts arguments of type \User or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Patient relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildAssignedPrayerQuery The current query, for fluid interface
     */
    public function joinPatient($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Patient');

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
            $this->addJoinObject($join, 'Patient');
        }

        return $this;
    }

    /**
     * Use the Patient relation User object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \UserQuery A secondary query class using the current class as primary query
     */
    public function usePatientQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinPatient($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Patient', '\UserQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildAssignedPrayer $assignedPrayer Object to remove from the list of results
     *
     * @return $this|ChildAssignedPrayerQuery The current query, for fluid interface
     */
    public function prune($assignedPrayer = null)
    {
        if ($assignedPrayer) {
            $this->addUsingAlias(AssignedPrayerTableMap::COL_ID, $assignedPrayer->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the assigned_prayer table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(AssignedPrayerTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            AssignedPrayerTableMap::clearInstancePool();
            AssignedPrayerTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(AssignedPrayerTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(AssignedPrayerTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            AssignedPrayerTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            AssignedPrayerTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

    // timestampable behavior

    /**
     * Filter by the latest updated
     *
     * @param      int $nbDays Maximum age of the latest update in days
     *
     * @return     $this|ChildAssignedPrayerQuery The current query, for fluid interface
     */
    public function recentlyUpdated($nbDays = 7)
    {
        return $this->addUsingAlias(AssignedPrayerTableMap::COL_UPDATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);
    }

    /**
     * Order by update date desc
     *
     * @return     $this|ChildAssignedPrayerQuery The current query, for fluid interface
     */
    public function lastUpdatedFirst()
    {
        return $this->addDescendingOrderByColumn(AssignedPrayerTableMap::COL_UPDATED_AT);
    }

    /**
     * Order by update date asc
     *
     * @return     $this|ChildAssignedPrayerQuery The current query, for fluid interface
     */
    public function firstUpdatedFirst()
    {
        return $this->addAscendingOrderByColumn(AssignedPrayerTableMap::COL_UPDATED_AT);
    }

    /**
     * Order by create date desc
     *
     * @return     $this|ChildAssignedPrayerQuery The current query, for fluid interface
     */
    public function lastCreatedFirst()
    {
        return $this->addDescendingOrderByColumn(AssignedPrayerTableMap::COL_CREATED_AT);
    }

    /**
     * Filter by the latest created
     *
     * @param      int $nbDays Maximum age of in days
     *
     * @return     $this|ChildAssignedPrayerQuery The current query, for fluid interface
     */
    public function recentlyCreated($nbDays = 7)
    {
        return $this->addUsingAlias(AssignedPrayerTableMap::COL_CREATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);
    }

    /**
     * Order by create date asc
     *
     * @return     $this|ChildAssignedPrayerQuery The current query, for fluid interface
     */
    public function firstCreatedFirst()
    {
        return $this->addAscendingOrderByColumn(AssignedPrayerTableMap::COL_CREATED_AT);
    }

} // AssignedPrayerQuery
