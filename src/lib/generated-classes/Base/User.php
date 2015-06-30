<?php

namespace Base;

use \Age as ChildAge;
use \AgeQuery as ChildAgeQuery;
use \AssignedPrayer as ChildAssignedPrayer;
use \AssignedPrayerQuery as ChildAssignedPrayerQuery;
use \PainRating as ChildPainRating;
use \PainRatingQuery as ChildPainRatingQuery;
use \Partners as ChildPartners;
use \PartnersQuery as ChildPartnersQuery;
use \User as ChildUser;
use \UserDemos as ChildUserDemos;
use \UserDemosQuery as ChildUserDemosQuery;
use \UserQuery as ChildUserQuery;
use \DateTime;
use \Exception;
use \PDO;
use Map\UserTableMap;
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
 * Base class that represents a row from the 'users' table.
 *
 *
 *
* @package    propel.generator..Base
*/
abstract class User implements ActiveRecordInterface
{
    /**
     * TableMap class name
     */
    const TABLE_MAP = '\\Map\\UserTableMap';


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
     * The value for the nickname field.
     * @var        string
     */
    protected $nickname;

    /**
     * The value for the email field.
     * @var        string
     */
    protected $email;

    /**
     * The value for the age field.
     * @var        string
     */
    protected $age;

    /**
     * The value for the sex field.
     * @var        string
     */
    protected $sex;

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
     * @var        ChildAge
     */
    protected $aUserAge;

    /**
     * @var        ObjectCollection|ChildAssignedPrayer[] Collection to store aggregation of ChildAssignedPrayer objects.
     */
    protected $collAssignedPrayersRelatedByAgentId;
    protected $collAssignedPrayersRelatedByAgentIdPartial;

    /**
     * @var        ObjectCollection|ChildAssignedPrayer[] Collection to store aggregation of ChildAssignedPrayer objects.
     */
    protected $collAssignedPrayersRelatedByPatientId;
    protected $collAssignedPrayersRelatedByPatientIdPartial;

    /**
     * @var        ObjectCollection|ChildPartners[] Collection to store aggregation of ChildPartners objects.
     */
    protected $collPartnerssRelatedByAgentId;
    protected $collPartnerssRelatedByAgentIdPartial;

    /**
     * @var        ObjectCollection|ChildPartners[] Collection to store aggregation of ChildPartners objects.
     */
    protected $collPartnerssRelatedByPatientId;
    protected $collPartnerssRelatedByPatientIdPartial;

    /**
     * @var        ObjectCollection|ChildPainRating[] Collection to store aggregation of ChildPainRating objects.
     */
    protected $collPainRatings;
    protected $collPainRatingsPartial;

    /**
     * @var        ObjectCollection|ChildUserDemos[] Collection to store aggregation of ChildUserDemos objects.
     */
    protected $collUserDemoss;
    protected $collUserDemossPartial;

    /**
     * @var        ObjectCollection|ChildUser[] Cross Collection to store aggregation of ChildUser objects.
     */
    protected $collPatients;

    /**
     * @var bool
     */
    protected $collPatientsPartial;

    /**
     * @var        ObjectCollection|ChildUser[] Cross Collection to store aggregation of ChildUser objects.
     */
    protected $collAgents;

    /**
     * @var bool
     */
    protected $collAgentsPartial;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var boolean
     */
    protected $alreadyInSave = false;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildUser[]
     */
    protected $patientsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildUser[]
     */
    protected $agentsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildAssignedPrayer[]
     */
    protected $assignedPrayersRelatedByAgentIdScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildAssignedPrayer[]
     */
    protected $assignedPrayersRelatedByPatientIdScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildPartners[]
     */
    protected $partnerssRelatedByAgentIdScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildPartners[]
     */
    protected $partnerssRelatedByPatientIdScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildPainRating[]
     */
    protected $painRatingsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildUserDemos[]
     */
    protected $userDemossScheduledForDeletion = null;

    /**
     * Initializes internal state of Base\User object.
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
     * Compares this with another <code>User</code> instance.  If
     * <code>obj</code> is an instance of <code>User</code>, delegates to
     * <code>equals(User)</code>.  Otherwise, returns <code>false</code>.
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
     * @return $this|User The current object, for fluid interface
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
     * Get the [nickname] column value.
     *
     * @return string
     */
    public function getNickname()
    {
        return $this->nickname;
    }

    /**
     * Get the [email] column value.
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Get the [age] column value.
     *
     * @return string
     */
    public function getAge()
    {
        return $this->age;
    }

    /**
     * Get the [sex] column value.
     *
     * @return string
     */
    public function getSex()
    {
        return $this->sex;
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
     * @return $this|\User The current object (for fluent API support)
     */
    public function setId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->id !== $v) {
            $this->id = $v;
            $this->modifiedColumns[UserTableMap::COL_ID] = true;
        }

