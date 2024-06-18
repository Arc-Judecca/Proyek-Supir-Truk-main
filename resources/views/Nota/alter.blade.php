@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit Nota</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('update.nota', $nota->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="form-group row">
                            <label for="supir" class="col-md-4 col-form-label text-md-right">Nama Supir</label>

                            <div class="col-md-6">
                                <select id="supir" class="form-control @error('supir_id') is-invalid @enderror" name="supir_id" required autocomplete="supir_id" autofocus>
                                    <option value="">Pilih Supir</option>
                                    @foreach($supirs as $supir)
                                        <option value="{{ $supir->id }}" {{ $supir->id == $nota->supir_id ? 'selected' : '' }}>{{ $supir->nama }}</option>
                                    @endforeach
                                </select>

                                @error('supir_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="tanggal" class="col-md-4 col-form-label text-md-right">Tanggal</label>

                            <div class="col-md-6">
                                <input type="date" id="tanggal" class="form-control @error('tanggal') is-invalid @enderror" name="tanggal" value="{{ $nota->tanggal }}" required autocomplete="tanggal">

                                @error('tanggal')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="nota" class="col-md-4 col-form-label text-md-right">Upload Nota</label>

                            <div class="col-md-6">
                                <input id="nota" type="file" class="form-control-file @error('nota') is-invalid @enderror" name="nota">
                                @if($nota->nota)
                                    <a href="{{ asset('storage/' . $nota->nota) }}" target="_blank">Lihat File</a>
                                @endif

                                @error('nota')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Update
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
