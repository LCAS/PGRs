<?php

namespace App\Http\Controllers;

use App\Award;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\HttpResponse;

use DB;

class AwardsController extends Controller
{
    private $data;

    public function __construct() {
        $this->data = array();
        $this->data['controllerName'] = 'AwardsController';
        $this->data['tableName'] = 'award_id';
        $this->data['singleName'] = 'Award';
        $this->data['pluralName'] = 'Awards';
        $this->data['indexUrl'] = 'awards';
    }
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $this->data['entities'] = Award::all();
        $this->data['stats'] = DB::select('SELECT awards.name as name, COUNT(*) as count FROM students, awards WHERE students.award_id = awards.id GROUP BY name ORDER BY name');
        return view('admin.layouts.name_comment_with_student_count.index', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.layouts.name_comment.create', $this->data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $this->validate($request, ['name' => 'required|string|regex:/^[a-zA-Z0-9\.\'\ \(\)\-]*$/|unique:awards']);
        Award::create($request->all());
        return redirect()->action('AwardsController@index')->with('success_message', 'Successfully added new '.$this->data['singleName'].': '.$request->name);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($name)
    {
        $this->data['entity'] = Award::where('name', $name)->firstOrFail();
        $this->data['students'] = \App\Student::with('user', 'supervisors.staff.user')->where('award_id', $this->data['entity']->id)->get();
        return view('admin.layouts.name_comment_with_student_count.show', $this->data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($name)
    {
        $this->data['entity'] = Award::where('name', $name)->firstOrFail();
        return view('admin.layouts.name_comment.edit', $this->data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($name, Request $request)
    {
        $this->validate($request, ['name' => 'required|string|regex:/^[a-zA-Z0-9\.\'\ \(\)\-]*$/']);
        $this->data['entity'] = Award::where('name', $name)->firstOrFail();
        $this->data['entity']->update($request->all());
        return view('admin.layouts.name_comment.show', $this->data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($name)
    {
        $entity = Award::where('name', $name)->firstOrFail();
        $entity->delete();
        return redirect()->action('AwardsController@index')->with('info_message', 'Successfully removed '.$this->data['singleName'].': '.$entity->name);
    }
}
