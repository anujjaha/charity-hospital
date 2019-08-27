<?php namespace App\Repositories\Booking;

/**
 * Class EloquentBookingRepository
 *
 * @author Anuj Jaha ( er.anujjaha@gmail.com)
 */

use App\Models\Booking\Booking;
use App\Repositories\DbRepository;
use App\Exceptions\GeneralException;

class EloquentBookingRepository extends DbRepository
{
    /**
     * Booking Model
     *
     * @var Object
     */
    public $model;

    /**
     * Booking Title
     *
     * @var string
     */
    public $moduleTitle = 'Booking';

    /**
     * Table Headers
     *
     * @var array
     */
    public $tableHeaders = [
        'id'        => 'Id',
'doctor_id'        => 'Doctor_id',
'patient_id'        => 'Patient_id',
'queue_number'        => 'Queue_number',
'consulting_fees'        => 'Consulting_fees',
'notes'        => 'Notes',
'status'        => 'Status',
'created_at'        => 'Created_at',
'updated_at'        => 'Updated_at',
"actions"         => "Actions"
    ];

    /**
     * Table Columns
     *
     * @var array
     */
    public $tableColumns = [
        'id' =>   [
                'data'          => 'id',
                'name'          => 'id',
                'searchable'    => true,
                'sortable'      => true
            ],
		'doctor_id' =>   [
                'data'          => 'doctor_id',
                'name'          => 'doctor_id',
                'searchable'    => true,
                'sortable'      => true
            ],
		'patient_id' =>   [
                'data'          => 'patient_id',
                'name'          => 'patient_id',
                'searchable'    => true,
                'sortable'      => true
            ],
		'queue_number' =>   [
                'data'          => 'queue_number',
                'name'          => 'queue_number',
                'searchable'    => true,
                'sortable'      => true
            ],
		'consulting_fees' =>   [
                'data'          => 'consulting_fees',
                'name'          => 'consulting_fees',
                'searchable'    => true,
                'sortable'      => true
            ],
		'notes' =>   [
                'data'          => 'notes',
                'name'          => 'notes',
                'searchable'    => true,
                'sortable'      => true
            ],
		'status' =>   [
                'data'          => 'status',
                'name'          => 'status',
                'searchable'    => true,
                'sortable'      => true
            ],
		'created_at' =>   [
                'data'          => 'created_at',
                'name'          => 'created_at',
                'searchable'    => true,
                'sortable'      => true
            ],
		'updated_at' =>   [
                'data'          => 'updated_at',
                'name'          => 'updated_at',
                'searchable'    => true,
                'sortable'      => true
            ],
		'actions' => [
            'data'          => 'actions',
            'name'          => 'actions',
            'searchable'    => false,
            'sortable'      => false
        ]
    ];

    /**
     * Is Admin
     *
     * @var boolean
     */
    protected $isAdmin = false;

    /**
     * Admin Route Prefix
     *
     * @var string
     */
    public $adminRoutePrefix = 'admin';

    /**
     * Client Route Prefix
     *
     * @var string
     */
    public $clientRoutePrefix = 'frontend';

    /**
     * Admin View Prefix
     *
     * @var string
     */
    public $adminViewPrefix = 'backend';

    /**
     * Client View Prefix
     *
     * @var string
     */
    public $clientViewPrefix = 'frontend';

    /**
     * Module Routes
     *
     * @var array
     */
    public $moduleRoutes = [
        'listRoute'     => 'booking.index',
        'createRoute'   => 'booking.create',
        'storeRoute'    => 'booking.store',
        'editRoute'     => 'booking.edit',
        'updateRoute'   => 'booking.update',
        'deleteRoute'   => 'booking.destroy',
        'dataRoute'     => 'booking.get-list-data'
    ];

    /**
     * Module Views
     *
     * @var array
     */
    public $moduleViews = [
        'listView'      => 'booking.index',
        'createView'    => 'booking.create',
        'editView'      => 'booking.edit',
        'deleteView'    => 'booking.destroy',
    ];

    /**
     * Construct
     *
     */
    public function __construct()
    {
        $this->model = new Booking;
    }

    /**
     * Create Booking
     *
     * @param array $input
     * @return mixed
     */
    public function create($input)
    {
        $input = $this->prepareInputData($input, true);
        $model = $this->model->create($input);

        if($model)
        {
            return $model;
        }

        return false;
    }

    /**
     * Update Booking
     *
     * @param int $id
     * @param array $input
     * @return bool|int|mixed
     */
    public function update($id, $input)
    {
        $model = $this->model->find($id);

        if($model)
        {
            $input = $this->prepareInputData($input);

            return $model->update($input);
        }

        return false;
    }

    /**
     * Destroy Booking
     *
     * @param int $id
     * @return mixed
     * @throws GeneralException
     */
    public function destroy($id)
    {
        $model = $this->model->find($id);

        if($model)
        {
            return $model->delete();
        }

        return  false;
    }

    /**
     * Get All
     *
     * @param string $orderBy
     * @param string $sort
     * @return mixed
     */
    public function getAll($orderBy = 'id', $sort = 'asc')
    {
        return $this->model->orderBy($orderBy, $sort)->get();
    }

    /**
     * Get by Id
     *
     * @param int $id
     * @return mixed
     */
    public function getById($id = null)
    {
        if($id)
        {
            return $this->model->find($id);
        }

        return false;
    }

    /**
     * Get Table Fields
     *
     * @return array
     */
    public function getTableFields()
    {
        return [
            $this->model->getTable().'.*'
        ];
    }

    /**
     * @return mixed
     */
    public function getForDataTable()
    {
        return $this->model->select($this->getTableFields())->get();
    }

    /**
     * Set Admin
     *
     * @param boolean $isAdmin [description]
     */
    public function setAdmin($isAdmin = false)
    {
        $this->isAdmin = $isAdmin;

        return $this;
    }

    /**
     * Prepare Input Data
     *
     * @param array $input
     * @param bool $isCreate
     * @return array
     */
    public function prepareInputData($input = array(), $isCreate = false)
    {
        if($isCreate)
        {
            $input = array_merge($input, ['user_id' => access()->user()->id]);
        }

        return $input;
    }

    /**
     * Get Table Headers
     *
     * @return string
     */
    public function getTableHeaders()
    {
        if($this->isAdmin)
        {
            return json_encode($this->setTableStructure($this->tableHeaders));
        }

        $clientHeaders = $this->tableHeaders;

        unset($clientHeaders['username']);

        return json_encode($this->setTableStructure($clientHeaders));
    }

    /**
     * Get Table Columns
     *
     * @return string
     */
    public function getTableColumns()
    {
        if($this->isAdmin)
        {
            return json_encode($this->setTableStructure($this->tableColumns));
        }

        $clientColumns = $this->tableColumns;

        unset($clientColumns['username']);

        return json_encode($this->setTableStructure($clientColumns));
    }
}