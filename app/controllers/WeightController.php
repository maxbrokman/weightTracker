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
            return Redirect::back()->withErrors( $validator );
        }

		$userId = Auth::user()->id;
        $user = User::find($userId);

        $weight = new Weight();
        $weight->weight = Input::get('weight');
        $weight->user()->associate($user);
        $weight->save();
        return Redirect::back()->with(array('message' => 'Measurement saved!'));
	}

    public function destroy( $id )
    {
        $weight = Weight::find($id);
        $weight->delete();

        Session::flash('message', 'Deleted the weight measurement!');
        return Redirect::back();
    }

    public function listAll()
    {
        $userId = Auth::user()->id;

        $weights = $this->getWeightsWithChange( $userId )->sortBy('created_at', SORT_REGULAR, true);

        $dailyWeights = $this->getDailyWeightForMonth($userId);

        $data = array(
            'weights_collection'    => $weights,
            'graph_data'            => $dailyWeights,
        );

        return View::make('weights.list', $data);

    }

    public function getWeightsWithChange( $userId )
    {
        $weights = Weight::where('user_id', '=', $userId)
            ->orderBy('created_at', 'ASC')
            ->get( array(
                'id',
                'weight',
                'created_at'
            ));

        //add changes
        $i = 0;
        foreach( $weights as $weight ) {

            $change = 'N/A';

            if ( $i > 0 && $i <= count( $weights ) ) {
                $change = $weight->weight - $weights[ $i - 1 ]->weight;
            }

            $weight->change = $change;

            $i++;
        }

        return $weights;
    }

    /**
     * Gets highest weight for each day of last month
     *
     * @param $userId
     * @return array date => weight
     */
    public function getDailyWeightForMonth( $userId )
    {
        $date = new DateTime( 'tomorrow -1 month' );

        $days = Weight::select(array(
                DB::raw('DATE(`created_at`) as date'),
                DB::raw('COUNT(*) as count'),
                DB::raw('MAX(`weight`) as weight')
            ))
            ->where('user_id', '=', $userId )
            ->where('created_at', '>', $date)
            ->groupBy('date')
            ->orderBy('date', 'ASC')
            ->lists('weight', 'date');

        $data = array();

        foreach ( $days as $date => $weight ) {
            $obj = new stdClass();
            $obj->date = $date;
            $obj->weight = $weight;
            $data[] = $obj;
        }

        return $data;

    }

}
