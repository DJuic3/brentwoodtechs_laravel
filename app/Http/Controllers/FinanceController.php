<?php

namespace App\Http\Controllers;

use App\Models\Finance;
use App\Models\Employee;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class FinanceController extends Controller
{
    public function index()
    {
        $finances = Finance::all();
        $finances = Finance::with('user')->get();
        return view('finance.index', compact('finances'));
    }
    public function personalitems()
    {
        $user = auth()->user();
        $finances = Finance::where('user_id', $user->id)->get();
        return view('finance.personalitems', compact('finances'));
    }

    public function create()
    {
        $employees = Employee::all(); 
        return view('finance.create', compact('employees'));
    }

   public function store(Request $request)
    {
        $validatedData = $request->validate([
            'employee_id' => 'required|exists:users,id',
            'amount' => 'required|numeric',
        ]);

        $finance = new Finance();
        $finance->user_id = $validatedData['employee_id'];
        $finance->amount = $validatedData['amount'];
        $finance->save();
        return redirect()->route('finance.index')->with('success', 'Finance Record added successfully.');

    }


    public function edit(Finance $finance)
    {
        return view('finance.edit', compact('finance'));
    }

    public function update(Request $request, Finance $finance)
    {
        $request->validate([
            'amount' => 'required|numeric',
        ]);

        $finance->update([
            'amount' => $request->amount,
        ]);

        return redirect()->route('finance.index')->with('success', 'Finance record updated successfully.');
    }

    public function destroy(Finance $finance)
    {
        $finance->delete();

        return redirect()->route('finance.index')->with('success', 'Finance record deleted successfully.');
    }


}
