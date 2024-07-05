<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Book;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BookTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_create_a_book()
    {
        $bookData = [
            'title' => 'Test Book',
            'author' => 'John Doe',
            'isbn' => '1234567890123',
        ];

        $response = $this->postJson('/api/books', $bookData);

        $response->assertStatus(201)
                 ->assertJsonStructure([
                     'success',
                     'message',
                     'data' => [
                         'id',
                         'title',
                         'author',
                         'isbn',
                         'created_at'
                     ]
                 ]);

        $this->assertDatabaseHas('books', $bookData);
    }

    public function test_can_get_a_list_of_books()
    {
        Book::factory()->count(5)->create();

        $response = $this->getJson('/api/books');

        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'success',
                     'message',
                     'data' => [
                         '*' => [
                             'id',
                             'title',
                             'author',
                             'isbn',
                             'created_at'
                         ]
                     ]
                 ]);
    }

    public function test_can_get_a_single_book()
    {
        $book = Book::factory()->create();

        $response = $this->getJson('/api/books/' . $book->id);

        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'success',
                     'message',
                     'data' => [
                         'id',
                         'title',
                         'author',
                         'isbn',
                         'created_at'
                     ]
                 ]);
    }

    public function test_validation_errors_on_create()
    {
        $response = $this->postJson('/api/books', []);

        $response->assertStatus(422)
                 ->assertJsonStructure([
                     'message',
                     'errors' => [
                        'title',
                        'author',
                        'isbn',
                     ]
                 ]);
    }
    public function test_book_not_found_in_show()
{
    $response = $this->getJson('/api/books/999'); // Assuming '999' is a non-existent ID.

    $response->assertStatus(404)
             ->assertJson([
                 'success' => false,
                 'message' => 'Book not found.',
             ]);
}
}


