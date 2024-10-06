<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Work;
use App\Models\BreakTime;

class FirstTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    use RefreshDatabase;
    // public function test_can_access()
    // {
    //     $response = $this->get('/register');
    //     $response->assertStatus(200);

    //     $response = $this->get('/login');
    //     $response->assertStatus(200);

    //     $response = $this->get('/no_route');
    //     $response->assertStatus(404);
    // }
    // public function test_create_user()
    // {
    // User::factory()->create([
    //     'name' => 'aaa',
    //     'email' => 'bbb@ccc.com',
    //     'password' => 'test12345',
    // ]);
    // $this->assertDatabaseHas('users', [
    //     'name' => 'aaa',
    //     'email' => 'bbb@ccc.com',
    //     'password' => 'test12345',
    // ]);
    // $user=User::factory()->create();
    // $response=$this->actingAs($user)->get('/');
    // $response->assertOk();
    // }
    public function test_time_stamps()
    {
        $user = User::factory()->create();
        $work = Work::factory()->create(['user_id' => $user->id]);
        $break = BreakTime::factory()->create(['work_id' => $work->id]);
        // $response = $this->actingAs($user)->post('/', [
        //     'user_id' => $user->id,
        //     'work_start' => '2024-10-06 09:00:00',
        // ]);
        // $response->assertStatus(302);
        // $response->assertSessionHas('message', '勤務開始を記録しました');

        // $response = $this->actingAs($user)->post('/break', [
        //     'work_id' => $work->id,
        //     'break_start' => '2024-10-06 11:00:00',
        // ]);
        // $response->assertStatus(302);
        // $response->assertSessionHas('message', '休憩開始を記録しました');

        $response = $this->actingAs($user)->put('/break/update', [
            'work_id' => $work->id,
            'break_end' => '2024-10-06 11:30:00',
        ]);
        $response->assertStatus(302);
        $response->assertSessionHas('message', '休憩終了を記録しました');

        $response = $this->actingAs($user)->post('/work/update', [
            'user_id' => $user->id,
            'work_end' => '2024-10-06 18:00:00',
        ]);
        $response->assertStatus(302);
        $response->assertSessionHas('message', '勤務終了を記録しました');
        // updateの関数のテストが status code 405 で返ってくる
    }
}
