@extends('layouts.app')

@section('content')
<div class="main-container">
    <ul class="nav nav-tabs" id="drawingTabs" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="structural-tab" data-toggle="tab" href="#structural" role="tab" aria-controls="structural" aria-selected="true">Structural</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="architectural-tab" data-toggle="tab" href="#architectural" role="tab" aria-controls="architectural" aria-selected="false">Architectural</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="mefps-tab" data-toggle="tab" href="#mefps" role="tab" aria-controls="mefps" aria-selected="false">MEFPS</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="asbuilt-tab" data-toggle="tab" href="#asbuilt" role="tab" aria-controls="asbuilt" aria-selected="false">AS-BUILT</a>
        </li>
    </ul>
    <div class="tab-content" id="drawingTabsContent">
        <div class="tab-pane fade show active" id="structural" role="tabpanel" aria-labelledby="structural-tab">
            @include('drawingSubpages.structural')
        </div>
        <div class="tab-pane fade" id="architectural" role="tabpanel" aria-labelledby="architectural-tab">
            @include('drawingSubpages.architectural')
        </div>
        <div class="tab-pane fade" id="mefps" role="tabpanel" aria-labelledby="mefps-tab">
            @include('drawingSubpages.mefps')
        </div>
        <div class="tab-pane fade" id="asbuilt" role="tabpanel" aria-labelledby="asbuilt-tab">
            @include('drawingSubpages.asbuilt')
        </div>
    </div>
</div>
@endsection
