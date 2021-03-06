<?php namespace App\Repositories\Doctor;

/**
 * Class EloquentDoctorRepository
 *
 * @author Anuj Jaha ( er.anujjaha@gmail.com)
 */

use App\Models\Doctor\Doctor;
use App\Repositories\DbRepository;
use App\Exceptions\GeneralException;
use App\Models\Department\Department;

class EloquentDoctorRepository extends DbRepository
{
    /**
     * Doctor Model
     *
     * @var Object
     */
    public $model;

    /**
     * Doctor Title
     *
     * @var string
     */
    public $moduleTitle = 'Doctor';

    /**
     * Table Headers
     *
     * @var array
     */
    public $tableHeaders = [
        'id'                => 'Id',
        'department'        => 'Department',
        'name'              => 'Name',
        'fees'              => 'Consulting Fees',
        'designation'       => 'Designation',
        'mobile'            => 'Mobile',
        'notes'             => 'Notes',
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
		'department' =>   [
                'data'          => 'department',
                'name'          => 'department',
                'searchable'    => true,
                'sortable'      => true
            ],
		'name' =>   [
                'data'          => 'name',
                'name'          => 'name',
                'searchable'    => true,
                'sortable'      => true
            ],
		'fees' =>   [
                'data'          => 'fees',
                'name'          => 'fees',
                'searchable'    => true,
                'sortable'      => true
            ],
        'designation' =>   [
                'data'          => 'designation',
                'name'          => 'designation',
                'searchable'    => true,
                'sortable'      => true
            ],
		'mobile' =>   [
                'data'          => 'mobile',
                'name'          => 'mobile',
                'searchable'    => true,
                'sortable'      => true
            ],
		'notes' =>   [
                'data'          => 'notes',
                'name'          => 'notes',
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
        'listRoute'     => 'doctor.index',
        'createRoute'   => 'doctor.create',
        'storeRoute'    => 'doctor.store',
        'editRoute'     => 'doctor.edit',
        'updateRoute'   => 'doctor.update',
        'deleteRoute'   => 'doctor.destroy',
        'dataRoute'     => 'doctor.get-list-data'
    ];

    /**
     * Module Views
     *
     * @var array
     */
    public $moduleViews = [
        'listView'      => 'doctor.index',
        'createView'    => 'doctor.create',
        'editView'      => 'doctor.edit',
        'deleteView'    => 'doctor.destroy',
    ];

    /**
     * Construct
     *
     */
    public function __construct()
    {
        $this->model        = new Doctor;
        $this->department   = new Department;
    }

    /**
     * Create Doctor
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
     * Update Doctor
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
     * Destroy Doctor
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
            $model->status = 0;
            return $model->save();
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
            $this->department->getTable().'.name as department'
        ];
    }

    /**
     * @return mixed
     */
    public function getForDataTable()
    {
        return $this->model->select($this->getTableFields())
            ->leftjoin($this->department->getTable(), $this->department->getTable().'.id', '=', $this->model->getTable().'.department_id')
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