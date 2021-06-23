<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

use App\Models\User;
use App\Models\Role;
use App\Models\Student;

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
     * Update an existing student record.
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
