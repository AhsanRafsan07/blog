@component('mail::message')
	Hello **{{$name}}**,  {{-- use double space for line break --}}
	A new category has been created successfully and the name of the category is {{ $data['category_name'] }}

	@component('mail::button', ['url' => $link])
	Go to your inbox
	@endcomponent
	Sincerely,  
	CDIP LARAVEL BATCH 08.
@endcomponent