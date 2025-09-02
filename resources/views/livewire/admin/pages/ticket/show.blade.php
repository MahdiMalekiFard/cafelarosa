@php use App\Helpers\Constants;use App\Helpers\DateHelper; @endphp
<div class="">
    <x-admin.widget.card title="{{ __('ticket.ticket_number', ['number' => $ticket->id]) }}">

        <div class="row">
            <div class="col-6">
                <div class="form-group d-flex flex-row">
                    <label class="control-label text-primary">{{__('ticket.subject')}}:</label>
                    <div @class(['ps-2'=>rtlEnable(),'ps-2'=>!rtlEnable()])>
                        <p class="form-control-static pr-3 pl-3"> {{ $ticket->subject }} </p>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group d-flex flex-row">
                    <label class="control-label text-primary">{{__('datatable.created_at')}}: </label>
                    <div @class(['ps-2'=>rtlEnable(),'ps-2'=>!rtlEnable()])>
                        <p class="form-control-static pr-3 pl-3"> {{ DateHelper::format($ticket->created_at) }} </p>
                    </div>
                </div>
            </div>

            <div class="col-6">
                <div class="form-group d-flex flex-row">
                    <label class="control-label text-primary">{{__('datatable.department')}}: </label>
                    <div @class(['ps-2'=>rtlEnable(),'ps-2'=>!rtlEnable()])>
                        <p class="form-control-static pr-3 pl-3"> {{ $ticket->department->value }} </p>
                    </div>
                </div>
            </div>
            <!--/span-->
            <div class="col-6">
                <div class="form-group d-flex flex-row">
                    <label class="control-label text-primary">{{__('ticket.status')}}:</label>
                    <div @class(['ps-2'=>rtlEnable(),'ps-2'=>!rtlEnable()])>
                        <span class="form-control-static p-3 badge badge-pill @if($ticket->status->value === 'open')  badge-success @else  badge-danger  @endif"> {{ $ticket->status->value }} </span>
                    </div>
                </div>
            </div>
            <!--/span-->
            <div class="col-6">
                <div class="form-group d-flex flex-row">
                    <label class="control-label text-primary">{{__('validation.attributes.full_name')}}:</label>
                    <div @class(['ps-2'=>rtlEnable(),'ps-2'=>!rtlEnable()])>
                                <span
                                    class="form-control-static pr-3 pl-3"> {{ $ticket->user->full_name }} </span>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group d-flex flex-row">
                    <label class="control-label text-primary">{{__('validation.attributes.mobile')}}:</label>
                    <div @class(['ps-2'=>rtlEnable(),'ps-2'=>!rtlEnable()])>
                                <span
                                    class="form-control-static pr-3 pl-3"> {{ $ticket->user->mobile }} </span>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group d-flex flex-row">
                    <label class="control-label text-primary">{{__('validation.attributes.email')}}:</label>
                    <div @class(['ps-2'=>rtlEnable(),'ps-2'=>!rtlEnable()])>
                                <span
                                    class="form-control-static pr-3 pl-3"> {{ $ticket->user->email }} </span>
                    </div>
                </div>
            </div>
            @if (isset($ticket->user))
                <div class="col-6">
                    <div class="form-group d-flex flex-row">
                        <label class="control-label text-primary">{{__('validation.attributes.created_at')}}:</label>
                        <div @class(['ps-2'=>rtlEnable(),'ps-2'=>!rtlEnable()])>
                            <span class="form-control-static pr-3 pl-3">{{DateHelper::format($ticket->user->created_at)}}</span>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group d-flex flex-row">
                        <label class="control-label text-primary">{{__('validation.attributes.type')}}:</label>
                        <div @class(['ps-2'=>rtlEnable(),'ps-2'=>!rtlEnable()])>
                            <span class="form-control-static pr-3 pl-3">{{$ticket->user->rolesName()}}</span>
                        </div>
                    </div>
                </div>
            @endif

        </div>
    </x-admin.widget.card>

    <form wire:submit="submit" class="mt-5">
        <x-admin.element.text-area name="comment" wire:model="comment" placeholder="{{__('ticket.comment')}}"/>
        <button type="submit" wire:loading.attr="disabled" class="btn btn-outline">{{__('ticket.send')}}</button>
    </form>

    <div class="mt-5">
        @foreach($comments as $comment)
            <div data-kt-inbox-message="message_wrapper">
                <div class="d-flex flex-row gap-2 justify-content-between">
                    <div class="d-flex col-lg-11 align-items-center">
                        <div class="symbol symbol-50 me-4">
                            <span class="symbol-label" style="background-image:url({{loadMedia($comment->user,'avatar','thumb')}});"></span>
                        </div>
                        <div class="pe-5">
                            <div class="d-flex align-items-center flex-wrap gap-1">
                                <a href="#" class="fw-bold text-dark text-hover-primary">{{$comment->user->full_name}}</a>
                            </div>
                            <div class="text-muted fw-semibold" data-kt-inbox-message="preview">{{$comment->message}}</div>
                        </div>
                    </div>
                    <div class="d-flex col-1 align-items-center mw-lg-300px">
                        <span class="fw-semibold text-muted text-end me-3">{{DateHelper::format($comment->created_at,Constants::DEFAULT_DATE_FORMAT_WITH_TIME)}}</span>
                    </div>
                </div>
            </div>

            @if(!$loop->last)
                <div class="separator my-6"></div>
            @endif
        @endforeach
    </div>

</div>