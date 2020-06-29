@extends('layouts.app')

@section('title', 'Configuraciones')

@section('sidebar')
    @parent

    <p>This is appended to the master sidebar.</p>
@endsection

@section('content')
<div class="">
  <nav>
    <div class="nav nav-tabs" id="nav-tab" role="tablist">
      <a class="nav-item nav-link active" id="nav-tipodoc-tab" data-toggle="tab" href="#nav-tipodoc" role="tab" aria-controls="nav-tipodoc" aria-selected="true">Tipos Docs</a>
      <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Profile</a>
      <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">Contact</a>
    </div>
  </nav>
  <div class="tab-content" id="nav-tabContent">
    <div class="tab-pane fade show active" id="nav-tipodoc" role="tabpanel" aria-labelledby="nav-tipodoc-tab">
      <div class="container">
        <div class="row">
          <div class="col-md-6">
            <add-document-type></add-document-type>
          </div>
          <div class="col-md-6">
            <list-document-type></list-document-type>
          </div>
        </div>
      </div>
    </div>
    <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">...</div>
    <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">...</div>
  </div>
  
</div>

@endsection