<?php

namespace App\Console\Commands;

use App\FlexNGate\Applicants\EloquentApplicantRepository;
use App\FlexNGate\Positions\EloquentPositionRepository;
use App\FlexNGate\Users\EloquentUserRepository;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class Populate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'data:populate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Run command to populate tables with data for demo';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(EloquentApplicantRepository $applicants,
                                EloquentPositionRepository $positions,
                                EloquentUserRepository $users)
    {
        parent::__construct();
        $this->applicants = $applicants;
        $this->positions = $positions;
        $this->users = $users;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->generate_people();
        $this->generate_users();
        $this->generate_positions();


        return 0;
    }

    private function generate_people(){
            $people = [];
            $people[] = (object) ['name' => 'Steve Smith', 'position_id' => 1,'status' => 'interviewing','created_by' => 1];
            $people[] = (object) ['name' => 'Mike Thomas', 'position_id' => 1,'created_by' => 1];
            $people[] = (object) ['name' => 'Noah Kolcz', 'position_id' => 3,'created_by' => 1];
            $people[] = (object) ['name' => 'Wally Kolcz', 'position_id' => 2,'status' => 'interviewing','created_by' => 1];
            $people[] = (object) ['name' => 'Gabe Kolcz', 'position_id' => 1,'created_by' => 1];
            $people[] = (object) ['name' => 'Glen Kolcz', 'position_id' => 3,'status' => 'rejected','created_by' => 1];
            $people[] = (object) ['name' => 'Jody Kolcz', 'position_id' => 3,'created_by' => 1];
            $people[] = (object) ['name' => 'Hollie Kolcz', 'position_id' => 2,'status' => 'contacted','created_by' => 1];
            $people[] = (object) ['name' => 'Mike Kolcz', 'position_id' => 3,'created_by' => 1];
            $people[] = (object) ['name' => 'Mary Lewis', 'position_id' => 3,'created_by' => 1];
            $people[] = (object) ['name' => 'Chad Morgan', 'position_id' => 2,'status' => 'rejected','created_by' => 1];
            $people[] = (object) ['name' => 'Kimi Blackledge', 'position_id' => 3,'created_by' => 1];
            $people[] = (object) ['name' => 'Cameron Payne', 'position_id' => 3,'status' => 'contacted','created_by' => 1];
            $people[] = (object) ['name' => 'Oksana Kravets', 'position_id' => 3,'created_by' => 1];

        foreach($people as $person){
            $this->applicants->create($person);
        }
    }

    private function generate_positions(){
        $positions[] =(object) ['position' => '.NET Software Developer','posted_on' => '2021-11-10', 'created_by' => 1];
        $positions[] = (object) ['position' => 'PHP Software Developer','posted_on' => '2022-02-09', 'created_by' => 1];
        $positions[] = (object) ['position' => '2nd shift Materials Coordinator','posted_on' => '2022-01-06', 'created_by' => 1];

        foreach($positions as $position){
            $this->positions->create($position);
        }
    }

    private function generate_users(){
        $users[] = (object) ['name' => 'Site User','email' => 'user@testdemo.com','role' => 'user','password' => Hash::make('demo')];
        $users[] = (object) ['name' => 'Site Admin','email' => 'admin@testdemo.com','role' => 'admin','password' => Hash::make('demoadmin')];

        foreach($users as $user){
            $this->users->create($user);
        }

    }
}
