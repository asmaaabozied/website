@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.adminmenu.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.adminmenus.update", [$adminmenu->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="menuTitleEn">{{ trans('cruds.adminmenu.fields.menuTitleEn') }}</label>
                <input class="form-control {{ $errors->has('menuTitleEn') ? 'is-invalid' : '' }}" type="text" name="menuTitleEn" id="menuTitleEn" value="{{ old('menuTitleEn', $adminmenu->menuTitleEn) }}">
                @if($errors->has('menuTitleEn'))
                    <div class="invalid-feedback">
                        {{ $errors->first('menuTitleEn') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.adminmenu.fields.menuTitleEn_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="menuTitleAr">{{ trans('cruds.adminmenu.fields.menuTitleAr') }}</label>
                <input class="form-control {{ $errors->has('menuTitleAr') ? 'is-invalid' : '' }}" type="text" name="menuTitleAr" id="menuTitleAr" value="{{ old('menuTitleAr', $adminmenu->menuTitleAr) }}" required>
                @if($errors->has('menuTitleAr'))
                    <div class="invalid-feedback">
                        {{ $errors->first('menuTitleAr') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.adminmenu.fields.menuTitleAr_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="menuLink">{{ trans('cruds.adminmenu.fields.menuLink') }}</label>
                <input class="form-control {{ $errors->has('menuLink') ? 'is-invalid' : '' }}" type="text" name="menuLink" id="menuLink" value="{{ old('menuLink', $adminmenu->menuLink) }}" required>
                @if($errors->has('menuLink'))
                    <div class="invalid-feedback">
                        {{ $errors->first('menuLink') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.adminmenu.fields.menuLink_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="menuIco">{{ trans('cruds.adminmenu.fields.menuIco') }}</label>
                <input class="form-control {{ $errors->has('menuIco') ? 'is-invalid' : '' }}" type="text" name="menuIco" id="menuIco" value="{{ old('menuIco', $adminmenu->menuIco) }}">
                @if($errors->has('menuIco'))
                    <div class="invalid-feedback">
                        {{ $errors->first('menuIco') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.adminmenu.fields.menuIco_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="parentMenuID">{{ trans('cruds.adminmenu.fields.parentMenuID') }}</label>
                <select class="form-control select2 {{ $errors->has('parentMenuID') ? 'is-invalid' : '' }}" name="parentMenuID" id="parentMenuID">
                    @foreach($adminmenus as $id => $adminmenuu)
                        <option value="{{ $id }}" {{ ($adminmenu->menue_parent ? $adminmenu->menue_parent->id : old('parentMenuID')) == $id ? 'selected' : '' }}>{{ $adminmenuu }}</option>
                    @endforeach
                </select>
                @if($errors->has('parentMenuID'))
                    <div class="invalid-feedback">
                        {{ $errors->first('parentMenuID') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.adminmenu.fields.parentMenuID_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="ordering">{{ trans('cruds.adminmenu.fields.ordering') }}</label>
                <input class="form-control {{ $errors->has('ordering') ? 'is-invalid' : '' }}" type="number" name="ordering" id="ordering" value="{{ old('ordering', $adminmenu->ordering) }}" step="1">
                @if($errors->has('ordering'))
                    <div class="invalid-feedback">
                        {{ $errors->first('ordering') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.adminmenu.fields.ordering_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('visable') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="visable" value="0">
                    <input class="form-check-input" type="checkbox" name="visable" id="visable" value="1" {{ $adminmenu->visable || old('visable', 0) === 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="visable">{{ trans('cruds.adminmenu.fields.visable') }}</label>
                </div>
                @if($errors->has('visable'))
                    <div class="invalid-feedback">
                        {{ $errors->first('visable') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.adminmenu.fields.visable_helper') }}</span>
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