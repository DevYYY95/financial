<?php

namespace App\Http\Controllers;

use App\Expense;
use App\ExpenseCategory;
use Illuminate\Http\Request;

class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Expense::all();
        // dd($data);
        return view('backend.expense.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = ExpenseCategory::all();
        return view('backend.expense.create',compact('category'));
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
            'expense_cat_id' => 'required'
        ]);
        
        Expense::create($validatedData + ['user_id' => auth()->id()]);

        return redirect('expense')->withStatus(__('Expense successfully created.'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function show(Expense $expense)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Expense::find($id);
        $category = ExpenseCategory::all();
        return view('backend.expense.edit',compact('data','category'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'entry_date' => 'required|max:255',
            'amount' => 'required',
            'description' => 'required',
            'expense_cat_id' => 'required'
        ]);

        Expense::whereId($id)->update($validatedData + ['user_id' => auth()->id()]);

        return redirect('expense')->withStatus(__('Expense successfully updated.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Expense::find($id);
        $data->delete();

        return redirect('expense')->withStatus(__('Expense successfully deleted.'));
    }
}
