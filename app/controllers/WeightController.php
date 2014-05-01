<?php

class WeightController extends \BaseController {

    /**
     * Adds Csrf and Auth filters
     */
    public function __construct()
    {
        $this->beforeFilter('csrf', array('on' => 'store'));
        $this->beforeFilter('auth');
    }

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('forms.createWeight');
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
        $data = Input::all();
        $rules = array(
            'weight' => 'required|numeric'
        );

        $validator = Validator::make( $data, $rules );

        if ( $validator->fails() ) {
            return Redirect::action('WeightController@create')->withErrors( $validator );
        }

		$userId = Auth::user()->id;
        $user = User::find($userId);

        $weight = new Weight();
        $weight->weight = Input::get('weight');
        $weight->user()->associate($user);
        $weight->save();

        return Redirect::route('weight.create');
	}

    public function listAll()
    {
        $userId = Auth::user()->id;

        return Weight::where('user_id', '=', $userId)->orderBy('created_at')->get();

    }


}
