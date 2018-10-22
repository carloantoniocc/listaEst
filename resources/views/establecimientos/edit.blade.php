@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <!--BreadCrumb-->
			<ol class="breadcrumb">
			  <li><a href="/establecimientos">Establecimientos</a></li>
			  <li class="active">Editar</li>
			</ol>
			<!--FIN BreadCrumb-->
			<!--Panel Formulario Editar Establecimiento-->
			<div class="panel panel-default">
                <div class="panel-heading">Editar Establecimiento</div>
                <div class="panel-body">
					<form class="form-horizontal" role="form" method="POST" action="/establecimientos/{{$establecimiento->id}}">
                        <input type="hidden" name="_method" value="PUT">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Nombre</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{$establecimiento->name}}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
						<!--Lista Activo-->
						<div class="form-group{{ $errors->has('active') ? ' has-error' : '' }}">
                            <label for="active" class="col-md-4 control-label">Activo</label>

                            <div class="col-md-6">
								<select id="active" class="form-control" name="active" required>
								@if ($establecimiento->active == 1)
									<option value="1" selected>Si</option>
									<option value="0">No</option>
								@else
									<option value="1">Si</option>
									<option value="0" selected>No</option>		
								@endif
								</select>
                            </div>
                        </div>
						<!--Boton Submit-->
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Editar
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
			<!--FIN Panel Formulario Crear Establecimientos-->
        </div>
    </div>
</div>

<!--evita submit al presionar enter-->
<script>
	
	function stopRKey(evt) {
		var evt = (evt) ? evt : ((event) ? event : null);
		var node = (evt.target) ? evt.target : ((evt.srcElement) ? evt.srcElement : null);
		if ((evt.keyCode == 13) && (node.type=="text")) {return false;}
	}

	document.onkeypress = stopRKey;
</script>

<!--Script Autocompletado-->
<script>
	var placeSearch, autocomplete;
	
	function initAutocomplete() {
		
		autocomplete = new google.maps.places.Autocomplete(
			(document.getElementById('direccion')),
			{types: ['geocode']});
		
		autocomplete.addListener('place_changed', fillInAddress);
	}
	
	function fillInAddress() {
		document.getElementById("y").value = autocomplete.getPlace().geometry.location.lat();
		document.getElementById("x").value = autocomplete.getPlace().geometry.location.lng();
	}
	
	function geolocate() {
        if (navigator.geolocation) {
          navigator.geolocation.getCurrentPosition(function(position) {
            var geolocation = {
              lat: position.coords.latitude,
              lng: position.coords.longitude
            };
            var circle = new google.maps.Circle({
              center: geolocation,
              radius: position.coords.accuracy
            });
            autocomplete.setBounds(circle.getBounds());
          });
        }
    }
</script>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBza1gebFTuaENlMQolN2EHuoLyVkraOR8&libraries=places&callback=initAutocomplete"
         async defer></script>
@endsection

