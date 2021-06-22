<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

use App\Models\User;
use App\Models\Role;
use App\Models\Student;

class JuntosTest extends TestCase
{

    public function setUp() :void
    {
        parent::setUp();

        $this->withoutExceptionHandling();

        $this->artisan('migrate');
        $this->artisan('db:seed',['--class'=>'DatabaseSeeder']);
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
    public function test_create_new_student(){
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
     * Check when create a student record that the validator is working.
     */
    public function test_check_validation_create_student(){
        $user = User::factory()->createOne();

        $adminRole = Role::find('1');
        $user->roles()->attach($adminRole);

        $this->actingAs($user);

        $response = $this->post('/students',[
            'student_first_name'=>'test',
            'student_last_name'=>'test_last',

        ]);

        $response->assertRedirect('students/create');
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

        $response = $this->put('/students/1',[
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

        $this->assertDatabaseHas('students',['id'=>1,'student_first_name'=>'test2']);
    }

    /**
     * @test
     * Update an existing student record.
     */
    public function test_delete_existing_student(){
        $user = User::factory()->createOne();

        $adminRole = Role::find('1');
        $user->roles()->attach($adminRole);

        $this->actingAs($user);


        $response = $this->delete('/students/1',[]);

        $this->assertDatabaseMissing('students',['id'=>1]);
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
}
