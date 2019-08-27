<?php namespace App\Http\Controllers\Backend\Doctor;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\Datatables\Facades\Datatables;
use App\Repositories\Doctor\EloquentDoctorRepository;
use App\Models\Department\Department;

/**
 * Class AdminDoctorController
 */
class AdminDoctorController extends Controller
{
    /**
     * Doctor Repository
     *
     * @var object
     */
    public $repository;

    /**
     * Create Success Message
     *
     * @var string
     */
    protected $createSuccessMessage = "Doctor Created Successfully!";

    /**
     * Edit Success Message
     *
     * @var string
     */
    protected $editSuccessMessage = "Doctor Edited Successfully!";

    /**
     * Delete Success Message
     *
     * @var string
     */
    protected $deleteSuccessMessage = "Doctor Deleted Successfully";

    /**
     * __construct
     *
     */
    public function __construct()
    {
        $this->repository = new EloquentDoctorRepository;
    }

    /**
     * Doctor Listing
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view($this->repository->setAdmin(true)->getModuleView('listView'))->with([
            'repository' => $this->repository
        ]);
    }

    /**
     * Doctor View
     *
     * @return \Illuminate\View\View
     */
    public function create(Request $request)
    {
        $departments = Department::where('status', 1)->pluck('name', 'id')->toArray();

        return view($this->repository->setAdmin(true)->getModuleView('createView'))->with([
            'departments'   => $departments,
            'repository'    => $this->repository
        ]);
    }

    /**
     * Doctor Store
     *
     * @return \Illuminate\View\View
     */
    public function store(Request $request)
    {
        $this->repository->create($request->all());

        return redirect()->route($this->repository->setAdmin(true)->getActionRoute('listRoute'))->withFlashSuccess($this->createSuccessMessage);
    }

    /**
     * Doctor Edit
     *
     * @return \Illuminate\View\View
     */
    public function edit($id, Request $request)
    {
        $item        = $this->repository->findOrThrowException($id);
        $departments = Department::where('status', 1)->pluck('name', 'id')->toArray();

        return view($this->repository->setAdmin(true)->getModuleView('editView'))->with([
            'item'          => $item,
            'departments'   => $departments,
            'repository'    => $this->repository
        ]);
    }

    /**
     * Doctor Show
     *
     * @return \Illuminate\View\View
     */
    public function show($id, Request $request)
    {
        $item = $this->repository->findOrThrowException($id);

        return view($this->repository->setAdmin(true)->getModuleView('editView'))->with([
            'item'          => $item,
            'repository'    => $this->repository
        ]);
    }


    /**
     * Doctor Update
     *
     * @return \Illuminate\View\View
     */
    public function update($id, Request $request)
    {
        $status = $this->repository->update($id, $request->all());

        return redirect()->route($this->repository->setAdmin(true)->getActionRoute('listRoute'))->withFlashSuccess($this->editSuccessMessage);
    }

    /**
     * Doctor Destroy
     *
     * @return \Illuminate\View\View
     */
    public function destroy($id)
    {
        $status = $this->repository->destroy($id);

        return redirect()->route($this->repository->setAdmin(true)->getActionRoute('listRoute'))->withFlashSuccess($this->deleteSuccessMessage);
    }

    /**
     * Get Table Data
     *
     * @return json|mixed
     */
    public function getTableData()
    {
        return Datatables::of($this->repository->getForDataTable())
            ->escapeColumns(['id', 'sort'])
            ->addColumn('actions', function ($item) {
                return $item->admin_action_buttons;
            })
            ->make(true);
    }
}