<?php

namespace Tests\Feature;

use App\Models\BreakTime;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Work;

class FirstTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    use RefreshDatabase;
    public function test_can_access()
    {
        $response = $this->get('/register');
        $response->assertStatus(200);
        $response->assertViewIs('register');

        $response = $this->get('/login');
        $response->assertStatus(200);
        $response->assertViewIs('login');

        $response = $this->get('/no_route');
        $response->assertStatus(404);
    }
    public function test_create_user()
    {
        User::factory()->create([
            'name' => 'aaa',
            'email' => 'bbb@ccc.com',
            'password' => 'test12345',
        ]);
        $this->assertDatabaseHas('users', [
            'name' => 'aaa',
            'email' => 'bbb@ccc.com',
            'password' => 'test12345',
        ]);

        $user = User::factory()->create();
        $response = $this->actingAs($user)->get('/');
        $response->assertOk();
        $response->assertViewIs('timestamp');
    }
    public function test_validation_errors()
    {
        $response = $this->post('/register', [
            'name' => '',
            'email' => 'invalid_email',
            'password' => 'test',
        ]);
        $response->assertSessionHasErrors(['name', 'email', 'password']);
        $response->assertSessionHasErrors([
            'name' => '名前は、必ず入力してください。',
            'email' => 'メールアドレスは、有効なメールアドレス形式で入力してください。',
            'password' => 'パスワードは、8文字以上にしてください。'
        ]);
    }
    public function test_work_time()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->post('/', [
            'user_id' => $user->id,
            'work_start' => '2024-10-06 09:00:00',
        ]);
        $response->assertStatus(302);
        $response->assertSessionHas('message', '勤務開始を記録しました');

        $response = $this->actingAs($user)->put('/work/update', [
            'user_id' => $user->id,
            'work_end' => '2024-10-06 18:00:00',
        ]);
        $response->assertStatus(302);
        $response->assertSessionHas('message', '勤務終了を記録しました');
    }

    public function test_break_time()
    {
        $user = User::factory()->create();
        $work = Work::factory()->create(['user_id' => $user->id]);
        $response = $this->actingAs($user)->post('/break', [
            'work_id' => $work->id,
            'break_start' => '2024-10-06 11:00:00',
        ]);
        $response->assertStatus(302);
        $response->assertSessionHas('message', '休憩開始を記録しました');

        $response = $this->actingAs($user)->put('/break/update', [
            'work_id' => $work->id,
            'break_end' => '2024-10-06 11:30:00',
        ]);
        $response->assertStatus(302);
        $response->assertSessionHas('message', '休憩終了を記録しました');
    }

    public function test_attendance()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->get('/attendance');
        $response->assertOk();
        $response->assertViewIs('date');

        $response = $this->actingAs($user)->get('/user');
        $response->assertOk();
        $response->assertViewIs('users_index');

        $response = $this->actingAs($user)->get('/user/show/' . $user->id);
        $response->assertOk();
        $response->assertViewIs('user_attendance');
    }

    public function test_console_command()
    {
        $user = User::factory()->create();
        $work = Work::factory()->create(['user_id' => $user->id]);

        $this->actingAs($user)->post('/', [
            'user_id' => $user->id,
            'work_start' => '2024-10-06 09:00:00',
        ]);

        $this->actingAs($user)->post('/break', [
            'work_id' => $work->id,
            'break_start' => '2024-10-06 11:00:00',
        ]);
        $this->artisan('time:update_end')->assertExitCode(0);
    }
}
