@extends('dashboard.layouts.master')

@section('title')
    @lang('place.edit_workingHours')
@endsection
@section('active')
    places
@endsection
@section('card_title')
    @lang('place.edit_workingHours')
@endsection

@section('content')
    <h4 class="form-section"><i class="la la-globe"></i> @lang('place.opening_hours')</h4>
        @foreach($openingHours as $openingHour)
            <form action="{{route('dashboard.openingHour.update', $openingHour->id)}}" method="post">
                {{method_field('put')}}
                @csrf
                @if ($errors->any())
                    @foreach($errors->all() as $error)
                        <div class="alert bg-danger alert-icon-left alert-arrow-left alert-dismissible mb-2" role="alert">
                            <span class="alert-icon"><i class="la la-thumbs-o-down"></i></span>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                            {{$error}}
                        </div>
                    @endforeach
                @endif
                <!-- Start Row -->
                            <div class="row my-2">
                                <div class="form-group col-md-2">
                                    <label for="">@lang('place.day')</label>
                                    <select name="days" id="opening_hours" class="form-control">
                                        @foreach($days  as $day)
                                            <option value="{{$day->id}}" {{$day->id === $openingHour->day_id ? 'selected' : ''}}>{{$day->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label for="">@lang('place.am')</label>
                                    <input type="number" min="1" max="12" name="am" class="form-control" placeholder="@lang('place.am')" value="{{ $openingHour->am}}">
                                </div>
                                <div class="col-md-4">
                                    <label for="">@lang('place.pm')</label>
                                    <input type="number" name="pm" min="1" max="12" class="form-control" placeholder="@lang('place.pm')" value="{{ $openingHour->pm}}">
                                </div>
                                <div class="col-md-1 text-center">
                                    <label for=""> </label>
                                    <button type="submit" class="btn btn-primary btn-sm"><i class="ft-edit"></i> @lang('global.edit')</button>
                                </div>

                                <div class="col-md-1 text-center">
                                    <label for=""> </label>
                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#model_{{$openingHour->id}}"> <i class="ft-trash"></i> @lang('global.delete')</button>
                                </div>
                            </div>
            </form>
            <div class="modal animated bounceIn text-left" id="model_{{$openingHour->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel46" style="display: none;" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="myModalLabel46">@lang('global.sure_want_delete')</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <form action="{{route('dashboard.openingHour.destroy', $openingHour->id)}}" method="post">
                            @csrf
                            {{method_field('delete')}}
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <label for="">@lang('place.day')</label>
                                        <input type="text" class="form-control" value="{{$openingHour->day->name}}" disabled>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="">@lang('place.am')</label>
                                        <input type="text" class="form-control" value="{{$openingHour->am}}" disabled>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="">@lang('place.pm')</label>
                                        <input type="text" class="form-control" value="{{$openingHour->pm}}" disabled>
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
@endsection


@section('script')
    <script src="{{URL::asset("assets/app-assets/vendors/js/forms/repeater/jquery.repeater.min.js")}}"></script>
    <script src="{{URL::asset("assets/app-assets/js/scripts/forms/form-repeater.js")}}"></script>
    <script src="{{URL::asset("assets/main-assets/js/ajax/placeAjax.js")}}"></script>
@endsection
