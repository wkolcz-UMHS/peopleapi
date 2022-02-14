<?php

namespace Tests\Unit;

use App\FlexNGate\Applicants\EloquentApplicantRepository;
use App\Models\User;
use Tests\TestCase;

class ApplicantTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_get_all_applicants()
    {
        $user = User::find(1);
        $this->actingAs($user)->get(route('fetch-applicants'))->assertStatus(200);
    }

    public function test_get_applicant_by_id()
    {
        $user = User::find(1);
        $this->actingAs($user)->get(route('fetch-applicant',['id' => 4]))->assertStatus(200);
    }

    public function test_create_applicant(){
        $user = User::find(1);
        $applicant = [
            'name' => 'Shawn Mulvey',
            'created_by' => 1,
            'position' => 1
        ];
        $this->actingAs($user)->post(route('create-applicant'),$applicant)->assertStatus(200);
    }
    public function test_update_applicant(){
        $user = User::find(1);
        $applicant = [
            'name' => 'Sean Mulvey',
            'created_by' => 1,
            'position' => 1
        ];
        $this->actingAs($user)->post(route('update-applicant',['id' => 1]),$applicant)->assertStatus(200);
    }

    public function test_delete_applicant_as_admin(){
        $user = User::find(2);
        $this->actingAs($user)->delete(route('delete-applicant',['id' => 1]))->assertStatus(200);
    }
    public function test_delete_applicant_as_user(){
        $user = User::find(1);
        $this->actingAs($user)->delete(route('delete-applicant',['id' => 1]))->assertStatus(401);
    }
}
