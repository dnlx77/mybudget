<?php

namespace Tests\Feature;

use App\Models\Conto;
use App\Models\Operazione;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->withoutVite();
    }

    public function test_guest_is_redirected_to_login(): void
    {
        $this->get('/dashboard')->assertRedirect('/login');
        $this->get('/')->assertRedirect('/dashboard');
    }

    public function test_user_can_register_and_logout(): void
    {
        $this->post('/register', [
            'name' => 'Mario',
            'email' => 'mario@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ])->assertRedirect('/dashboard');

        $this->assertAuthenticated();
        $this->post('/logout');
        $this->assertGuest();
    }

    public function test_user_can_login(): void
    {
        $user = User::factory()->create(['password' => 'password123']);
        $this->post('/login', ['email' => $user->email, 'password' => 'password123'])
            ->assertRedirect('/dashboard');
        $this->assertAuthenticatedAs($user);
    }

    public function test_data_is_scoped_per_user(): void
    {
        $a = User::factory()->create();
        $b = User::factory()->create();

        $this->actingAs($a);
        $conto = Conto::create(['nome' => 'Conto A']);
        Tag::create(['nome' => 'Tag A']);
        $op = Operazione::create([
            'data_operazione' => '2026-01-01', 'importo' => 10, 'conto_id' => $conto->id, 'trasferimento' => 'N',
        ]);
        $this->assertEquals($a->id, $op->user_id);

        $this->actingAs($b);
        $this->assertCount(0, Conto::all());
        $this->assertCount(0, Tag::all());
        $this->assertCount(0, Operazione::all());
        $this->get(route('operazione.get_operazione_json', $op->id))->assertNotFound();

        $this->actingAs($a);
        $this->assertCount(1, Operazione::all());
    }

    public function test_dashboard_renders_for_new_user(): void
    {
        $this->actingAs(User::factory()->create());
        $this->get('/dashboard/2026/1/0/0')->assertOk();
    }
}
