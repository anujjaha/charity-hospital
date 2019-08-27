<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Transformers\OrderTransformer;
use App\Http\Controllers\Api\BaseApiController;
use App\Repositories\Order\EloquentOrderRepository;

class APIOrderController extends BaseApiController 
{   
    /**
     * Repository
     * 
     * @var Object
     */
    protected $repository;

    /**
     * __construct
     * 
     * @param EventTransformer $eventTransformer
     */
    public function __construct()
    {
        parent::__construct();

        $this->repository           = new EloquentOrderRepository;
        $this->orderTransformer     = new OrderTransformer;
    }

    public function create(Request $request)
    {
        $userInfo   = Auth()->user();

        if($userInfo->cart)
        {
            $orderInfo = $this->repository->cartToOrder($userInfo, $userInfo->cart);

            if(isset($orderInfo) && $orderInfo)
            {
                $orderData     = $this->orderTransformer->singleOrderData($orderInfo);

                return $this->ApiSuccessResponse($orderData);
            }

            $error = [
                'reason' => 'Unable to find User Cart!'
            ];

            return $this->setStatusCode(400)->failureResponse($error, 'Unable to find User Cart !');
        }

        return $this->respondInternalError('No Items Found in Cart !');
    }
}
