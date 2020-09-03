<?php

namespace App\Http\Controllers\Admin;

use App\Company;
use App\Imports\CompanyImport;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use Session;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //


        $query = Company::query();
        $search_type = 0;
        $search_info = '';
        $is_active = -1;


        if ($request->has('is_active')) {
            $is_active = $request->input('is_active');
        }
        if ($is_active >= 0) {
            $query->where('is_active', '=', $is_active);
        }


        if ($request->has('search_type')) {
            $search_type = $request->query('search_type');
        }
        if ($search_type > 0) {
            $search_info = $request->query('search_info');
            switch ($search_type) {
                case 1:
                    $query->where('tax_id', 'like', "%{$search_info}%");

                    break;
                case 2:
                    $query->where('name', 'like', "%{$search_info}%");
                    break;
                default:
                    break;
            }
        }



        $query->orderBy('create_date',"DESC");
        $companies = $query->paginate(15);

        $data = [
            'companies' => $companies,
            'search_info' => $search_info,
            'search_type' => $search_type,
            'is_active' => $is_active,
        ];

        return view('admin.company.index',$data);

    }
    function containsOnlyNull($input)
    {
        return empty(array_filter($input, function ($a) { return $a !== null;}));
    }

    public function import(Request $request)
    {
        if($request->file('file') == null){
            $msg = '必須上傳檔案';
            \Illuminate\Support\Facades\Session::flash('msg',$msg);
            return redirect()->back();
        }

        $extension = $request->file->getClientOriginalExtension();
        if(!in_array($extension, ['csv', 'xls', 'xlsx'])){
            $msg = '檔案必需為excel格式(副檔名為csv,xls,xlsx)';
            Session::flash('msg',$msg);
            return redirect()->back();
        }
        try{
            $import = new CompanyImport();
            Excel::import($import, request()->file('file'));
            $rows = $import->getRows()->toArray();
            array_shift($rows);

            $msgs = [];
            $msg = '';
            foreach($rows as $row){
                if($this->containsOnlyNull($row)){
                    continue;
                }
                $rename_row = [
                    'name' => $row[0],
                    'tax_id' => $row[1],
                    'is_active' =>$row[2],
                ];
//                check product isbn exists
                $company = Company::where('tax_id','=',$rename_row['tax_id'])->first();
                if(!is_null($company)){
                    $msg = '統編: ' . $rename_row['tax_id'] . '已存在，無法重複';
                    array_push($msgs,$msg);
                    continue;
                }
                $company = Company::create([
                    'name' => $rename_row['name'],
                    'tax_id' => $rename_row['tax_id'],
                    'is_active' => $rename_row['is_active'],
                    'create_date' => now(),
                    'update_date' => now(),
                ]);
                $msg = '公司統編: ' . $rename_row['tax_id'] . ' 公司名稱: '. $rename_row['name'] . '建立成功';
                array_push($msgs,$msg);

            }
            Session::flash('msgs',$msgs);
            return redirect()->back();

        }
        catch (\Exception $exception){
            $msg = $exception->getMessage();
            Session::flash('msg',$msg);
            return redirect()->back();
        }

    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Company $company)
    {
        //

        $data = [
            'company' => $company,
        ];
        return view('admin.company.edit',$data);


    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Company $company)
    {
        //
        $this->validate($request, [
            'tax_id' => 'required|string|max:8|min:8',
            'name' => 'required',
            'is_active' => 'required',
        ]);


        if($company->tax_id != $request->input('tax_id')){

            $find_company = Company::where('tax_id','=',$request->input('tax_id'))->first();
            if(!is_null($find_company)){
                Session::flash('msg','統編已存在');
                return redirect()->back();
            }

        }

        $company->tax_id = $request->input('tax_id');
        $company->name = $request->input('name');
        $company->is_active = $request->input('is_active');
        $company->create_date = now();
        $company->update_date = now();
        $company->update();

        return redirect()->route('admin_company.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
