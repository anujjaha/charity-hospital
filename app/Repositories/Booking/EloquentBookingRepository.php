<?php namespace App\Repositories\Booking;

/**
 * Class EloquentBookingRepository
 *
 * @author Anuj Jaha ( er.anujjaha@gmail.com)
 */

use App\Models\Booking\Booking;
use App\Repositories\DbRepository;
use App\Exceptions\GeneralException;
use App\Models\Doctor\Doctor;
use App\Models\Patient\Patient;

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
    public $moduleTitle = 'Records';

    /**
     * Table Headers
     *
     * @var array
     */
    public $tableHeaders = [
        'id'                => 'Id',
        'doctor_name'       => 'Doctor',
        'patient_name'      => 'Patient',
        'consulting_fees'   => 'Consulting Fees',
        'total'             => 'Total',
        'created_at'        => 'Created At',
        "actions"           => "Actions"
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
		'doctor_name' =>   [
                'data'          => 'doctor_name',
                'name'          => 'doctor_name',
                'searchable'    => true,
                'sortable'      => true
            ],
		'patient_name' =>   [
                'data'          => 'patient_name',
                'name'          => 'patient_name',
                'searchable'    => true,
                'sortable'      => true
            ],
		
		'consulting_fees' =>   [
                'data'          => 'consulting_fees',
                'name'          => 'consulting_fees',
                'searchable'    => true,
                'sortable'      => true
            ],
        'total' =>   [
                'data'          => 'total',
                'name'          => 'total',
                'searchable'    => true,
                'sortable'      => true
            ],
		'created_at' =>   [
                'data'          => 'created_at',
                'name'          => 'created_at',
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
        $this->model        = new Booking;
        $this->doctorModel  = new Doctor;
        $this->patientModel = new Patient;

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
            $this->model->getTable().'.*',
            $this->doctorModel->getTable().'.name as doctor_name',
            $this->patientModel->getTable().'.name as patient_name'
        ];
    }

    /**
     * @return mixed
     */
    public function getForDataTable()
    {
        return $this->model->select($this->getTableFields())
        ->leftjoin($this->doctorModel->getTable(), $this->doctorModel->getTable().'.id', '=', $this->model->
            getTable().'.doctor_id')
        ->leftjoin($this->patientModel->getTable(), $this->patientModel->getTable().'.id', '=', $this->model->getTable().'.patient_id')
        ->get();
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