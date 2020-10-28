@extends('app')

@section('content')

    @if(session("success"))
    <div class="row justify-content-center mb-3">
        <div class="col-md-5 text-center">
            <div class="alert alert-success">
                {{session("success")}}
            </div>
        </div>
    </div>
    @endif
    @if(isset($filter))
    <div class="row">
        <div class="col-md-5">
            <div class="alert alert-light">
                <h5>{{$filter->filter.': '.$filter->value}}</h5>
            </div>
        </div>
    </div>
    @endif
    {{-- <div class="row"> --}}
    <div class="wf-container">
        @foreach ($notes as $note)
        {{-- <div class="col-md-3"> --}}
        <div class="wf-box">
            <div class="content">
                <div class="card mb-3 shadow-lg {{'card-'.(($note->category != null)? $note->category_->title: 'General')}}">
                    <div class="card-header" style="display: flexbox; position: relative">
                        <span style="padding-right: 20px"><a style="text-decoration: none; color: currentColor" href="{{url('notes/view/'.$note->id)}}">d jhgfdsj fgsjdf dsjfd hhh {{$note->title}}</a></span>
                        <a style="text-decoration: none; color: currentColor" href="#" onclick="javascript:deleteNote({{$note->id}});"><i class="fas fa-times" style="align-items: center; position: absolute; right: 15px; top: 15px; cursor: pointer"></i></a>
                    </div>
                    <div class="card-body">
                        <p class="card-text">{!! formatHTML(substr($note->description, 0, 400)) !!}@if (strlen($note->description) > 400){{'...'}} @endif</p>
                    </div>
                    <div class="card-footer">
                        <div class="row justify-content-between">
                            <div class="col-md-auto">
                                <a style="text-decoration: none; color: currentColor" href="{{url('filter/author/'.(($note->author != null)? $note->author : 0))}}">{{($note->author != null)? $note->author_->name: 'Anónimo'}}</a>
                            </div>
                            <div class="col-md-1 text-center align-self-center">
                                <a style="text-decoration: none; color: currentColor" href="{{url('filter/category/'.(($note->category != null)? $note->category : 0))}}">{!! categoryIcon((($note->category != null)?$note->category_->title:'Desconocida')) !!}</a>
                            </div>
                            <div class="col-md-auto text-right align-items-end">
                                <a style="text-decoration: none; color: currentColor" href="{{url('filter/date/'.date("d-m-Y", strtotime($note->created_at)))}}">{{\Carbon\Carbon::parse(strtotime($note->created_at))->formatLocalized('%b %d, %Y')}}</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    {{-- </div> --}}
    <div class="row">
        {{ $notes->links() }}
    </div>

    <script>
        var waterfall = new Waterfall({ 
            containerSelector: '.wf-container',
            boxSelector: '.wf-box',
            minBoxWidth: 310
        });
    </script>

@endsection