@extends('home.layouts.site_home')

@section('content')
<section class="w3l-blog-single">
    <section class="w3l-blog-single1 py-5">
        <div class="title-content mb-5">
            <h5 class="title-small text-center mb-2">Agenda</h5>
            <h3 class="title-big text-center mb-5">GenBI UNHAS</h3>
        </div>
        <div class="container py-lg-3">
            <div id="evoCalendar"></div>
        </div>
    </section>
</section>
@endsection

@section('script')
<script type="text/javascript">
    var myEvents = [
        { 
            id: "required-id-1",
            name: "New Year", 
            date: "Wed Jan 01 2020 00:00:00 GMT-0800 (Pacific Standard Time)", 
            type: "holiday", 
            everyYear: true 
        },
        { 
            id: "required-id-2",
            name: "Valentine's Day", 
            date: ["08/03/2020","08/05/2020"], 
            type: "event", 
            everyYear: true,
            color: "#003597"
        }
    ]

    $(document).ready(function(){
        $.ajax({
            type: "GET",
            url: "{{ url('agenda/json') }}",
            dataType: "JSON",
            success: function (data) {
                $('#evoCalendar').evoCalendar({
                    theme: 'Royal Navy',
                    calendarEvents: data,
                });
            }
        });
    });
</script>
@endsection