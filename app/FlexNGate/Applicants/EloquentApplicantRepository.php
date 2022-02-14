<?php



namespace App\FlexNGate\Applicants;

use App\Models\Applicant;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class EloquentApplicantRepository implements ApplicantInterface
{

    /**
     * Fetches all the applicants and their position applied for
     * @return false|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function fetch_all(){

//        $q = "Select a.name, a.status, a.created_by, a.created_at, a.updated_at, p.position
//            from applicants a JOIN positions p on a.position_id = p.position_id

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

//        $q = "Select a.name, a.status, a.created_by, a.created_at, a.updated_at, p.position
//            from applicants a JOIN positions p on a.position_id = p.position_id
//            WHERE a.id = ".$id;

        try{
            return Applicant::with('position')->where('id',$id)->first();
        }catch(\Exception $e){
            return false;
        }
    }

    /**
     * Returns an applicants based on passed search term, status, and page
     * @param $term
     * @param $status
     * @param $page
     * @return false|\Illuminate\Database\Eloquent\Collection
     */
    public function search($term, $status, $page){
        // Sets the paging offset. Page * number of results per page
        $offset = $page ? $page*2 : $page;

//        $q = "Select a.name, a.status, a.created_by, a.created_ay, a.updated_at, p.position
//                FROM applicants a JOIN positions p on a.position_id = p.position_id
//                WHERE a.name LIKE %".$term."%";
//
//        if($status!=='all'){
//            $q.=" AND WHERE status='.$status.' ";
//        }
//
//        $q.="LIMIT ".$offset.",2)";
//        dd($q);
//        $applicants = DB::select(DB::RAW($q));

        $applicants = Applicant::with('position')
            ->where('name','like','%'.$term.'%')
            ->status($status)
            ->take('2')
            ->skip($offset)
            ->get();


        try{
            if(count($applicants)){
                return $applicants;
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

//        $q = "INSERT INTO application (name,position_id,created_by,status)
//                values(".$applicant->name.",".$applicant->position_id.",".$applicant->created_by.",
//                ".property_exists($applicant,'status') ? $applicant->status :'open'.")";

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

//        $q = "UPDATE applicants
//                SET name=".$info->name.", position_id=".$info->position_id.",created_by=".$info->created_by.", status=".$info->status."
//                WHERE id = ".$id;

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

//        $q = "DELETE FROM applicants where id = ".$id

        try{
            Applicant::where('id',$id)->delete();
            return true;
        }catch(\Exception $e){
            return false;
        }
    }
}
