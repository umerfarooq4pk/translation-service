<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Translation;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TranslationTest extends TestCase
{
    use RefreshDatabase;
    
    public function test_can_create_translation()
    {
        $data = [
            'key' => 'greeting',
            'content' => 'Hello',
            'locale' => 'en',
            'tags' => 'mobile',
        ];

        $response = $this->postJson('/api/translations', $data);

        $response->assertStatus(201)
                 ->assertJsonFragment($data);
    }

    public function test_can_update_translation()
    {
        $translation = Translation::factory()->create();

        $data = ['content' => 'Updated content'];

        $response = $this->putJson("/api/translations/{$translation->id}", $data);

        $response->assertStatus(200)
                 ->assertJsonFragment($data);
    }

    public function test_can_delete_translation()
    {
        $translation = Translation::factory()->create();

        $response = $this->deleteJson("/api/translations/{$translation->id}");

        $response->assertStatus(204);
    }

    public function test_can_export_translations()
    {
        Translation::factory()->count(10)->create();

        $response = $this->getJson('/api/translations/export');

        $response->assertStatus(200)
                 ->assertJsonStructure([
                     '*' => ['key', 'content', 'locale'],
                 ]);
    }

}
