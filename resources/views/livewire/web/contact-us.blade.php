<div id="contact-us" class="contactus-area p-[50px_0] bg-blue-50">
    <div class="container">
        <div class="flex flex-wrap mx-[-12px]">
            <div class="lg:w-6/12 w-full max-w-full px-[12px] mx-auto">
                <div class="section-title text-center mb-[70px]">
                    <h2 class=" text-[32px] uppercase font-semibold leading-8">{{trans('website.components.contact_us.heading.title')}}</h2>
                    <span
                            class=" relative block before:content-[''] before:h-0.5 before:w-[44%] before:absolute before:top-2/4 before:inset-x-0 after:content-[''] after:h-0.5 after:w-[44%] after:absolute after:right-0 after:top-2/4 before:bg-[#222222] after:bg-[#222222]">
                            <img src="/img/separ-logo.png" alt="جداکننده" class="m-[13px_auto]">
                        </span>
                    <p class=" text-[15px] text-[#363636]">{{trans('website.components.contact_us.heading.description')}}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="container">

        <div class="flex flex-wrap mx-[-12px]">
            <div class="lg:w-6/12 w-full max-w-full px-[12px] text-center pt-[50px]">
                <div class="contact-info">

                    <div class="flex flex-wrap mx-[-12px]">
                        <div class="md:w-6/12 w-full lg:w-4/12 max-w-full px-[12px] mb-5">
                            <input class="form-control shadow-none text-[#777777] h-[50px] rounded-md border-0  bg-white block w-full text-[1rem] font-normal leading-normal px-3 py-1.5"
                                   type="text"
                                   name="name"
                                   wire:model="name"
                                   placeholder="{{trans('website.components.contact_us.form.name')}}">
                            @error('name')
                            <p class="text-red-500 text-sm mt-1 text-start">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="md:w-6/12 w-full lg:w-4/12 max-w-full px-[12px] mb-5">
                            <input class="form-control shadow-none text-[#777777] h-[50px] rounded-md border-0  bg-white block w-full text-[1rem] font-normal leading-normal px-3 py-1.5"
                                   type="tel"
                                   name="phone"
                                   wire:model="phone"
                                   placeholder="{{trans('website.components.contact_us.form.phone')}}">
                            @error('phone')
                            <p class="text-red-500 text-sm mt-1 text-start">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="md:w-6/12 w-full lg:w-4/12 max-w-full px-[12px] mb-5">
                            <input class="form-control shadow-none text-[#777777] h-[50px] rounded-md border-0  bg-white block w-full text-[1rem] font-normal leading-normal px-3 py-1.5"
                                   type="email"
                                   name="email"
                                   wire:model="email"
                                   placeholder="{{trans('website.components.contact_us.form.email')}}">
                            @error('email')
                            <p class="text-red-500 text-sm mt-1 text-start">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <textarea class="form-control shadow-none text-[#777777] h-[133px] rounded-md border-0 bg-white min-h-[calc(1.5em_+_0.75rem_+_2px)] block w-full text-[16px] font-normal leading-normal px-3 py-1.5"
                              name="message"
                              wire:model="message"
                              cols="30"
                              rows="8"
                              placeholder="{{trans('website.components.contact_us.form.message')}}"></textarea>
                    @error('message')
                    <p class="text-red-500 text-sm mt-1 text-start">{{ $message }}</p>
                    @enderror

                    @if(!empty($resultMessage))
                        <blockquote class="blockquote mx-0 my-[25px] p-[15px] border-l-4 border-l-green-800 border-r-4 border-r-green-800 border-solid bg-green-300">
                            <p class=" text-[#333333] font-semibold text-[16px]">{{$resultMessage}}</p>
                        </blockquote>
                    @endif

                    <button wire:click="submit"
                            wire:loading.attr="disabled"
                            wire:loading.class="pointer-events-none"
                            wire:loading.class.remove="cursor-pointer"
                            class="btn btn-type-4 !rounded-lg cursor-pointer mt-5">
                        <spna wire:loading.attr="hidden" wire:target="submit">{{trans('website.components.contact_us.form.submit')}}</spna>
                        <span hidden wire:loading.attr.remove="hidden" wire:target="submit">...</span>
                    </button>

                </div>
            </div>
            <div class="lg:w-6/12 w-full max-w-full px-[12px]">
                <div class="contact-info-detail sm:mt-[30px]">
                    <ul class="contact-text-info" id="contact-text-info">
                        <li class="block mb-5">
                            <strong class=" capitalize text-[18px]">
                                <span class=" text-[#ffab00] inline-block text-[18px] leading-[30px] text-center transition-all duration-[0.3s] me-2.5"><i class="fa fa-map-marker"></i></span>
                                {{trans('website.contact_info.address1')}}
                            </strong>
                            <p class="mt-2.5">{{trans('website.contact_info.address1_value')}}</p>
                        </li>

                        <li class="block mb-5">
                            <strong class=" capitalize text-[18px]">
                                <span class=" text-[#ffab00] inline-block text-[18px] leading-[30px] text-center transition-all duration-[0.3s] me-2.5"><i class="fa fa-map-marker"></i></span>
                                {{trans('website.contact_info.address2')}}
                            </strong>
                            <p class="mt-2.5">{{trans('website.contact_info.address2_value')}}</p>
                        </li>

                        <li class="block mb-5">
                            <strong class=" capitalize text-[18px]">
                                <span class=" text-[#ffab00] inline-block text-[18px] leading-[30px] text-center transition-all duration-[0.3s] me-2.5"><i class="fa fa-phone"></i></span>
                                {{trans('website.contact_info.phone')}}
                            </strong>
                            <p class="mt-2.5">
                                <a href="tel:09150265615">09150265615</a> |
                                <a href="tel:09352616689">09352616689</a> |
                                <a href="tel:05137050881">051-37050881</a> |
                                <a href="tel:05137050882">051-37050882</a>
                            </p>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>