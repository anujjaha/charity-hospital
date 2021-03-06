<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Repositories\Category\EloquentCategoryRepository;
use App\Repositories\Product\EloquentProductRepository;
use App\Repositories\Schedule\EloquentScheduleRepository;
use App\Models\Doctor\Doctor;
use App\Models\Surgery\Surgery;

/**
 * Class FrontendController.
 */
class FrontendController extends Controller
{
    public function __construct()
    {
        $this->categoryRepository = new EloquentCategoryRepository;
        $this->productRepository  = new EloquentProductRepository;
    }

    /**
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $user       = access()->user();

        if($user)
        {
            $condition  = [
                'status'        => 1,
                'department_id' => $user->department_id 
            ];
        }
        else
        {
            $condition  = [
                'status'        => 1 
            ];
        }

        $doctors    = Doctor::where($condition)->pluck('name', 'id')->toArray();
        $allDoctors = Doctor::where($condition)->get();
        $surgeries  = Surgery::where($condition)->get();

        return view('frontend.index')->with([
            'doctors'       => $doctors,
            'allDoctors'    => $allDoctors,
            'surgeries'     => $surgeries
        ]);
    }

    /**
     * @return \Illuminate\View\View
     */
    public function macros()
    {
        return view('frontend.macros');
    }

    public function jewelCategories()
    {
        return view('frontend.jewel.category')->with('categories', $this->categoryRepository->getAll('title'));
    }

    public function jewelProducts()
    {
        return view('frontend.jewel.product')->with([
            'products'      => $this->productRepository->getAll('title'),
            'repository'    => $this->productRepository
        ]);
    }

    public function jewelProductsByCategory($id)
    {
        return view('frontend.jewel.product-by-category')->with([
                'repository'    => $this->productRepository,
                'categoryId'    => $id
            ]);
    }

    

    public function productDetails($id)
    {
        return view('frontend.jewel.product-details')->with('product', $this->productRepository->getById($id));
    }

    public function timePiece()
    {
        $repository = new EloquentScheduleRepository;

        return view('frontend.jewel.front-end-pages.time-piece')->with(['repository' => $repository]);
    }

    public function accessories()
    {
        return view('frontend.jewel.front-end-pages.accessories');   
    }

    public function gifts()
    {
        return view('frontend.jewel.front-end-pages.gifts');   
    } 
    
    public function clientService()
    {
        return view('frontend.jewel.front-end-pages.client-service');   
    }

    public function corporate()
    {
        return view('frontend.jewel.front-end-pages.corporate');   
    }

    public function catelogs()
    {
        return view('frontend.jewel.front-end-pages.catelogs');   
    }

    public function legalTerms()
    {
        return view('frontend.jewel.front-end-pages.legal-terms');   
    }

    public function helpDesk()
    {
        return view('frontend.jewel.front-end-pages.help-desk');   
    }

    public function contactUs()
    {
        return view('frontend.jewel.front-end-pages.contact-us');   
    }

    public function customPolicy()
    {
        $key        = 'legal-terms-page';
        $response   = access()->getBlock($key);

        return view('api.custom-page')->with('value', $response);   
    }
}
