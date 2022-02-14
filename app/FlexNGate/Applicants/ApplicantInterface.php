<?php

namespace App\FlexNGate\Applicants;


interface ApplicantInterface{

    public function fetch_all();
    public function fetch($id);
    public function create($applicant);
    public function update($id,$applicant);
    public function delete($id);
    public function search($term, $status, $page);

}
