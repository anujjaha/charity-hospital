<?php namespace App\Repositories\PatientSurgery;

/**
 * Class EloquentPatientSurgeryRepository
 *
 * @author Anuj Jaha ( er.anujjaha@gmail.com)
 */

use App\Models\PatientSurgery\PatientSurgery;
use App\Repositories\DbRepository;
use App\Exceptions\GeneralException;

class EloquentPatientSurgeryRepository extends DbRepository
{
    /**
     * PatientSurgery Model
     *
     * @var Object
     */
    public $model;

    /**
     * PatientSurgery Title
     *
     * @var string
     */
    public $moduleTitle = 'PatientSurgery';

    /**
     * Table Headers
     *
     * @var array
     */
    public $tableHeaders = [
        'id'        => 'Id',
'patient_id'        => 'Patient_id',
'doctor_id'        => 'Doctor_id',
'booking_id'        => 'Booking_id',
'surgery_id'        => 'Surgery_id',
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
		'patient_id' =>   [
                'data'          => 'patient_id',
                'name'          => 'patient_id',
                'searchable'    => true,
                'sortable'      => true
            ],
		'doctor_id' =>   [
                'data'          => 'doctor_id',
                'name'          => 'doctor_id',
                'searchable'    => true,
                'sortable'      => true
            ],
		'booking_id' =>   [
                'data'          => 'booking_id',
                'name'          => 'booking_id',
                'searchable'    => true,
                'sortable'      => true
            ],
		'surgery_id' =>   [
                'data'          => 'surgery_id',
                'name'          => 'surgery_id',
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
        'listRoute'     => 'patientsurgery.index',
        'createRoute'   => 'patientsurgery.create',
        'storeRoute'    => 'patientsurgery.store',
        'editRoute'     => 'patientsurgery.edit',
        'updateRoute'   => 'patientsurgery.update',
        'deleteRoute'   => 'patientsurgery.destroy',
        'dataRoute'     => 'patientsurgery.get-list-data'
    ];

    /**
     * Module Views
     *
     * @var array
     */
    public $moduleViews = [
        'listView'      => 'patientsurgery.index',
        'createView'    => 'patientsurgery.create',
        'editView'      => 'patientsurgery.edit',
        'deleteView'    => 'patientsurgery.destroy',
    ];

    /**
     * Construct
     *
     */
    public function __construct()
    {
        $this->model = new PatientSurgery;
    }

    /**
     * Create PatientSurgery
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
     * Update PatientSurgery
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
     * Destroy PatientSurgery
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