<?php

namespace Base;

use \PainAssessmentItem as ChildPainAssessmentItem;
use \PainAssessmentItemQuery as ChildPainAssessmentItemQuery;
use \Prayer as ChildPrayer;
use \PrayerQuery as ChildPrayerQuery;
use \Trial as ChildTrial;
use \TrialPainRatingAssociation as ChildTrialPainRatingAssociation;
use \TrialPainRatingAssociationQuery as ChildTrialPainRatingAssociationQuery;
use \TrialPrayerAssociation as ChildTrialPrayerAssociation;
use \TrialPrayerAssociationQuery as ChildTrialPrayerAssociationQuery;
use \TrialQuery as ChildTrialQuery;
use \DateTime;
use \Exception;
use \PDO;
use Map\TrialTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveRecord\ActiveRecordInterface;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\BadMethodCallException;
use Propel\Runtime\Exception\LogicException;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Map\TableMap;
use Propel\Runtime\Parser\AbstractParser;
use Propel\Runtime\Util\PropelDateTime;

/**
 * Base class that represents a row from the 'trials' table.
 *
 *
 *
* @package    propel.generator..Base
*/
abstract class Trial implements ActiveRecordInterface
{
    /**
     * TableMap class name
     */
    const TABLE_MAP = '\\Map\\TrialTableMap';


    /**
     * attribute to determine if this object has previously been saved.
     * @var boolean
     */
    protected $new = true;

    /**
     * attribute to determine whether this object has been deleted.
     * @var boolean
     */
    protected $deleted = false;

    /**
     * The columns that have been modified in current object.
     * Tracking modified columns allows us to only update modified columns.
     * @var array
     */
    protected $modifiedColumns = array();

    /**
     * The (virtual) columns that are added at runtime
     * The formatters can add supplementary columns based on a resultset
     * @var array
     */
    protected $virtualColumns = array();

    /**
     * The value for the id field.
     * @var        int
     */
    protected $id;

    /**
     * The value for the created_at field.
     * @var        \DateTime
     */
    protected $created_at;

    /**
     * The value for the updated_at field.
     * @var        \DateTime
     */
    protected $updated_at;

    /**
     * @var        ObjectCollection|ChildTrialPrayerAssociation[] Collection to store aggregation of ChildTrialPrayerAssociation objects.
     */
    protected $collTrialPrayerAssociations;
    protected $collTrialPrayerAssociationsPartial;

    /**
     * @var        ObjectCollection|ChildTrialPainRatingAssociation[] Collection to store aggregation of ChildTrialPainRatingAssociation objects.
     */
    protected $collTrialPainRatingAssociations;
    protected $collTrialPainRatingAssociationsPartial;

    /**
     * @var        ObjectCollection|ChildPrayer[] Cross Collection to store aggregation of ChildPrayer objects.
     */
    protected $collPrayers;

    /**
     * @var bool
     */
    protected $collPrayersPartial;

    /**
     * @var        ObjectCollection|ChildPainAssessmentItem[] Cross Collection to store aggregation of ChildPainAssessmentItem objects.
     */
    protected $collPainAssessmentItems;

    /**
     * @var bool
     */
    protected $collPainAssessmentItemsPartial;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var boolean
     */
    protected $alreadyInSave = false;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildPrayer[]
     */
    protected $prayersScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildPainAssessmentItem[]
     */
    protected $painAssessmentItemsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildTrialPrayerAssociation[]
     */
    protected $trialPrayerAssociationsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildTrialPainRatingAssociation[]
     */
    protected $trialPainRatingAssociationsScheduledForDeletion = null;

    /**
     * Initializes internal state of Base\Trial object.
     */
    public function __construct()
    {
    }

    /**
     * Returns whether the object has been modified.
     *
     * @return boolean True if the object has been modified.
     */
    public function isModified()
    {
        return !!$this->modifiedColumns;
    }

    /**
     * Has specified column been modified?
     *
     * @param  string  $col column fully qualified name (TableMap::TYPE_COLNAME), e.g. Book::AUTHOR_ID
     * @return boolean True if $col has been modified.
     */
    public function isColumnModified($col)
    {
        return $this->modifiedColumns && isset($this->modifiedColumns[$col]);
    }

    /**
     * Get the columns that have been modified in this object.
     * @return array A unique list of the modified column names for this object.
     */
    public function getModifiedColumns()
    {
        return $this->modifiedColumns ? array_keys($this->modifiedColumns) : [];
    }

    /**
     * Returns whether the object has ever been saved.  This will
     * be false, if the object was retrieved from storage or was created
     * and then saved.
     *
     * @return boolean true, if the object has never been persisted.
     */
    public function isNew()
    {
        return $this->new;
    }

    /**
     * Setter for the isNew attribute.  This method will be called
     * by Propel-generated children and objects.
     *
     * @param boolean $b the state of the object.
     */
    public function setNew($b)
    {
        $this->new = (boolean) $b;
    }

    /**
     * Whether this object has been deleted.
     * @return boolean The deleted state of this object.
     */
    public function isDeleted()
    {
        return $this->deleted;
    }

    /**
     * Specify whether this object has been deleted.
     * @param  boolean $b The deleted state of this object.
     * @return void
     */
    public function setDeleted($b)
    {
        $this->deleted = (boolean) $b;
    }

    /**
     * Sets the modified state for the object to be false.
     * @param  string $col If supplied, only the specified column is reset.
     * @return void
     */
    public function resetModified($col = null)
    {
        if (null !== $col) {
            if (isset($this->modifiedColumns[$col])) {
                unset($this->modifiedColumns[$col]);
            }
        } else {
            $this->modifiedColumns = array();
        }
    }

    /**
     * Compares this with another <code>Trial</code> instance.  If
     * <code>obj</code> is an instance of <code>Trial</code>, delegates to
     * <code>equals(Trial)</code>.  Otherwise, returns <code>false</code>.
     *
     * @param  mixed   $obj The object to compare to.
     * @return boolean Whether equal to the object specified.
     */
    public function equals($obj)
    {
        if (!$obj instanceof static) {
            return false;
        }

        if ($this === $obj) {
            return true;
        }

        if (null === $this->getPrimaryKey() || null === $obj->getPrimaryKey()) {
            return false;
        }

        return $this->getPrimaryKey() === $obj->getPrimaryKey();
    }

    /**
     * Get the associative array of the virtual columns in this object
     *
     * @return array
     */
    public function getVirtualColumns()
    {
        return $this->virtualColumns;
    }

    /**
     * Checks the existence of a virtual column in this object
     *
     * @param  string  $name The virtual column name
     * @return boolean
     */
    public function hasVirtualColumn($name)
    {
        return array_key_exists($name, $this->virtualColumns);
    }

    /**
     * Get the value of a virtual column in this object
     *
     * @param  string $name The virtual column name
     * @return mixed
     *
     * @throws PropelException
     */
    public function getVirtualColumn($name)
    {
        if (!$this->hasVirtualColumn($name)) {
            throw new PropelException(sprintf('Cannot get value of inexistent virtual column %s.', $name));
        }

        return $this->virtualColumns[$name];
    }

    /**
     * Set the value of a virtual column in this object
     *
     * @param string $name  The virtual column name
     * @param mixed  $value The value to give to the virtual column
     *
     * @return $this|Trial The current object, for fluid interface
     */
    public function setVirtualColumn($name, $value)
    {
        $this->virtualColumns[$name] = $value;

        return $this;
    }

    /**
     * Logs a message using Propel::log().
     *
     * @param  string  $msg
     * @param  int     $priority One of the Propel::LOG_* logging levels
     * @return boolean
     */
    protected function log($msg, $priority = Propel::LOG_INFO)
    {
        return Propel::log(get_class($this) . ': ' . $msg, $priority);
    }

