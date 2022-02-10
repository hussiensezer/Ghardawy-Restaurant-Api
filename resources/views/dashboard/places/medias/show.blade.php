@extends('dashboard.layouts.master')
@section('style')
    <link rel="stylesheet" type="text/css" href="{{URL::asset('assets/app-assets/css-rtl/pages/gallery.css')}}">
@endsection
@section('title')
    @lang('place.gallery')
@endsection
@section('active')
    places
@endsection
@section('card_title')
    @lang('place.gallery')
@endsection

@section('without-card')
    <div class="grid-hover col-md-12">
        <div class="row">
        @foreach($medias as $media)
            <div class="col-md-4">
                <figure class="effect-zoe">
                    <img src="{{URL::to('public/files/places/gallery/' . $media->path)}}" alt="" class="w-100 h-100">
                    <figcaption>
                        <h2>Creative <span>Zoe</span></h2>
                        <p class="icon-links">
                            <button type="button"  class="btn btn-outline-danger btn-sm" data-toggle="modal" data-target="#delete_{{$media->id}}">
                                <i class="ft-trash d-block"></i>
                               <small> @lang('global.delete')</small>
                            </button>
                        </p>
                    </figcaption>
                </figure>
            </div>

            <!--Start Destroy Model -->
                <!-- Modal -->
                <div class="modal fade" id="delete_{{$media->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLongTitle">@lang('global.delete')</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action="{{route('dashboard.medias.destroy', $media->id)}}" method="post">
                                @csrf
                                {{method_field('delete')}}
                                <div class="modal-body">
                                    <img src="{{URL::to('public/files/places/gallery/' . $media->path)}}" alt="" class="w-100 h-100">
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">@lang('global.close')</button>
                                    <button type="submit" class="btn btn-danger">@lang('global.delete')</button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            <!--End Destroy Model -->
        @endforeach
        </div>
    </div>
        <div class="col-md-12">
         <div class="m-auto">
             {{$medias->links()}}
         </div>
        </div>
@endsection


@section('script')
@endsection
