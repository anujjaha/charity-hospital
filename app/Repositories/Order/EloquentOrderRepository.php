<?php namespace App\Repositories\Order;

use App\Models\Product\Product;
use App\Models\Category\Category;
use App\Models\Order\Order;
use App\Models\OrderItem\OrderItem;
use App\Models\Access\User\User;
use App\Repositories\DbRepository;
use App\Exceptions\GeneralException;
use App\Models\Cart\Cart;

class EloquentOrderRepository extends DbRepository
{
	/**
	 * Event Model
	 * 
	 * @var Object
	 */
	public $model;

	/**
	 * Module Title
	 * 
	 * @var string
	 */
	public $moduleTitle = 'Order';

	/**
	 * 
	 * Table Headers
	 *
	 * @var array
	 */
	public $tableHeaders = [
		'username'		=> 'User Name',
		'title' 		=> 'Title',
		'total_amount' 	=> 'Total',
		'total_qty' 	=> 'Qty',
		'description' 	=> 'Description',
		'actions' 		=> 'Actions'
	];

	/**
	 * Table Columns
	 *
	 * @var array
	 */
	public $tableColumns = [
		'username' => [
			'data' 			=> 'username',
			'name' 			=> 'username',
			'searchable' 	=> true, 
			'sortable'		=> true
		],
		'title' => [
			'data' 			=> 'title',
			'name' 			=> 'title',
			'searchable' 	=> true, 
			'sortable'		=> true
		],
		'total_amount' => [
			'data' 			=> 'total_amount',
			'name' 			=> 'total_amount',
			'searchable' 	=> true, 
			'sortable'		=> true
		],
		'total_qty' => [
			'data' 			=> 'total_qty',
			'name' 			=> 'total_qty',
			'searchable' 	=> true, 
			'sortable'		=> true
		],
		'description' => [
			'data' 			=> 'description',
			'name' 			=> 'description',
			'searchable' 	=> true, 
			'sortable'		=> true
		],
		'actions' => [
			'data' 			=> 'actions',
			'name' 			=> 'actions',
			'searchable' 	=> false, 
			'sortable'		=> false
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
		'listRoute' 	=> 'order.index',
		'createRoute' 	=> 'order.create',
		'storeRoute' 	=> 'order.store',
		'editRoute' 	=> 'order.edit',
		'viewRoute' 	=> 'order.details',
		'updateRoute' 	=> 'order.update',
		'deleteRoute' 	=> 'order.destroy',
		'dataRoute' 	=> 'order.get-list-data'
	];

	/**
	 * Module Views
	 * 
	 * @var array
	 */
	public $moduleViews = [
		'listView' 		=> 'order.index',
		'createView' 	=> 'order.create',
		'editView' 		=> 'order.edit',
		'deleteView' 	=> 'order.destroy',
	];

	/**
	 * Construct
	 *
	 */
	public function __construct()
	{
		$this->model 			= new Order;
		$this->categoryModel 	= new Category;
		$this->userModel		= new User;
	}

	/**
	 * Create Event
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
	 * Update Event
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
	 * Destroy Event
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
    	if(isset($orderBy) && $sort)
    	{
    		return $this->model->orderBy($orderBy, $sort)->get();	
    	}

    	return $this->model->all();
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
			$this->model->getTable().'.id as id',
			$this->model->getTable().'.title',
			$this->model->getTable().'.total_amount',
			$this->model->getTable().'.total_qty',
			$this->model->getTable().'.description',
			$this->userModel->getTable().'.name as username',
		];
    }

    /**
     * @return mixed
     */
    public function getForDataTable()
    {
    	return  $this->model->select($this->getTableFields())
    				->leftjoin($this->userModel->getTable(), $this->userModel->getTable().'.id', '=', $this->model->getTable().'.user_id')
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

    public function cartToOrder($user = null, $userCart = null)
    {
    	if(isset($userCart) && count($userCart))
    	{
    		$orderItems = [];
    		$totalQty	= 0;
    		$total 		= 0;

    		foreach($userCart as $cart)
    		{
    			$total 		= $total + $cart->product->price * $cart->qty;
    			$totalQty 	= $totalQty + $cart->qty;
    		}

    		$order = $this->model->create([
    			'user_id' 		=> $user->id,
    			'title'			=> 'Order by ' . $user->name,
    			'subtotal'		=> $total,
    			'total_amount'	=> $total,
    			'due'			=> $total,
    			'total_qty'		=> $totalQty,
    			'description'	=> 'Order by' .$user->name
    		]);

    		foreach($userCart as $cart)
    		{
    			$orderItems[] = [
    				'user_id'		=> $user->id,
    				'order_id'		=> $order->id,
    				'product_id'	=> $cart->product->id,
    				'qty'			=> $cart->qty,
    				'price'			=> $cart->product->price,
    				'total'			=> $cart->product->price * $cart->qty,
    			];
    		}

    		OrderItem::insert($orderItems);

    		Cart::where('user_id', $user->id)->delete();

    		return $order;
    	}

    	return false;
    }
}