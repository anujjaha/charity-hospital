<?php

namespace App\Http\Controllers\Backend\Category;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\Datatables\Facades\Datatables;
use App\Repositories\Category\EloquentCategoryRepository;
use Html;

/**
 * Class AdminCategoryController
 */
class AdminCategoryController extends Controller
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
    protected $createSuccessMessage = "Category Created Successfully!";

    /**
     * Edit Success Message
     * 
     * @var string
     */
    protected $editSuccessMessage = "Category Edited Successfully!";

    /**
     * Delete Success Message
     * 
     * @var string
     */
    protected $deleteSuccessMessage = "Category Deleted Successfully";

	/**
	 * __construct
	 * 
	 * @param EloquentEventRepository $eventRepository
	 */
	public function __construct()
	{
		$this->repository = new EloquentCategoryRepository;
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
            'repository' => $this->repository
        ]);
    }

    /**
     * Store View
     * 
     * @return \Illuminate\View\View
     */
    public function store(Request $request)
    {
        $input = $request->all();

        if($request->file('image'))
        {
            $imageName  = rand(11111, 99999) . '_category.' . $request->file('image')->getClientOriginalExtension();
            $request->file('image')->move(base_path() . '/public/uploads/category/', $imageName);
            $input = array_merge($request->all(), ['image' => $imageName]);
        }

        $this->repository->create($input);

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
            'item'          => $event,
            'repository'    => $this->repository
        ]);
    }

    /**
     * Event Update
     * 
     * @return \Illuminate\View\View
     */
    public function update($id, Request $request)
    {
        $input = $request->all();

        if($request->file('image'))
        {
            $imageName  = rand(11111, 99999) . '_category.' . $request->file('image')->getClientOriginalExtension();
            $request->file('image')->move(base_path() . '/public/uploads/category/', $imageName);
            $input = array_merge($request->all(), ['image' => $imageName]);
        }

        $status = $this->repository->update($id, $input);
        
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
             ->addColumn('productscount', function ($item)
            {
                return count($item->products);
            })
            ->addColumn('image', function ($item) 
            {
                
                return  Html::image('/uploads/category/'.$item->image, 'Image', ['width' => 60, 'height' => 60]);    
            })
            ->addColumn('actions', function ($event) {
                return $event->admin_action_buttons;
            })
		    ->make(true);
    }
}
