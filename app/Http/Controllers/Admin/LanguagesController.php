<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\LanguagesRequest;
use App\Models\Language;
use Illuminate\Http\Request;

class LanguagesController extends Controller
{
    public function index()
    {
        $languages = Language::select()->paginate(PAGINATION_COUNT);
        return view('admin.Languages.index', compact('languages'));
    }

    public function create()
    {
        return view('admin.Languages.create');
    }

    public function store(LanguagesRequest $request)
    {
        // insert to db
        //        return $request -> except('_token');
        try {
            if ($request->has('active'));
            $request->request->add(['active' => 0]);
            Language::create($request->except('_token'));
            return redirect()->route('admin.languages')->with(['success' => 'تم حفظ اللغة بنجاح']);
        } catch (\Exception $ex) {
            return redirect()->route('admin.languages')->with(['success' => 'تم حفظ اللغة بنجاح']);
        }
    }

    public function edit($id)
    {
        $language = Language::select()->find($id);
        if (!$language) {
            return redirect()->route('admin.languages')->with(['error' => 'هذة اللغة غير موجودة']);
        }
        return view('admin.Languages.edit', compact('language'));
    }


    public function update($id, LanguagesRequest $request)
    {
        try {
            $language = Language::find($id);
            if (!$language) {
                return redirect()->route('admin.languages.edit')->with(['error' => 'هذة اللغة غير موجودة']);
            }
            if (!$request->has('active'))
                $request->request->add(['active' => 0]);
            $language->update($request->except('_token'));
            return redirect()->route('admin.languages')->with(['success' => 'تم حذف اللغة بنجاح']);
        } catch (\Exception $ex) {
            return redirect()->route('admin.languages')->with(['error' => 'هناك خطا ما يرجي المحاولة فيما بعد']);
        }
    }


    public function destroy($id)
    {
        try {
            $language = Language::find($id);
            if (!$language) {
                return redirect()->route('admin.languages')->with(['error' => 'هذة اللغة غير موجودة']);
            }
            $language->delete();
            return redirect()->route('admin.languages')->with(['success' => 'تم حذف اللغة بنجاح']);
        } catch (\Exception $ex) {
            return redirect()->route('admin.languages')->with(['error' => 'هناك خطا ما يرجي المحاولة فيما بعد']);
        }
    }
}
