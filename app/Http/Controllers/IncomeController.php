<?php

namespace App\Http\Controllers;

use App\Income;
use App\IncomeCategory;
use Illuminate\Http\Request;

class IncomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Income::all();
        return view('backend.income.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = IncomeCategory::all();
        return view('backend.income.create',compact('category'));
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
            'entry_date' => 'required|max:255',
            'amount' => 'required',
            'description' => 'required',
            'income_cat_id' => 'required'
        ]);
        
        Income::create($validatedData + ['user_id' => auth()->id()]);

        return redirect('income')->withStatus(__('Income successfully created.'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Income  $income
     * @return \Illuminate\Http\Response
     */
    public function show(Income $income)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Income  $income
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Income::find($id);
        $category = IncomeCategory::all();
        return view('backend.income.edit',compact('data','category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Income  $income
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'entry_date' => 'required|max:255',
            'amount' => 'required',
            'description' => 'required',
            'income_cat_id' => 'required'
        ]);

        Income::whereId($id)->update($validatedData + ['user_id' => auth()->id()]);

        return redirect('income')->withStatus(__('Income successfully updated.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Income  $income
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Income::find($id);
        $data->delete();

        return redirect('income')->withStatus(__('Income successfully deleted.'));
    }
}
