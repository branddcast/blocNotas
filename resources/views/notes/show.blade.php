@extends('app')

@section('content')

<script>

    function getSelectionHTML(tag){
        var selection = window.getSelection().getRangeAt(0);
        //if(window.getSelection().baseNode.parentNode.id != "description") return;
        var selectedText = selection.extractContents();

        console.log(tag);
        console.log(selectedText);

        // var tagHTML = document.createElement(tag);
        // tagHTML.appendChild(selectedText);
        // selection.insertNode(tagHTML);
    }
</script>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            @if(session("danger"))
                <div class="alert alert-danger">
                    {{session("danger")}}
                </div>
            @endif
            <div class="row">
                <div class="col-md-12">
                    @if (isset($editable) || isset($create))
                    <nav class="navbar navbar-light" style="background: #e2e2e2">
                        <span class="navbar-text">
                            Completa o edita los siguientes campos
                        </span>
                      </nav>
                    @endif
                </div>
            </div>
            <div class="card">
                <form id="saveNote" method="POST" action="{{url('notes/save')}}" class="mb-0">
                @csrf
                <div class="card-header" style="display: flexbox; position: relative">
                    @if(isset($editable) || isset($create))
                    <label>Título</label>
                    <input name="title" class="form-control w-75" type="text" placeholder="Título" value="{{$note->title ?? ''}}">
                    @else
                    <span style="padding-right: 20px">{{$note->title}}</span>
                    @endif 
                    @if(empty($editable) && empty($create))
                    <a style="text-decoration: none; color: rgb(55, 165, 255)" href="{{url('notes/edit/'.$note->id)}}">
                        <i class="fas fa-pen" style="align-items: center; position: absolute; right: 45px; top: 15px; cursor: pointer"></i>
                    </a>
                    @endif
                    @empty($create)
                    <a style="text-decoration: none; color: red" href="#" onclick="javascript:deleteNote({{$note->id}});">
                        <i class="fas fa-trash" style="align-items: center; position: absolute; right: 15px; top: 15px; cursor: pointer"></i>
                    </a> 
                    @endempty
                </div>
                <div class="card-body">
                    <label class="font-weight-bold">Descripción</label>
                    <textarea id="description" required name="description" placeholder="Descripción" style="border: 1px solid #ddd; border-radius: 3px; padding: 10px; width: 100%; height: 250px; max-height: 250px" @if(isset($editable) === false && empty($create) === true) disabled="true" @endif>{{$note->description ?? ''}}</textarea>
                    @if(isset($editable) || isset($create))
                    <div class="row">
                        <div class="col-md-7 align-self-end">
                            <input type="submit" @if(isset($editable)) name="updateNote" @else name="saveNote" @endif class="btn btn-primary btn-sm mt-3" value="Guardar Nota">
                            <input type="hidden" name="id" value="{{$note->id ?? ''}}">
                        </div>
                        <div class="col-md-5 mt-3">
                            <label class="font-weight-bold">Categoría</label>
                            <select name="category" class="form-control form-control-sm">
                                <option value="0" disabled selected>Categoría</option>
                                @foreach ($categories as $category)
                                <option value="{{$category->id}}" @if (isset($note) && $category->id == $note->category){{'selected'}}@endif>{{$category->title}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    @endif
                </div>
                <div class="card-footer">
                    {{-- @isset($editable)
                    <div class="row mb-2">
                        <div class="col-md-auto">
                            <button onclick="getSelectionHTML('b')" class="boton_html_tag mr-2 @php if(array_search("[Bold]", $tags) !== false) echo 'boton_html_tag_active' @endphp"><i class="fas fa-bold"></i></button>
                            <button onclick="getSelectionHTML('i')" class="boton_html_tag mr-2 @php if(array_search("[Italic]", $tags) !== false) echo 'boton_html_tag_active' @endphp"><i class="fas fa-italic"></i></button>
                            <button onclick="getSelectionHTML('u')" class="boton_html_tag mr-2 @php if(array_search("[Underline]", $tags) !== false) echo 'boton_html_tag_active' @endphp"><i class="fas fa-underline"></i></button>
                        </div>
                    </div>
                    <div class="border-bottom mb-2"></div>
                    @endisset --}}
                    <div class="row justify-content-between">
                        <div class="col-md-auto">
                            {{(isset($note) && $note->author != null)? $note->author_->name: 'Anónimo'}}
                        </div>
                        <div class="col-md-1 text-center align-self-center">
                            {!! categoryIcon((($note->category != null)?$note->category_->title:'Desconocida')) !!}
                        </div>
                        <div class="col-md-auto text-right">
                            {{\Carbon\Carbon::parse(strtotime((isset($note->created_at))? $note->created_at: time()))->formatLocalized('%b %d, %Y')}}
                        </div>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection