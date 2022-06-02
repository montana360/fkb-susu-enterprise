<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Department;
// use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class DepartmentController extends Controller
{
    //
     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        date_default_timezone_set(get_option('timezone', 'Asia/Dhaka'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $departments = Department::all()->sortByDesc("id");
        return view('backend.department.list', compact('departments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request) {
        if (!$request->ajax()) {
            return view('backend.department.create');
        } else {
            return view('backend.department.modal.create');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
            'name'          => '',
            'descriptions'  => '',
        ]);

        if ($validator->fails()) {
            if ($request->ajax()) {
                return response()->json(['result' => 'error', 'message' => $validator->errors()->all()]);
            } else {
                return redirect()->route('departments.create')
                    ->withErrors($validator)
                    ->withInput();
            }
        }

        $department                = new Department();
        $department->name          = $request->input('name');
        $department->descriptions  = $request->input('descriptions');

        $department->save();

        if (!$request->ajax()) {
            return redirect()->route('departments.create')->with('success', _lang('Saved Successfully'));
        } else {
            return response()->json(['result' => 'success', 'action' => 'store', 'message' => _lang('Saved Successfully'), 'data' => $department, 'table' => '#departments_table']);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id) {
        $department = Department::find($id);
        if (!$request->ajax()) {
            return view('backend.department.view', compact('department', 'id'));
        } else {
            return view('backend.department.modal.view', compact('department', 'id'));
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id) {
        $department = Department::find($id);
        if (!$request->ajax()) {
            return view('backend.department.edit', compact('department', 'id'));
        } else {
            return view('backend.department.modal.edit', compact('department', 'id'));
        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $validator = Validator::make($request->all(), [
            'name'          => '',
            'descriptions'  => '',
        ]);

        if ($validator->fails()) {
            if ($request->ajax()) {
                return response()->json(['result' => 'error', 'message' => $validator->errors()->all()]);
            } else {
                return redirect()->route('departments.edit', $id)
                    ->withErrors($validator)
                    ->withInput();
            }
        }

        $department                = Department::find($id);
        $department->name          = $request->input('name');
        $department->descriptions  = $request->input('descriptions');

        $department->save();

        if (!$request->ajax()) {
            return redirect()->route('departments.index')->with('success', _lang('Updated Successfully'));
        } else {
            return response()->json(['result' => 'success', 'action' => 'update', 'message' => _lang('Updated Successfully'), 'data' => $department, 'table' => '#departments_table']);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $department = Department::find($id);
        $department->delete();
        return redirect()->route('departments.index')->with('success', _lang('Deleted Successfully'));
    }
}
