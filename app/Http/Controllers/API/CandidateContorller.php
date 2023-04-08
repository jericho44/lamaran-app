<?php

namespace App\Http\Controllers\API;

use App\Helpers\ApiFormatter;
use App\Http\Controllers\Controller;
use App\Models\Candidate;
use App\Models\Job;
use App\Models\Skill;
use App\Models\SkillSetModel;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class CandidateContorller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Job::all();

        if ($data) {
            return ApiFormatter::createApi(200, 'Success', $data);
        } else {
            return ApiFormatter::createApi(400, 'Failed');
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
        // dump($request);
        try {
            $validator = Validator::make($request->all(), [
                'job_id' => 'required',
                'name' => 'required',
                'email' => 'required|email|unique:candidates,email',
                'phone' => 'required|numeric|unique:candidates,phone',
                'year' =>  'required|integer',
                'skill' => 'required'
            ], [
                'job_id.required' => 'Form :attribute harus diisi',
                'name.required' => 'Form :attribute harus diisi',
                'email.required' => 'Form :attribute harus diisi',
                'email.unique' => 'Email yang digunakan sudah terdaftar',
                'email.email' => 'Email tidak sesuai, sertakan @ pada email',
                'phone.required' => 'Form telepon harus diisi',
                'phone.unique' => 'No. telepon yang digunakan sudah terdaftar',
                'phone.numeric' => 'No. telepon harus angka',
                'year.required' => 'Form :attribute harus diisi',
                'skill.required' => 'Form :attribute harus diisi',
            ]);

            if ($validator->fails()) {
                return ApiFormatter::createApi(Response::HTTP_BAD_REQUEST, 'Failed', $validator->errors());
            }

            $candidate = Candidate::create($validator->validate());

            for ($i = 0; $i < count($request->skill); $i++) {
                $skills[] = [
                    'candidate_id' => $candidate->id,
                    'skill_id' => (int) $request->skill[$i],
                ];
            }
            SkillSetModel::insert($skills);

            $data = Candidate::where('id', '=', $candidate->id)->get();

            if ($data) {
                return ApiFormatter::createApi(Response::HTTP_CREATED, 'Success', $data);
            } else {
                return ApiFormatter::createApi(Response::HTTP_BAD_REQUEST, 'Failed', $data);
            }
        } catch (Exception $error) {
            return ApiFormatter::createApi(Response::HTTP_BAD_REQUEST, 'Failed', $error);
        }
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
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
