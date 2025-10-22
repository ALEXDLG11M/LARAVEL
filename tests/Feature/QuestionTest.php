<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Question;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class QuestionTest extends TestCase
{
    use RefreshDatabase;
    /**
	 * A basic feature test example.
	 */
    public function test_guest_cannot_create_question(): void
    {
        $resp = $this->post('/questions', ['title'=>'X','body'=>'contenido suficiente']);
        $resp->assertRedirect('/login');
    }

    public function test_user_can_create_question(): void
    {
        $u = User::factory()->create();
        $resp = $this->actingAs($u)->post('/questions', [
            'title' => 'Título válido',
            'body'  => 'Contenido con más de diez caracteres',
        ]);
        $resp->assertSessionHas('status');
        $this->assertDatabaseHas('questions', ['title'=>'Título válido','user_id'=>$u->id]);
    }

    public function test_only_author_can_update(): void
    {
        $author = User::factory()->create();
        $other  = User::factory()->create();
        $q = Question::factory()->create(['user_id'=>$author->id]);

        $this->actingAs($other)
            ->put("/questions/{$q->id}", ['title'=>'Nuevo','body'=>'Contenido válido'])
            ->assertForbidden();

        $this->actingAs($author)
            ->put("/questions/{$q->id}", ['title'=>'Nuevo','body'=>'Contenido válido'])
            ->assertSessionHas('status');
        $this->assertDatabaseHas('questions', ['id'=>$q->id,'title'=>'Nuevo']);
    }
}
