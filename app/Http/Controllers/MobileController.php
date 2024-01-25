<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Finance;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\UsersExport;


class MobileController extends Controller
{
    public function index()
    {
        try {
            $users = User::all();


            if ($users->isEmpty()) {
                return response()->view('mobile.index', ['users' => $users, 'message' => 'No users found'], 404);
            }

            return view('mobile.index', ['users' => $users]);
        } catch (\Exception $e) {
            return response()->view('error', ['message' => $e->getMessage()], 500);
        }
    }
    public function getUsers()
    {
        $users = User::all();

        $employeesListData = [];

        foreach ($users as $user) {
            $employeesListData[] = new User([
                'name' => $user->name,
                'dob' => $user->dob,
                'gender' => $user->gender,
                'email' => $user->email,
                'department' => $user->department,
                'status' => $user->status,
                'phonenumber' => $user->phonenumber,

            ]);
        }

        return response()->json(['data' => $employeesListData]);
    }
    public function register(Request $request)
    {
        $rules = [
            'name' => ['required', 'string'],
            'email' => ['required', 'string', 'unique:users,email'],
            'password' => ['required', 'string', 'confirmed']
        ];
        $validator = Validator::make($request->all(), $rules);
        if($validator->fails())
        {
            $errors = $validator->errors();
            $response = [
                'message' => 'Validation failed',
                'errors' => $errors->all()

            ];
            return response()->json($response, 400);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        $token = $user->createToken('apiendpointtokenapp')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];


        return response()->json($response, 201);
    }
    public function logout(Request $request)
    {
        auth()->user()->tokens()->delete();

        $response = [
            'message' => 'logged out'
        ];

        return response($response, 200);
    }
    public function login(Request $request)
    {
        $fields = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string']
        ]);

        $user = User::where('email', $fields['email'])->first();

        if (is_null($user) || !Hash::check($fields['password'], $user->password))
        {
            return response([
                'message' => 'Wrong credentials'
            ], 401);
        }

        $token = $user->createToken('apiendpointtokenapp')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response($response, 201);
    }
    public function financeindex()
    {
        $finances = Finance::all();
        return response()->json(['finances' => $finances], 200);

    }




    public function personalitems()
    {
        $user = auth()->user();
        $finances = Finance::where('user_id', $user->id)->get();
        return response()->json(['finances' => $finances], 200);
    }
    public function edit($id)
    {
        $finance = Finance::find($id);

        if (!$finance) {
            return response()->json(['error' => 'Finance record not found'], 404);
        }

        // Return the finance record as JSON
        return response()->json(['finance' => $finance], 200);
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
        return response()->json(['message' => 'Finance Record added successfully'], 200);

    }
    public function update(Request $request, $id)
    {
        $finance = Finance::find($id);

        if (!$finance) {
            return response()->json(['error' => 'Finance record not found'], 404);
        }

        $validatedData = $request->validate([
            'employee_id' => 'required|exists:users,id',
            'amount' => 'required|numeric',
        ]);

        $finance->user_id = $validatedData['employee_id'];
        $finance->amount = $validatedData['amount'];
        $finance->save();

        return response()->json(['message' => 'Finance record updated successfully'], 200);
    }
    public function destroy(Finance $finance)
    {
        if ($finance) {
            $finance->delete();
            return response()->json(['message' => 'Finance record deleted successfully'], 200);
        } else {
            return response()->json(['error' => 'Finance record not found'], 404);
        }
    }


}
