<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

use App\Models\User;
use App\Models\Role;
use App\Models\Student;
use App\Models\Event;
use App\Models\Volunteer;

class JuntosTest extends TestCase
{
    use DatabaseMigrations;

    public function setUp() :void
    {
        parent::setUp();

        $this->withoutExceptionHandling();

        $this->artisan('migrate');
        $this->artisan('db:seed',['--class'=>'DatabaseSeeder']);
    }

    /**
     * @test
     * Coordinator check and see if possible access student listing.
     */
    public function test_coordinator_see_student_listing(){

        $user = User::factory()->createOne();

        $coordinatorRole = Role::find('2');
        $user->roles()->attach($coordinatorRole);

        //Assign user to site, at a minimum should have 1.
        $user->studentAccess()->attach(1);

        $response = $this->actingAs($user)->get('students');
        $response->assertOk();
    }

    /**
     * @test
     * Coordinator provide a list of users to add to attendance.
     * This is the initial stage before they save it to an actual event.
     */
    public function test_coordinator_provide_student_to_add_to_event(){
        $user = User::factory()->createOne();

        $coordinatorRole = Role::find('2');
        $user->roles()->attach($coordinatorRole);
        //Assign user to site, at a minimum should have 1.
        $user->studentAccess()->attach(1);
        $response = $this->actingAs($user)->post('students/attendance',['id'=>[1]]);
        $response->assertOk();
    }

    /**
     * @test
     */
    public function test_coordinator_provide_attendance_no_student_provided(){

        $user = User::factory()->createOne();

        $coordinatorRole = Role::find('2');
        $user->roles()->attach($coordinatorRole);

        //Assign user to site, at a minimum should have 1.
        $user->studentAccess()->attach(1);

        //Provide no student id.
        $this->followingRedirects()->actingAs($user)->post('/students/attendance',[
            'id'=>null
        ])->assertStatus(200);
    }

    /**
     * @test
     * Complete the process of saving a student to a particular event.
     */
    public function test_coordinator_provide_student_complete_attendance(){
        $user = User::factory()->createOne();
        $coordinatorRole = Role::find('2');
        $user->roles()->attach($coordinatorRole);
        $user->studentAccess()->attach(1);
        $this->followingRedirects()->actingAs($user)->post('students/attendance/complete',
            [
            'eventOptions'=>'1',
            'type'=>'student',
            'students'=>json_encode([[
                'id'=>1,
                'student_first_name'=>'Sample Student First',
                'student_last_name'=>'Sample Student Last']]),
        ])->assertStatus(200);
    }

    /**
     * @test
     */
    public function test_coordinator_provide_student_add_attendance_no_event(){
        $user = User::factory()->createOne();
        $coordinatorRole = Role::find('2');
        $user->roles()->attach($coordinatorRole);
        $user->studentAccess()->attach(1);

        $this->followingRedirects()->actingAs($user)->post('students/attendance/complete',
            [
                'eventOptions'=>null,
                'type'=>'student',
            ])->assertStatus(200);
    }

    /**
     * @test
     */
    public function test_coordinator_provide_student_remove_attendance(){
        $user = User::factory()->createOne();
        $coordinatorRole = Role::find('2');
        $user->roles()->attach($coordinatorRole);
        $user->studentAccess()->attach(1);

        $event = Event::factory()->createOne();
        $student = Student::factory()->createOne();

        $this->followingRedirects()->actingAs($user)->get('students/attendance/remove/'.$event->id."/".$student->id)->assertStatus(200);
    }

    /**
     * @test
     */
    public function test_admin_see_student_listing(){

        $user = User::factory()->createOne();

        $adminRole = Role::find('1');
        $user->roles()->attach($adminRole);

        $response = $this->actingAs($user)->get('students');
        $response->assertOk();
    }

    /**
     * @test
     */
    public function test_admin_create_new_student(){
        $user = User::factory()->createOne();

        $adminRole = Role::find('1');
        $user->roles()->attach($adminRole);

        $this->actingAs($user);

        $response = $this->post('/students',[
            'student_id'=>'1',
            'student_first_name'=>'test',
            'student_last_name'=>'test_last',
            'address_line_1'=>'123 Main St.',
            'city'=>'Testville',
            'state'=>'AZ',
            'zip'=>'12345',
            'grade'=>'8',
            'site_id'=>'1'
        ]);

        $this->assertDatabaseHas('students',['id'=>1,'student_first_name'=>'test']);
    }

