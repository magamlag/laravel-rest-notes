<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class NotesController extends Controller {
	public function __construct() {
		$this->middleware( 'auth:api' );
	}

	/**
	 * Display a listing of the resource related for authorized user.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
		return Note::where( 'user_id', Auth::user()->id )
				->with( 'tags' )
				->get();
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create() {
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @return \Illuminate\Http\Response
	 */
	public function store( Request $request ) {
		$validator = Validator::make( [
				'text' => $request->text
		], [
				'text' => 'required|max:255'
		] );

		if ( $validator->fails() ) {
			return response()->json( [
					'success' => false,
					'errors'  => $validator->errors()->all()
			], 422 );
		}

		$create = Note::create( array_merge(
				$request->input(),
				[
						'user_id' => Auth::user()->id,
				]
		) );

		if ( $create ) {
			return [
					'success' => true,
					'note'    => $create
			];
		}
		return [
				'success' => false,
				'errors'  => 'Error when creating note'
		];
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int $id
	 * @return \Illuminate\Http\Response
	 */
	public function show( $id ) {
		return Note::with( 'tags' )->where( 'user_id', Auth::user()->id )
				->where( 'id', $id )->firstOrFail();
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit( $id ) {
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @param  int                      $id
	 * @return \Illuminate\Http\Response
	 */
	public function update( Request $request, $id ) {
		$note = Note::where( 'user_id', Auth::user()->id )
				->where( 'id', $id )->first();

		if ( !$note ) {
			return response()->json( [
					'success' => false,
					'errors'  => 'Note not found'
			], 404 );
		}

		/**
		 * I know i need use form request here.
		 */
		$validation = Validator::make( [
				'text' => $request->input( 'text' )
		], [
				'text' => 'required|max:255'
		] );

		if ( $validation->fails() ) {
			return response()->json(
					[
							'success' => false,
							'errors'  => $validation->errors()->all(),
					], 422
			);
		}

		$note->update( [
				'text' => $request->input( 'text' ),
		] );

		return [
				'success' => true,
				'info'    => 'Note updated',
		];
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int $id
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function destroy( $id ) {
		$note = Note::where( 'id', $id )->where( 'user_id', Auth::user()->id )
				->first();

		if ( !$note ) {
			return response()->json( [
					'success' => false,
					'errors'  => 'Note not found',
			], 404 );
		}

		$note->delete();

		return [
				'success' => true,
				'info'    => 'Note deleted',
		];
	}
}
