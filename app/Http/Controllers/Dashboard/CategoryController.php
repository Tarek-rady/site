<?php

namespace App\Http\Controllers\Dashboard;

use App\Exports\CategoryExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CategoryRequest;
use App\Http\Requests\Admin\ImportFileRequest;
use App\Imports\CategoryImport;
use App\Repositories\Sql\CategoryRepository;
use Maatwebsite\Excel\Facades\Excel;
use PDF;
class CategoryController extends Controller
{
    protected $categoryRepo ;

    public function __construct(CategoryRepository $categoryRepo)
    {
        $this->middleware('permission:categories-read')->only(['index']);
        $this->middleware('permission:categories-create')->only(['create', 'store']);
        $this->middleware('permission:categories-update')->only(['edit', 'update']);
        $this->middleware('permission:categories-delete')->only(['destroy']);
        $this->categoryRepo = $categoryRepo ;
    }

    public function index()
    {
         $categories = $this->categoryRepo->getAll();

         return view('dashboard.backend.categories.index' , compact('categories'));
    }

    public function create()
    {
         return view('dashboard.backend.categories.create');
    }


    public function store(CategoryRequest $request)
    {
        $data = $request->all();
        $this->categoryRepo->create($data);
        return redirect(route('admin.categories.index'))->with('success', __('models.added_successfully'));

    }



    public function edit($id)
    {
        $category = $this->categoryRepo->findOne($id);
         return view('dashboard.backend.categories.edit' , compact('category'));
    }


    public function update(CategoryRequest $request, $id)
    {
        $category = $this->categoryRepo->findOne($id);

        $data = $request->all();

        $category->update($data);
        return redirect(route('admin.categories.index'))->with('success', __('models.updated_successfully'));

    }


    public function destroy($id)
    {

        $category = $this->categoryRepo->findOne($id)->delete();

         return \response()->json([
            'message' => __('models.deleted_successfully')
        ]);
    }

    public function get_category_data()
    {
        return Excel::download(new CategoryExport, 'categories.xlsx');
    }

    public function createPDF(){

        $categories = $this->categoryRepo->getAll();
        view()->share ('categories', $categories);

        $pdf = PDF::loadView('dashboard.backend.categories.pdf', $categories->toArray());
        dd($pdf);
        // ->setOptions(['defaultFont' => 'sans-serif'])

        return $pdf->download('categories.pdf');
    }

    public function upload_file()
    {
        return view('dashboard.backend.categories.upload');
    }

    public function import_categories(ImportFileRequest $request)
    {

        $file = $request->file('file');
        // dd( $file);
        Excel::import(new CategoryImport, $file);

        return redirect(route('admin.categories.index'))->with('success', __('models.updated_successfully'));
    }

}
