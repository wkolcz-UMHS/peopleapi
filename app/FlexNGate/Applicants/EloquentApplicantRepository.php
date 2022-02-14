<?php



namespace App\FlexNGate\Applicants;

use App\Models\Applicant;
use Illuminate\Support\Facades\Log;

class EloquentApplicantRepository implements ApplicantInterface
{

    /**
     * Fetches all the applicants and their position applied for
     * @return false|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function fetch_all(){
        try{
            return Applicant::with('position')->get();
        }catch(\Exception $e){
            return false;
        }
    }

    /**
     *  Returns an individual applicant based on passed id
     * @param $id
     * @return false|\Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model|object|null
     */
    public function fetch($id){
        try{
            return Applicant::with('position')->where('id',$id)->first();
        }catch(\Exception $e){
            return false;
        }
    }

    /**
     * Returns an applicants based on passed search term
     * @param $term
     * @param $page
     * @return false|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function search($term, $page){
        // Sets the paging offset. Page * number of results per page
        $offset = $page ? $page*2 : $page;
        try{
            if(count($applicant= Applicant::with('position')->where('name','like','%'.$term.'%')->take('2')->skip($offset)->get())){
                return $applicant;
            }else{
                return false;
            }
        }catch(\Exception $e){
            Log::error($e->getMessage());
            return false;
        }
    }

    /**
     * Creates and returns an individual applicant based on data passed
     * @param $applicant
     * @return false
     */
    public function create($applicant){

        try{
           $applicant = Applicant::create([
                'name' => $applicant->name,
                'position_id' => $applicant->position_id,
                'created_by' => $applicant->created_by,
                'status' => property_exists($applicant,'status') ? $applicant->status :'open'
            ]);
           return $applicant;
        }catch(\Exception $e){
            Log::error($e->getMessage());
            return false;
        }

    }

    /**
     * Updates and returns an individual applicant based on data passed
     * @param $id
     * @param $info
     * @return false
     */
    public function update($id, $info){
        try{
            $applicant = Applicant::where('id',$id)->first();
            if($applicant){
                $applicant->update(
                    [
                        'name' => $info->name,
                        'position_id' => $info->position_id,
                        'created_by' => $info->created_by,
                        'status' => $info->status
                    ]
                );
                return $applicant;
            }else{
                return false;
            }

        }catch(\Exception $e){
            Log::error($e->getMessage());
            return false;
        }

    }

    /**
     * Deletes an individual applicant based on id passed
     * @param $id
     * @return bool
     */
    public function delete($id){

        try{
            Applicant::where('id',$id)->delete();
            return true;
        }catch(\Exception $e){
            return false;
        }
    }
}
