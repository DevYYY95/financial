<?php

namespace App\Http\Controllers;

use App\IncomeCategory;
use Illuminate\Http\Request;

class IncomeCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = IncomeCategory::all();
        return view('backend.incomeCategory.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.incomeCategory.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255'
        ]);
        
        IncomeCategory::create($validatedData);

        return redirect('income_category')->withStatus(__('Income Category successfully created.'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\IncomeCategory  $incomeCategory
     * @return \Illuminate\Http\Response
     */
    public function show(IncomeCategory $incomeCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\IncomeCategory  $incomeCategory
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = IncomeCategory::find($id);
        return view('backend.incomeCategory.edit',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\IncomeCategory  $incomeCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255'
        ]);

        IncomeCategory::whereId($id)->update($validatedData);

        return redirect('income_category')->withStatus(__('Income Category successfully updated.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\IncomeCategory  $incomeCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = IncomeCategory::find($id);
        $data->delete();

        return redirect('income_category')->withStatus(__('Income Category successfully deleted.'));
    }
}