    /**
     * @test
     * Check and see if we can edit a student.
     */
    public function test_admin_see_editable_student(){
        $user = User::factory()->createOne();

        $adminRole = Role::find('1');
        $user->roles()->attach($adminRole);

        $this->actingAs($user);

        $student = Student::factory()->createOne();

        $response = $this->actingAs($user)->get('students/'.$student->id."/edit");
        $response->assertOk();
    }

    /**
     * @test
     * Check and see if we can edit a student.
     */
    public function test_admin_create_new_student_page(){
        $user = User::factory()->createOne();

        $adminRole = Role::find('1');
        $user->roles()->attach($adminRole);

        $this->actingAs($user);

        $response = $this->actingAs($user)->get('students/create');
        $response->assertOk();
    }

    /**
     * @test
     */
    public function test_check_validation_update_student(){
        $user = User::factory()->createOne();
        $adminRole = Role::find('1');
        $user->roles()->attach($adminRole);
        $this->actingAs($user);
        $student = Student::factory()->createOne();

        $this->followingRedirects()->put('/students/'.$student->id,[
            'student_first_name'=>'test',
            'student_last_name'=>'test_last',
        ])->assertStatus(200);
    }

    /**
     * @test
     * Check when create a student record that the validator is working.
     */
    public function test_check_validation_create_student(){
        $user = User::factory()->createOne();

        $adminRole = Role::find('1');
        $user->roles()->attach($adminRole);

        $this->actingAs($user);

        $this->followingRedirects()->post('/students',[
            'student_first_name'=>'test',
            'student_last_name'=>'test_last',
        ])->assertStatus(200);
    }

    /**
     * @test
     * Update an existing student record.
     */
    public function test_update_existing_student(){
        $user = User::factory()->createOne();

        $adminRole = Role::find('1');
        $user->roles()->attach($adminRole);

        $this->actingAs($user);

        $student = Student::factory()->createOne();

        $this->put('/students/'.$student->id,[
            'student_id'=>'2',
            'student_first_name'=>'test2',
            'student_last_name'=>'test_last',
            'address_line_1'=>'123 Main St.',
            'city'=>'Testville',
            'state'=>'AZ',
            'zip'=>'12345',
            'grade'=>'8',
            'site_id'=>'1'
        ]);

        $this->assertDatabaseHas('students',['id'=>$student->id,'student_first_name'=>'test2']);
    }

    /**
     * @test
     * Delete an existing student record.
     */
    public function test_delete_existing_student(){
        $user = User::factory()->createOne();

        $adminRole = Role::find('1');
        $user->roles()->attach($adminRole);

        $this->actingAs($user);

        $student = Student::factory()->createOne();


        $this->delete('/students/'.$student->id,[]);
        $this->assertDatabaseMissing('students',['id'=>$student->id]);
    }

    /**
     * @test
     * Admin see the parent listing.
     */
    public function test_admin_see_parent_listing(){
        $user = User::factory()->createOne();

        $adminRole = Role::find('1');
        $user->roles()->attach($adminRole);

        $response = $this->actingAs($user)->get('parents');
        $response->assertOk();
    }

    /**
     *@test
     * Admin user accessd the event listing page.
     */
    public function test_admin_see_event_listing(){
        $user = User::factory()->createOne();

        $adminRole = Role::find('1');
        $user->roles()->attach($adminRole);

        $response = $this->actingAs($user)->get('event');
        $response->assertOk();
    }

    /**
     *@test
     * Coordinator access the event listing page.
     */
    public function test_coordinator_see_event_listing(){
        $user = User::factory()->createOne();
        $coordinatorRole = Role::find('2');
        $user->roles()->attach($coordinatorRole);
        $user->studentAccess()->attach(1);
        $response = $this->actingAs($user)->get('event');
        $response->assertOk();
    }