    /**
     * Export the current object properties to a string, using a given parser format
     * <code>
     * $book = BookQuery::create()->findPk(9012);
     * echo $book->exportTo('JSON');
     *  => {"Id":9012,"Title":"Don Juan","ISBN":"0140422161","Price":12.99,"PublisherId":1234,"AuthorId":5678}');
     * </code>
     *
     * @param  mixed   $parser                 A AbstractParser instance, or a format name ('XML', 'YAML', 'JSON', 'CSV')
     * @param  boolean $includeLazyLoadColumns (optional) Whether to include lazy load(ed) columns. Defaults to TRUE.
     * @return string  The exported data
     */
    public function exportTo($parser, $includeLazyLoadColumns = true)
    {
        if (!$parser instanceof AbstractParser) {
            $parser = AbstractParser::getParser($parser);
        }

        return $parser->fromArray($this->toArray(TableMap::TYPE_PHPNAME, $includeLazyLoadColumns, array(), true));
    }

    /**
     * Clean up internal collections prior to serializing
     * Avoids recursive loops that turn into segmentation faults when serializing
     */
    public function __sleep()
    {
        $this->clearAllReferences();

        return array_keys(get_object_vars($this));
    }

    /**
     * Get the [id] column value.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get the [optionally formatted] temporal [created_at] column value.
     *
     *
     * @param      string $format The date/time format string (either date()-style or strftime()-style).
     *                            If format is NULL, then the raw DateTime object will be returned.
     *
     * @return string|DateTime Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00 00:00:00
     *
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getCreatedAt($format = NULL)
    {
        if ($format === null) {
            return $this->created_at;
        } else {
            return $this->created_at instanceof \DateTime ? $this->created_at->format($format) : null;
        }
    }

    /**
     * Get the [optionally formatted] temporal [updated_at] column value.
     *
     *
     * @param      string $format The date/time format string (either date()-style or strftime()-style).
     *                            If format is NULL, then the raw DateTime object will be returned.
     *
     * @return string|DateTime Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00 00:00:00
     *
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getUpdatedAt($format = NULL)
    {
        if ($format === null) {
            return $this->updated_at;
        } else {
            return $this->updated_at instanceof \DateTime ? $this->updated_at->format($format) : null;
        }
    }

    /**
     * Set the value of [id] column.
     *
     * @param int $v new value
     * @return $this|\Trial The current object (for fluent API support)
     */
    public function setId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->id !== $v) {
            $this->id = $v;
            $this->modifiedColumns[TrialTableMap::COL_ID] = true;
        }

        return $this;
    } // setId()

    /**
     * Sets the value of [created_at] column to a normalized version of the date/time value specified.
     *
     * @param  mixed $v string, integer (timestamp), or \DateTime value.
     *               Empty strings are treated as NULL.
     * @return $this|\Trial The current object (for fluent API support)
     */
    public function setCreatedAt($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->created_at !== null || $dt !== null) {
            if ($this->created_at === null || $dt === null || $dt->format("Y-m-d H:i:s") !== $this->created_at->format("Y-m-d H:i:s")) {
                $this->created_at = $dt === null ? null : clone $dt;
                $this->modifiedColumns[TrialTableMap::COL_CREATED_AT] = true;
            }
        } // if either are not null

        return $this;
    } // setCreatedAt()

    /**
     * Sets the value of [updated_at] column to a normalized version of the date/time value specified.
     *
     * @param  mixed $v string, integer (timestamp), or \DateTime value.
     *               Empty strings are treated as NULL.
     * @return $this|\Trial The current object (for fluent API support)
     */
    public function setUpdatedAt($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->updated_at !== null || $dt !== null) {
            if ($this->updated_at === null || $dt === null || $dt->format("Y-m-d H:i:s") !== $this->updated_at->format("Y-m-d H:i:s")) {
                $this->updated_at = $dt === null ? null : clone $dt;
                $this->modifiedColumns[TrialTableMap::COL_UPDATED_AT] = true;
            }
        } // if either are not null

        return $this;
    } // setUpdatedAt()

    /**
     * Indicates whether the columns in this object are only set to default values.
     *
     * This method can be used in conjunction with isModified() to indicate whether an object is both
     * modified _and_ has some values set which are non-default.
     *
     * @return boolean Whether the columns in this object are only been set with default values.
     */
    public function hasOnlyDefaultValues()
    {
        // otherwise, everything was equal, so return TRUE
        return true;
    } // hasOnlyDefaultValues()

    /**
     * Hydrates (populates) the object variables with values from the database resultset.
     *
     * An offset (0-based "start column") is specified so that objects can be hydrated
     * with a subset of the columns in the resultset rows.  This is needed, for example,
     * for results of JOIN queries where the resultset row includes columns from two or
     * more tables.
     *
     * @param array   $row       The row returned by DataFetcher->fetch().
     * @param int     $startcol  0-based offset column which indicates which restultset column to start with.
     * @param boolean $rehydrate Whether this object is being re-hydrated from the database.
     * @param string  $indexType The index type of $row. Mostly DataFetcher->getIndexType().
                                  One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                            TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *
     * @return int             next starting column
     * @throws PropelException - Any caught Exception will be rewrapped as a PropelException.
     */
    public function hydrate($row, $startcol = 0, $rehydrate = false, $indexType = TableMap::TYPE_NUM)
    {
        try {

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : TrialTableMap::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)];
            $this->id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : TrialTableMap::translateFieldName('CreatedAt', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->created_at = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : TrialTableMap::translateFieldName('UpdatedAt', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->updated_at = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 3; // 3 = TrialTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\Trial'), 0, $e);
        }
    }

    /**
     * Checks and repairs the internal consistency of the object.
     *
     * This method is executed after an already-instantiated object is re-hydrated
     * from the database.  It exists to check any foreign keys to make sure that
     * the objects related to the current object are correct based on foreign key.
     *
     * You can override this method in the stub class, but you should always invoke
     * the base method from the overridden method (i.e. parent::ensureConsistency()),
     * in case your model changes.
     *
     * @throws PropelException
     */
    public function ensureConsistency()
    {
    } // ensureConsistency

    /**
     * Reloads this object from datastore based on primary key and (optionally) resets all associated objects.
     *
     * This will only work if the object has been saved and has a valid primary key set.
     *
     * @param      boolean $deep (optional) Whether to also de-associated any related objects.
     * @param      ConnectionInterface $con (optional) The ConnectionInterface connection to use.
     * @return void
     * @throws PropelException - if this object is deleted, unsaved or doesn't have pk match in db
     */
    public function reload($deep = false, ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("Cannot reload a deleted object.");
        }

        if ($this->isNew()) {
            throw new PropelException("Cannot reload an unsaved object.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(TrialTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildTrialQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->collTrialPrayerAssociations = null;

            $this->collTrialPainRatingAssociations = null;

            $this->collPrayers = null;
            $this->collPainAssessmentItems = null;
        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param      ConnectionInterface $con
     * @return void
     * @throws PropelException
     * @see Trial::setDeleted()
     * @see Trial::isDeleted()
     */
    public function delete(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(TrialTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildTrialQuery::create()
                ->filterByPrimaryKey($this->getPrimaryKey());
            $ret = $this->preDelete($con);
            if ($ret) {
                $deleteQuery->delete($con);
                $this->postDelete($con);
                $this->setDeleted(true);
            }
        });
    }

    /**
     * Persists this object to the database.
     *
     * If the object is new, it inserts it; otherwise an update is performed.
     * All modified related objects will also be persisted in the doSave()
     * method.  This method wraps all precipitate database operations in a
     * single transaction.
     *
     * @param      ConnectionInterface $con
     * @return int             The number of rows affected by this insert/update and any referring fk objects' save() operations.
     * @throws PropelException
     * @see doSave()
     */
    public function save(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("You cannot save an object that has been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(TrialTableMap::DATABASE_NAME);
        }

        return $con->transaction(function () use ($con) {
            $isInsert = $this->isNew();
            $ret = $this->preSave($con);
            if ($isInsert) {
                $ret = $ret && $this->preInsert($con);
                // timestampable behavior

                if (!$this->isColumnModified(TrialTableMap::COL_CREATED_AT)) {
                    $this->setCreatedAt(time());
                }
                if (!$this->isColumnModified(TrialTableMap::COL_UPDATED_AT)) {
                    $this->setUpdatedAt(time());
                }
            } else {
                $ret = $ret && $this->preUpdate($con);
                // timestampable behavior
                if ($this->isModified() && !$this->isColumnModified(TrialTableMap::COL_UPDATED_AT)) {
                    $this->setUpdatedAt(time());
                }
            }
            if ($ret) {
                $affectedRows = $this->doSave($con);
                if ($isInsert) {
                    $this->postInsert($con);
                } else {
                    $this->postUpdate($con);
                }
                $this->postSave($con);
                TrialTableMap::addInstanceToPool($this);
            } else {
                $affectedRows = 0;
            }

            return $affectedRows;
        });
    }

    /**
     * Performs the work of inserting or updating the row in the database.
     *
     * If the object is new, it inserts it; otherwise an update is performed.
     * All related objects are also updated in this method.
     *
     * @param      ConnectionInterface $con
     * @return int             The number of rows affected by this insert/update and any referring fk objects' save() operations.
     * @throws PropelException
     * @see save()
     */
    protected function doSave(ConnectionInterface $con)
    {
        $affectedRows = 0; // initialize var to track total num of affected rows
        if (!$this->alreadyInSave) {
            $this->alreadyInSave = true;

            if ($this->isNew() || $this->isModified()) {
                // persist changes
                if ($this->isNew()) {
                    $this->doInsert($con);
                    $affectedRows += 1;
                } else {
                    $affectedRows += $this->doUpdate($con);
                }
                $this->resetModified();
            }

            if ($this->prayersScheduledForDeletion !== null) {
                if (!$this->prayersScheduledForDeletion->isEmpty()) {
                    $pks = array();
                    foreach ($this->prayersScheduledForDeletion as $entry) {
                        $entryPk = [];

                        $entryPk[0] = $this->getId();
                        $entryPk[1] = $entry->getId();
                        $pks[] = $entryPk;
                    }

                    \TrialPrayerAssociationQuery::create()
                        ->filterByPrimaryKeys($pks)
                        ->delete($con);

                    $this->prayersScheduledForDeletion = null;
                }

            }

            if ($this->collPrayers) {
                foreach ($this->collPrayers as $prayer) {
                    if (!$prayer->isDeleted() && ($prayer->isNew() || $prayer->isModified())) {
                        $prayer->save($con);
                    }
                }
            }


            if ($this->painAssessmentItemsScheduledForDeletion !== null) {
                if (!$this->painAssessmentItemsScheduledForDeletion->isEmpty()) {
                    $pks = array();
                    foreach ($this->painAssessmentItemsScheduledForDeletion as $entry) {
                        $entryPk = [];

                        $entryPk[0] = $this->getId();
                        $entryPk[1] = $entry->getId();
                        $pks[] = $entryPk;
                    }

                    \TrialPainRatingAssociationQuery::create()
                        ->filterByPrimaryKeys($pks)
                        ->delete($con);

                    $this->painAssessmentItemsScheduledForDeletion = null;
                }

            }

            if ($this->collPainAssessmentItems) {
                foreach ($this->collPainAssessmentItems as $painAssessmentItem) {
                    if (!$painAssessmentItem->isDeleted() && ($painAssessmentItem->isNew() || $painAssessmentItem->isModified())) {
                        $painAssessmentItem->save($con);
                    }
                }
            }


            if ($this->trialPrayerAssociationsScheduledForDeletion !== null) {
                if (!$this->trialPrayerAssociationsScheduledForDeletion->isEmpty()) {
                    \TrialPrayerAssociationQuery::create()
                        ->filterByPrimaryKeys($this->trialPrayerAssociationsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->trialPrayerAssociationsScheduledForDeletion = null;
                }
            }

            if ($this->collTrialPrayerAssociations !== null) {
                foreach ($this->collTrialPrayerAssociations as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->trialPainRatingAssociationsScheduledForDeletion !== null) {
                if (!$this->trialPainRatingAssociationsScheduledForDeletion->isEmpty()) {
                    \TrialPainRatingAssociationQuery::create()
                        ->filterByPrimaryKeys($this->trialPainRatingAssociationsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->trialPainRatingAssociationsScheduledForDeletion = null;
                }
            }

            if ($this->collTrialPainRatingAssociations !== null) {
                foreach ($this->collTrialPainRatingAssociations as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            $this->alreadyInSave = false;

        }

        return $affectedRows;
    } // doSave()

    /**
     * Insert the row in the database.
     *
     * @param      ConnectionInterface $con
     *
     * @throws PropelException
     * @see doSave()
     */
    protected function doInsert(ConnectionInterface $con)
    {
        $modifiedColumns = array();
        $index = 0;

        $this->modifiedColumns[TrialTableMap::COL_ID] = true;
        if (null !== $this->id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . TrialTableMap::COL_ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(TrialTableMap::COL_ID)) {
            $modifiedColumns[':p' . $index++]  = 'id';
        }
        if ($this->isColumnModified(TrialTableMap::COL_CREATED_AT)) {
            $modifiedColumns[':p' . $index++]  = 'created_at';
        }
        if ($this->isColumnModified(TrialTableMap::COL_UPDATED_AT)) {
            $modifiedColumns[':p' . $index++]  = 'updated_at';
        }

        $sql = sprintf(
            'INSERT INTO trials (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case 'id':
                        $stmt->bindValue($identifier, $this->id, PDO::PARAM_INT);
                        break;
                    case 'created_at':
                        $stmt->bindValue($identifier, $this->created_at ? $this->created_at->format("Y-m-d H:i:s") : null, PDO::PARAM_STR);
                        break;
                    case 'updated_at':
                        $stmt->bindValue($identifier, $this->updated_at ? $this->updated_at->format("Y-m-d H:i:s") : null, PDO::PARAM_STR);
                        break;
                }
            }
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute INSERT statement [%s]', $sql), 0, $e);
        }

        try {
            $pk = $con->lastInsertId();
        } catch (Exception $e) {
            throw new PropelException('Unable to get autoincrement id.', 0, $e);
        }
        $this->setId($pk);

        $this->setNew(false);
    }

    /**
     * Update the row in the database.
     *
     * @param      ConnectionInterface $con
     *
     * @return Integer Number of updated rows
     * @see doSave()
     */
    protected function doUpdate(ConnectionInterface $con)
    {
        $selectCriteria = $this->buildPkeyCriteria();
        $valuesCriteria = $this->buildCriteria();

        return $selectCriteria->doUpdate($valuesCriteria, $con);
    }

    /**
     * Retrieves a field from the object by name passed in as a string.
     *
     * @param      string $name name
     * @param      string $type The type of fieldname the $name is of:
     *                     one of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                     TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *                     Defaults to TableMap::TYPE_PHPNAME.
     * @return mixed Value of field.
     */
    public function getByName($name, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = TrialTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
        $field = $this->getByPosition($pos);

        return $field;
    }

    /**
     * Retrieves a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param      int $pos position in xml schema
     * @return mixed Value of field at $pos
     */
    public function getByPosition($pos)
    {
        switch ($pos) {
            case 0:
                return $this->getId();
                break;
            case 1:
                return $this->getCreatedAt();
                break;
            case 2:
                return $this->getUpdatedAt();
                break;
            default:
                return null;
                break;
        } // switch()
    }

    /**
     * Exports the object as an array.
     *
     * You can specify the key type of the array by passing one of the class
     * type constants.
     *
     * @param     string  $keyType (optional) One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME,
     *                    TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *                    Defaults to TableMap::TYPE_PHPNAME.
     * @param     boolean $includeLazyLoadColumns (optional) Whether to include lazy loaded columns. Defaults to TRUE.
     * @param     array $alreadyDumpedObjects List of objects to skip to avoid recursion
     * @param     boolean $includeForeignObjects (optional) Whether to include hydrated related objects. Default to FALSE.
     *
     * @return array an associative array containing the field names (as keys) and field values
     */
    public function toArray($keyType = TableMap::TYPE_PHPNAME, $includeLazyLoadColumns = true, $alreadyDumpedObjects = array(), $includeForeignObjects = false)
    {

        if (isset($alreadyDumpedObjects['Trial'][$this->hashCode()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['Trial'][$this->hashCode()] = true;
        $keys = TrialTableMap::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getId(),
            $keys[1] => $this->getCreatedAt(),
            $keys[2] => $this->getUpdatedAt(),
        );

        $utc = new \DateTimeZone('utc');
        if ($result[$keys[1]] instanceof \DateTime) {
            // When changing timezone we don't want to change existing instances
            $dateTime = clone $result[$keys[1]];
            $result[$keys[1]] = $dateTime->setTimezone($utc)->format('Y-m-d\TH:i:s\Z');
        }

        if ($result[$keys[2]] instanceof \DateTime) {
            // When changing timezone we don't want to change existing instances
            $dateTime = clone $result[$keys[2]];
            $result[$keys[2]] = $dateTime->setTimezone($utc)->format('Y-m-d\TH:i:s\Z');
        }

        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->collTrialPrayerAssociations) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'trialPrayerAssociations';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'trialsXprayerss';
                        break;
                    default:
                        $key = 'TrialPrayerAssociations';
                }

                $result[$key] = $this->collTrialPrayerAssociations->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collTrialPainRatingAssociations) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'trialPainRatingAssociations';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'trialsXpain_itemss';
                        break;
                    default:
                        $key = 'TrialPainRatingAssociations';
                }

                $result[$key] = $this->collTrialPainRatingAssociations->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
        }

        return $result;
    }

    /**
     * Sets a field from the object by name passed in as a string.
     *
     * @param  string $name
     * @param  mixed  $value field value
     * @param  string $type The type of fieldname the $name is of:
     *                one of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *                Defaults to TableMap::TYPE_PHPNAME.
     * @return $this|\Trial
     */
    public function setByName($name, $value, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = TrialTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

        return $this->setByPosition($pos, $value);
    }

    /**
     * Sets a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param  int $pos position in xml schema
     * @param  mixed $value field value
     * @return $this|\Trial
     */
    public function setByPosition($pos, $value)
    {
        switch ($pos) {
            case 0:
                $this->setId($value);
                break;
            case 1:
                $this->setCreatedAt($value);
                break;
            case 2:
                $this->setUpdatedAt($value);
                break;
        } // switch()

        return $this;
    }

    /**
     * Populates the object using an array.
     *
     * This is particularly useful when populating an object from one of the
     * request arrays (e.g. $_POST).  This method goes through the column
     * names, checking to see whether a matching key exists in populated
     * array. If so the setByName() method is called for that column.
     *
     * You can specify the key type of the array by additionally passing one
     * of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME,
     * TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     * The default key type is the column's TableMap::TYPE_PHPNAME.
     *
     * @param      array  $arr     An array to populate the object from.
     * @param      string $keyType The type of keys the array uses.
     * @return void
     */
    public function fromArray($arr, $keyType = TableMap::TYPE_PHPNAME)
    {
        $keys = TrialTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setId($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setCreatedAt($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setUpdatedAt($arr[$keys[2]]);
        }
    }

     /**
     * Populate the current object from a string, using a given parser format
     * <code>
     * $book = new Book();
     * $book->importFrom('JSON', '{"Id":9012,"Title":"Don Juan","ISBN":"0140422161","Price":12.99,"PublisherId":1234,"AuthorId":5678}');
     * </code>
     *
     * You can specify the key type of the array by additionally passing one
     * of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME,
     * TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     * The default key type is the column's TableMap::TYPE_PHPNAME.
     *
     * @param mixed $parser A AbstractParser instance,
     *                       or a format name ('XML', 'YAML', 'JSON', 'CSV')
     * @param string $data The source data to import from
     * @param string $keyType The type of keys the array uses.
     *
     * @return $this|\Trial The current object, for fluid interface
     */
    public function importFrom($parser, $data, $keyType = TableMap::TYPE_PHPNAME)
    {
        if (!$parser instanceof AbstractParser) {
            $parser = AbstractParser::getParser($parser);
        }

        $this->fromArray($parser->toArray($data), $keyType);

        return $this;
    }

    /**
     * Build a Criteria object containing the values of all modified columns in this object.
     *
     * @return Criteria The Criteria object containing all modified values.
     */
    public function buildCriteria()
    {
        $criteria = new Criteria(TrialTableMap::DATABASE_NAME);

        if ($this->isColumnModified(TrialTableMap::COL_ID)) {
            $criteria->add(TrialTableMap::COL_ID, $this->id);
        }
        if ($this->isColumnModified(TrialTableMap::COL_CREATED_AT)) {
            $criteria->add(TrialTableMap::COL_CREATED_AT, $this->created_at);
        }
        if ($this->isColumnModified(TrialTableMap::COL_UPDATED_AT)) {
            $criteria->add(TrialTableMap::COL_UPDATED_AT, $this->updated_at);
        }

        return $criteria;
    }

    /**
     * Builds a Criteria object containing the primary key for this object.
     *
     * Unlike buildCriteria() this method includes the primary key values regardless
     * of whether or not they have been modified.
     *
     * @throws LogicException if no primary key is defined
     *
     * @return Criteria The Criteria object containing value(s) for primary key(s).
     */
    public function buildPkeyCriteria()
    {
        $criteria = ChildTrialQuery::create();
        $criteria->add(TrialTableMap::COL_ID, $this->id);

        return $criteria;
    }

    /**
     * If the primary key is not null, return the hashcode of the
     * primary key. Otherwise, return the hash code of the object.
     *
     * @return int Hashcode
     */
    public function hashCode()
    {
        $validPk = null !== $this->getId();

        $validPrimaryKeyFKs = 0;
        $primaryKeyFKs = [];

        if ($validPk) {
            return crc32(json_encode($this->getPrimaryKey(), JSON_UNESCAPED_UNICODE));
        } elseif ($validPrimaryKeyFKs) {
            return crc32(json_encode($primaryKeyFKs, JSON_UNESCAPED_UNICODE));
        }

        return spl_object_hash($this);
    }

    /**
     * Returns the primary key for this object (row).
     * @return int
     */
    public function getPrimaryKey()
    {
        return $this->getId();
    }

    /**
     * Generic method to set the primary key (id column).
     *
     * @param       int $key Primary key.
     * @return void
     */
    public function setPrimaryKey($key)
    {
        $this->setId($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     * @return boolean
     */
    public function isPrimaryKeyNull()
    {
        return null === $this->getId();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param      object $copyObj An object of \Trial (or compatible) type.
     * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setCreatedAt($this->getCreatedAt());
        $copyObj->setUpdatedAt($this->getUpdatedAt());

        if ($deepCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);

            foreach ($this->getTrialPrayerAssociations() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addTrialPrayerAssociation($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getTrialPainRatingAssociations() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addTrialPainRatingAssociation($relObj->copy($deepCopy));
                }
            }

        } // if ($deepCopy)

        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setId(NULL); // this is a auto-increment column, so set to default value
        }
    }

    /**
     * Makes a copy of this object that will be inserted as a new row in table when saved.
     * It creates a new object filling in the simple attributes, but skipping any primary
     * keys that are defined for the table.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param  boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @return \Trial Clone of current object.
     * @throws PropelException
     */
    public function copy($deepCopy = false)
    {
        // we use get_class(), because this might be a subclass
        $clazz = get_class($this);
        $copyObj = new $clazz();
        $this->copyInto($copyObj, $deepCopy);

        return $copyObj;
    }


    /**
     * Initializes a collection based on the name of a relation.
     * Avoids crafting an 'init[$relationName]s' method name
     * that wouldn't work when StandardEnglishPluralizer is used.
     *
     * @param      string $relationName The name of the relation to initialize
     * @return void
     */
    public function initRelation($relationName)
    {
        if ('TrialPrayerAssociation' == $relationName) {
            return $this->initTrialPrayerAssociations();
        }
        if ('TrialPainRatingAssociation' == $relationName) {
            return $this->initTrialPainRatingAssociations();
        }
    }

    /**
     * Clears out the collTrialPrayerAssociations collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addTrialPrayerAssociations()
     */
    public function clearTrialPrayerAssociations()
    {
        $this->collTrialPrayerAssociations = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collTrialPrayerAssociations collection loaded partially.
     */
    public function resetPartialTrialPrayerAssociations($v = true)
    {
        $this->collTrialPrayerAssociationsPartial = $v;
    }

    /**
     * Initializes the collTrialPrayerAssociations collection.
     *
     * By default this just sets the collTrialPrayerAssociations collection to an empty array (like clearcollTrialPrayerAssociations());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initTrialPrayerAssociations($overrideExisting = true)
    {
        if (null !== $this->collTrialPrayerAssociations && !$overrideExisting) {
            return;
        }
        $this->collTrialPrayerAssociations = new ObjectCollection();
        $this->collTrialPrayerAssociations->setModel('\TrialPrayerAssociation');
    }

    /**
     * Gets an array of ChildTrialPrayerAssociation objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildTrial is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildTrialPrayerAssociation[] List of ChildTrialPrayerAssociation objects
     * @throws PropelException
     */
    public function getTrialPrayerAssociations(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collTrialPrayerAssociationsPartial && !$this->isNew();
        if (null === $this->collTrialPrayerAssociations || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collTrialPrayerAssociations) {
                // return empty collection
                $this->initTrialPrayerAssociations();
            } else {
                $collTrialPrayerAssociations = ChildTrialPrayerAssociationQuery::create(null, $criteria)
                    ->filterByTrial($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collTrialPrayerAssociationsPartial && count($collTrialPrayerAssociations)) {
                        $this->initTrialPrayerAssociations(false);

                        foreach ($collTrialPrayerAssociations as $obj) {
                            if (false == $this->collTrialPrayerAssociations->contains($obj)) {
                                $this->collTrialPrayerAssociations->append($obj);
                            }
                        }

                        $this->collTrialPrayerAssociationsPartial = true;
                    }

                    return $collTrialPrayerAssociations;
                }

                if ($partial && $this->collTrialPrayerAssociations) {
                    foreach ($this->collTrialPrayerAssociations as $obj) {
                        if ($obj->isNew()) {
                            $collTrialPrayerAssociations[] = $obj;
                        }
                    }
                }

                $this->collTrialPrayerAssociations = $collTrialPrayerAssociations;
                $this->collTrialPrayerAssociationsPartial = false;
            }
        }

        return $this->collTrialPrayerAssociations;
    }

    /**
     * Sets a collection of ChildTrialPrayerAssociation objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $trialPrayerAssociations A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildTrial The current object (for fluent API support)
     */
    public function setTrialPrayerAssociations(Collection $trialPrayerAssociations, ConnectionInterface $con = null)
    {
        /** @var ChildTrialPrayerAssociation[] $trialPrayerAssociationsToDelete */
        $trialPrayerAssociationsToDelete = $this->getTrialPrayerAssociations(new Criteria(), $con)->diff($trialPrayerAssociations);


        //since at least one column in the foreign key is at the same time a PK
        //we can not just set a PK to NULL in the lines below. We have to store
        //a backup of all values, so we are able to manipulate these items based on the onDelete value later.
        $this->trialPrayerAssociationsScheduledForDeletion = clone $trialPrayerAssociationsToDelete;

        foreach ($trialPrayerAssociationsToDelete as $trialPrayerAssociationRemoved) {
            $trialPrayerAssociationRemoved->setTrial(null);
        }

        $this->collTrialPrayerAssociations = null;
        foreach ($trialPrayerAssociations as $trialPrayerAssociation) {
            $this->addTrialPrayerAssociation($trialPrayerAssociation);
        }

        $this->collTrialPrayerAssociations = $trialPrayerAssociations;
        $this->collTrialPrayerAssociationsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related TrialPrayerAssociation objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related TrialPrayerAssociation objects.
     * @throws PropelException
     */
    public function countTrialPrayerAssociations(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collTrialPrayerAssociationsPartial && !$this->isNew();
        if (null === $this->collTrialPrayerAssociations || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collTrialPrayerAssociations) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getTrialPrayerAssociations());
            }

            $query = ChildTrialPrayerAssociationQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByTrial($this)
                ->count($con);
        }

        return count($this->collTrialPrayerAssociations);
    }

    /**
     * Method called to associate a ChildTrialPrayerAssociation object to this object
     * through the ChildTrialPrayerAssociation foreign key attribute.
     *
     * @param  ChildTrialPrayerAssociation $l ChildTrialPrayerAssociation
     * @return $this|\Trial The current object (for fluent API support)
     */
    public function addTrialPrayerAssociation(ChildTrialPrayerAssociation $l)
    {
        if ($this->collTrialPrayerAssociations === null) {
            $this->initTrialPrayerAssociations();
            $this->collTrialPrayerAssociationsPartial = true;
        }

        if (!$this->collTrialPrayerAssociations->contains($l)) {
            $this->doAddTrialPrayerAssociation($l);
        }

        return $this;
    }

    /**
     * @param ChildTrialPrayerAssociation $trialPrayerAssociation The ChildTrialPrayerAssociation object to add.
     */
    protected function doAddTrialPrayerAssociation(ChildTrialPrayerAssociation $trialPrayerAssociation)
    {
        $this->collTrialPrayerAssociations[]= $trialPrayerAssociation;
        $trialPrayerAssociation->setTrial($this);
    }

    /**
     * @param  ChildTrialPrayerAssociation $trialPrayerAssociation The ChildTrialPrayerAssociation object to remove.
     * @return $this|ChildTrial The current object (for fluent API support)
     */
    public function removeTrialPrayerAssociation(ChildTrialPrayerAssociation $trialPrayerAssociation)
    {
        if ($this->getTrialPrayerAssociations()->contains($trialPrayerAssociation)) {
            $pos = $this->collTrialPrayerAssociations->search($trialPrayerAssociation);
            $this->collTrialPrayerAssociations->remove($pos);
            if (null === $this->trialPrayerAssociationsScheduledForDeletion) {
                $this->trialPrayerAssociationsScheduledForDeletion = clone $this->collTrialPrayerAssociations;
                $this->trialPrayerAssociationsScheduledForDeletion->clear();
            }
            $this->trialPrayerAssociationsScheduledForDeletion[]= clone $trialPrayerAssociation;
            $trialPrayerAssociation->setTrial(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Trial is new, it will return
     * an empty collection; or if this Trial has previously
     * been saved, it will retrieve related TrialPrayerAssociations from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Trial.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildTrialPrayerAssociation[] List of ChildTrialPrayerAssociation objects
     */
    public function getTrialPrayerAssociationsJoinPrayer(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildTrialPrayerAssociationQuery::create(null, $criteria);
        $query->joinWith('Prayer', $joinBehavior);

        return $this->getTrialPrayerAssociations($query, $con);
    }

    /**
     * Clears out the collTrialPainRatingAssociations collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addTrialPainRatingAssociations()
     */
    public function clearTrialPainRatingAssociations()
    {
        $this->collTrialPainRatingAssociations = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collTrialPainRatingAssociations collection loaded partially.
     */
    public function resetPartialTrialPainRatingAssociations($v = true)
    {
        $this->collTrialPainRatingAssociationsPartial = $v;
    }

    /**
     * Initializes the collTrialPainRatingAssociations collection.
     *
     * By default this just sets the collTrialPainRatingAssociations collection to an empty array (like clearcollTrialPainRatingAssociations());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initTrialPainRatingAssociations($overrideExisting = true)
    {
        if (null !== $this->collTrialPainRatingAssociations && !$overrideExisting) {
            return;
        }
        $this->collTrialPainRatingAssociations = new ObjectCollection();
        $this->collTrialPainRatingAssociations->setModel('\TrialPainRatingAssociation');
    }

    /**
     * Gets an array of ChildTrialPainRatingAssociation objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildTrial is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildTrialPainRatingAssociation[] List of ChildTrialPainRatingAssociation objects
     * @throws PropelException
     */
    public function getTrialPainRatingAssociations(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collTrialPainRatingAssociationsPartial && !$this->isNew();
        if (null === $this->collTrialPainRatingAssociations || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collTrialPainRatingAssociations) {
                // return empty collection
                $this->initTrialPainRatingAssociations();
            } else {
                $collTrialPainRatingAssociations = ChildTrialPainRatingAssociationQuery::create(null, $criteria)
                    ->filterByTrial($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collTrialPainRatingAssociationsPartial && count($collTrialPainRatingAssociations)) {
                        $this->initTrialPainRatingAssociations(false);

                        foreach ($collTrialPainRatingAssociations as $obj) {
                            if (false == $this->collTrialPainRatingAssociations->contains($obj)) {
                                $this->collTrialPainRatingAssociations->append($obj);
                            }
                        }

                        $this->collTrialPainRatingAssociationsPartial = true;
                    }

                    return $collTrialPainRatingAssociations;
                }

                if ($partial && $this->collTrialPainRatingAssociations) {
                    foreach ($this->collTrialPainRatingAssociations as $obj) {
                        if ($obj->isNew()) {
                            $collTrialPainRatingAssociations[] = $obj;
                        }
                    }
                }

                $this->collTrialPainRatingAssociations = $collTrialPainRatingAssociations;
                $this->collTrialPainRatingAssociationsPartial = false;
            }
        }

        return $this->collTrialPainRatingAssociations;
    }

    /**
     * Sets a collection of ChildTrialPainRatingAssociation objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $trialPainRatingAssociations A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildTrial The current object (for fluent API support)
     */
    public function setTrialPainRatingAssociations(Collection $trialPainRatingAssociations, ConnectionInterface $con = null)
    {
        /** @var ChildTrialPainRatingAssociation[] $trialPainRatingAssociationsToDelete */
        $trialPainRatingAssociationsToDelete = $this->getTrialPainRatingAssociations(new Criteria(), $con)->diff($trialPainRatingAssociations);


        //since at least one column in the foreign key is at the same time a PK
        //we can not just set a PK to NULL in the lines below. We have to store
        //a backup of all values, so we are able to manipulate these items based on the onDelete value later.
        $this->trialPainRatingAssociationsScheduledForDeletion = clone $trialPainRatingAssociationsToDelete;

        foreach ($trialPainRatingAssociationsToDelete as $trialPainRatingAssociationRemoved) {
            $trialPainRatingAssociationRemoved->setTrial(null);
        }

        $this->collTrialPainRatingAssociations = null;
        foreach ($trialPainRatingAssociations as $trialPainRatingAssociation) {
            $this->addTrialPainRatingAssociation($trialPainRatingAssociation);
        }

        $this->collTrialPainRatingAssociations = $trialPainRatingAssociations;
        $this->collTrialPainRatingAssociationsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related TrialPainRatingAssociation objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related TrialPainRatingAssociation objects.
     * @throws PropelException
     */
    public function countTrialPainRatingAssociations(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collTrialPainRatingAssociationsPartial && !$this->isNew();
        if (null === $this->collTrialPainRatingAssociations || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collTrialPainRatingAssociations) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getTrialPainRatingAssociations());
            }

            $query = ChildTrialPainRatingAssociationQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByTrial($this)
                ->count($con);
        }

        return count($this->collTrialPainRatingAssociations);
    }

    /**
     * Method called to associate a ChildTrialPainRatingAssociation object to this object
     * through the ChildTrialPainRatingAssociation foreign key attribute.
     *
     * @param  ChildTrialPainRatingAssociation $l ChildTrialPainRatingAssociation
     * @return $this|\Trial The current object (for fluent API support)
     */
    public function addTrialPainRatingAssociation(ChildTrialPainRatingAssociation $l)
    {
        if ($this->collTrialPainRatingAssociations === null) {
            $this->initTrialPainRatingAssociations();
            $this->collTrialPainRatingAssociationsPartial = true;
        }

        if (!$this->collTrialPainRatingAssociations->contains($l)) {
            $this->doAddTrialPainRatingAssociation($l);
        }

        return $this;
    }

    /**
     * @param ChildTrialPainRatingAssociation $trialPainRatingAssociation The ChildTrialPainRatingAssociation object to add.
     */
    protected function doAddTrialPainRatingAssociation(ChildTrialPainRatingAssociation $trialPainRatingAssociation)
    {
        $this->collTrialPainRatingAssociations[]= $trialPainRatingAssociation;
        $trialPainRatingAssociation->setTrial($this);
    }

    /**
     * @param  ChildTrialPainRatingAssociation $trialPainRatingAssociation The ChildTrialPainRatingAssociation object to remove.
     * @return $this|ChildTrial The current object (for fluent API support)
     */
    public function removeTrialPainRatingAssociation(ChildTrialPainRatingAssociation $trialPainRatingAssociation)
    {
        if ($this->getTrialPainRatingAssociations()->contains($trialPainRatingAssociation)) {
            $pos = $this->collTrialPainRatingAssociations->search($trialPainRatingAssociation);
            $this->collTrialPainRatingAssociations->remove($pos);
            if (null === $this->trialPainRatingAssociationsScheduledForDeletion) {
                $this->trialPainRatingAssociationsScheduledForDeletion = clone $this->collTrialPainRatingAssociations;
                $this->trialPainRatingAssociationsScheduledForDeletion->clear();
            }
            $this->trialPainRatingAssociationsScheduledForDeletion[]= clone $trialPainRatingAssociation;
            $trialPainRatingAssociation->setTrial(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Trial is new, it will return
     * an empty collection; or if this Trial has previously
     * been saved, it will retrieve related TrialPainRatingAssociations from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Trial.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildTrialPainRatingAssociation[] List of ChildTrialPainRatingAssociation objects
     */
    public function getTrialPainRatingAssociationsJoinPainAssessmentItem(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildTrialPainRatingAssociationQuery::create(null, $criteria);
        $query->joinWith('PainAssessmentItem', $joinBehavior);

        return $this->getTrialPainRatingAssociations($query, $con);
    }

    /**
     * Clears out the collPrayers collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addPrayers()
     */
    public function clearPrayers()
    {
        $this->collPrayers = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Initializes the collPrayers crossRef collection.
     *
     * By default this just sets the collPrayers collection to an empty collection (like clearPrayers());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @return void
     */
    public function initPrayers()
    {
        $this->collPrayers = new ObjectCollection();
        $this->collPrayersPartial = true;

        $this->collPrayers->setModel('\Prayer');
    }

    /**
     * Checks if the collPrayers collection is loaded.
     *
     * @return bool
     */
    public function isPrayersLoaded()
    {
        return null !== $this->collPrayers;
    }

    /**
     * Gets a collection of ChildPrayer objects related by a many-to-many relationship
     * to the current object by way of the trialsXprayers cross-reference table.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildTrial is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria Optional query object to filter the query
     * @param      ConnectionInterface $con Optional connection object
     *
     * @return ObjectCollection|ChildPrayer[] List of ChildPrayer objects
     */
    public function getPrayers(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collPrayersPartial && !$this->isNew();
        if (null === $this->collPrayers || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collPrayers) {
                    $this->initPrayers();
                }
            } else {

                $query = ChildPrayerQuery::create(null, $criteria)
                    ->filterByTrial($this);
                $collPrayers = $query->find($con);
                if (null !== $criteria) {
                    return $collPrayers;
                }

                if ($partial && $this->collPrayers) {
                    //make sure that already added objects gets added to the list of the database.
                    foreach ($this->collPrayers as $obj) {
                        if (!$collPrayers->contains($obj)) {
                            $collPrayers[] = $obj;
                        }
                    }
                }

                $this->collPrayers = $collPrayers;
                $this->collPrayersPartial = false;
            }
        }

        return $this->collPrayers;
    }

    /**
     * Sets a collection of Prayer objects related by a many-to-many relationship
     * to the current object by way of the trialsXprayers cross-reference table.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param  Collection $prayers A Propel collection.
     * @param  ConnectionInterface $con Optional connection object
     * @return $this|ChildTrial The current object (for fluent API support)
     */
    public function setPrayers(Collection $prayers, ConnectionInterface $con = null)
    {
        $this->clearPrayers();
        $currentPrayers = $this->getPrayers();

        $prayersScheduledForDeletion = $currentPrayers->diff($prayers);

        foreach ($prayersScheduledForDeletion as $toDelete) {
            $this->removePrayer($toDelete);
        }

        foreach ($prayers as $prayer) {
            if (!$currentPrayers->contains($prayer)) {
                $this->doAddPrayer($prayer);
            }
        }

        $this->collPrayersPartial = false;
        $this->collPrayers = $prayers;

        return $this;
    }

    /**
     * Gets the number of Prayer objects related by a many-to-many relationship
     * to the current object by way of the trialsXprayers cross-reference table.
     *
     * @param      Criteria $criteria Optional query object to filter the query
     * @param      boolean $distinct Set to true to force count distinct
     * @param      ConnectionInterface $con Optional connection object
     *
     * @return int the number of related Prayer objects
     */
    public function countPrayers(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collPrayersPartial && !$this->isNew();
        if (null === $this->collPrayers || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collPrayers) {
                return 0;
            } else {

                if ($partial && !$criteria) {
                    return count($this->getPrayers());
                }

                $query = ChildPrayerQuery::create(null, $criteria);
                if ($distinct) {
                    $query->distinct();
                }

                return $query
                    ->filterByTrial($this)
                    ->count($con);
            }
        } else {
            return count($this->collPrayers);
        }
    }

    /**
     * Associate a ChildPrayer to this object
     * through the trialsXprayers cross reference table.
     *
     * @param ChildPrayer $prayer
     * @return ChildTrial The current object (for fluent API support)
     */
    public function addPrayer(ChildPrayer $prayer)
    {
        if ($this->collPrayers === null) {
            $this->initPrayers();
        }

        if (!$this->getPrayers()->contains($prayer)) {
            // only add it if the **same** object is not already associated
            $this->collPrayers->push($prayer);
            $this->doAddPrayer($prayer);
        }

        return $this;
    }

    /**
     *
     * @param ChildPrayer $prayer
     */
    protected function doAddPrayer(ChildPrayer $prayer)
    {
        $trialPrayerAssociation = new ChildTrialPrayerAssociation();

        $trialPrayerAssociation->setPrayer($prayer);

        $trialPrayerAssociation->setTrial($this);

        $this->addTrialPrayerAssociation($trialPrayerAssociation);

        // set the back reference to this object directly as using provided method either results
        // in endless loop or in multiple relations
        if (!$prayer->isTrialsLoaded()) {
            $prayer->initTrials();
            $prayer->getTrials()->push($this);
        } elseif (!$prayer->getTrials()->contains($this)) {
            $prayer->getTrials()->push($this);
        }

    }

    /**
     * Remove prayer of this object
     * through the trialsXprayers cross reference table.
     *
     * @param ChildPrayer $prayer
     * @return ChildTrial The current object (for fluent API support)
     */
    public function removePrayer(ChildPrayer $prayer)
    {
        if ($this->getPrayers()->contains($prayer)) { $trialPrayerAssociation = new ChildTrialPrayerAssociation();

            $trialPrayerAssociation->setPrayer($prayer);
            if ($prayer->isTrialsLoaded()) {
                //remove the back reference if available
                $prayer->getTrials()->removeObject($this);
            }

            $trialPrayerAssociation->setTrial($this);
            $this->removeTrialPrayerAssociation(clone $trialPrayerAssociation);
            $trialPrayerAssociation->clear();

            $this->collPrayers->remove($this->collPrayers->search($prayer));

            if (null === $this->prayersScheduledForDeletion) {
                $this->prayersScheduledForDeletion = clone $this->collPrayers;
                $this->prayersScheduledForDeletion->clear();
            }

            $this->prayersScheduledForDeletion->push($prayer);
        }


        return $this;
    }

    /**
     * Clears out the collPainAssessmentItems collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addPainAssessmentItems()
     */
    public function clearPainAssessmentItems()
    {
        $this->collPainAssessmentItems = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Initializes the collPainAssessmentItems crossRef collection.
     *
     * By default this just sets the collPainAssessmentItems collection to an empty collection (like clearPainAssessmentItems());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @return void
     */
    public function initPainAssessmentItems()
    {
        $this->collPainAssessmentItems = new ObjectCollection();
        $this->collPainAssessmentItemsPartial = true;

        $this->collPainAssessmentItems->setModel('\PainAssessmentItem');
    }

    /**
     * Checks if the collPainAssessmentItems collection is loaded.
     *
     * @return bool
     */
    public function isPainAssessmentItemsLoaded()
    {
        return null !== $this->collPainAssessmentItems;
    }

    /**
     * Gets a collection of ChildPainAssessmentItem objects related by a many-to-many relationship
     * to the current object by way of the trialsXpain_items cross-reference table.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildTrial is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria Optional query object to filter the query
     * @param      ConnectionInterface $con Optional connection object
     *
     * @return ObjectCollection|ChildPainAssessmentItem[] List of ChildPainAssessmentItem objects
     */
    public function getPainAssessmentItems(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collPainAssessmentItemsPartial && !$this->isNew();
        if (null === $this->collPainAssessmentItems || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collPainAssessmentItems) {
                    $this->initPainAssessmentItems();
                }
            } else {

                $query = ChildPainAssessmentItemQuery::create(null, $criteria)
                    ->filterByTrial($this);
                $collPainAssessmentItems = $query->find($con);
                if (null !== $criteria) {
                    return $collPainAssessmentItems;
                }

                if ($partial && $this->collPainAssessmentItems) {
                    //make sure that already added objects gets added to the list of the database.
                    foreach ($this->collPainAssessmentItems as $obj) {
                        if (!$collPainAssessmentItems->contains($obj)) {
                            $collPainAssessmentItems[] = $obj;
                        }
                    }
                }

                $this->collPainAssessmentItems = $collPainAssessmentItems;
                $this->collPainAssessmentItemsPartial = false;
            }
        }

        return $this->collPainAssessmentItems;
    }

    /**
     * Sets a collection of PainAssessmentItem objects related by a many-to-many relationship
     * to the current object by way of the trialsXpain_items cross-reference table.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param  Collection $painAssessmentItems A Propel collection.
     * @param  ConnectionInterface $con Optional connection object
     * @return $this|ChildTrial The current object (for fluent API support)
     */
    public function setPainAssessmentItems(Collection $painAssessmentItems, ConnectionInterface $con = null)
    {
        $this->clearPainAssessmentItems();
        $currentPainAssessmentItems = $this->getPainAssessmentItems();

        $painAssessmentItemsScheduledForDeletion = $currentPainAssessmentItems->diff($painAssessmentItems);

        foreach ($painAssessmentItemsScheduledForDeletion as $toDelete) {
            $this->removePainAssessmentItem($toDelete);
        }

        foreach ($painAssessmentItems as $painAssessmentItem) {
            if (!$currentPainAssessmentItems->contains($painAssessmentItem)) {
                $this->doAddPainAssessmentItem($painAssessmentItem);
            }
        }

        $this->collPainAssessmentItemsPartial = false;
        $this->collPainAssessmentItems = $painAssessmentItems;

        return $this;
    }

    /**
     * Gets the number of PainAssessmentItem objects related by a many-to-many relationship
     * to the current object by way of the trialsXpain_items cross-reference table.
     *
     * @param      Criteria $criteria Optional query object to filter the query
     * @param      boolean $distinct Set to true to force count distinct
     * @param      ConnectionInterface $con Optional connection object
     *
     * @return int the number of related PainAssessmentItem objects
     */
    public function countPainAssessmentItems(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collPainAssessmentItemsPartial && !$this->isNew();
        if (null === $this->collPainAssessmentItems || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collPainAssessmentItems) {
                return 0;
            } else {

                if ($partial && !$criteria) {
                    return count($this->getPainAssessmentItems());
                }

                $query = ChildPainAssessmentItemQuery::create(null, $criteria);
                if ($distinct) {
                    $query->distinct();
                }

                return $query
                    ->filterByTrial($this)
                    ->count($con);
            }
        } else {
            return count($this->collPainAssessmentItems);
        }
    }

    /**
     * Associate a ChildPainAssessmentItem to this object
     * through the trialsXpain_items cross reference table.
     *
     * @param ChildPainAssessmentItem $painAssessmentItem
     * @return ChildTrial The current object (for fluent API support)
     */
    public function addPainAssessmentItem(ChildPainAssessmentItem $painAssessmentItem)
    {
        if ($this->collPainAssessmentItems === null) {
            $this->initPainAssessmentItems();
        }

        if (!$this->getPainAssessmentItems()->contains($painAssessmentItem)) {
            // only add it if the **same** object is not already associated
            $this->collPainAssessmentItems->push($painAssessmentItem);
            $this->doAddPainAssessmentItem($painAssessmentItem);
        }

        return $this;
    }

    /**
     *
     * @param ChildPainAssessmentItem $painAssessmentItem
     */
    protected function doAddPainAssessmentItem(ChildPainAssessmentItem $painAssessmentItem)
    {
        $trialPainRatingAssociation = new ChildTrialPainRatingAssociation();

        $trialPainRatingAssociation->setPainAssessmentItem($painAssessmentItem);

        $trialPainRatingAssociation->setTrial($this);

        $this->addTrialPainRatingAssociation($trialPainRatingAssociation);

        // set the back reference to this object directly as using provided method either results
        // in endless loop or in multiple relations
        if (!$painAssessmentItem->isTrialsLoaded()) {
            $painAssessmentItem->initTrials();
            $painAssessmentItem->getTrials()->push($this);
        } elseif (!$painAssessmentItem->getTrials()->contains($this)) {
            $painAssessmentItem->getTrials()->push($this);
        }

    }

    /**
     * Remove painAssessmentItem of this object
     * through the trialsXpain_items cross reference table.
     *
     * @param ChildPainAssessmentItem $painAssessmentItem
     * @return ChildTrial The current object (for fluent API support)
     */
    public function removePainAssessmentItem(ChildPainAssessmentItem $painAssessmentItem)
    {
        if ($this->getPainAssessmentItems()->contains($painAssessmentItem)) { $trialPainRatingAssociation = new ChildTrialPainRatingAssociation();

            $trialPainRatingAssociation->setPainAssessmentItem($painAssessmentItem);
            if ($painAssessmentItem->isTrialsLoaded()) {
                //remove the back reference if available
                $painAssessmentItem->getTrials()->removeObject($this);
            }

            $trialPainRatingAssociation->setTrial($this);
            $this->removeTrialPainRatingAssociation(clone $trialPainRatingAssociation);
            $trialPainRatingAssociation->clear();

            $this->collPainAssessmentItems->remove($this->collPainAssessmentItems->search($painAssessmentItem));

            if (null === $this->painAssessmentItemsScheduledForDeletion) {
                $this->painAssessmentItemsScheduledForDeletion = clone $this->collPainAssessmentItems;
                $this->painAssessmentItemsScheduledForDeletion->clear();
            }

            $this->painAssessmentItemsScheduledForDeletion->push($painAssessmentItem);
        }


        return $this;
    }

    /**
     * Clears the current object, sets all attributes to their default values and removes
     * outgoing references as well as back-references (from other objects to this one. Results probably in a database
     * change of those foreign objects when you call `save` there).
     */
    public function clear()
    {
        $this->id = null;
        $this->created_at = null;
        $this->updated_at = null;
        $this->alreadyInSave = false;
        $this->clearAllReferences();
        $this->resetModified();
        $this->setNew(true);
        $this->setDeleted(false);
    }

    /**
     * Resets all references and back-references to other model objects or collections of model objects.
     *
     * This method is used to reset all php object references (not the actual reference in the database).
     * Necessary for object serialisation.
     *
     * @param      boolean $deep Whether to also clear the references on all referrer objects.
     */
    public function clearAllReferences($deep = false)
    {
        if ($deep) {
            if ($this->collTrialPrayerAssociations) {
                foreach ($this->collTrialPrayerAssociations as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collTrialPainRatingAssociations) {
                foreach ($this->collTrialPainRatingAssociations as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collPrayers) {
                foreach ($this->collPrayers as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collPainAssessmentItems) {
                foreach ($this->collPainAssessmentItems as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        $this->collTrialPrayerAssociations = null;
        $this->collTrialPainRatingAssociations = null;
        $this->collPrayers = null;
        $this->collPainAssessmentItems = null;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(TrialTableMap::DEFAULT_STRING_FORMAT);
    }

    // timestampable behavior

    /**
     * Mark the current object so that the update date doesn't get updated during next save
     *
     * @return     $this|ChildTrial The current object (for fluent API support)
     */
    public function keepUpdateDateUnchanged()
    {
        $this->modifiedColumns[TrialTableMap::COL_UPDATED_AT] = true;

        return $this;
    }

    /**
     * Code to be run before persisting the object
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preSave(ConnectionInterface $con = null)
    {
        return true;
    }

    /**
     * Code to be run after persisting the object
     * @param ConnectionInterface $con
     */
    public function postSave(ConnectionInterface $con = null)
    {

    }

    /**
     * Code to be run before inserting to database
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preInsert(ConnectionInterface $con = null)
    {
        return true;
    }

    /**
     * Code to be run after inserting to database
     * @param ConnectionInterface $con
     */
    public function postInsert(ConnectionInterface $con = null)
    {

    }

    /**
     * Code to be run before updating the object in database
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preUpdate(ConnectionInterface $con = null)
    {
        return true;
    }

    /**
     * Code to be run after updating the object in database
     * @param ConnectionInterface $con
     */
    public function postUpdate(ConnectionInterface $con = null)
    {

    }

    /**
     * Code to be run before deleting the object in database
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preDelete(ConnectionInterface $con = null)
    {
        return true;
    }

    /**
     * Code to be run after deleting the object in database
     * @param ConnectionInterface $con
     */
    public function postDelete(ConnectionInterface $con = null)
    {

    }


    /**
     * Derived method to catches calls to undefined methods.
     *
     * Provides magic import/export method support (fromXML()/toXML(), fromYAML()/toYAML(), etc.).
     * Allows to define default __call() behavior if you overwrite __call()
     *
     * @param string $name
     * @param mixed  $params
     *
     * @return array|string
     */
    public function __call($name, $params)
    {
        if (0 === strpos($name, 'get')) {
            $virtualColumn = substr($name, 3);
            if ($this->hasVirtualColumn($virtualColumn)) {
                return $this->getVirtualColumn($virtualColumn);
            }

            $virtualColumn = lcfirst($virtualColumn);
            if ($this->hasVirtualColumn($virtualColumn)) {
                return $this->getVirtualColumn($virtualColumn);
            }
        }

        if (0 === strpos($name, 'from')) {
            $format = substr($name, 4);

            return $this->importFrom($format, reset($params));
        }

        if (0 === strpos($name, 'to')) {
            $format = substr($name, 2);
            $includeLazyLoadColumns = isset($params[0]) ? $params[0] : true;

            return $this->exportTo($format, $includeLazyLoadColumns);
        }

        throw new BadMethodCallException(sprintf('Call to undefined method: %s.', $name));
    }

}
