@extends('layouts.standard')

@section('javascripts')
    @parent
    <script>
        var weightDataJSON = <?php echo json_encode($graph_data); ?>;
    </script>
    <link rel="stylesheet" href="http://cdn.oesmith.co.uk/morris-0.4.3.min.css">
@stop

@section('main')

    @if ( count($weights_collection) > 0 )
        <div class="jumbotron">
            <div id="weight-graph" style="width: 100%; height: 300px;"></div>
        </div>
    @endif

    <section class="add-form">
        <h4>Enter new measurement</h4>
        @include('forms.createWeight')
    </section>

    <hr>

    <section class="list-table">
        <table class="table">
            <thead>
            <tr>
                <th>Date</th>
                <th>Weight (kg)</th>
                <th>Change</th>
                <th>Remove</th>
            </tr>
            </thead>
            <tbody>
                    
                @foreach( $weights_collection as $key => $weight )

                <tr>
                    <td>{{{ date( 'jS M y' , strtotime($weight->created_at) ) }}}</td>
                    <td>{{{ $weight->weight }}}</td>
                    <td>{{{ $weight->change }}}</td>
                    <td>@include('forms.deleteWeight', array( 'id' => $weight->id ))</td>
                </tr>
                
                @endforeach

                @if ( count($weights_collection) == 0 )

                <tr>
                    <td colspan="4">No data yet!</td>
                </tr>

                @endif
            
            </tbody>
        </table>
    </section>
@stop

@section('footer_javascripts')
    @parent
    <script src="http://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="http://cdn.oesmith.co.uk/morris-0.4.3.min.js"></script>
    <script>
        new Morris.Line({
            // ID of the element in which to draw the chart.
            element: 'weight-graph',
            // Chart data records -- each entry in this array corresponds to a point on
            // the chart.
            data: weightDataJSON,
            // The name of the data record attribute that contains x-values.
            xkey: 'date',
            // A list of names of data record attributes that contain y-values.
            ykeys: ['weight'],
            // Labels for the ykeys -- will be displayed when you hover over the
            // chart.
            labels: ['Weight'],
            postUnits: "kg",
            // turn off hover
            hideHover: true,
            ymin: 'auto ' + ( Math.min.apply(
                Math, weightDataJSON.map(function(o){
                    return o.weight;
                })) - 5 ),
            ymax: 'auto ' + ( Math.max.apply(
                Math, weightDataJSON.map(function(o){
                    return o.weight;
                })) + 5 ),
            //xLabels: "day",
            xLabelFormat: function(x) {
                return x.getDate() + ' / ' + ( x.getMonth() + 1 );
            }
        });
    </script>
@stop