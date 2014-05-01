@extends('layouts.standard')

@section('javascripts')
    @parent
    <link rel="stylesheet" href="http://cdn.oesmith.co.uk/morris-0.4.3.min.css">
@stop

@section('main')
    <div class="jumbotron">
        <h1>WTPro</h1>
        <p>Track you weight with a nifty graph!</p>
        <a href="#register"><button class="btn btn-sm btn-danger" value="Register Now">Register Now!</button></a>
        <div id="weight-graph" style="height: 300%; width: 100%;">

        </div>
    </div>
    <section id="register">
        @include('forms.register')
    </section>

@stop

@section('footer_javascripts')
    @parent
    <script src="http://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="http://cdn.oesmith.co.uk/morris-0.4.3.min.js"></script>
    <script>
        var data =
            [
                { date: "2014-04-02", weight: "60" },
                { date: "2014-05-03", weight: "59.8" },
                { date: "2014-06-04", weight: "59.4" },
                { date: "2014-07-05", weight: "58" },
                { date: "2014-08-06", weight: "57" },
                { date: "2014-09-07", weight: "57.4" },
                { date: "2014-10-08", weight: "57.1" },
                { date: "2014-12-09", weight: "56.8" }
            ];

        new Morris.Line({
            // ID of the element in which to draw the chart.
            element: 'weight-graph',
            // Chart data records -- each entry in this array corresponds to a point on
            // the chart.
            data: data,
            // The name of the data record attribute that contains x-values.
            xkey: 'date',
            // A list of names of data record attributes that contain y-values.
            ykeys: ['weight'],
            // Labels for the ykeys -- will be displayed when you hover over the
            // chart.
            labels: ['Weight'],
            postUnits: "kg",
            // turn off hover
            hideHover: 'always',
            //ymin false origin
            ymin: 'auto ' + ( Math.min.apply(
                Math, data.map(function(o){
                    return o.weight;
                })) - 5 ),
            ymax: 'auto ' + ( Math.max.apply(
                Math, data.map(function(o){
                    return o.weight;
                })) + 5 ),
            xLabelFormat: function(x) {
                return x.getDate() + ' / ' + ( x.getMonth() + 1 );
            }
        });
    </script>
@stop