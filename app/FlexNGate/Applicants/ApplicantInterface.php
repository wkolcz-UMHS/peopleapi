<?php

namespace App\FlexNGate\Applicants;

use http\Env\Request;

interface ApplicantInterface{

    public function fetch_all();
    public function fetch($id);
    public function create($applicant);
    public function update($id,$applicant);
    public function delete($id);
    public function search($name,$page);

}
