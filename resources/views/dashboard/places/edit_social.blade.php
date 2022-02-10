@extends('dashboard.layouts.master')

@section('title')
    @lang('place.edit_social')
@endsection
@section('active')
    places
@endsection
@section('card_title')
    @lang('place.edit_social')
@endsection

@section('content')
            <h4 class="form-section"><i class="la la-globe"></i> @lang('place.social_networks')</h4>
                    <div data-repeater-item="">
                        @foreach($placeSocials as $placeSocial)
                            <form action="{{route('dashboard.places.updateSocial', $placeSocial->id)}}" method="post">
                                {{method_field('put')}}
                                @csrf
                                @if ($errors->any())
                                    @foreach ($errors->all() as $error)
                                        <div class="alert bg-danger alert-icon-left alert-arrow-left alert-dismissible mb-2" role="alert">
                                            <span class="alert-icon"><i class="la la-thumbs-o-down"></i></span>
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                            {{$error}}
                                        </div>
                                    @endforeach
                                @endif
                                    <div class="row">
                                        <div class="col-md-4">
                                            <select name="socials" id="" class="form-control">
                                                <option disabled selected>@lang('global.choose') ....</option>
                                                @foreach($socials as $social)
                                                    <option value="{{$social->id}}" {{$social->id == $placeSocial->social_id ? 'selected' : ''}}> {{$social->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="url" name="links" id="" class="form-control" placeholder="@lang("place.link")" value="{{$placeSocial->link}}">
                                        </div>

                                        <div class="form-group col-md-1 text-center">
                                            <button type="submit" class="btn btn-primary btn-sm"><i class="ft-edit"></i> @lang('global.edit')</button>
                                        </div>

                                    <div class="form-group col-md-1 text-center">
                                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#model_{{$placeSocial->id}}"> <i class="ft-trash"></i> @lang('global.delete')</button>
                                    </div>
                                </div>
                        </form>
                            <div class="modal animated bounceIn text-left" id="model_{{$placeSocial->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel46" style="display: none;" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title" id="myModalLabel46">@lang('global.sure_want_delete')</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                        </div>
                                        <form action="{{route('dashboard.places.destroySocial', $placeSocial->id)}}" method="post">
                                            @csrf
                                            {{method_field('delete')}}
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <input type="text" class="form-control" value="{{$placeSocial->social->name}}" disabled>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <input type="text" class="form-control" value="{{$placeSocial->link}}" disabled>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal">@lang('global.close')</button>
                                                <button type="submit" class="btn btn-outline-danger"><i class="ft-trash"></i> @lang('global.confirm')</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
@endsection


@section('script')
    <script src="{{URL::asset("assets/app-assets/vendors/js/forms/repeater/jquery.repeater.min.js")}}"></script>
    <script src="{{URL::asset("assets/app-assets/js/scripts/forms/form-repeater.js")}}"></script>
    <script src="{{URL::asset("assets/main-assets/js/ajax/placeAjax.js")}}"></script>
@endsection
