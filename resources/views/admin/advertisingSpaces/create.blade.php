@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.advertisingSpace.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.advertising-spaces.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="title">{{ trans('cruds.advertisingSpace.fields.title') }}</label>
                <input class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" type="text" name="title" id="title" value="{{ old('title', '') }}" required>
                @if($errors->has('title'))
                    <div class="invalid-feedback">
                        {{ $errors->first('title') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.advertisingSpace.fields.title_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required">{{ trans('cruds.advertisingSpace.fields.ads_type') }}</label>
                @foreach(App\AdvertisingSpace::ADS_TYPE_RADIO as $key => $label)
                    <div class="form-check {{ $errors->has('ads_type') ? 'is-invalid' : '' }}">
                        <input class="" type="radio" id="ads_type_{{ $key }}" name="ads_type" value="{{ $key }}" {{ old('ads_type', '') === (string) $key ? 'checked' : '' }} required>
                        <label class="" for="ads_type_{{ $key }}">{{ $label }}</label>
                    </div>
                @endforeach
                @if($errors->has('ads_type'))
                    <div class="invalid-feedback">
                        {{ $errors->first('ads_type') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.advertisingSpace.fields.ads_type_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="image">{{ trans('cruds.advertisingSpace.fields.image') }}</label>
                <div class="needsclick dropzone {{ $errors->has('image') ? 'is-invalid' : '' }}" id="image-dropzone">
                </div>
                @if($errors->has('image'))
                    <div class="invalid-feedback">
                        {{ $errors->first('image') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.advertisingSpace.fields.image_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="code">{{ trans('cruds.advertisingSpace.fields.code') }}</label>
                <textarea class="form-control {{ $errors->has('code') ? 'is-invalid' : '' }}" name="code" id="code">{{ old('code') }}</textarea>
                @if($errors->has('code'))
                    <div class="invalid-feedback">
                        {{ $errors->first('code') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.advertisingSpace.fields.code_helper') }}</span>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>


    </div>
</div>
@endsection

@section('scripts')
<script>
    Dropzone.options.imageDropzone = {
    url: '{{ route('admin.advertising-spaces.storeMedia') }}',
    maxFilesize: 20, // MB
    acceptedFiles: '.jpeg,.jpg,.png,.gif',
    maxFiles: 1,
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 20,
      width: 9096,
      height: 9096
    },
    success: function (file, response) {
      $('form').find('input[name="image"]').remove()
      $('form').append('<input type="hidden" name="image" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="image"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($advertisingSpace) && $advertisingSpace->image)
      var file = {!! json_encode($advertisingSpace->image) !!}
          this.options.addedfile.call(this, file)
      this.options.thumbnail.call(this, file, '{{ $advertisingSpace->image->getUrl('thumb') }}')
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="image" value="' + file.file_name + '">')
      this.options.maxFiles = this.options.maxFiles - 1
@endif
    },
    error: function (file, response) {
        if ($.type(response) === 'string') {
            var message = response //dropzone sends it's own error messages in string
        } else {
            var message = response.errors.file
        }
        file.previewElement.classList.add('dz-error')
        _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
        _results = []
        for (_i = 0, _len = _ref.length; _i < _len; _i++) {
            node = _ref[_i]
            _results.push(node.textContent = message)
        }

        return _results
    }
}
</script>
@endsection