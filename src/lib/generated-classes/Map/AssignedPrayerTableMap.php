<?php

namespace Map;

use \AssignedPrayer;
use \AssignedPrayerQuery;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\InstancePoolTrait;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\DataFetcher\DataFetcherInterface;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Map\RelationMap;
use Propel\Runtime\Map\TableMap;
use Propel\Runtime\Map\TableMapTrait;


/**
 * This class defines the structure of the 'assigned_prayer' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 */
class AssignedPrayerTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = '.Map.AssignedPrayerTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'main';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'assigned_prayer';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\AssignedPrayer';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'AssignedPrayer';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 7;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 7;

    /**
     * the column name for the id field
     */
    const COL_ID = 'assigned_prayer.id';

    /**
     * the column name for the prayer_date field
     */
    const COL_PRAYER_DATE = 'assigned_prayer.prayer_date';

    /**
     * the column name for the agent_id field
     */
    const COL_AGENT_ID = 'assigned_prayer.agent_id';

    /**
     * the column name for the patient_id field
     */
    const COL_PATIENT_ID = 'assigned_prayer.patient_id';

    /**
     * the column name for the complete field
     */
    const COL_COMPLETE = 'assigned_prayer.complete';

    /**
     * the column name for the created_at field
     */
    const COL_CREATED_AT = 'assigned_prayer.created_at';

    /**
     * the column name for the updated_at field
     */
    const COL_UPDATED_AT = 'assigned_prayer.updated_at';

    /**
     * The default string format for model objects of the related table
     */
    const DEFAULT_STRING_FORMAT = 'YAML';

    /**
     * holds an array of fieldnames
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldNames[self::TYPE_PHPNAME][0] = 'Id'
     */
    protected static $fieldNames = array (
        self::TYPE_PHPNAME       => array('Id', 'PrayerDate', 'AgentId', 'PatientId', 'Complete', 'CreatedAt', 'UpdatedAt', ),
        self::TYPE_CAMELNAME     => array('id', 'prayerDate', 'agentId', 'patientId', 'complete', 'createdAt', 'updatedAt', ),
        self::TYPE_COLNAME       => array(AssignedPrayerTableMap::COL_ID, AssignedPrayerTableMap::COL_PRAYER_DATE, AssignedPrayerTableMap::COL_AGENT_ID, AssignedPrayerTableMap::COL_PATIENT_ID, AssignedPrayerTableMap::COL_COMPLETE, AssignedPrayerTableMap::COL_CREATED_AT, AssignedPrayerTableMap::COL_UPDATED_AT, ),
        self::TYPE_FIELDNAME     => array('id', 'prayer_date', 'agent_id', 'patient_id', 'complete', 'created_at', 'updated_at', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('Id' => 0, 'PrayerDate' => 1, 'AgentId' => 2, 'PatientId' => 3, 'Complete' => 4, 'CreatedAt' => 5, 'UpdatedAt' => 6, ),
        self::TYPE_CAMELNAME     => array('id' => 0, 'prayerDate' => 1, 'agentId' => 2, 'patientId' => 3, 'complete' => 4, 'createdAt' => 5, 'updatedAt' => 6, ),
        self::TYPE_COLNAME       => array(AssignedPrayerTableMap::COL_ID => 0, AssignedPrayerTableMap::COL_PRAYER_DATE => 1, AssignedPrayerTableMap::COL_AGENT_ID => 2, AssignedPrayerTableMap::COL_PATIENT_ID => 3, AssignedPrayerTableMap::COL_COMPLETE => 4, AssignedPrayerTableMap::COL_CREATED_AT => 5, AssignedPrayerTableMap::COL_UPDATED_AT => 6, ),
        self::TYPE_FIELDNAME     => array('id' => 0, 'prayer_date' => 1, 'agent_id' => 2, 'patient_id' => 3, 'complete' => 4, 'created_at' => 5, 'updated_at' => 6, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, )
    );

    /**
     * Initialize the table attributes and columns
     * Relations are not initialized by this method since they are lazy loaded
     *
     * @return void
     * @throws PropelException
     */
    public function initialize()
    {
        // attributes
        $this->setName('assigned_prayer');
        $this->setPhpName('AssignedPrayer');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\AssignedPrayer');
        $this->setPackage('');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, null, null);
        $this->addColumn('prayer_date', 'PrayerDate', 'DATE', true, null, null);
        $this->addForeignKey('agent_id', 'AgentId', 'INTEGER', 'users', 'id', true, null, null);
        $this->addForeignKey('patient_id', 'PatientId', 'INTEGER', 'users', 'id', true, null, null);
        $this->addColumn('complete', 'Complete', 'BOOLEAN', false, 1, false);
        $this->addColumn('created_at', 'CreatedAt', 'TIMESTAMP', false, null, null);
        $this->addColumn('updated_at', 'UpdatedAt', 'TIMESTAMP', false, null, null);
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('agent', '\\User', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':agent_id',
    1 => ':id',
  ),
), null, null, null, false);
        $this->addRelation('patient', '\\User', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':patient_id',
    1 => ':id',
  ),
), null, null, null, false);
    } // buildRelations()

    /**
     *
     * Gets the list of behaviors registered for this table
     *
     * @return array Associative array (name => parameters) of behaviors
     */
    public function getBehaviors()
    {
        return array(
            'timestampable' => array('create_column' => 'created_at', 'update_column' => 'updated_at', 'disable_created_at' => 'false', 'disable_updated_at' => 'false', ),
        );
    } // getBehaviors()

    /**
     * Retrieves a string version of the primary key from the DB resultset row that can be used to uniquely identify a row in this table.
     *
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, a serialize()d version of the primary key will be returned.
     *
     * @param array  $row       resultset row.
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM
     *
     * @return string The primary key hash of the row
     */
    public static function getPrimaryKeyHashFromRow($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        // If the PK cannot be derived from the row, return NULL.
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)];
    }

    /**
     * Retrieves the primary key from the DB resultset row
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, an array of the primary key columns will be returned.
     *
     * @param array  $row       resultset row.
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM
     *
     * @return mixed The primary key of the row
     */
    public static function getPrimaryKeyFromRow($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        return (int) $row[
            $indexType == TableMap::TYPE_NUM
                ? 0 + $offset
                : self::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)
        ];
    }

    /**
     * The class that the tableMap will make instances of.
     *
     * If $withPrefix is true, the returned path
     * uses a dot-path notation which is translated into a path
     * relative to a location on the PHP include_path.
     * (e.g. path.to.MyClass -> 'path/to/MyClass.php')
     *
     * @param boolean $withPrefix Whether or not to return the path with the class name
     * @return string path.to.ClassName
     */
    public static function getOMClass($withPrefix = true)
    {
        return $withPrefix ? AssignedPrayerTableMap::CLASS_DEFAULT : AssignedPrayerTableMap::OM_CLASS;
    }

    /**
     * Populates an object of the default type or an object that inherit from the default.
     *
     * @param array  $row       row returned by DataFetcher->fetch().
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType The index type of $row. Mostly DataFetcher->getIndexType().
                                 One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     * @return array           (AssignedPrayer object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = AssignedPrayerTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = AssignedPrayerTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + AssignedPrayerTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = AssignedPrayerTableMap::OM_CLASS;
            /** @var AssignedPrayer $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            AssignedPrayerTableMap::addInstanceToPool($obj, $key);
        }

        return array($obj, $col);
    }

    /**
     * The returned array will contain objects of the default type or
     * objects that inherit from the default.
     *
     * @param DataFetcherInterface $dataFetcher
     * @return array
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function populateObjects(DataFetcherInterface $dataFetcher)
    {
        $results = array();

        // set the class once to avoid overhead in the loop
        $cls = static::getOMClass(false);
        // populate the object(s)
        while ($row = $dataFetcher->fetch()) {
            $key = AssignedPrayerTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = AssignedPrayerTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var AssignedPrayer $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                AssignedPrayerTableMap::addInstanceToPool($obj, $key);
            } // if key exists
        }

        return $results;
    }
    /**
     * Add all the columns needed to create a new object.
     *
     * Note: any columns that were marked with lazyLoad="true" in the
     * XML schema will not be added to the select list and only loaded
     * on demand.
     *
     * @param Criteria $criteria object containing the columns to add.
     * @param string   $alias    optional table alias
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function addSelectColumns(Criteria $criteria, $alias = null)
    {
        if (null === $alias) {
            $criteria->addSelectColumn(AssignedPrayerTableMap::COL_ID);
            $criteria->addSelectColumn(AssignedPrayerTableMap::COL_PRAYER_DATE);
            $criteria->addSelectColumn(AssignedPrayerTableMap::COL_AGENT_ID);
            $criteria->addSelectColumn(AssignedPrayerTableMap::COL_PATIENT_ID);
            $criteria->addSelectColumn(AssignedPrayerTableMap::COL_COMPLETE);
            $criteria->addSelectColumn(AssignedPrayerTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(AssignedPrayerTableMap::COL_UPDATED_AT);
        } else {
            $criteria->addSelectColumn($alias . '.id');
            $criteria->addSelectColumn($alias . '.prayer_date');
            $criteria->addSelectColumn($alias . '.agent_id');
            $criteria->addSelectColumn($alias . '.patient_id');
            $criteria->addSelectColumn($alias . '.complete');
            $criteria->addSelectColumn($alias . '.created_at');
            $criteria->addSelectColumn($alias . '.updated_at');
        }
    }

    /**
     * Returns the TableMap related to this object.
     * This method is not needed for general use but a specific application could have a need.
     * @return TableMap
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function getTableMap()
    {
        return Propel::getServiceContainer()->getDatabaseMap(AssignedPrayerTableMap::DATABASE_NAME)->getTable(AssignedPrayerTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(AssignedPrayerTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(AssignedPrayerTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new AssignedPrayerTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a AssignedPrayer or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or AssignedPrayer object or primary key or array of primary keys
     *              which is used to create the DELETE statement
     * @param  ConnectionInterface $con the connection to use
     * @return int             The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                         if supported by native driver or if emulated using Propel.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
     public static function doDelete($values, ConnectionInterface $con = null)
     {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(AssignedPrayerTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \AssignedPrayer) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(AssignedPrayerTableMap::DATABASE_NAME);
            $criteria->add(AssignedPrayerTableMap::COL_ID, (array) $values, Criteria::IN);
        }

        $query = AssignedPrayerQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            AssignedPrayerTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                AssignedPrayerTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the assigned_prayer table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return AssignedPrayerQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a AssignedPrayer or Criteria object.
     *
     * @param mixed               $criteria Criteria or AssignedPrayer object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(AssignedPrayerTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from AssignedPrayer object
        }

        if ($criteria->containsKey(AssignedPrayerTableMap::COL_ID) && $criteria->keyContainsValue(AssignedPrayerTableMap::COL_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.AssignedPrayerTableMap::COL_ID.')');
        }


        // Set the correct dbName
        $query = AssignedPrayerQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // AssignedPrayerTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
AssignedPrayerTableMap::buildTableMap();