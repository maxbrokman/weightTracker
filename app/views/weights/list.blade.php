@extends('layouts.standard')

@section('javascripts')
    @parent
    <script>
        var days = <?php echo json_encode($day_data); ?>;
        var weightDataJSON = <?php echo json_encode($graph_data); ?>;
    </script>
    <link rel="stylesheet" href="http://cdn.oesmith.co.uk/morris-0.4.3.min.css">
@stop

@section('main')


    <div class="jumbotron">
        <div id="weight-graph" style="width: 100%; height: 300px;"></div>
    </div>

    <section class="list-table">
        <table class="table">
            <thead>
            <tr>
                <th>Date</th>
                <th>Weight (kg)</th>
                <th>Change</th>
            </tr>
            </thead>
            <tbody>
                    
                @foreach( $weights_collection as $key => $weight )

                <tr>
                    <td>{{{ date( 'jS M y' , strtotime($weight->created_at) ) }}}</td>
                    <td>{{{ $weight->weight }}}</td>
                    <td>{{{ $weight->change }}}</td>
                </tr>
                
                @endforeach
            
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
            data: [
                { year: '2008', value: 20 },
                { year: '2009', value: 10 },
                { year: '2010', value: 5 },
                { year: '2011', value: 5 },
                { year: '2012', value: 20 }
            ],
            // The name of the data record attribute that contains x-values.
            xkey: 'year',
            // A list of names of data record attributes that contain y-values.
            ykeys: ['value'],
            // Labels for the ykeys -- will be displayed when you hover over the
            // chart.
            labels: ['Value']
        });
    </script>
@stop