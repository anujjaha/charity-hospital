<?php

namespace App\Http\Controllers\Backend\Order;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\Datatables\Facades\Datatables;
use App\Repositories\Order\EloquentOrderRepository;
use App\Repositories\Category\EloquentCategoryRepository;
use Html;

/**
 * Class AdminOrderController
 */
class AdminOrderController extends Controller
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
    protected $createSuccessMessage = "Product Created Successfully!";

    /**
     * Edit Success Message
     * 
     * @var string
     */
    protected $editSuccessMessage = "Product Edited Successfully!";

    /**
     * Delete Success Message
     * 
     * @var string
     */
    protected $deleteSuccessMessage = "Product Deleted Successfully";

	/**
	 * __construct
	 * 
	 */
	public function __construct()
	{
		$this->repository         = new EloquentOrderRepository;
        $this->categoryRepository = new EloquentCategoryRepository;
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

    public function show($id)
    {
        $item = $this->repository->getById($id);

        return view('backend.order.items')->with('item', $item);
        
    }

    /**
     * Event View
     * 
     * @return \Illuminate\View\View
     */
    public function create(Request $request)
    {
        return view($this->repository->setAdmin(true)->getModuleView('createView'))->with([
            'repository'            => $this->repository,
            'categoryRepository'    => $this->categoryRepository
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
            $imageName  = rand(11111, 99999) . '_product.' . $request->file('image')->getClientOriginalExtension();
            $request->file('image')->move(base_path() . '/public/uploads/product/', $imageName);
            $input = array_merge($input, ['image' => $imageName]);
        }

        if($request->file('image1'))
        {
            $imageName1  = rand(11111, 99999) . '_product.' . $request->file('image1')->getClientOriginalExtension();
            $request->file('image1')->move(base_path() . '/public/uploads/product/', $imageName1);
            $input = array_merge($input, ['image1' => $imageName1]);
        }

        if($request->file('image2'))
        {
            $imageName2  = rand(11111, 99999) . '_product.' . $request->file('image2')->getClientOriginalExtension();
            $request->file('image2')->move(base_path() . '/public/uploads/product/', $imageName2);
            $input = array_merge($input, ['image2' => $imageName2]);
        }

        if($request->file('image3'))
        {
            $imageName3  = rand(11111, 99999) . '_product.' . $request->file('image3')->getClientOriginalExtension();
            $request->file('image3')->move(base_path() . '/public/uploads/product/', $imageName3);
            $input = array_merge($input, ['image3' => $imageName3]);
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
            'item'                  => $event,
            'repository'            => $this->repository,
            'categoryRepository'    => $this->categoryRepository
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
            $imageName  = rand(11111, 99999) . '_product.' . $request->file('image')->getClientOriginalExtension();
            $request->file('image')->move(base_path() . '/public/uploads/product/', $imageName);
            $input = array_merge($input, ['image' => $imageName]);
        }

        if($request->file('image1'))
        {
            $imageName  = rand(11111, 99999) . '_product.' . $request->file('image1')->getClientOriginalExtension();
            $request->file('image1')->move(base_path() . '/public/uploads/product/', $imageName);
            $input = array_merge($input, ['image1' => $imageName]);
        }

        if($request->file('image2'))
        {
            $imageName  = rand(11111, 99999) . '_product.' . $request->file('image2')->getClientOriginalExtension();
            $request->file('image2')->move(base_path() . '/public/uploads/product/', $imageName);
            $input = array_merge($input, ['image2' => $imageName]);
        }

        if($request->file('image3'))
        {
            $imageName  = rand(11111, 99999) . '_product.' . $request->file('image3')->getClientOriginalExtension();
            $request->file('image3')->move(base_path() . '/public/uploads/product/', $imageName);
            $input = array_merge($input, ['image3' => $imageName]);
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
		    ->escapeColumns(['username', 'sort'])
            ->escapeColumns(['title', 'sort'])
            ->escapeColumns(['total_amount', 'sort'])
            ->escapeColumns(['total_qty', 'sort'])
            ->escapeColumns(['description', 'sort'])
            ->addColumn('actions', function ($event) {
                return $event->admin_action_buttons;
            })
		    ->make(true);
    }

    public function orderDetails($id, Request $request)
    {
        $item = $this->repository->getById($id);

        return view('backend.order.items')->with('item', $item);
    }
}
