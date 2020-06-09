<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Expense;
use App\Income;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $from = Carbon::parse(sprintf(
            '%s-%s-01',
            request()->query('y', Carbon::now()->year),
            request()->query('m', Carbon::now()->month)
        ));
        $to      = clone $from;
        $to->day = $to->daysInMonth;

        $expenses = Expense::with('category')
            ->whereBetween('entry_date', [$from, $to]);

        $incomes = Income::with('category')
            ->whereBetween('entry_date', [$from, $to]);

        $expensesTotal   = $expenses->sum('amount');
        $incomesTotal    = $incomes->sum('amount');
        $groupedExpenses = $expenses->whereNotNull('expense_cat_id')->orderBy('amount', 'desc')->get()->groupBy('expense_cat_id');
        $groupedIncomes  = $incomes->whereNotNull('income_cat_id')->orderBy('amount', 'desc')->get()->groupBy('income_cat_id');
        $profit          = $incomesTotal - $expensesTotal;

        $expensesSummary = [];

        foreach ($groupedExpenses as $exp) {
            foreach ($exp as $line) {
                if (!isset($expensesSummary[$line->category->name])) {
                    $expensesSummary[$line->category->name] = [
                        'name'   => $line->category->name,
                        'amount' => 0,
                    ];
                }

                $expensesSummary[$line->category->name]['amount'] += $line->amount;
            }
        }

        $incomesSummary = [];

        foreach ($groupedIncomes as $inc) {
            foreach ($inc as $line) {
                if (!isset($incomesSummary[$line->category->name])) {
                    $incomesSummary[$line->category->name] = [
                        'name'   => $line->category->name,
                        'amount' => 0,
                    ];
                }

                $incomesSummary[$line->category->name]['amount'] += $line->amount;
            }
        }
        return view('home',compact(
            'expensesSummary',
            'incomesSummary',
            'expensesTotal',
            'incomesTotal',
            'profit'
        ));
    }
}
