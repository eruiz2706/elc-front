{{--@extends('layouts.app')--}}

@extends('layouts.adminlte.app')

@section('banner')
<div class="img-bannerhome" style="background-image: url('{{ URL::asset('rsc/dist/img/banner.jpg') }}');">
</div>
@endsection

@section('content')

<div class="container">

  <div class="row">
    <div class="col-md-3">
      @include('backend.nav.index')

      @include('backend.es.navcursos')
    </div>

    <div class="col-md-9" style='padding-top:70px;'>
      <div class="row">
            @include('backend.es.navtabgrupo')

            <div class="col-md-12">
            <div class="card card-primary">
              <div class="card-body p-0">
                <!-- THE CALENDAR -->
                <div id="calendar" class="fc fc-ltr fc-unthemed"><div class="fc-toolbar"><div class="fc-left"><div class="fc-button-group"><button type="button" class="fc-prev-button fc-button fc-state-default fc-corner-left"><span class="fc-icon fc-icon-left-single-arrow"></span></button><button type="button" class="fc-next-button fc-button fc-state-default fc-corner-right"><span class="fc-icon fc-icon-right-single-arrow"></span></button></div><button type="button" class="fc-today-button fc-button fc-state-default fc-corner-left fc-corner-right fc-state-disabled" disabled="disabled">today</button></div><div class="fc-right"><div class="fc-button-group"><button type="button" class="fc-month-button fc-button fc-state-default fc-corner-left fc-state-active">month</button><button type="button" class="fc-agendaWeek-button fc-button fc-state-default">week</button><button type="button" class="fc-agendaDay-button fc-button fc-state-default fc-corner-right">day</button></div></div><div class="fc-center"><h2>September 2018</h2></div><div class="fc-clear"></div></div><div class="fc-view-container" style=""><div class="fc-view fc-month-view fc-basic-view" style=""><table><thead><tr><td class="fc-widget-header"><div class="fc-row fc-widget-header"><table><thead><tr><th class="fc-day-header fc-widget-header fc-sun">Sun</th><th class="fc-day-header fc-widget-header fc-mon">Mon</th><th class="fc-day-header fc-widget-header fc-tue">Tue</th><th class="fc-day-header fc-widget-header fc-wed">Wed</th><th class="fc-day-header fc-widget-header fc-thu">Thu</th><th class="fc-day-header fc-widget-header fc-fri">Fri</th><th class="fc-day-header fc-widget-header fc-sat">Sat</th></tr></thead></table></div></td></tr></thead><tbody><tr><td class="fc-widget-content"><div class="fc-day-grid-container" style=""><div class="fc-day-grid"><div class="fc-row fc-week fc-widget-content" style="height: 76px;"><div class="fc-bg"><table><tbody><tr><td class="fc-day fc-widget-content fc-sun fc-other-month fc-past" data-date="2018-08-26"></td><td class="fc-day fc-widget-content fc-mon fc-other-month fc-past" data-date="2018-08-27"></td><td class="fc-day fc-widget-content fc-tue fc-other-month fc-past" data-date="2018-08-28"></td><td class="fc-day fc-widget-content fc-wed fc-other-month fc-past" data-date="2018-08-29"></td><td class="fc-day fc-widget-content fc-thu fc-other-month fc-past" data-date="2018-08-30"></td><td class="fc-day fc-widget-content fc-fri fc-other-month fc-past" data-date="2018-08-31"></td><td class="fc-day fc-widget-content fc-sat fc-past" data-date="2018-09-01"></td></tr></tbody></table></div><div class="fc-content-skeleton"><table><thead><tr><td class="fc-day-number fc-sun fc-other-month fc-past" data-date="2018-08-26">26</td><td class="fc-day-number fc-mon fc-other-month fc-past" data-date="2018-08-27">27</td><td class="fc-day-number fc-tue fc-other-month fc-past" data-date="2018-08-28">28</td><td class="fc-day-number fc-wed fc-other-month fc-past" data-date="2018-08-29">29</td><td class="fc-day-number fc-thu fc-other-month fc-past" data-date="2018-08-30">30</td><td class="fc-day-number fc-fri fc-other-month fc-past" data-date="2018-08-31">31</td><td class="fc-day-number fc-sat fc-past" data-date="2018-09-01">1</td></tr></thead><tbody><tr><td></td><td></td><td></td><td></td><td></td><td></td><td class="fc-event-container"><a class="fc-day-grid-event fc-event fc-start fc-end fc-draggable" style="background-color:#f56954;border-color:#f56954"><div class="fc-content"><span class="fc-time">12a</span> <span class="fc-title">All Day Event</span></div></a></td></tr></tbody></table></div></div><div class="fc-row fc-week fc-widget-content" style="height: 76px;"><div class="fc-bg"><table><tbody><tr><td class="fc-day fc-widget-content fc-sun fc-past" data-date="2018-09-02"></td><td class="fc-day fc-widget-content fc-mon fc-past" data-date="2018-09-03"></td><td class="fc-day fc-widget-content fc-tue fc-past" data-date="2018-09-04"></td><td class="fc-day fc-widget-content fc-wed fc-past" data-date="2018-09-05"></td><td class="fc-day fc-widget-content fc-thu fc-past" data-date="2018-09-06"></td><td class="fc-day fc-widget-content fc-fri fc-past" data-date="2018-09-07"></td><td class="fc-day fc-widget-content fc-sat fc-past" data-date="2018-09-08"></td></tr></tbody></table></div><div class="fc-content-skeleton"><table><thead><tr><td class="fc-day-number fc-sun fc-past" data-date="2018-09-02">2</td><td class="fc-day-number fc-mon fc-past" data-date="2018-09-03">3</td><td class="fc-day-number fc-tue fc-past" data-date="2018-09-04">4</td><td class="fc-day-number fc-wed fc-past" data-date="2018-09-05">5</td><td class="fc-day-number fc-thu fc-past" data-date="2018-09-06">6</td><td class="fc-day-number fc-fri fc-past" data-date="2018-09-07">7</td><td class="fc-day-number fc-sat fc-past" data-date="2018-09-08">8</td></tr></thead><tbody><tr><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr></tbody></table></div></div><div class="fc-row fc-week fc-widget-content" style="height: 76px;"><div class="fc-bg"><table><tbody><tr><td class="fc-day fc-widget-content fc-sun fc-past" data-date="2018-09-09"></td><td class="fc-day fc-widget-content fc-mon fc-past" data-date="2018-09-10"></td><td class="fc-day fc-widget-content fc-tue fc-past" data-date="2018-09-11"></td><td class="fc-day fc-widget-content fc-wed fc-past" data-date="2018-09-12"></td><td class="fc-day fc-widget-content fc-thu fc-past" data-date="2018-09-13"></td><td class="fc-day fc-widget-content fc-fri fc-past" data-date="2018-09-14"></td><td class="fc-day fc-widget-content fc-sat fc-past" data-date="2018-09-15"></td></tr></tbody></table></div><div class="fc-content-skeleton"><table><thead><tr><td class="fc-day-number fc-sun fc-past" data-date="2018-09-09">9</td><td class="fc-day-number fc-mon fc-past" data-date="2018-09-10">10</td><td class="fc-day-number fc-tue fc-past" data-date="2018-09-11">11</td><td class="fc-day-number fc-wed fc-past" data-date="2018-09-12">12</td><td class="fc-day-number fc-thu fc-past" data-date="2018-09-13">13</td><td class="fc-day-number fc-fri fc-past" data-date="2018-09-14">14</td><td class="fc-day-number fc-sat fc-past" data-date="2018-09-15">15</td></tr></thead><tbody><tr><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr></tbody></table></div></div><div class="fc-row fc-week fc-widget-content" style="height: 76px;"><div class="fc-bg"><table><tbody><tr><td class="fc-day fc-widget-content fc-sun fc-past" data-date="2018-09-16"></td><td class="fc-day fc-widget-content fc-mon fc-past" data-date="2018-09-17"></td><td class="fc-day fc-widget-content fc-tue fc-past" data-date="2018-09-18"></td><td class="fc-day fc-widget-content fc-wed fc-past" data-date="2018-09-19"></td><td class="fc-day fc-widget-content fc-thu fc-past" data-date="2018-09-20"></td><td class="fc-day fc-widget-content fc-fri fc-past" data-date="2018-09-21"></td><td class="fc-day fc-widget-content fc-sat fc-past" data-date="2018-09-22"></td></tr></tbody></table></div><div class="fc-content-skeleton"><table><thead><tr><td class="fc-day-number fc-sun fc-past" data-date="2018-09-16">16</td><td class="fc-day-number fc-mon fc-past" data-date="2018-09-17">17</td><td class="fc-day-number fc-tue fc-past" data-date="2018-09-18">18</td><td class="fc-day-number fc-wed fc-past" data-date="2018-09-19">19</td><td class="fc-day-number fc-thu fc-past" data-date="2018-09-20">20</td><td class="fc-day-number fc-fri fc-past" data-date="2018-09-21">21</td><td class="fc-day-number fc-sat fc-past" data-date="2018-09-22">22</td></tr></thead><tbody><tr><td></td><td></td><td></td><td></td><td class="fc-event-container" colspan="3"><a class="fc-day-grid-event fc-event fc-start fc-end fc-draggable" style="background-color:#f39c12;border-color:#f39c12"><div class="fc-content"><span class="fc-time">12a</span> <span class="fc-title">Long Event</span></div></a></td></tr></tbody></table></div></div><div class="fc-row fc-week fc-widget-content" style=""><div class="fc-bg"><table><tbody><tr><td class="fc-day fc-widget-content fc-sun fc-past" data-date="2018-09-23"></td><td class="fc-day fc-widget-content fc-mon fc-past" data-date="2018-09-24"></td><td class="fc-day fc-widget-content fc-tue fc-today fc-state-highlight" data-date="2018-09-25"></td><td class="fc-day fc-widget-content fc-wed fc-future" data-date="2018-09-26"></td><td class="fc-day fc-widget-content fc-thu fc-future" data-date="2018-09-27"></td><td class="fc-day fc-widget-content fc-fri fc-future" data-date="2018-09-28"></td><td class="fc-day fc-widget-content fc-sat fc-future" data-date="2018-09-29"></td></tr></tbody></table></div><div class="fc-content-skeleton"><table><thead><tr><td class="fc-day-number fc-sun fc-past" data-date="2018-09-23">23</td><td class="fc-day-number fc-mon fc-past" data-date="2018-09-24">24</td><td class="fc-day-number fc-tue fc-today fc-state-highlight" data-date="2018-09-25">25</td><td class="fc-day-number fc-wed fc-future" data-date="2018-09-26">26</td><td class="fc-day-number fc-thu fc-future" data-date="2018-09-27">27</td><td class="fc-day-number fc-fri fc-future" data-date="2018-09-28">28</td><td class="fc-day-number fc-sat fc-future" data-date="2018-09-29">29</td></tr></thead><tbody><tr><td rowspan="2"></td><td rowspan="2"></td><td class="fc-event-container"><a class="fc-day-grid-event fc-event fc-start fc-end fc-draggable" style="background-color:#0073b7;border-color:#0073b7"><div class="fc-content"><span class="fc-time">10:30a</span> <span class="fc-title">Meeting</span></div></a></td><td class="fc-event-container" rowspan="2"><a class="fc-day-grid-event fc-event fc-start fc-end fc-draggable" style="background-color:#00a65a;border-color:#00a65a"><div class="fc-content"><span class="fc-time">7p</span> <span class="fc-title">Birthday Party</span></div></a></td><td rowspan="2"></td><td class="fc-event-container" rowspan="2"><a class="fc-day-grid-event fc-event fc-start fc-end fc-draggable" href="http://google.com/" style="background-color:#3c8dbc;border-color:#3c8dbc"><div class="fc-content"><span class="fc-time">12a</span> <span class="fc-title">Click for. Google</span></div></a></td><td rowspan="2"></td></tr><tr><td class="fc-event-container"><a class="fc-day-grid-event fc-event fc-start fc-end fc-draggable" style="background-color:#00c0ef;border-color:#00c0ef"><div class="fc-content"><span class="fc-time">12p</span> <span class="fc-title">Lunch</span></div></a></td></tr></tbody></table></div></div><div class="fc-row fc-week fc-widget-content" style="height: 76px;"><div class="fc-bg"><table><tbody><tr><td class="fc-day fc-widget-content fc-sun fc-future" data-date="2018-09-30"></td><td class="fc-day fc-widget-content fc-mon fc-other-month fc-future" data-date="2018-10-01"></td><td class="fc-day fc-widget-content fc-tue fc-other-month fc-future" data-date="2018-10-02"></td><td class="fc-day fc-widget-content fc-wed fc-other-month fc-future" data-date="2018-10-03"></td><td class="fc-day fc-widget-content fc-thu fc-other-month fc-future" data-date="2018-10-04"></td><td class="fc-day fc-widget-content fc-fri fc-other-month fc-future" data-date="2018-10-05"></td><td class="fc-day fc-widget-content fc-sat fc-other-month fc-future" data-date="2018-10-06"></td></tr></tbody></table></div><div class="fc-content-skeleton"><table><thead><tr><td class="fc-day-number fc-sun fc-future" data-date="2018-09-30">30</td><td class="fc-day-number fc-mon fc-other-month fc-future" data-date="2018-10-01">1</td><td class="fc-day-number fc-tue fc-other-month fc-future" data-date="2018-10-02">2</td><td class="fc-day-number fc-wed fc-other-month fc-future" data-date="2018-10-03">3</td><td class="fc-day-number fc-thu fc-other-month fc-future" data-date="2018-10-04">4</td><td class="fc-day-number fc-fri fc-other-month fc-future" data-date="2018-10-05">5</td><td class="fc-day-number fc-sat fc-other-month fc-future" data-date="2018-10-06">6</td></tr></thead><tbody><tr><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr></tbody></table></div></div></div></div></td></tr></tbody></table></div></div></div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /. box -->
          </div>
      </div>
    </div>
  </div>
</div>
@endsection

@section('scripts')
@parent

@stop
