@extends('layouts.main')

@section('title')
    <ol class="breadcrumb m-0">
        <li class="breadcrumb-item"><a href="{{ route('grades.index') }}">Grades</a></li>
        <li class="breadcrumb-item"><a href="{{ route('grades.show',$grade) }}">{{ $grade->grade_name }}</a></li>
        <li class="breadcrumb-item active">Edit</li>
    </ol>
@endsection

@section('dynamic-content')
    <div class="container">
        <form action="{{ route('grades.update',$grade) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="grade_name">Grade Name</label>
                <input class="form-control {{ $errors->has('grade_name') ? ' is-invalid' : '' }}" type="text" id="grade_name" name="grade_name" value="{{ $grade->grade_name }}" required>
                @if ($errors->has('grade_name'))
                    <span class="invalid-feedback" role="alert">
                        {{ $errors->first('grade_name') }}
                    </span>
                @endif
            </div>

            <div class="form-group">
                <label for="tobaccotype_id">Tobacco Type</label>
                <select class="form-control {{ $errors->has('tobaccotype_id') ? ' is-invalid' : '' }}" name="tobaccotype_id" id="tobaccotype_id">
                    @foreach ($tobaccotypes as $tobaccotype)
                        <option @if($grade->tobaccotype_id == $tobaccotype->id) selected @endif value="{{ $tobaccotype->id }}">{{ $tobaccotype->type_name }}</option>
                    @endforeach
                </select>
                @if ($errors->has('tobaccotype_id'))
                    <span class="invalid-feedback" role="alert">
                        {{ $errors->first('tobaccotype_id') }}
                    </span>
                @endif
            </div>
            <div class="form-group">
                <label for="threshold">Threshold</label>
                <input class="form-control {{ $errors->has('threshold') ? ' is-invalid' : '' }}" type="text" id="threshold" name="threshold" value="{{ old('threshold') }}" placeholder="Enter the Monitor Value" required>
                @if ($errors->has('threshold'))
                    <span class="invalid-feedback" role="alert">
                        {{ $errors->first('threshold') }}
                    </span>
                @endif
            </div>

            <div class="form-group mb-2 text-center">
                <button class="btn btn-primary btn-block" type="submit">
                    <i class="mdi mdi-content-save"></i> Submit
                </button>
            </div>
        </form>
    </div>
@endsection