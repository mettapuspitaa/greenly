<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Emission;
use Illuminate\Foundation\Testing\RefreshDatabase;

class EmissionControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_creates_an_emission()
    {
        // Arrange
        $data = [
            'name' => 'Test Emission',
            'type' => 'transportation',
            'emission' => 123.45,
        ];

        // Act
        $response = $this->post(route('emission.store'), $data);

        // Assert
        $response->assertRedirect(route('emission.index'));
        $response->assertSessionHas('success', 'Emission created successfully.');
        $this->assertDatabaseHas('emission', $data);
    }

    /** @test */
    public function it_validates_emission_creation_input()
    {
        // Arrange
        $data = [
            'name' => '', // Invalid: empty name
            'type' => 'Carbon',
            'emission' => 'abc', // Invalid: non-numeric emission
        ];

        // Act
        $response = $this->post(route('emission.store'), $data);

        // Assert
        $response->assertSessionHasErrors(['name', 'emission']);
        $this->assertDatabaseCount('emission', 0);
    }

    /** @test */
    public function it_displays_edit_form_for_an_emission()
    {
        // Arrange
        $emission = Emission::factory()->create();

        // Act
        $response = $this->get(route('emission.edit', $emission));

        // Assert
        $response->assertStatus(200);
        $response->assertViewIs('admin.edit');
        $response->assertViewHas('emission', $emission);
    }

    /** @test */
    public function it_updates_an_emission()
    {
        // Arrange
        $emission = Emission::factory()->create();
        $updatedData = [
            'name' => 'Updated Name',
            'type' => 'Updated Type',
            'emission' => 678.90,
        ];

        // Act
        $response = $this->put(route('emission.update', $emission), $updatedData);

        // Assert
        $response->assertRedirect(route('emission.index'));
        $response->assertSessionHas('success', 'Emission updated successfully.');
        $this->assertDatabaseHas('emission', $updatedData);
    }

    /** @test */
    public function it_validates_emission_update_input()
    {
        // Arrange
        $emission = Emission::factory()->create();
        $invalidData = [
            'name' => '', // Invalid: empty name
            'type' => '',
            'emission' => 'not-a-number', // Invalid: non-numeric emission
        ];

        // Act
        $response = $this->put(route('emission.update', $emission), $invalidData);

        // Assert
        $response->assertSessionHasErrors(['name', 'type', 'emission']);
        $this->assertDatabaseMissing('emission', $invalidData);
    }

    /** @test */
    public function it_deletes_an_emission()
    {
        // Arrange
        $emission = Emission::factory()->create();

        // Act
        $response = $this->delete(route('emission.destroy', $emission));

        // Assert
        $response->assertRedirect(route('emission.index'));
        $response->assertSessionHas('success', 'Emission deleted successfully.');
        $this->assertDatabaseMissing('emission', ['id' => $emission->id]);
    }

    /** @test */
    public function it_fetches_all_emission_categories()
    {
        // Arrange
        Emission::factory()->create(['type' => 'Carbon', 'name' => 'Test1', 'emission' => 123.45]);
        Emission::factory()->create(['type' => 'Carbon', 'name' => 'Test2', 'emission' => 678.90]);
        Emission::factory()->create(['type' => 'Methane', 'name' => 'Test3', 'emission' => 111.11]);

        // Act
        $response = $this->get(route('emission.allCategories'));

        // Assert
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'Carbon' => [
                ['name', 'emission'],
            ],
            'Methane' => [
                ['name', 'emission'],
            ],
        ]);
    }
}
