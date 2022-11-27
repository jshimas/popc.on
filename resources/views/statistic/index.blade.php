@extends('layout')

@section('content')
    <div>
        <p class="text-5xl text-center uppercase text-gray-700 tracking-wide border-solid border-b border-gray-300 mb-8 pb-5">Statistika</p>              
        <div class="flex items-center gap-8 text-gray-700 mb-5">
            <div class="flex flex-col items-end gap-2 w-2/5">
                <p>Vidutinis aptarnavimo įvertinimas</p>
                <p>Vidutinis teatro užimtumas</p>
                <p>Parduota bilietų iš viso</p>
                <p>Metinės pajamos</p>
            </div>
            <div class="flex flex-col gap-2 w-1/5 font-semibold">
                <p>{{ $statistics->theater->service_rating }}</p>
                <p>{{ $statistics->theater->avg_occupancy }} %</p>
                <p>{{ $statistics->theater->tickets_sold }}</p>
                <p>{{ $statistics->theater->yearly_revenue }} &euro;</p>       
            </div>
            <div class="w-2/5 border-solid border-l border-gray-300 pl-6">
                <p class="uppercase text-sm text-pink-600 font-semibold tracking-widest">Metų filmas</p>
                <p class="text-xl font-semibold mb-4">{{ $statistics->movie_of_the_year->movie_name }}</p>
                <div class="flex flex-col gap-2 ">
                    <p>Parduota viso bilietų: <span class="font-semibold">{{ $statistics->movie_of_the_year->occupancy }} %</span></p>
                    <p>Aptarnavimo įvertinimas: <span class="font-semibold">{{ $statistics->movie_of_the_year->service_rating }}</span></p>
                    <p>Filmo įvertinimas: <span class="font-semibold">{{ $statistics->movie_of_the_year->movie_rating }}</span></p>
                    <p>Pajamos: <span class="font-semibold">{{ $statistics->movie_of_the_year->revenue }} &euro;</span></p>
                </div>
            </div>
        </div>
        <div class="flex flex-col items-center">
            <script type="text/javascript">
                google.charts.load('current', {'packages':['corechart']});
                google.charts.setOnLoadCallback(drawChart);
          
                function drawChart() {          
                    var data = google.visualization.arrayToDataTable({{ Js::from($statistics->chartData) }});
          
                  var options = {'title': 'Šių metų 5 pelningiausi filmai',
                                 'width':800,
                                 'height':400,
                                 'colors': ['#DB2777']};
          
                  var chart = new google.visualization.ColumnChart(document.getElementById('chart_div'));
                  chart.draw(data, options);
                }
              </script>
              {{-- <h3 class="text-2xl text-gray-700 text-center pb-1">Šių metų 5 pelningiausi filmai</h3> --}}
              <div id="chart_div"></div>          
        </div>
        <p class="text-3xl text-gray-700 text-center border-solid border-b border-gray-300 pb-3 mb-5 mt-8">Atsiliepimai</p>
        <div class="flex gap-20">
            <div class="flex-1">
                <p class="text-center uppercase text-xl mb-5">Paskutiniai filmų įvertinimai</p>
                <div>
                    @foreach($statistics->movie_reviews as $mrev)
                        <div>
                            <p class="text-center text-lg">{{ $mrev->movie }} - {{ $mrev->rating }}</p>
                            <blockquote class="italic text-justify text-gray-700 tracking-wide mb-2">"{{ $mrev->comment }}"</blockquote>
                            <p class="text-right">- {{ $mrev->username }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="flex-1">
                <p class="text-center uppercase text-xl mb-5">Paskutiniai aptarnavimo atsiliepimai</p>
                <div>
                    @foreach($statistics->service_reviews as $mrev)
                        <div>
                            <p class="text-center text-lg">Aptarnavimas - {{ $mrev->rating }}</p>
                            <p class="text-center mb-2">{{ $mrev->date }} - {{ $mrev->time }}, {{ $mrev->movie }}</p>
                            <blockquote class="italic text-justify text-gray-700 tracking-wide mb-2">{{ $mrev->comment }}</blockquote>
                            <p class="text-right">- {{ $mrev->username }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
