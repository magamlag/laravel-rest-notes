<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class NotesTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * @return void
     */
    public function testAddNoteTag()
    {
        $this->post('/api/notes/1/add_tag?api_token=1',[
            'tag'   =>  'testcasetag'
        ])->seeStatusCode(200)->seeJsonContains([
           'success'    =>  true,
        ]);
    }

    /**
     * @return void
     */
    public function testAddNoteTagBadWithNoteNotFound()
    {
        $this->post('/api/notes/133333/add_tag?api_token=1',[
            'tag'   =>  'testcasetag'
        ])->seeStatusCode(404)->seeJsonContains([
            'success'    =>  false,
        ]);
    }

    /**
     * @return void
     */
    public function testAddNoteTagBadWithEmptyTag()
    {
        $this->post('/api/notes/1/add_tag?api_token=1')
            ->seeStatusCode(422)->seeJsonContains([
            'success'    =>  false,
        ]);
    }


    /**
     * @return void
     */
    public function testRemoveNoteTag()
    {
        $this->delete('/api/notes/1/remove_tag/1?api_token=1')
            ->seeStatusCode(200)->seeJsonContains([
                'success'    =>  true,
            ]);
    }

    /**
     * @return void
     */
    public function testRemoveTagBadNoteNotFound()
    {
        $this->delete('/api/notes/14444444/remove_tag/1?api_token=1')
            ->seeStatusCode(404)->seeJsonContains([
                'success'    =>  false,
            ]);
    }

    /**
     * @return void
     */
    public function testShowAllNotes()
    {
        $this->get('/api/notes?api_token=1')
            ->seeStatusCode(200);
    }

    /**
     * @return void
     */
    public function testAddNote()
    {
        $this->post('/api/notes/?api_token=1', [
            'text' => 'Test note'
        ])->seeJsonContains([
            'success' => true
        ]);
    }

    /**
     * @return void
     */
    public function testAddEmptyNote()
    {
        $this->post('/api/notes/?api_token=1')->seeJsonContains([
            'success' => false,
        ])->seeStatusCode(422);
    }

    /**
     * @return void
     */
    public function testNoteEdit()
    {
        $this->put('/api/notes/1/?api_token=1',[
            'text'  =>  'Text edited'
        ])->seeStatusCode(200)->seeJsonContains([
            'success'   =>  true
        ]);
    }

    /**
     * @return void
     */
    public function testNoteEditWithEmptyText()
    {
        $this->put('/api/notes/1/?api_token=1')->seeStatusCode(422)->seeJsonContains([
            'success'   =>  false
        ]);
    }

    /**
     * @return void
     */
    public function testNoteDelete()
    {
        $this->delete('/api/notes/1/?api_token=1')
            ->seeStatusCode(200)
            ->seeJsonContains([
                'success'   =>  true
            ]);
    }

    /**
     * @return void
     */
    public function testNoteDeleteNotFound()
    {
        $this->delete('/api/notes/99999/?api_token=1')
            ->seeStatusCode(404)
            ->seeJsonContains([
                'success'   =>  false
            ]);
    }
}
