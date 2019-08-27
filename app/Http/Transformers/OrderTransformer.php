<?php

namespace App\Http\Transformers;

use App\Http\Transformers;
use URL;

class OrderTransformer extends Transformer 
{
    /** Transform
     * 
     * @param array $data
     * @return array
     */
    public function transform($data) 
    {
        if(is_array($data))
        {
            $data = (object)$data;
        }
        
        return [
            'eventId'           => (int) $data->id,
            'eventName'         => $data->name,
            'eventTitle'        => $data->title,
            'eventStartDate'    => date('d-m-Y', strtotime($data->start_date)),
            'eventEndDate'      => date('d-m-Y', strtotime($data->end_date))
        ];
    }

    public function singleOrderData($order)
    {
        if($order)
        {
            return [
                'orderId'       => $order->id,
                'userId'        => $order->user_id,
                'orderTitle'    => $order->title,
                'totalAmount'   => $order->total_amount,
                'totalQty'      => $order->total_qty,
                'description'   => $order->description
            ];
        }

        return [];
    }
}
