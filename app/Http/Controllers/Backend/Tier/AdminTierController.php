<?php

namespace App\Http\Controllers\Backend\Tier;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\Datatables\Facades\Datatables;
use App\Repositories\Tier\EloquentTierRepository;
use App\Repositories\Category\EloquentCategoryRepository;
use Html;

/**
 * Class AdminTierController
 */
class AdminTierController extends Controller
{
	/**
	 * Event Repository
	 * 
	 * @var object
	 */
	public $repository;

    /**
     * Create Success Message
     * 
     * @var string
     */
    protected $createSuccessMessage = "Tier Created Successfully!";

    /**
     * Edit Success Message
     * 
     * @var string
     */
    protected $editSuccessMessage = "Tier Edited Successfully!";

    /**
     * Delete Success Message
     * 
     * @var string
     */
    protected $deleteSuccessMessage = "Tier Deleted Successfully";

	/**
	 * __construct
	 * 
	 */
	public function __construct()
	{
		$this->repository         = new EloquentTierRepository;
	}

    /**
     * Event Listing 
     * 
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view($this->repository->setAdmin(true)->getModuleView('listView'))->with([
            'repository' => $this->repository
        ]);
    }

    public function show()
    {

    }

    /**
     * Event View
     * 
     * @return \Illuminate\View\View
     */
    public function create(Request $request)
    {
        return view($this->repository->setAdmin(true)->getModuleView('createView'))->with([
            'repository'            => $this->repository
        ]);
    }

    /**
     * Store View
     * 
     * @return \Illuminate\View\View
     */
    public function store(Request $request)
    {
        $this->repository->create($request->all());

        return redirect()->route($this->repository->setAdmin(true)->getActionRoute('listRoute'))->withFlashSuccess($this->createSuccessMessage);
    }

    /**
     * Event View
     * 
     * @return \Illuminate\View\View
     */
    public function edit($id, Request $request)
    {
        $event = $this->repository->findOrThrowException($id);

        return view($this->repository->setAdmin(true)->getModuleView('editView'))->with([
            'item'                  => $event,
            'repository'            => $this->repository
        ]);
    }

    /**
     * Event Update
     * 
     * @return \Illuminate\View\View
     */
    public function update($id, Request $request)
    {
        $status = $this->repository->update($id, $request->all());
        
        return redirect()->route($this->repository->setAdmin(true)->getActionRoute('listRoute'))->withFlashSuccess($this->editSuccessMessage);
    }

    /**
     * Event Update
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
		    ->escapeColumns(['title', 'sort'])
            ->addColumn('title', function ($item)
            {
                return $item->title . '('. count($item->users) .')';
            })
            
            ->addColumn('actions', function ($event) {
                return $event->admin_action_buttons;
            })
		    ->make(true);
    }
}