        return $this;
    } // setId()

    /**
     * Set the value of [nickname] column.
     *
     * @param string $v new value
     * @return $this|\User The current object (for fluent API support)
     */
    public function setNickname($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->nickname !== $v) {
            $this->nickname = $v;
            $this->modifiedColumns[UserTableMap::COL_NICKNAME] = true;
        }

        return $this;
    } // setNickname()

    /**
     * Set the value of [email] column.
     *
     * @param string $v new value
     * @return $this|\User The current object (for fluent API support)
     */
    public function setEmail($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->email !== $v) {
            $this->email = $v;
            $this->modifiedColumns[UserTableMap::COL_EMAIL] = true;
        }

        return $this;
    } // setEmail()

    /**
     * Set the value of [age] column.
     *
     * @param string $v new value
     * @return $this|\User The current object (for fluent API support)
     */
    public function setAge($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->age !== $v) {
            $this->age = $v;
            $this->modifiedColumns[UserTableMap::COL_AGE] = true;
        }

        if ($this->aUserAge !== null && $this->aUserAge->getAge() !== $v) {
            $this->aUserAge = null;
        }

        return $this;
    } // setAge()

    /**
     * Set the value of [sex] column.
     *
     * @param string $v new value
     * @return $this|\User The current object (for fluent API support)
     */
    public function setSex($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->sex !== $v) {
            $this->sex = $v;
            $this->modifiedColumns[UserTableMap::COL_SEX] = true;
        }

        return $this;
    } // setSex()

    /**
     * Sets the value of [created_at] column to a normalized version of the date/time value specified.
     *
     * @param  mixed $v string, integer (timestamp), or \DateTime value.
     *               Empty strings are treated as NULL.
     * @return $this|\User The current object (for fluent API support)
     */
    public function setCreatedAt($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->created_at !== null || $dt !== null) {
            if ($this->created_at === null || $dt === null || $dt->format("Y-m-d H:i:s") !== $this->created_at->format("Y-m-d H:i:s")) {
                $this->created_at = $dt === null ? null : clone $dt;
                $this->modifiedColumns[UserTableMap::COL_CREATED_AT] = true;
            }
        } // if either are not null

        return $this;
    } // setCreatedAt()

    /**
     * Sets the value of [updated_at] column to a normalized version of the date/time value specified.
     *
     * @param  mixed $v string, integer (timestamp), or \DateTime value.
     *               Empty strings are treated as NULL.
     * @return $this|\User The current object (for fluent API support)
     */
    public function setUpdatedAt($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->updated_at !== null || $dt !== null) {
            if ($this->updated_at === null || $dt === null || $dt->format("Y-m-d H:i:s") !== $this->updated_at->format("Y-m-d H:i:s")) {
                $this->updated_at = $dt === null ? null : clone $dt;
                $this->modifiedColumns[UserTableMap::COL_UPDATED_AT] = true;
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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : UserTableMap::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)];
            $this->id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : UserTableMap::translateFieldName('Nickname', TableMap::TYPE_PHPNAME, $indexType)];
            $this->nickname = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : UserTableMap::translateFieldName('Email', TableMap::TYPE_PHPNAME, $indexType)];
            $this->email = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : UserTableMap::translateFieldName('Age', TableMap::TYPE_PHPNAME, $indexType)];
            $this->age = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : UserTableMap::translateFieldName('Sex', TableMap::TYPE_PHPNAME, $indexType)];
            $this->sex = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : UserTableMap::translateFieldName('CreatedAt', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->created_at = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : UserTableMap::translateFieldName('UpdatedAt', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->updated_at = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 7; // 7 = UserTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\User'), 0, $e);
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
        if ($this->aUserAge !== null && $this->age !== $this->aUserAge->getAge()) {
            $this->aUserAge = null;
        }
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
            $con = Propel::getServiceContainer()->getReadConnection(UserTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildUserQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aUserAge = null;
            $this->collAssignedPrayersRelatedByAgentId = null;

            $this->collAssignedPrayersRelatedByPatientId = null;

            $this->collPartnerssRelatedByAgentId = null;

            $this->collPartnerssRelatedByPatientId = null;

            $this->collPainRatings = null;

            $this->collUserDemoss = null;

            $this->collPatients = null;
            $this->collAgents = null;
        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param      ConnectionInterface $con
     * @return void
     * @throws PropelException
     * @see User::setDeleted()
     * @see User::isDeleted()
     */
    public function delete(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(UserTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildUserQuery::create()
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
            $con = Propel::getServiceContainer()->getWriteConnection(UserTableMap::DATABASE_NAME);
        }

        return $con->transaction(function () use ($con) {
            $isInsert = $this->isNew();
            $ret = $this->preSave($con);
            if ($isInsert) {
                $ret = $ret && $this->preInsert($con);
                // timestampable behavior

                if (!$this->isColumnModified(UserTableMap::COL_CREATED_AT)) {
                    $this->setCreatedAt(time());
                }
                if (!$this->isColumnModified(UserTableMap::COL_UPDATED_AT)) {
                    $this->setUpdatedAt(time());
                }
            } else {
                $ret = $ret && $this->preUpdate($con);
                // timestampable behavior
                if ($this->isModified() && !$this->isColumnModified(UserTableMap::COL_UPDATED_AT)) {
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
                UserTableMap::addInstanceToPool($this);
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

            // We call the save method on the following object(s) if they
            // were passed to this object by their corresponding set
            // method.  This object relates to these object(s) by a
            // foreign key reference.

            if ($this->aUserAge !== null) {
                if ($this->aUserAge->isModified() || $this->aUserAge->isNew()) {
                    $affectedRows += $this->aUserAge->save($con);
                }
                $this->setUserAge($this->aUserAge);
            }

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

            if ($this->patientsScheduledForDeletion !== null) {
                if (!$this->patientsScheduledForDeletion->isEmpty()) {
                    $pks = array();
                    foreach ($this->patientsScheduledForDeletion as $entry) {
                        $entryPk = [];

                        $entryPk[0] = $this->getId();
                        $entryPk[1] = $entry->getId();
                        $pks[] = $entryPk;
                    }

                    \PartnersQuery::create()
                        ->filterByPrimaryKeys($pks)
                        ->delete($con);

                    $this->patientsScheduledForDeletion = null;
                }

            }

            if ($this->collPatients) {
                foreach ($this->collPatients as $patient) {
                    if (!$patient->isDeleted() && ($patient->isNew() || $patient->isModified())) {
                        $patient->save($con);
                    }
                }
            }


            if ($this->agentsScheduledForDeletion !== null) {
                if (!$this->agentsScheduledForDeletion->isEmpty()) {
                    $pks = array();
                    foreach ($this->agentsScheduledForDeletion as $entry) {
                        $entryPk = [];

                        $entryPk[1] = $this->getId();
                        $entryPk[0] = $entry->getId();
                        $pks[] = $entryPk;
                    }

                    \PartnersQuery::create()
                        ->filterByPrimaryKeys($pks)
                        ->delete($con);

                    $this->agentsScheduledForDeletion = null;
                }

            }

            if ($this->collAgents) {
                foreach ($this->collAgents as $agent) {
                    if (!$agent->isDeleted() && ($agent->isNew() || $agent->isModified())) {
                        $agent->save($con);
                    }
                }
            }


            if ($this->assignedPrayersRelatedByAgentIdScheduledForDeletion !== null) {
                if (!$this->assignedPrayersRelatedByAgentIdScheduledForDeletion->isEmpty()) {
                    \AssignedPrayerQuery::create()
                        ->filterByPrimaryKeys($this->assignedPrayersRelatedByAgentIdScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->assignedPrayersRelatedByAgentIdScheduledForDeletion = null;
                }
            }

            if ($this->collAssignedPrayersRelatedByAgentId !== null) {
                foreach ($this->collAssignedPrayersRelatedByAgentId as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->assignedPrayersRelatedByPatientIdScheduledForDeletion !== null) {
                if (!$this->assignedPrayersRelatedByPatientIdScheduledForDeletion->isEmpty()) {
                    \AssignedPrayerQuery::create()
                        ->filterByPrimaryKeys($this->assignedPrayersRelatedByPatientIdScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->assignedPrayersRelatedByPatientIdScheduledForDeletion = null;
                }
            }

            if ($this->collAssignedPrayersRelatedByPatientId !== null) {
                foreach ($this->collAssignedPrayersRelatedByPatientId as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->partnerssRelatedByAgentIdScheduledForDeletion !== null) {
                if (!$this->partnerssRelatedByAgentIdScheduledForDeletion->isEmpty()) {
                    \PartnersQuery::create()
                        ->filterByPrimaryKeys($this->partnerssRelatedByAgentIdScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->partnerssRelatedByAgentIdScheduledForDeletion = null;
                }
            }

            if ($this->collPartnerssRelatedByAgentId !== null) {
                foreach ($this->collPartnerssRelatedByAgentId as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->partnerssRelatedByPatientIdScheduledForDeletion !== null) {
                if (!$this->partnerssRelatedByPatientIdScheduledForDeletion->isEmpty()) {
                    \PartnersQuery::create()
                        ->filterByPrimaryKeys($this->partnerssRelatedByPatientIdScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->partnerssRelatedByPatientIdScheduledForDeletion = null;
                }
            }

            if ($this->collPartnerssRelatedByPatientId !== null) {
                foreach ($this->collPartnerssRelatedByPatientId as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->painRatingsScheduledForDeletion !== null) {
                if (!$this->painRatingsScheduledForDeletion->isEmpty()) {
                    \PainRatingQuery::create()
                        ->filterByPrimaryKeys($this->painRatingsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->painRatingsScheduledForDeletion = null;
                }
            }

            if ($this->collPainRatings !== null) {
                foreach ($this->collPainRatings as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->userDemossScheduledForDeletion !== null) {
                if (!$this->userDemossScheduledForDeletion->isEmpty()) {
                    \UserDemosQuery::create()
                        ->filterByPrimaryKeys($this->userDemossScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->userDemossScheduledForDeletion = null;
                }
            }

            if ($this->collUserDemoss !== null) {
                foreach ($this->collUserDemoss as $referrerFK) {
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

        $this->modifiedColumns[UserTableMap::COL_ID] = true;
        if (null !== $this->id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . UserTableMap::COL_ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(UserTableMap::COL_ID)) {
            $modifiedColumns[':p' . $index++]  = 'id';
        }
        if ($this->isColumnModified(UserTableMap::COL_NICKNAME)) {
            $modifiedColumns[':p' . $index++]  = 'nickname';
        }
        if ($this->isColumnModified(UserTableMap::COL_EMAIL)) {
            $modifiedColumns[':p' . $index++]  = 'email';
        }
        if ($this->isColumnModified(UserTableMap::COL_AGE)) {
            $modifiedColumns[':p' . $index++]  = 'age';
        }
        if ($this->isColumnModified(UserTableMap::COL_SEX)) {
            $modifiedColumns[':p' . $index++]  = 'sex';
        }
        if ($this->isColumnModified(UserTableMap::COL_CREATED_AT)) {
            $modifiedColumns[':p' . $index++]  = 'created_at';
        }
        if ($this->isColumnModified(UserTableMap::COL_UPDATED_AT)) {
            $modifiedColumns[':p' . $index++]  = 'updated_at';
        }

        $sql = sprintf(
            'INSERT INTO users (%s) VALUES (%s)',
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
                    case 'nickname':
                        $stmt->bindValue($identifier, $this->nickname, PDO::PARAM_STR);
                        break;
                    case 'email':
                        $stmt->bindValue($identifier, $this->email, PDO::PARAM_STR);
                        break;
                    case 'age':
                        $stmt->bindValue($identifier, $this->age, PDO::PARAM_STR);
                        break;
                    case 'sex':
                        $stmt->bindValue($identifier, $this->sex, PDO::PARAM_STR);
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
        $pos = UserTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getNickname();
                break;
            case 2:
                return $this->getEmail();
                break;
            case 3:
                return $this->getAge();
                break;
            case 4:
                return $this->getSex();
                break;
            case 5:
                return $this->getCreatedAt();
                break;
            case 6:
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

        if (isset($alreadyDumpedObjects['User'][$this->hashCode()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['User'][$this->hashCode()] = true;
        $keys = UserTableMap::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getId(),
            $keys[1] => $this->getNickname(),
            $keys[2] => $this->getEmail(),
            $keys[3] => $this->getAge(),
            $keys[4] => $this->getSex(),
            $keys[5] => $this->getCreatedAt(),
            $keys[6] => $this->getUpdatedAt(),
        );

        $utc = new \DateTimeZone('utc');
        if ($result[$keys[5]] instanceof \DateTime) {
            // When changing timezone we don't want to change existing instances
            $dateTime = clone $result[$keys[5]];
            $result[$keys[5]] = $dateTime->setTimezone($utc)->format('Y-m-d\TH:i:s\Z');
        }

        if ($result[$keys[6]] instanceof \DateTime) {
            // When changing timezone we don't want to change existing instances
            $dateTime = clone $result[$keys[6]];
            $result[$keys[6]] = $dateTime->setTimezone($utc)->format('Y-m-d\TH:i:s\Z');
        }

        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->aUserAge) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'age';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'u_ages';
                        break;
                    default:
                        $key = 'Age';
                }

                $result[$key] = $this->aUserAge->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->collAssignedPrayersRelatedByAgentId) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'assignedPrayers';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'assigned_prayers';
                        break;
                    default:
                        $key = 'AssignedPrayers';
                }

                $result[$key] = $this->collAssignedPrayersRelatedByAgentId->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collAssignedPrayersRelatedByPatientId) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'assignedPrayers';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'assigned_prayers';
                        break;
                    default:
                        $key = 'AssignedPrayers';
                }

                $result[$key] = $this->collAssignedPrayersRelatedByPatientId->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collPartnerssRelatedByAgentId) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'partnerss';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'partnerss';
                        break;
                    default:
                        $key = 'Partnerss';
                }

                $result[$key] = $this->collPartnerssRelatedByAgentId->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collPartnerssRelatedByPatientId) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'partnerss';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'partnerss';
                        break;
                    default:
                        $key = 'Partnerss';
                }

                $result[$key] = $this->collPartnerssRelatedByPatientId->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collPainRatings) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'painRatings';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'pain_ratingss';
                        break;
                    default:
                        $key = 'PainRatings';
                }

                $result[$key] = $this->collPainRatings->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collUserDemoss) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'userDemoss';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'user_demoss';
                        break;
                    default:
                        $key = 'UserDemoss';
                }

                $result[$key] = $this->collUserDemoss->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
     * @return $this|\User
     */
    public function setByName($name, $value, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = UserTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

        return $this->setByPosition($pos, $value);
    }

    /**
     * Sets a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param  int $pos position in xml schema
     * @param  mixed $value field value
     * @return $this|\User
     */
    public function setByPosition($pos, $value)
    {
        switch ($pos) {
            case 0:
                $this->setId($value);
                break;
            case 1:
                $this->setNickname($value);
                break;
            case 2:
                $this->setEmail($value);
                break;
            case 3:
                $this->setAge($value);
                break;
            case 4:
                $this->setSex($value);
                break;
            case 5:
                $this->setCreatedAt($value);
                break;
            case 6:
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
        $keys = UserTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setId($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setNickname($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setEmail($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setAge($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setSex($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setCreatedAt($arr[$keys[5]]);
        }
        if (array_key_exists($keys[6], $arr)) {
            $this->setUpdatedAt($arr[$keys[6]]);
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
     * @return $this|\User The current object, for fluid interface
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
        $criteria = new Criteria(UserTableMap::DATABASE_NAME);

        if ($this->isColumnModified(UserTableMap::COL_ID)) {
            $criteria->add(UserTableMap::COL_ID, $this->id);
        }
        if ($this->isColumnModified(UserTableMap::COL_NICKNAME)) {
            $criteria->add(UserTableMap::COL_NICKNAME, $this->nickname);
        }
        if ($this->isColumnModified(UserTableMap::COL_EMAIL)) {
            $criteria->add(UserTableMap::COL_EMAIL, $this->email);
        }
        if ($this->isColumnModified(UserTableMap::COL_AGE)) {
            $criteria->add(UserTableMap::COL_AGE, $this->age);
        }
        if ($this->isColumnModified(UserTableMap::COL_SEX)) {
            $criteria->add(UserTableMap::COL_SEX, $this->sex);
        }
        if ($this->isColumnModified(UserTableMap::COL_CREATED_AT)) {
            $criteria->add(UserTableMap::COL_CREATED_AT, $this->created_at);
        }
        if ($this->isColumnModified(UserTableMap::COL_UPDATED_AT)) {
            $criteria->add(UserTableMap::COL_UPDATED_AT, $this->updated_at);
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
        $criteria = ChildUserQuery::create();
        $criteria->add(UserTableMap::COL_ID, $this->id);
        $criteria->add(UserTableMap::COL_NICKNAME, $this->nickname);

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
        $validPk = null !== $this->getId() &&
            null !== $this->getNickname();

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
     * Returns the composite primary key for this object.
     * The array elements will be in same order as specified in XML.
     * @return array
     */
    public function getPrimaryKey()
    {
        $pks = array();
        $pks[0] = $this->getId();
        $pks[1] = $this->getNickname();

        return $pks;
    }

    /**
     * Set the [composite] primary key.
     *
     * @param      array $keys The elements of the composite key (order must match the order in XML file).
     * @return void
     */
    public function setPrimaryKey($keys)
    {
        $this->setId($keys[0]);
        $this->setNickname($keys[1]);
    }

    /**
     * Returns true if the primary key for this object is null.
     * @return boolean
     */
    public function isPrimaryKeyNull()
    {
        return (null === $this->getId()) && (null === $this->getNickname());
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param      object $copyObj An object of \User (or compatible) type.
     * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setNickname($this->getNickname());
        $copyObj->setEmail($this->getEmail());
        $copyObj->setAge($this->getAge());
        $copyObj->setSex($this->getSex());
        $copyObj->setCreatedAt($this->getCreatedAt());
        $copyObj->setUpdatedAt($this->getUpdatedAt());

        if ($deepCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);

            foreach ($this->getAssignedPrayersRelatedByAgentId() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addAssignedPrayerRelatedByAgentId($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getAssignedPrayersRelatedByPatientId() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addAssignedPrayerRelatedByPatientId($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getPartnerssRelatedByAgentId() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addPartnersRelatedByAgentId($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getPartnerssRelatedByPatientId() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addPartnersRelatedByPatientId($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getPainRatings() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addPainRating($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getUserDemoss() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addUserDemos($relObj->copy($deepCopy));
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
     * @return \User Clone of current object.
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
     * Declares an association between this object and a ChildAge object.
     *
     * @param  ChildAge $v
     * @return $this|\User The current object (for fluent API support)
     * @throws PropelException
     */
    public function setUserAge(ChildAge $v = null)
    {
        if ($v === null) {
            $this->setAge(NULL);
        } else {
            $this->setAge($v->getAge());
        }

        $this->aUserAge = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildAge object, it will not be re-added.
        if ($v !== null) {
            $v->addUser($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildAge object
     *
     * @param  ConnectionInterface $con Optional Connection object.
     * @return ChildAge The associated ChildAge object.
     * @throws PropelException
     */
    public function getUserAge(ConnectionInterface $con = null)
    {
        if ($this->aUserAge === null && (($this->age !== "" && $this->age !== null))) {
            $this->aUserAge = ChildAgeQuery::create()->findPk($this->age, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aUserAge->addUsers($this);
             */
        }

        return $this->aUserAge;
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
        if ('AssignedPrayerRelatedByAgentId' == $relationName) {
            return $this->initAssignedPrayersRelatedByAgentId();
        }
        if ('AssignedPrayerRelatedByPatientId' == $relationName) {
            return $this->initAssignedPrayersRelatedByPatientId();
        }
        if ('PartnersRelatedByAgentId' == $relationName) {
            return $this->initPartnerssRelatedByAgentId();
        }
        if ('PartnersRelatedByPatientId' == $relationName) {
            return $this->initPartnerssRelatedByPatientId();
        }
        if ('PainRating' == $relationName) {
            return $this->initPainRatings();
        }
        if ('UserDemos' == $relationName) {
            return $this->initUserDemoss();
        }
    }

    /**
     * Clears out the collAssignedPrayersRelatedByAgentId collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addAssignedPrayersRelatedByAgentId()
     */
    public function clearAssignedPrayersRelatedByAgentId()
    {
        $this->collAssignedPrayersRelatedByAgentId = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collAssignedPrayersRelatedByAgentId collection loaded partially.
     */
    public function resetPartialAssignedPrayersRelatedByAgentId($v = true)
    {
        $this->collAssignedPrayersRelatedByAgentIdPartial = $v;
    }

    /**
     * Initializes the collAssignedPrayersRelatedByAgentId collection.
     *
     * By default this just sets the collAssignedPrayersRelatedByAgentId collection to an empty array (like clearcollAssignedPrayersRelatedByAgentId());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initAssignedPrayersRelatedByAgentId($overrideExisting = true)
    {
        if (null !== $this->collAssignedPrayersRelatedByAgentId && !$overrideExisting) {
            return;
        }
        $this->collAssignedPrayersRelatedByAgentId = new ObjectCollection();
        $this->collAssignedPrayersRelatedByAgentId->setModel('\AssignedPrayer');
    }

    /**
     * Gets an array of ChildAssignedPrayer objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildUser is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildAssignedPrayer[] List of ChildAssignedPrayer objects
     * @throws PropelException
     */
    public function getAssignedPrayersRelatedByAgentId(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collAssignedPrayersRelatedByAgentIdPartial && !$this->isNew();
        if (null === $this->collAssignedPrayersRelatedByAgentId || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collAssignedPrayersRelatedByAgentId) {
                // return empty collection
                $this->initAssignedPrayersRelatedByAgentId();
            } else {
                $collAssignedPrayersRelatedByAgentId = ChildAssignedPrayerQuery::create(null, $criteria)
                    ->filterByAgent($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collAssignedPrayersRelatedByAgentIdPartial && count($collAssignedPrayersRelatedByAgentId)) {
                        $this->initAssignedPrayersRelatedByAgentId(false);

                        foreach ($collAssignedPrayersRelatedByAgentId as $obj) {
                            if (false == $this->collAssignedPrayersRelatedByAgentId->contains($obj)) {
                                $this->collAssignedPrayersRelatedByAgentId->append($obj);
                            }
                        }

                        $this->collAssignedPrayersRelatedByAgentIdPartial = true;
                    }

                    return $collAssignedPrayersRelatedByAgentId;
                }

                if ($partial && $this->collAssignedPrayersRelatedByAgentId) {
                    foreach ($this->collAssignedPrayersRelatedByAgentId as $obj) {
                        if ($obj->isNew()) {
                            $collAssignedPrayersRelatedByAgentId[] = $obj;
                        }
                    }
                }

                $this->collAssignedPrayersRelatedByAgentId = $collAssignedPrayersRelatedByAgentId;
                $this->collAssignedPrayersRelatedByAgentIdPartial = false;
            }
        }

        return $this->collAssignedPrayersRelatedByAgentId;
    }

    /**
     * Sets a collection of ChildAssignedPrayer objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $assignedPrayersRelatedByAgentId A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildUser The current object (for fluent API support)
     */
    public function setAssignedPrayersRelatedByAgentId(Collection $assignedPrayersRelatedByAgentId, ConnectionInterface $con = null)
    {
        /** @var ChildAssignedPrayer[] $assignedPrayersRelatedByAgentIdToDelete */
        $assignedPrayersRelatedByAgentIdToDelete = $this->getAssignedPrayersRelatedByAgentId(new Criteria(), $con)->diff($assignedPrayersRelatedByAgentId);


        $this->assignedPrayersRelatedByAgentIdScheduledForDeletion = $assignedPrayersRelatedByAgentIdToDelete;

        foreach ($assignedPrayersRelatedByAgentIdToDelete as $assignedPrayerRelatedByAgentIdRemoved) {
            $assignedPrayerRelatedByAgentIdRemoved->setAgent(null);
        }

        $this->collAssignedPrayersRelatedByAgentId = null;
        foreach ($assignedPrayersRelatedByAgentId as $assignedPrayerRelatedByAgentId) {
            $this->addAssignedPrayerRelatedByAgentId($assignedPrayerRelatedByAgentId);
        }

        $this->collAssignedPrayersRelatedByAgentId = $assignedPrayersRelatedByAgentId;
        $this->collAssignedPrayersRelatedByAgentIdPartial = false;

        return $this;
    }

    /**
     * Returns the number of related AssignedPrayer objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related AssignedPrayer objects.
     * @throws PropelException
     */
    public function countAssignedPrayersRelatedByAgentId(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collAssignedPrayersRelatedByAgentIdPartial && !$this->isNew();
        if (null === $this->collAssignedPrayersRelatedByAgentId || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collAssignedPrayersRelatedByAgentId) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getAssignedPrayersRelatedByAgentId());
            }

            $query = ChildAssignedPrayerQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByAgent($this)
                ->count($con);
        }

        return count($this->collAssignedPrayersRelatedByAgentId);
    }

    /**
     * Method called to associate a ChildAssignedPrayer object to this object
     * through the ChildAssignedPrayer foreign key attribute.
     *
     * @param  ChildAssignedPrayer $l ChildAssignedPrayer
     * @return $this|\User The current object (for fluent API support)
     */
    public function addAssignedPrayerRelatedByAgentId(ChildAssignedPrayer $l)
    {
        if ($this->collAssignedPrayersRelatedByAgentId === null) {
            $this->initAssignedPrayersRelatedByAgentId();
            $this->collAssignedPrayersRelatedByAgentIdPartial = true;
        }

        if (!$this->collAssignedPrayersRelatedByAgentId->contains($l)) {
            $this->doAddAssignedPrayerRelatedByAgentId($l);
        }

        return $this;
    }

    /**
     * @param ChildAssignedPrayer $assignedPrayerRelatedByAgentId The ChildAssignedPrayer object to add.
     */
    protected function doAddAssignedPrayerRelatedByAgentId(ChildAssignedPrayer $assignedPrayerRelatedByAgentId)
    {
        $this->collAssignedPrayersRelatedByAgentId[]= $assignedPrayerRelatedByAgentId;
        $assignedPrayerRelatedByAgentId->setAgent($this);
    }

    /**
     * @param  ChildAssignedPrayer $assignedPrayerRelatedByAgentId The ChildAssignedPrayer object to remove.
     * @return $this|ChildUser The current object (for fluent API support)
     */
    public function removeAssignedPrayerRelatedByAgentId(ChildAssignedPrayer $assignedPrayerRelatedByAgentId)
    {
        if ($this->getAssignedPrayersRelatedByAgentId()->contains($assignedPrayerRelatedByAgentId)) {
            $pos = $this->collAssignedPrayersRelatedByAgentId->search($assignedPrayerRelatedByAgentId);
            $this->collAssignedPrayersRelatedByAgentId->remove($pos);
            if (null === $this->assignedPrayersRelatedByAgentIdScheduledForDeletion) {
                $this->assignedPrayersRelatedByAgentIdScheduledForDeletion = clone $this->collAssignedPrayersRelatedByAgentId;
                $this->assignedPrayersRelatedByAgentIdScheduledForDeletion->clear();
            }
            $this->assignedPrayersRelatedByAgentIdScheduledForDeletion[]= clone $assignedPrayerRelatedByAgentId;
            $assignedPrayerRelatedByAgentId->setAgent(null);
        }

        return $this;
    }

    /**
     * Clears out the collAssignedPrayersRelatedByPatientId collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addAssignedPrayersRelatedByPatientId()
     */
    public function clearAssignedPrayersRelatedByPatientId()
    {
        $this->collAssignedPrayersRelatedByPatientId = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collAssignedPrayersRelatedByPatientId collection loaded partially.
     */
    public function resetPartialAssignedPrayersRelatedByPatientId($v = true)
    {
        $this->collAssignedPrayersRelatedByPatientIdPartial = $v;
    }

    /**
     * Initializes the collAssignedPrayersRelatedByPatientId collection.
     *
     * By default this just sets the collAssignedPrayersRelatedByPatientId collection to an empty array (like clearcollAssignedPrayersRelatedByPatientId());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initAssignedPrayersRelatedByPatientId($overrideExisting = true)
    {
        if (null !== $this->collAssignedPrayersRelatedByPatientId && !$overrideExisting) {
            return;
        }
        $this->collAssignedPrayersRelatedByPatientId = new ObjectCollection();
        $this->collAssignedPrayersRelatedByPatientId->setModel('\AssignedPrayer');
    }

    /**
     * Gets an array of ChildAssignedPrayer objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildUser is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildAssignedPrayer[] List of ChildAssignedPrayer objects
     * @throws PropelException
     */
    public function getAssignedPrayersRelatedByPatientId(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collAssignedPrayersRelatedByPatientIdPartial && !$this->isNew();
        if (null === $this->collAssignedPrayersRelatedByPatientId || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collAssignedPrayersRelatedByPatientId) {
                // return empty collection
                $this->initAssignedPrayersRelatedByPatientId();
            } else {
                $collAssignedPrayersRelatedByPatientId = ChildAssignedPrayerQuery::create(null, $criteria)
                    ->filterByPatient($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collAssignedPrayersRelatedByPatientIdPartial && count($collAssignedPrayersRelatedByPatientId)) {
                        $this->initAssignedPrayersRelatedByPatientId(false);

                        foreach ($collAssignedPrayersRelatedByPatientId as $obj) {
                            if (false == $this->collAssignedPrayersRelatedByPatientId->contains($obj)) {
                                $this->collAssignedPrayersRelatedByPatientId->append($obj);
                            }
                        }

                        $this->collAssignedPrayersRelatedByPatientIdPartial = true;
                    }

                    return $collAssignedPrayersRelatedByPatientId;
                }

                if ($partial && $this->collAssignedPrayersRelatedByPatientId) {
                    foreach ($this->collAssignedPrayersRelatedByPatientId as $obj) {
                        if ($obj->isNew()) {
                            $collAssignedPrayersRelatedByPatientId[] = $obj;
                        }
                    }
                }

                $this->collAssignedPrayersRelatedByPatientId = $collAssignedPrayersRelatedByPatientId;
                $this->collAssignedPrayersRelatedByPatientIdPartial = false;
            }
        }

        return $this->collAssignedPrayersRelatedByPatientId;
    }

    /**
     * Sets a collection of ChildAssignedPrayer objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $assignedPrayersRelatedByPatientId A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildUser The current object (for fluent API support)
     */
    public function setAssignedPrayersRelatedByPatientId(Collection $assignedPrayersRelatedByPatientId, ConnectionInterface $con = null)
    {
        /** @var ChildAssignedPrayer[] $assignedPrayersRelatedByPatientIdToDelete */
        $assignedPrayersRelatedByPatientIdToDelete = $this->getAssignedPrayersRelatedByPatientId(new Criteria(), $con)->diff($assignedPrayersRelatedByPatientId);


        $this->assignedPrayersRelatedByPatientIdScheduledForDeletion = $assignedPrayersRelatedByPatientIdToDelete;

        foreach ($assignedPrayersRelatedByPatientIdToDelete as $assignedPrayerRelatedByPatientIdRemoved) {
            $assignedPrayerRelatedByPatientIdRemoved->setPatient(null);
        }

        $this->collAssignedPrayersRelatedByPatientId = null;
        foreach ($assignedPrayersRelatedByPatientId as $assignedPrayerRelatedByPatientId) {
            $this->addAssignedPrayerRelatedByPatientId($assignedPrayerRelatedByPatientId);
        }

        $this->collAssignedPrayersRelatedByPatientId = $assignedPrayersRelatedByPatientId;
        $this->collAssignedPrayersRelatedByPatientIdPartial = false;

        return $this;
    }

    /**
     * Returns the number of related AssignedPrayer objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related AssignedPrayer objects.
     * @throws PropelException
     */
    public function countAssignedPrayersRelatedByPatientId(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collAssignedPrayersRelatedByPatientIdPartial && !$this->isNew();
        if (null === $this->collAssignedPrayersRelatedByPatientId || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collAssignedPrayersRelatedByPatientId) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getAssignedPrayersRelatedByPatientId());
            }

            $query = ChildAssignedPrayerQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByPatient($this)
                ->count($con);
        }

        return count($this->collAssignedPrayersRelatedByPatientId);
    }

    /**
     * Method called to associate a ChildAssignedPrayer object to this object
     * through the ChildAssignedPrayer foreign key attribute.
     *
     * @param  ChildAssignedPrayer $l ChildAssignedPrayer
     * @return $this|\User The current object (for fluent API support)
     */
    public function addAssignedPrayerRelatedByPatientId(ChildAssignedPrayer $l)
    {
        if ($this->collAssignedPrayersRelatedByPatientId === null) {
            $this->initAssignedPrayersRelatedByPatientId();
            $this->collAssignedPrayersRelatedByPatientIdPartial = true;
        }

        if (!$this->collAssignedPrayersRelatedByPatientId->contains($l)) {
            $this->doAddAssignedPrayerRelatedByPatientId($l);
        }

        return $this;
    }

    /**
     * @param ChildAssignedPrayer $assignedPrayerRelatedByPatientId The ChildAssignedPrayer object to add.
     */
    protected function doAddAssignedPrayerRelatedByPatientId(ChildAssignedPrayer $assignedPrayerRelatedByPatientId)
    {
        $this->collAssignedPrayersRelatedByPatientId[]= $assignedPrayerRelatedByPatientId;
        $assignedPrayerRelatedByPatientId->setPatient($this);
    }

    /**
     * @param  ChildAssignedPrayer $assignedPrayerRelatedByPatientId The ChildAssignedPrayer object to remove.
     * @return $this|ChildUser The current object (for fluent API support)
     */
    public function removeAssignedPrayerRelatedByPatientId(ChildAssignedPrayer $assignedPrayerRelatedByPatientId)
    {
        if ($this->getAssignedPrayersRelatedByPatientId()->contains($assignedPrayerRelatedByPatientId)) {
            $pos = $this->collAssignedPrayersRelatedByPatientId->search($assignedPrayerRelatedByPatientId);
            $this->collAssignedPrayersRelatedByPatientId->remove($pos);
            if (null === $this->assignedPrayersRelatedByPatientIdScheduledForDeletion) {
                $this->assignedPrayersRelatedByPatientIdScheduledForDeletion = clone $this->collAssignedPrayersRelatedByPatientId;
                $this->assignedPrayersRelatedByPatientIdScheduledForDeletion->clear();
            }
            $this->assignedPrayersRelatedByPatientIdScheduledForDeletion[]= clone $assignedPrayerRelatedByPatientId;
            $assignedPrayerRelatedByPatientId->setPatient(null);
        }

        return $this;
    }

    /**
     * Clears out the collPartnerssRelatedByAgentId collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addPartnerssRelatedByAgentId()
     */
    public function clearPartnerssRelatedByAgentId()
    {
        $this->collPartnerssRelatedByAgentId = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collPartnerssRelatedByAgentId collection loaded partially.
     */
    public function resetPartialPartnerssRelatedByAgentId($v = true)
    {
        $this->collPartnerssRelatedByAgentIdPartial = $v;
    }

    /**
     * Initializes the collPartnerssRelatedByAgentId collection.
     *
     * By default this just sets the collPartnerssRelatedByAgentId collection to an empty array (like clearcollPartnerssRelatedByAgentId());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initPartnerssRelatedByAgentId($overrideExisting = true)
    {
        if (null !== $this->collPartnerssRelatedByAgentId && !$overrideExisting) {
            return;
        }
        $this->collPartnerssRelatedByAgentId = new ObjectCollection();
        $this->collPartnerssRelatedByAgentId->setModel('\Partners');
    }

    /**
     * Gets an array of ChildPartners objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildUser is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildPartners[] List of ChildPartners objects
     * @throws PropelException
     */
    public function getPartnerssRelatedByAgentId(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collPartnerssRelatedByAgentIdPartial && !$this->isNew();
        if (null === $this->collPartnerssRelatedByAgentId || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collPartnerssRelatedByAgentId) {
                // return empty collection
                $this->initPartnerssRelatedByAgentId();
            } else {
                $collPartnerssRelatedByAgentId = ChildPartnersQuery::create(null, $criteria)
                    ->filterByAgent($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collPartnerssRelatedByAgentIdPartial && count($collPartnerssRelatedByAgentId)) {
                        $this->initPartnerssRelatedByAgentId(false);

                        foreach ($collPartnerssRelatedByAgentId as $obj) {
                            if (false == $this->collPartnerssRelatedByAgentId->contains($obj)) {
                                $this->collPartnerssRelatedByAgentId->append($obj);
                            }
                        }

                        $this->collPartnerssRelatedByAgentIdPartial = true;
                    }

                    return $collPartnerssRelatedByAgentId;
                }

                if ($partial && $this->collPartnerssRelatedByAgentId) {
                    foreach ($this->collPartnerssRelatedByAgentId as $obj) {
                        if ($obj->isNew()) {
                            $collPartnerssRelatedByAgentId[] = $obj;
                        }
                    }
                }

                $this->collPartnerssRelatedByAgentId = $collPartnerssRelatedByAgentId;
                $this->collPartnerssRelatedByAgentIdPartial = false;
            }
        }

        return $this->collPartnerssRelatedByAgentId;
    }

    /**
     * Sets a collection of ChildPartners objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $partnerssRelatedByAgentId A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildUser The current object (for fluent API support)
     */
    public function setPartnerssRelatedByAgentId(Collection $partnerssRelatedByAgentId, ConnectionInterface $con = null)
    {
        /** @var ChildPartners[] $partnerssRelatedByAgentIdToDelete */
        $partnerssRelatedByAgentIdToDelete = $this->getPartnerssRelatedByAgentId(new Criteria(), $con)->diff($partnerssRelatedByAgentId);


        //since at least one column in the foreign key is at the same time a PK
        //we can not just set a PK to NULL in the lines below. We have to store
        //a backup of all values, so we are able to manipulate these items based on the onDelete value later.
        $this->partnerssRelatedByAgentIdScheduledForDeletion = clone $partnerssRelatedByAgentIdToDelete;

        foreach ($partnerssRelatedByAgentIdToDelete as $partnersRelatedByAgentIdRemoved) {
            $partnersRelatedByAgentIdRemoved->setAgent(null);
        }

        $this->collPartnerssRelatedByAgentId = null;
        foreach ($partnerssRelatedByAgentId as $partnersRelatedByAgentId) {
            $this->addPartnersRelatedByAgentId($partnersRelatedByAgentId);
        }

        $this->collPartnerssRelatedByAgentId = $partnerssRelatedByAgentId;
        $this->collPartnerssRelatedByAgentIdPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Partners objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related Partners objects.
     * @throws PropelException
     */
    public function countPartnerssRelatedByAgentId(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collPartnerssRelatedByAgentIdPartial && !$this->isNew();
        if (null === $this->collPartnerssRelatedByAgentId || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collPartnerssRelatedByAgentId) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getPartnerssRelatedByAgentId());
            }

            $query = ChildPartnersQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByAgent($this)
                ->count($con);
        }

        return count($this->collPartnerssRelatedByAgentId);
    }

    /**
     * Method called to associate a ChildPartners object to this object
     * through the ChildPartners foreign key attribute.
     *
     * @param  ChildPartners $l ChildPartners
     * @return $this|\User The current object (for fluent API support)
     */
    public function addPartnersRelatedByAgentId(ChildPartners $l)
    {
        if ($this->collPartnerssRelatedByAgentId === null) {
            $this->initPartnerssRelatedByAgentId();
            $this->collPartnerssRelatedByAgentIdPartial = true;
        }

        if (!$this->collPartnerssRelatedByAgentId->contains($l)) {
            $this->doAddPartnersRelatedByAgentId($l);
        }

        return $this;
    }

    /**
     * @param ChildPartners $partnersRelatedByAgentId The ChildPartners object to add.
     */
    protected function doAddPartnersRelatedByAgentId(ChildPartners $partnersRelatedByAgentId)
    {
        $this->collPartnerssRelatedByAgentId[]= $partnersRelatedByAgentId;
        $partnersRelatedByAgentId->setAgent($this);
    }

    /**
     * @param  ChildPartners $partnersRelatedByAgentId The ChildPartners object to remove.
     * @return $this|ChildUser The current object (for fluent API support)
     */
    public function removePartnersRelatedByAgentId(ChildPartners $partnersRelatedByAgentId)
    {
        if ($this->getPartnerssRelatedByAgentId()->contains($partnersRelatedByAgentId)) {
            $pos = $this->collPartnerssRelatedByAgentId->search($partnersRelatedByAgentId);
            $this->collPartnerssRelatedByAgentId->remove($pos);
            if (null === $this->partnerssRelatedByAgentIdScheduledForDeletion) {
                $this->partnerssRelatedByAgentIdScheduledForDeletion = clone $this->collPartnerssRelatedByAgentId;
                $this->partnerssRelatedByAgentIdScheduledForDeletion->clear();
            }
            $this->partnerssRelatedByAgentIdScheduledForDeletion[]= clone $partnersRelatedByAgentId;
            $partnersRelatedByAgentId->setAgent(null);
        }

        return $this;
    }

    /**
     * Clears out the collPartnerssRelatedByPatientId collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addPartnerssRelatedByPatientId()
     */
    public function clearPartnerssRelatedByPatientId()
    {
        $this->collPartnerssRelatedByPatientId = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collPartnerssRelatedByPatientId collection loaded partially.
     */
    public function resetPartialPartnerssRelatedByPatientId($v = true)
    {
        $this->collPartnerssRelatedByPatientIdPartial = $v;
    }

    /**
     * Initializes the collPartnerssRelatedByPatientId collection.
     *
     * By default this just sets the collPartnerssRelatedByPatientId collection to an empty array (like clearcollPartnerssRelatedByPatientId());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initPartnerssRelatedByPatientId($overrideExisting = true)
    {
        if (null !== $this->collPartnerssRelatedByPatientId && !$overrideExisting) {
            return;
        }
        $this->collPartnerssRelatedByPatientId = new ObjectCollection();
        $this->collPartnerssRelatedByPatientId->setModel('\Partners');
    }

    /**
     * Gets an array of ChildPartners objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildUser is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildPartners[] List of ChildPartners objects
     * @throws PropelException
     */
    public function getPartnerssRelatedByPatientId(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collPartnerssRelatedByPatientIdPartial && !$this->isNew();
        if (null === $this->collPartnerssRelatedByPatientId || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collPartnerssRelatedByPatientId) {
                // return empty collection
                $this->initPartnerssRelatedByPatientId();
            } else {
                $collPartnerssRelatedByPatientId = ChildPartnersQuery::create(null, $criteria)
                    ->filterByPatient($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collPartnerssRelatedByPatientIdPartial && count($collPartnerssRelatedByPatientId)) {
                        $this->initPartnerssRelatedByPatientId(false);

                        foreach ($collPartnerssRelatedByPatientId as $obj) {
                            if (false == $this->collPartnerssRelatedByPatientId->contains($obj)) {
                                $this->collPartnerssRelatedByPatientId->append($obj);
                            }
                        }

                        $this->collPartnerssRelatedByPatientIdPartial = true;
                    }

                    return $collPartnerssRelatedByPatientId;
                }

                if ($partial && $this->collPartnerssRelatedByPatientId) {
                    foreach ($this->collPartnerssRelatedByPatientId as $obj) {
                        if ($obj->isNew()) {
                            $collPartnerssRelatedByPatientId[] = $obj;
                        }
                    }
                }

                $this->collPartnerssRelatedByPatientId = $collPartnerssRelatedByPatientId;
                $this->collPartnerssRelatedByPatientIdPartial = false;
            }
        }

        return $this->collPartnerssRelatedByPatientId;
    }

    /**
     * Sets a collection of ChildPartners objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $partnerssRelatedByPatientId A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildUser The current object (for fluent API support)
     */
    public function setPartnerssRelatedByPatientId(Collection $partnerssRelatedByPatientId, ConnectionInterface $con = null)
    {
        /** @var ChildPartners[] $partnerssRelatedByPatientIdToDelete */
        $partnerssRelatedByPatientIdToDelete = $this->getPartnerssRelatedByPatientId(new Criteria(), $con)->diff($partnerssRelatedByPatientId);


        //since at least one column in the foreign key is at the same time a PK
        //we can not just set a PK to NULL in the lines below. We have to store
        //a backup of all values, so we are able to manipulate these items based on the onDelete value later.
        $this->partnerssRelatedByPatientIdScheduledForDeletion = clone $partnerssRelatedByPatientIdToDelete;

        foreach ($partnerssRelatedByPatientIdToDelete as $partnersRelatedByPatientIdRemoved) {
            $partnersRelatedByPatientIdRemoved->setPatient(null);
        }

        $this->collPartnerssRelatedByPatientId = null;
        foreach ($partnerssRelatedByPatientId as $partnersRelatedByPatientId) {
            $this->addPartnersRelatedByPatientId($partnersRelatedByPatientId);
        }

        $this->collPartnerssRelatedByPatientId = $partnerssRelatedByPatientId;
        $this->collPartnerssRelatedByPatientIdPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Partners objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related Partners objects.
     * @throws PropelException
     */
    public function countPartnerssRelatedByPatientId(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collPartnerssRelatedByPatientIdPartial && !$this->isNew();
        if (null === $this->collPartnerssRelatedByPatientId || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collPartnerssRelatedByPatientId) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getPartnerssRelatedByPatientId());
            }

            $query = ChildPartnersQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByPatient($this)
                ->count($con);
        }

        return count($this->collPartnerssRelatedByPatientId);
    }

    /**
     * Method called to associate a ChildPartners object to this object
     * through the ChildPartners foreign key attribute.
     *
     * @param  ChildPartners $l ChildPartners
     * @return $this|\User The current object (for fluent API support)
     */
    public function addPartnersRelatedByPatientId(ChildPartners $l)
    {
        if ($this->collPartnerssRelatedByPatientId === null) {
            $this->initPartnerssRelatedByPatientId();
            $this->collPartnerssRelatedByPatientIdPartial = true;
        }

        if (!$this->collPartnerssRelatedByPatientId->contains($l)) {
            $this->doAddPartnersRelatedByPatientId($l);
        }

        return $this;
    }

    /**
     * @param ChildPartners $partnersRelatedByPatientId The ChildPartners object to add.
     */
    protected function doAddPartnersRelatedByPatientId(ChildPartners $partnersRelatedByPatientId)
    {
        $this->collPartnerssRelatedByPatientId[]= $partnersRelatedByPatientId;
        $partnersRelatedByPatientId->setPatient($this);
    }

    /**
     * @param  ChildPartners $partnersRelatedByPatientId The ChildPartners object to remove.
     * @return $this|ChildUser The current object (for fluent API support)
     */
    public function removePartnersRelatedByPatientId(ChildPartners $partnersRelatedByPatientId)
    {
        if ($this->getPartnerssRelatedByPatientId()->contains($partnersRelatedByPatientId)) {
            $pos = $this->collPartnerssRelatedByPatientId->search($partnersRelatedByPatientId);
            $this->collPartnerssRelatedByPatientId->remove($pos);
            if (null === $this->partnerssRelatedByPatientIdScheduledForDeletion) {
                $this->partnerssRelatedByPatientIdScheduledForDeletion = clone $this->collPartnerssRelatedByPatientId;
                $this->partnerssRelatedByPatientIdScheduledForDeletion->clear();
            }
            $this->partnerssRelatedByPatientIdScheduledForDeletion[]= clone $partnersRelatedByPatientId;
            $partnersRelatedByPatientId->setPatient(null);
        }

        return $this;
    }

    /**
     * Clears out the collPainRatings collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addPainRatings()
     */
    public function clearPainRatings()
    {
        $this->collPainRatings = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collPainRatings collection loaded partially.
     */
    public function resetPartialPainRatings($v = true)
    {
        $this->collPainRatingsPartial = $v;
    }

    /**
     * Initializes the collPainRatings collection.
     *
     * By default this just sets the collPainRatings collection to an empty array (like clearcollPainRatings());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initPainRatings($overrideExisting = true)
    {
        if (null !== $this->collPainRatings && !$overrideExisting) {
            return;
        }
        $this->collPainRatings = new ObjectCollection();
        $this->collPainRatings->setModel('\PainRating');
    }

    /**
     * Gets an array of ChildPainRating objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildUser is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildPainRating[] List of ChildPainRating objects
     * @throws PropelException
     */
    public function getPainRatings(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collPainRatingsPartial && !$this->isNew();
        if (null === $this->collPainRatings || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collPainRatings) {
                // return empty collection
                $this->initPainRatings();
            } else {
                $collPainRatings = ChildPainRatingQuery::create(null, $criteria)
                    ->filterByUser($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collPainRatingsPartial && count($collPainRatings)) {
                        $this->initPainRatings(false);

                        foreach ($collPainRatings as $obj) {
                            if (false == $this->collPainRatings->contains($obj)) {
                                $this->collPainRatings->append($obj);
                            }
                        }

                        $this->collPainRatingsPartial = true;
                    }

                    return $collPainRatings;
                }

                if ($partial && $this->collPainRatings) {
                    foreach ($this->collPainRatings as $obj) {
                        if ($obj->isNew()) {
                            $collPainRatings[] = $obj;
                        }
                    }
                }

                $this->collPainRatings = $collPainRatings;
                $this->collPainRatingsPartial = false;
            }
        }

        return $this->collPainRatings;
    }

    /**
     * Sets a collection of ChildPainRating objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $painRatings A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildUser The current object (for fluent API support)
     */
    public function setPainRatings(Collection $painRatings, ConnectionInterface $con = null)
    {
        /** @var ChildPainRating[] $painRatingsToDelete */
        $painRatingsToDelete = $this->getPainRatings(new Criteria(), $con)->diff($painRatings);


        $this->painRatingsScheduledForDeletion = $painRatingsToDelete;

        foreach ($painRatingsToDelete as $painRatingRemoved) {
            $painRatingRemoved->setUser(null);
        }

        $this->collPainRatings = null;
        foreach ($painRatings as $painRating) {
            $this->addPainRating($painRating);
        }

        $this->collPainRatings = $painRatings;
        $this->collPainRatingsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related PainRating objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related PainRating objects.
     * @throws PropelException
     */
    public function countPainRatings(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collPainRatingsPartial && !$this->isNew();
        if (null === $this->collPainRatings || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collPainRatings) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getPainRatings());
            }

            $query = ChildPainRatingQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByUser($this)
                ->count($con);
        }

        return count($this->collPainRatings);
    }

    /**
     * Method called to associate a ChildPainRating object to this object
     * through the ChildPainRating foreign key attribute.
     *
     * @param  ChildPainRating $l ChildPainRating
     * @return $this|\User The current object (for fluent API support)
     */
    public function addPainRating(ChildPainRating $l)
    {
        if ($this->collPainRatings === null) {
            $this->initPainRatings();
            $this->collPainRatingsPartial = true;
        }

        if (!$this->collPainRatings->contains($l)) {
            $this->doAddPainRating($l);
        }

        return $this;
    }

    /**
     * @param ChildPainRating $painRating The ChildPainRating object to add.
     */
    protected function doAddPainRating(ChildPainRating $painRating)
    {
        $this->collPainRatings[]= $painRating;
        $painRating->setUser($this);
    }

    /**
     * @param  ChildPainRating $painRating The ChildPainRating object to remove.
     * @return $this|ChildUser The current object (for fluent API support)
     */
    public function removePainRating(ChildPainRating $painRating)
    {
        if ($this->getPainRatings()->contains($painRating)) {
            $pos = $this->collPainRatings->search($painRating);
            $this->collPainRatings->remove($pos);
            if (null === $this->painRatingsScheduledForDeletion) {
                $this->painRatingsScheduledForDeletion = clone $this->collPainRatings;
                $this->painRatingsScheduledForDeletion->clear();
            }
            $this->painRatingsScheduledForDeletion[]= clone $painRating;
            $painRating->setUser(null);
        }

        return $this;
    }

    /**
     * Clears out the collUserDemoss collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addUserDemoss()
     */
    public function clearUserDemoss()
    {
        $this->collUserDemoss = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collUserDemoss collection loaded partially.
     */
    public function resetPartialUserDemoss($v = true)
    {
        $this->collUserDemossPartial = $v;
    }

    /**
     * Initializes the collUserDemoss collection.
     *
     * By default this just sets the collUserDemoss collection to an empty array (like clearcollUserDemoss());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initUserDemoss($overrideExisting = true)
    {
        if (null !== $this->collUserDemoss && !$overrideExisting) {
            return;
        }
        $this->collUserDemoss = new ObjectCollection();
        $this->collUserDemoss->setModel('\UserDemos');
    }

    /**
     * Gets an array of ChildUserDemos objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildUser is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildUserDemos[] List of ChildUserDemos objects
     * @throws PropelException
     */
    public function getUserDemoss(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collUserDemossPartial && !$this->isNew();
        if (null === $this->collUserDemoss || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collUserDemoss) {
                // return empty collection
                $this->initUserDemoss();
            } else {
                $collUserDemoss = ChildUserDemosQuery::create(null, $criteria)
                    ->filterByUser($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collUserDemossPartial && count($collUserDemoss)) {
                        $this->initUserDemoss(false);

                        foreach ($collUserDemoss as $obj) {
                            if (false == $this->collUserDemoss->contains($obj)) {
                                $this->collUserDemoss->append($obj);
                            }
                        }

                        $this->collUserDemossPartial = true;
                    }

                    return $collUserDemoss;
                }

                if ($partial && $this->collUserDemoss) {
                    foreach ($this->collUserDemoss as $obj) {
                        if ($obj->isNew()) {
                            $collUserDemoss[] = $obj;
                        }
                    }
                }

                $this->collUserDemoss = $collUserDemoss;
                $this->collUserDemossPartial = false;
            }
        }

        return $this->collUserDemoss;
    }

    /**
     * Sets a collection of ChildUserDemos objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $userDemoss A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildUser The current object (for fluent API support)
     */
    public function setUserDemoss(Collection $userDemoss, ConnectionInterface $con = null)
    {
        /** @var ChildUserDemos[] $userDemossToDelete */
        $userDemossToDelete = $this->getUserDemoss(new Criteria(), $con)->diff($userDemoss);


        $this->userDemossScheduledForDeletion = $userDemossToDelete;

        foreach ($userDemossToDelete as $userDemosRemoved) {
            $userDemosRemoved->setUser(null);
        }

        $this->collUserDemoss = null;
        foreach ($userDemoss as $userDemos) {
            $this->addUserDemos($userDemos);
        }

        $this->collUserDemoss = $userDemoss;
        $this->collUserDemossPartial = false;

        return $this;
    }

    /**
     * Returns the number of related UserDemos objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related UserDemos objects.
     * @throws PropelException
     */
    public function countUserDemoss(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collUserDemossPartial && !$this->isNew();
        if (null === $this->collUserDemoss || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collUserDemoss) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getUserDemoss());
            }

            $query = ChildUserDemosQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByUser($this)
                ->count($con);
        }

        return count($this->collUserDemoss);
    }

    /**
     * Method called to associate a ChildUserDemos object to this object
     * through the ChildUserDemos foreign key attribute.
     *
     * @param  ChildUserDemos $l ChildUserDemos
     * @return $this|\User The current object (for fluent API support)
     */
    public function addUserDemos(ChildUserDemos $l)
    {
        if ($this->collUserDemoss === null) {
            $this->initUserDemoss();
            $this->collUserDemossPartial = true;
        }

        if (!$this->collUserDemoss->contains($l)) {
            $this->doAddUserDemos($l);
        }

        return $this;
    }

    /**
     * @param ChildUserDemos $userDemos The ChildUserDemos object to add.
     */
    protected function doAddUserDemos(ChildUserDemos $userDemos)
    {
        $this->collUserDemoss[]= $userDemos;
        $userDemos->setUser($this);
    }

    /**
     * @param  ChildUserDemos $userDemos The ChildUserDemos object to remove.
     * @return $this|ChildUser The current object (for fluent API support)
     */
    public function removeUserDemos(ChildUserDemos $userDemos)
    {
        if ($this->getUserDemoss()->contains($userDemos)) {
            $pos = $this->collUserDemoss->search($userDemos);
            $this->collUserDemoss->remove($pos);
            if (null === $this->userDemossScheduledForDeletion) {
                $this->userDemossScheduledForDeletion = clone $this->collUserDemoss;
                $this->userDemossScheduledForDeletion->clear();
            }
            $this->userDemossScheduledForDeletion[]= clone $userDemos;
            $userDemos->setUser(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this User is new, it will return
     * an empty collection; or if this User has previously
     * been saved, it will retrieve related UserDemoss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in User.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildUserDemos[] List of ChildUserDemos objects
     */
    public function getUserDemossJoinEthnicity(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildUserDemosQuery::create(null, $criteria);
        $query->joinWith('Ethnicity', $joinBehavior);

        return $this->getUserDemoss($query, $con);
    }

    /**
     * Clears out the collPatients collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addPatients()
     */
    public function clearPatients()
    {
        $this->collPatients = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Initializes the collPatients crossRef collection.
     *
     * By default this just sets the collPatients collection to an empty collection (like clearPatients());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @return void
     */
    public function initPatients()
    {
        $this->collPatients = new ObjectCollection();
        $this->collPatientsPartial = true;

        $this->collPatients->setModel('\User');
    }

    /**
     * Checks if the collPatients collection is loaded.
     *
     * @return bool
     */
    public function isPatientsLoaded()
    {
        return null !== $this->collPatients;
    }

    /**
     * Gets a collection of ChildUser objects related by a many-to-many relationship
     * to the current object by way of the partners cross-reference table.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildUser is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria Optional query object to filter the query
     * @param      ConnectionInterface $con Optional connection object
     *
     * @return ObjectCollection|ChildUser[] List of ChildUser objects
     */
    public function getPatients(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collPatientsPartial && !$this->isNew();
        if (null === $this->collPatients || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collPatients) {
                    $this->initPatients();
                }
            } else {

                $query = ChildUserQuery::create(null, $criteria)
                    ->filterByAgent($this);
                $collPatients = $query->find($con);
                if (null !== $criteria) {
                    return $collPatients;
                }

                if ($partial && $this->collPatients) {
                    //make sure that already added objects gets added to the list of the database.
                    foreach ($this->collPatients as $obj) {
                        if (!$collPatients->contains($obj)) {
                            $collPatients[] = $obj;
                        }
                    }
                }

                $this->collPatients = $collPatients;
                $this->collPatientsPartial = false;
            }
        }

        return $this->collPatients;
    }

    /**
     * Sets a collection of User objects related by a many-to-many relationship
     * to the current object by way of the partners cross-reference table.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param  Collection $patients A Propel collection.
     * @param  ConnectionInterface $con Optional connection object
     * @return $this|ChildUser The current object (for fluent API support)
     */
    public function setPatients(Collection $patients, ConnectionInterface $con = null)
    {
        $this->clearPatients();
        $currentPatients = $this->getPatients();

        $patientsScheduledForDeletion = $currentPatients->diff($patients);

        foreach ($patientsScheduledForDeletion as $toDelete) {
            $this->removePatient($toDelete);
        }

        foreach ($patients as $patient) {
            if (!$currentPatients->contains($patient)) {
                $this->doAddPatient($patient);
            }
        }

        $this->collPatientsPartial = false;
        $this->collPatients = $patients;

        return $this;
    }

    /**
     * Gets the number of User objects related by a many-to-many relationship
     * to the current object by way of the partners cross-reference table.
     *
     * @param      Criteria $criteria Optional query object to filter the query
     * @param      boolean $distinct Set to true to force count distinct
     * @param      ConnectionInterface $con Optional connection object
     *
     * @return int the number of related User objects
     */
    public function countPatients(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collPatientsPartial && !$this->isNew();
        if (null === $this->collPatients || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collPatients) {
                return 0;
            } else {

                if ($partial && !$criteria) {
                    return count($this->getPatients());
                }

                $query = ChildUserQuery::create(null, $criteria);
                if ($distinct) {
                    $query->distinct();
                }

                return $query
                    ->filterByAgent($this)
                    ->count($con);
            }
        } else {
            return count($this->collPatients);
        }
    }

    /**
     * Associate a ChildUser to this object
     * through the partners cross reference table.
     *
     * @param ChildUser $patient
     * @return ChildUser The current object (for fluent API support)
     */
    public function addPatient(ChildUser $patient)
    {
        if ($this->collPatients === null) {
            $this->initPatients();
        }

        if (!$this->getPatients()->contains($patient)) {
            // only add it if the **same** object is not already associated
            $this->collPatients->push($patient);
            $this->doAddPatient($patient);
        }

        return $this;
    }

    /**
     *
     * @param ChildUser $patient
     */
    protected function doAddPatient(ChildUser $patient)
    {
        $partners = new ChildPartners();

        $partners->setPatient($patient);

        $partners->setAgent($this);

        $this->addPartnersRelatedByAgentId($partners);

        // set the back reference to this object directly as using provided method either results
        // in endless loop or in multiple relations
        if (!$patient->isAgentsLoaded()) {
            $patient->initAgents();
            $patient->getAgents()->push($this);
        } elseif (!$patient->getAgents()->contains($this)) {
            $patient->getAgents()->push($this);
        }

    }

    /**
     * Remove patient of this object
     * through the partners cross reference table.
     *
     * @param ChildUser $patient
     * @return ChildUser The current object (for fluent API support)
     */
    public function removePatient(ChildUser $patient)
    {
        if ($this->getPatients()->contains($patient)) { $partners = new ChildPartners();

            $partners->setPatient($patient);
            if ($patient->isAgentsLoaded()) {
                //remove the back reference if available
                $patient->getAgents()->removeObject($this);
            }

            $partners->setAgent($this);
            $this->removePartnersRelatedByAgentId(clone $partners);
            $partners->clear();

            $this->collPatients->remove($this->collPatients->search($patient));

            if (null === $this->patientsScheduledForDeletion) {
                $this->patientsScheduledForDeletion = clone $this->collPatients;
                $this->patientsScheduledForDeletion->clear();
            }

            $this->patientsScheduledForDeletion->push($patient);
        }


        return $this;
    }

    /**
     * Clears out the collAgents collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addAgents()
     */
    public function clearAgents()
    {
        $this->collAgents = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Initializes the collAgents crossRef collection.
     *
     * By default this just sets the collAgents collection to an empty collection (like clearAgents());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @return void
     */
    public function initAgents()
    {
        $this->collAgents = new ObjectCollection();
        $this->collAgentsPartial = true;

        $this->collAgents->setModel('\User');
    }

    /**
     * Checks if the collAgents collection is loaded.
     *
     * @return bool
     */
    public function isAgentsLoaded()
    {
        return null !== $this->collAgents;
    }

    /**
     * Gets a collection of ChildUser objects related by a many-to-many relationship
     * to the current object by way of the partners cross-reference table.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildUser is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria Optional query object to filter the query
     * @param      ConnectionInterface $con Optional connection object
     *
     * @return ObjectCollection|ChildUser[] List of ChildUser objects
     */
    public function getAgents(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collAgentsPartial && !$this->isNew();
        if (null === $this->collAgents || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collAgents) {
                    $this->initAgents();
                }
            } else {

                $query = ChildUserQuery::create(null, $criteria)
                    ->filterByPatient($this);
                $collAgents = $query->find($con);
                if (null !== $criteria) {
                    return $collAgents;
                }

                if ($partial && $this->collAgents) {
                    //make sure that already added objects gets added to the list of the database.
                    foreach ($this->collAgents as $obj) {
                        if (!$collAgents->contains($obj)) {
                            $collAgents[] = $obj;
                        }
                    }
                }

                $this->collAgents = $collAgents;
                $this->collAgentsPartial = false;
            }
        }

        return $this->collAgents;
    }

    /**
     * Sets a collection of User objects related by a many-to-many relationship
     * to the current object by way of the partners cross-reference table.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param  Collection $agents A Propel collection.
     * @param  ConnectionInterface $con Optional connection object
     * @return $this|ChildUser The current object (for fluent API support)
     */
    public function setAgents(Collection $agents, ConnectionInterface $con = null)
    {
        $this->clearAgents();
        $currentAgents = $this->getAgents();

        $agentsScheduledForDeletion = $currentAgents->diff($agents);

        foreach ($agentsScheduledForDeletion as $toDelete) {
            $this->removeAgent($toDelete);
        }

        foreach ($agents as $agent) {
            if (!$currentAgents->contains($agent)) {
                $this->doAddAgent($agent);
            }
        }

        $this->collAgentsPartial = false;
        $this->collAgents = $agents;

        return $this;
    }

    /**
     * Gets the number of User objects related by a many-to-many relationship
     * to the current object by way of the partners cross-reference table.
     *
     * @param      Criteria $criteria Optional query object to filter the query
     * @param      boolean $distinct Set to true to force count distinct
     * @param      ConnectionInterface $con Optional connection object
     *
     * @return int the number of related User objects
     */
    public function countAgents(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collAgentsPartial && !$this->isNew();
        if (null === $this->collAgents || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collAgents) {
                return 0;
            } else {

                if ($partial && !$criteria) {
                    return count($this->getAgents());
                }

                $query = ChildUserQuery::create(null, $criteria);
                if ($distinct) {
                    $query->distinct();
                }

                return $query
                    ->filterByPatient($this)
                    ->count($con);
            }
        } else {
            return count($this->collAgents);
        }
    }

    /**
     * Associate a ChildUser to this object
     * through the partners cross reference table.
     *
     * @param ChildUser $agent
     * @return ChildUser The current object (for fluent API support)
     */
    public function addAgent(ChildUser $agent)
    {
        if ($this->collAgents === null) {
            $this->initAgents();
        }

        if (!$this->getAgents()->contains($agent)) {
            // only add it if the **same** object is not already associated
            $this->collAgents->push($agent);
            $this->doAddAgent($agent);
        }

        return $this;
    }

    /**
     *
     * @param ChildUser $agent
     */
    protected function doAddAgent(ChildUser $agent)
    {
        $partners = new ChildPartners();

        $partners->setAgent($agent);

        $partners->setPatient($this);

        $this->addPartnersRelatedByPatientId($partners);

        // set the back reference to this object directly as using provided method either results
        // in endless loop or in multiple relations
        if (!$agent->isPatientsLoaded()) {
            $agent->initPatients();
            $agent->getPatients()->push($this);
        } elseif (!$agent->getPatients()->contains($this)) {
            $agent->getPatients()->push($this);
        }

    }

    /**
     * Remove agent of this object
     * through the partners cross reference table.
     *
     * @param ChildUser $agent
     * @return ChildUser The current object (for fluent API support)
     */
    public function removeAgent(ChildUser $agent)
    {
        if ($this->getAgents()->contains($agent)) { $partners = new ChildPartners();

            $partners->setAgent($agent);
            if ($agent->isPatientsLoaded()) {
                //remove the back reference if available
                $agent->getPatients()->removeObject($this);
            }

            $partners->setPatient($this);
            $this->removePartnersRelatedByPatientId(clone $partners);
            $partners->clear();

            $this->collAgents->remove($this->collAgents->search($agent));

            if (null === $this->agentsScheduledForDeletion) {
                $this->agentsScheduledForDeletion = clone $this->collAgents;
                $this->agentsScheduledForDeletion->clear();
            }

            $this->agentsScheduledForDeletion->push($agent);
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
        if (null !== $this->aUserAge) {
            $this->aUserAge->removeUser($this);
        }
        $this->id = null;
        $this->nickname = null;
        $this->email = null;
        $this->age = null;
        $this->sex = null;
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
            if ($this->collAssignedPrayersRelatedByAgentId) {
                foreach ($this->collAssignedPrayersRelatedByAgentId as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collAssignedPrayersRelatedByPatientId) {
                foreach ($this->collAssignedPrayersRelatedByPatientId as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collPartnerssRelatedByAgentId) {
                foreach ($this->collPartnerssRelatedByAgentId as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collPartnerssRelatedByPatientId) {
                foreach ($this->collPartnerssRelatedByPatientId as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collPainRatings) {
                foreach ($this->collPainRatings as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collUserDemoss) {
                foreach ($this->collUserDemoss as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collPatients) {
                foreach ($this->collPatients as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collAgents) {
                foreach ($this->collAgents as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        $this->collAssignedPrayersRelatedByAgentId = null;
        $this->collAssignedPrayersRelatedByPatientId = null;
        $this->collPartnerssRelatedByAgentId = null;
        $this->collPartnerssRelatedByPatientId = null;
        $this->collPainRatings = null;
        $this->collUserDemoss = null;
        $this->collPatients = null;
        $this->collAgents = null;
        $this->aUserAge = null;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(UserTableMap::DEFAULT_STRING_FORMAT);
    }

    // timestampable behavior

    /**
     * Mark the current object so that the update date doesn't get updated during next save
     *
     * @return     $this|ChildUser The current object (for fluent API support)
     */
    public function keepUpdateDateUnchanged()
    {
        $this->modifiedColumns[UserTableMap::COL_UPDATED_AT] = true;

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
