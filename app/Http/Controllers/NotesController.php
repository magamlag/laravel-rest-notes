<?php

namespace App\Http\Controllers;

use App\Models\Note;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class NotesController extends Controller
{
    /**
     * NotesController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    /**
     * Remove Tag
     *
     * @param $note_id integer
     * @param $tag_id integer
     * @return  \Illuminate\Http\Response
     */
    public function removeTag($note_id,$tag_id)
    {
        $note = Note::where('id',$note_id)->where('user_id',Auth::user()->id)
            ->first();

        if (! $note) {
            return response()->json([
                'success'   =>  false,
                'errors'    =>  'Note not found'
            ],404);
        }

        $note->tags()->detach($tag_id);

        return [
            'success'   =>  true,
            'info'      =>  'Tag successfully removed!'
        ];
    }

    /**
     * Add Tag
     *
     * @param $request Request
     * @param $id integer note id
     * @return \Illuminate\Http\Response
     */
    public function addTag(Request $request,$id)
    {
        $note = Note::where('id',$id)->where('user_id',Auth::user()->id)
            ->first();

        if (! $note) {
            return response()->json([
                'success'   =>  false,
                'errors'    =>  'Note not found'
            ],404);
        }

        if (empty($request->input('tag'))) {
            return response()->json([
                'success'   =>  false,
                'errors'    =>  'Tag field is empty!'
            ],422);
        }

        $find_tag = Tag::where('name',$request->input('tag'))->first();

        if ($find_tag) {
            $note->tags()->attach($find_tag);
        } else {
            $note->tags()->save(
                new Tag([
                    'name'  =>  $request->input('tag')
                ])
            );
        }

        return [
            'success'   =>  true,
            'info'      =>  'Tag successfully attached!'
        ];
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Note::where('user_id', Auth::user()->id)
            ->with('tags')
            ->get();
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make([
            'text'  =>  $request->text
        ],[
            'text'  =>  'required|max:255'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success'   =>  false,
                'errors'    =>  $validator->errors()->all()
            ],422);
        }

        $create = Note::create(array_merge(
            $request->input(),
            [
                'user_id' => Auth::user()->id,
            ]
        ));

        if ($create) {
            return [
                'success' => true,
                'note' => $create
            ];
        }
        return [
            'success' => false,
            'errors' => 'Error when creating note'
        ];
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Note::with('tags')->where('user_id',Auth::user()->id)
            ->where('id',$id)->firstOrFail();
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $note = Note::where('user_id',Auth::user()->id)
            ->where('id',$id)->first();

        if (! $note) {
            return response()->json([
                'success'   =>  false,
                'errors'    =>  'Note not found'
            ], 404);
        }

        /**
         * I know i need use form request here.
         */
        $validation = Validator::make([
            'text'  =>  $request->input('text')
        ],[
            'text'  =>  'required|max:255'
        ]);

        if ($validation->fails()) {
            return response()->json(
                [
                    'success'   =>  false,
                    'errors'    =>  $validation->errors()->all(),
                ],422
            );
        }

        $note->update([
            'text'  =>  $request->input('text'),
        ]);

        return [
            'success'   =>  true,
            'info'      =>  'Note updated',
        ];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $note = Note::where('id',$id)->where('user_id',Auth::user()->id)
            ->first();

        if (! $note) {
            return response()->json([
                'success'   =>  false,
                'errors'    =>  'Note not found',
            ],404);
        }

        $note->delete();

        return [
            'success'   =>  true,
            'info'      =>  'Note deleted',
        ];
    }
}