    /**
     * @test
     * Coordinator access the event creation page.
     */
    public function test_coordinator_access_new_event_create_page(){
        $user = User::factory()->createOne();
        $coordinatorRole = Role::find('2');
        $user->roles()->attach($coordinatorRole);
        $user->studentAccess()->attach(1);
        $response = $this->actingAs($user)->get('event/create');
        $response->assertOk();
    }

    /**
     * @test
     * Coordinator can create a new event successfully.
     */
    public function test_coordinator_create_new_event(){
        $user = User::factory()->createOne();
        $coordinatorRole = Role::find('2');
        $user->roles()->attach($coordinatorRole);
        $user->studentAccess()->attach(1);

        $response = $this->actingAs($user)->post('/event',[
            'event_start_date' => '2000-01-01',
            'event_end_date' => '2000-01-02',
            'event_name' => 'FakeEvent',
            'event_type' => '4H Club',
            'event_city' => 'FakeCity',
            'event_state' => 'NC',
            'contact_hours'=>'1',
            'site_id'=>1,
        ]);

        $newEvent = Event::orderBy('id','DESC')->first();

        $this->assertDatabaseHas('events',['id'=>$newEvent->id,'event_name'=>'FakeEvent']);
    }

    /**
     * @test
     *
     * Check whether the valdiation is working when not all information
     * is provided when creating an new event.
     */
    public function test_coordinator_create_new_event_failure(){
        $user = User::factory()->createOne();
        $coordinatorRole = Role::find('2');
        $user->roles()->attach($coordinatorRole);
        $user->studentAccess()->attach(1);

        $this->actingAs($user)->followingRedirects()->post('/event',[
            'event_type' => '4H Club',
            'event_city' => 'FakeCity',
            'event_state' => 'NC',
            'contact_hours'=>'1',
            'site_id'=>1,
        ])->assertStatus(200);
    }

    /**
     * @test
     * Coordinator can see the edit event page.
     */
    public function test_coordinator_see_edit_event(){
        $user = User::factory()->createOne();
        $coordinatorRole = Role::find('2');
        $user->roles()->attach($coordinatorRole);
        $user->studentAccess()->attach(1);

        $event = Event::factory()->createOne();

        $response = $this->actingAs($user)->get('event/'.$event->id."/edit");
        $response->assertOk();
    }

    /**
 * @test
 * Test that the profile/password page displays accordingly.
 */
    public function test_admin_get_profile_page(){
        $user = User::factory()->createOne();
        $adminRole = Role::find('1');
        $user->roles()->attach($adminRole);
        $response = $this->actingAs($user)->get('profile')->assertOk();
    }

    /**
     * @test
     * Test that the profile page updates accordingly.
     */
    public function test_admin_update_profile_page(){
        $user = User::factory()->createOne();
        $adminRole = Role::find('1');
        $user->roles()->attach($adminRole);
        $response = $this->followingRedirects()->actingAs($user)->put('profile',[
            'name'=>'user',
            'email' => 'demo@test.dev'
        ])->assertOk();
    }

    /**
     * @test
     * Test that the password page updates accordingly.
     */
    public function test_admin_update_password_page(){
        $user = User::factory()->createOne();
        $adminRole = Role::find('1');
        $user->roles()->attach($adminRole);
        $response = $this->followingRedirects()->actingAs($user)->put('profile/password',[
            'old_password'=>'oldiebutagoodie',
            'password' => 'lokoilokilolk',
            'password_confirmation'=>'lokoilokilolk'
        ])->assertOk();
    }

    /**
     * @test
     * Admin see the volunteer listing.
     */
    public function test_admin_see_volunteer_listing(){
        $user = User::factory()->createOne();

        $adminRole = Role::find('1');
        $user->roles()->attach($adminRole);

        $response = $this->actingAs($user)->get('volunteer');
        $response->assertOk();
    }

    /**
     * @test
     * Coordinator see the volunteer listing.
     */
    public function test_coordinator_see_volunteer_listing(){
        $user = User::factory()->createOne();
        $coordinatorRole = Role::find('2');
        $user->roles()->attach($coordinatorRole);
        $user->studentAccess()->attach(1);
        $response = $this->actingAs($user)->get('volunteer');
        $response->assertOk();
    }

