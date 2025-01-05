<?php

namespace Tests\Feature;

use App\Models\Content;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ContentControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_list_all_contents()
    {
        // Buat user dummy dan login menggunakan actingAs
        $user = \App\Models\UserAccount::factory()->create();
        $this->actingAs($user);

        // Buat dummy content untuk diuji
        Content::factory()->create(['name' => 'Test Content']);

        // Lakukan request ke route index dan periksa status serta konten
        $response = $this->get(route('content.index'));

        $response->assertStatus(200);
        $response->assertSee('Test Content');
    }


    /** @test */
    public function it_can_store_content()
    {
        Storage::fake('public');

        $file = UploadedFile::fake()->image('content.jpg');

        $response = $this->post(route('content.store'), [
            'name' => 'Test Content',
            'description' => 'Test description',
            'path' => $file,
        ]);

        $response->assertRedirect(route('content.index'));
        $this->assertDatabaseHas('content', [
            'name' => 'Test Content',
            'description' => 'Test description',
        ]);
    }

    /** @test */
    public function it_can_update_content()
    {
        $content = Content::factory()->create([
            'name' => 'Old Content',
            'description' => 'Old description',
            'path' => 'assets/old_file.jpg',
        ]);

        $response = $this->put(route('content.update', $content->content_id), [
            'name' => 'Updated Content',
            'description' => 'Updated description',
            'path' => null, // No new file
        ]);

        $response->assertRedirect(route('content.index'));
        $this->assertDatabaseHas('content', [
            'name' => 'Updated Content',
            'description' => 'Updated description',
        ]);
    }

    /** @test */
    public function it_can_delete_content()
    {
        $content = Content::factory()->create();

        $response = $this->delete(route('content.destroy', $content->content_id));

        $response->assertRedirect()->assertSessionHas('success', 'Content deleted successfully!');
        $this->assertDatabaseMissing('content', ['content_id' => $content->content_id]);
    }
}
