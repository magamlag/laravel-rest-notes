<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class NotesTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testShowAllNotes()
    {
        $this->get('/api/notes?api_token=1')
            ->seeStatusCode(200);
    }

    public function testAddNote()
    {
        $this->post('/api/notes/?api_token=1', [
            'text' => 'Test note'
        ])->seeJsonContains([
            'success' => true
        ]);
    }

    public function testAddEmptyNote()
    {
        $this->post('/api/notes/?api_token=1')->seeJsonContains([
            'success' => false,
        ])->seeStatusCode(422);
    }

    public function testNoteEdit()
    {
        $this->put('/api/notes/1/?api_token=1',[
            'text'  =>  'Text edited'
        ])->seeStatusCode(200)->seeJsonContains([
            'success'   =>  true
        ]);
    }

    public function testNoteEditWithEmptyText()
    {
        $this->put('/api/notes/1/?api_token=1')->seeStatusCode(422)->seeJsonContains([
            'success'   =>  false
        ]);
    }

    public function testNoteDelete()
    {
        $this->delete('/api/notes/1/?api_token=1')
            ->seeStatusCode(200)
            ->seeJsonContains([
                'success'   =>  true
            ]);
    }

    public function testNoteDeleteNotFound()
    {
        $this->delete('/api/notes/99999/?api_token=1')
            ->seeStatusCode(404)
            ->seeJsonContains([
                'success'   =>  false
            ]);
    }
}