    /**
     * @test
     * Properly go retrieve the volunteer page to create a new
     * volunteer in the system.
     */
    public function test_coordinator_create_page_volunteer(){
        $user = User::factory()->createOne();
        $coordinatorRole = Role::find('2');
        $user->roles()->attach($coordinatorRole);
        $user->studentAccess()->attach(1);
        $response = $this->actingAs($user)->get('volunteer/create');
        $response->assertOk();
    }
    /**
     * @test
     * Create a new volunteer in the system.
     */
    public function test_coordinator_create_new_volunteer(){
        $user = User::factory()->createOne();
        $coordinatorRole = Role::find('2');
        $user->roles()->attach($coordinatorRole);
        $user->studentAccess()->attach(1);
        $response = $this->actingAs($user)->post('/volunteer',[
            'volunteer_first_name'=>'test_volunteer_first',
            'volunteer_last_name'=>'test_volunteer_last',
            'address_line_1'=>'123 Main Street',
            'city'=>'Testville',
            'state'=>'AZ',
            'zip'=>'12345',
            'site_id'=>'1'
        ]);

        $this->assertDatabaseHas('volunteers',['id'=>1,'volunteer_first_name'=>'test_volunteer_first']);
    }

    /**
     * @test
     * Create a new volunteer in the system, check required fields and
     * make sure validation holds.
     */
    public function test_coordinator_create_new_volunteer_missing_fields(){
        $user = User::factory()->createOne();
        $coordinatorRole = Role::find('2');
        $user->roles()->attach($coordinatorRole);
        $user->studentAccess()->attach(1);
        $this->actingAs($user)->followingRedirects()->post('/volunteer',[
            'volunteer_first_name'=>'test_volunteer_first',
            'zip'=>'12345'
        ])->assertStatus(200);
    }

    /**
     * @test
     * Review an existing volunteer in the system to edit.
     */
    public function test_coordinator_see_editable_volunteer(){
        $user = User::factory()->createOne();
        $coordinatorRole = Role::find('2');
        $user->roles()->attach($coordinatorRole);
        $user->studentAccess()->attach(1);

        $volunteer = Volunteer::factory()->createOne();

        $response = $this->actingAs($user)->get('volunteer/'.$volunteer->id."/edit");
        $response->assertOk();
    }
    /**
     * @test
     * Review an existing volunteer in the system to edit.
     * Check if shouldn't have ability to review.
     */
    public function test_coordinator_see_editable_volunteer_check_access(){
        $user = User::factory()->createOne();
        $coordinatorRole = Role::find('2');
        $user->roles()->attach($coordinatorRole);
        //This test checks for lack of access, person is given no explicit site access.
        $volunteer = Volunteer::factory()->createOne();
        $this->actingAs($user)->followingRedirects()->get('volunteer/'.$volunteer->id."/edit")
            ->assertStatus(200);
    }

    /**
     * @test
     * Update an existing volunteer record.
     */
    public function test_update_existing_volunteer(){
        $user = User::factory()->createOne();
        $coordinatorRole = Role::find('2');
        $user->roles()->attach($coordinatorRole);
        $user->studentAccess()->attach(1);
        $volunteer = Volunteer::factory()->createOne();

        $this->actingAs($user)->put('/volunteer/'.$volunteer->id,[
            'volunteer_first_name'=>'test_volunteer_first_2',
            'volunteer_last_name'=>'test_volunteer_last_2',
            'address_line_1'=>'123 Main St.',
            'county'=>'TestCounty',
            'city'=>'Testville',
            'state'=>'AZ',
            'zip'=>'12345',
            'email_address'=>'volunteer@test.com',
            'site_id'=>'1'
        ]);

        $this->assertDatabaseHas('volunteers',['id'=>$volunteer->id,'volunteer_first_name'=>'test_volunteer_first_2']);
    }

    /**
     * @test
     * Delete an existing volunteer record.
     */
    public function test_delete_existing_volunteer(){
        $user = User::factory()->createOne();
        $coordinatorRole = Role::find('2');
        $user->roles()->attach($coordinatorRole);
        $user->studentAccess()->attach(1);

        $volunteer = Volunteer::factory()->createOne();

        $this->actingAs($user)->delete('/volunteer/'.$volunteer->id,[]);
        $this->assertDatabaseMissing('students',['id'=>$volunteer->id]);
    }

}
