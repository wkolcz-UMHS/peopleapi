<?php

namespace App\Http\Controllers;

use App\FlexNGate\Applicants\EloquentApplicantRepository;
use App\FlexNGate\Users\EloquentUserRepository;
use Illuminate\Http\Request;

/**
 *
 */
class ApplicantController extends Controller
{
    public function __construct(EloquentApplicantRepository $applicants)
    {
        $this->applicants = $applicants;
    }

    /**
     * Fetches all applicants and positions they applied for from the database
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function fetch_all(){
        try{
            $applicants = $this->applicants->fetch_all();
            if($applicants){
                return response([
                    'success' => true,
                    'data' => $applicants,
                ],200);
            }else{
                return response([
                    'success' => true,
                    'message' => 'Failed',
                ],200);
            }
        }catch(\Exception $e){
            return response([
                'success' => false,
                'message' => $e->getMessage()
            ],400);
        }
    }

    /**
     * Fetches an individual applicant and the position they applied for
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function fetch($id){
        try{
            $applicants = $this->applicants->fetch($id);
            if($applicants){
                return response([
                    'success' => true,
                    'data' => $applicants,
                ],200);
            }else{
                return response([
                    'success' => false,
                    'message' => 'No Users Match That ID',
                ],200);
            }
        }catch(\Exception $e){
            return response([
                'success' => false,
                'message' => $e->getMessage()
            ],400);
        }
    }

    /**
     * Returns fuzzy search of an applicant by name and allows for pagination
     * @param $name
     * @param int $page
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function search($name, $page=0){
        try{
            $applicants = $this->applicants->search($name,$page);
            if($applicants){
                return response([
                    'success' => true,
                    'data' => $applicants,
                ],200);
            }else{
                return response([
                    'success' => false,
                    'message' => 'No results',
                ],200);
            }
        }catch(\Exception $e){
            return response([
                'success' => false,
                'message' => $e->getMessage()
            ],400);
        }
    }

    /**
     * Create an applicant
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function create_applicant(Request $request){

            try{
                $applicant = $this->applicants->create(json_decode($request->get('info')));
                if($applicant){
                    return response([
                        'success' => true,
                        'data' => $applicant,
                    ],200);
                }else{
                    return response([
                        'success' => false,
                        'message' => 'Unable to Create: Missing Information',
                    ],200);
                }
            }catch(\Exception $e){
                return response([
                    'success' => false,
                    'message' => $e->getMessage()
                ],400);
            }
    }

    /**
     * Update an applicant information
     * @param Request $request
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function update_applicant(Request $request, $id){
        try{
            $applicant = $this->applicants->update($id,json_decode($request->get('info')));
            if($applicant){
                return response([
                    'success' => true,
                    'data' => $applicant,
                ],200);
            }else{
                return response([
                    'success' => false,
                    'message' => 'Unable to Update: Missing Information',
                ],200);
            }
        }catch(\Exception $e){
            return response([
                'success' => false,
                'message' => $e->getMessage()
            ],400);
        }
    }

    /**
     * Deletes an applicant if the requester has admin privileges
     * @param $id
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function delete_applicant($id, Request $request){
        $user = $request->user();
        if($user->role!=='admin'){
            return response([
                'success' => false,
                'message' => 'Not permitted to perform this action'
            ],401);
        }

        try{
            $success = $this->applicants->delete($id);
            if($success){
                return response([
                    'success' => $success,
                ],200);
            }else{
                return response([
                    'success' => false,
                    'message' => 'Unable to Delete',
                ],200);
            }
        }catch(\Exception $e){
            return response([
                'success' => false,
                'message' => $e->getMessage()
            ],400);
        }
    }
}
