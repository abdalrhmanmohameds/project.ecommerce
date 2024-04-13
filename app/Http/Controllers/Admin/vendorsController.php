<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\vendorRequest;
use App\Models\MainCategory;
use App\Models\Vendor;
use App\Notifications\vendorCreated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use SebastianBergmann\Diff\Exception;

class vendorsController extends Controller
{
    public function index(){

        $vendors = Vendor::Selection()->paginate(PAGINATION_COUNT);
        return view('admin.Vendors.index', compact('vendors'));

    }

    public function create(){

        $categories = MainCategory::where('translation_of', 0)->active()->get();
        return view('admin.Vendors.create', compact('categories'));

    }

    public function store(VendorRequest $request)
    {
        try {

            if (!$request->has('active'))
                $request->request->add(['active' => 0]);
            else
                $request->request->add(['active' => 1]);

            $filePath = "";
            if ($request->has('logo')) {
                $filePath = uploadImage('vendors', $request->logo);
            }

            $vendor = Vendor::create([
                'name' => $request->name,
                'mobile' => $request->mobile,
                'email' => $request->email,
                'active' => $request->active,
                'address' => $request->address,
                'password' => $request->password,
                'logo' => $filePath,
                'category_id' => $request->category_id,
            ]);

            Notification::send($vendor, new vendorCreated($vendor));

            return redirect()->route('admin.Vendors')->with(['success' => 'تم الحفظ بنجاح']);

        } catch (\Exception $ex) {
//            return $ex;
            return redirect()->route('admin.Vendors')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);

        }
    }



    public function edit($id){

        try {
            $vendor = Vendor::Selection() -> find($id);
            if (!$vendor)
                return redirect()->route('admin.Vendors')->with(['error' => 'هذا المتجر غير موجود او ربما يكون محذوفا']);
            $categories = MainCategory::where('translation_of', 0)->active()->get();

            return view('admin.Vendors.edit', compact('vendor','categories'));

        }catch (\Exception $exception){
            return redirect()->route('admin.Vendors')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }

    }

    public function update()
    {


    }
}
