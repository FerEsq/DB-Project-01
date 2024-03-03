@extends('layouts.app')

@section('content')
    <div>
        <h1>Dashboard</h1>
        <iframe 
            style="background: #F1F5F4; border: none; border-radius: 2px; box-shadow: 0 2px 10px 0 rgba(70, 76, 79, .2); width: 77vw; height: 100vh;" 
            src="https://charts.mongodb.com/charts-db-project-1-qqzhs/embed/dashboards?id=65daa048-d109-47e4-877f-19f06a1bdc84&theme=light&autoRefresh=true&maxDataAge=3600&showTitleAndDesc=false&scalingWidth=fixed&scalingHeight=fixed">
        </iframe>
    </div>
@stop