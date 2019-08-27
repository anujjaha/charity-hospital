<?php namespace App\Http\Controllers\Backend\Surgery;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\Datatables\Facades\Datatables;
use App\Repositories\Surgery\EloquentSurgeryRepository;
use App\Models\Department\Department;

/**
 * Class AdminSurgeryController
 */
class AdminSurgeryController extends Controller
{
    /**
     * Surgery Repository
     *
     * @var object
     */
    public $repository;

    /**
     * Create Success Message
     *
     * @var string
     */
    protected $createSuccessMessage = "Surgery Created Successfully!";

    /**
     * Edit Success Message
     *
     * @var string
     */
    protected $editSuccessMessage = "Surgery Edited Successfully!";

    /**
     * Delete Success Message
     *
     * @var string
     */
    protected $deleteSuccessMessage = "Surgery Deleted Successfully";

    /**
     * __construct
     *
     */
    public function __construct()
    {
        $this->repository = new EloquentSurgeryRepository;
    }

    /**
     * Surgery Listing
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
     * Surgery View
     *
     * @return \Illuminate\View\View
     */
    public function create(Request $request)
    {
        $departments = Department::where('status', 1)->pluck('name', 'id')->toArray();

        return view($this->repository->setAdmin(true)->getModuleView('createView'))->with([
            'repository' => $this->repository,
            'departments'  => $departments
        ]);
    }

    /**
     * Surgery Store
     *
     * @return \Illuminate\View\View
     */
    public function store(Request $request)
    {
        $this->repository->create($request->all());

        return redirect()->route($this->repository->setAdmin(true)->getActionRoute('listRoute'))->withFlashSuccess($this->createSuccessMessage);
    }

    /**
     * Surgery Edit
     *
     * @return \Illuminate\View\View
     */
    public function edit($id, Request $request)
    {
        $item = $this->repository->findOrThrowException($id);
        $departments = Department::where('status', 1)->pluck('name', 'id')->toArray();

        return view($this->repository->setAdmin(true)->getModuleView('editView'))->with([
            'item'          => $item,
            'repository'    => $this->repository,
            'departments'   => $departments
        ]);
    }

    /**
     * Surgery Show
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
     * Surgery Update
     *
     * @return \Illuminate\View\View
     */
    public function update($id, Request $request)
    {
        $status = $this->repository->update($id, $request->all());

        return redirect()->route($this->repository->setAdmin(true)->getActionRoute('listRoute'))->withFlashSuccess($this->editSuccessMessage);
    }

    /**
     * Surgery Destroy
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
            ->addColumn('status', function ($item) {
                return $item->status == 1 ? 'Active' : 'In-active';
            })
            ->addColumn('actions', function ($item) {
                return $item->admin_action_buttons;
            })
            ->make(true);
    }
}