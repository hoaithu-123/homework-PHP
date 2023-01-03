@extends('layouts.app')

@section('content')
    <div class="roles-permissions">
        <div class="flex items-center justify-between mb-6">
            <div>
                <h2 class="text-gray-700 uppercase font-bold">Classes</h2>
            </div>
            <div class="flex flex-wrap items-center">
                <a href="{{ route('classes.create') }}"
                   class="bg-gray-200 text-gray-700 text-sm uppercase py-2 px-4 flex items-center rounded">
                    <svg class="w-3 h-3 fill-current" aria-hidden="true" focusable="false" data-prefix="fas"
                         data-icon="plus" class="svg-inline--fa fa-plus fa-w-14" role="img"
                         xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                        <path fill="currentColor"
                              d="M416 208H272V64c0-17.67-14.33-32-32-32h-32c-17.67 0-32 14.33-32 32v144H32c-17.67 0-32 14.33-32 32v32c0 17.67 14.33 32 32 32h144v144c0 17.67 14.33 32 32 32h32c17.67 0 32-14.33 32-32V304h144c17.67 0 32-14.33 32-32v-32c0-17.67-14.33-32-32-32z"></path>
                    </svg>
                    <span class="ml-2 text-xs font-semibold">Class</span>
                </a>
            </div>
        </div>
        <div class="mt-8 bg-white rounded border-b-4 border-gray-300">
            <div
                class="flex flex-wrap items-center uppercase text-sm font-semibold bg-gray-300 text-gray-600 rounded-tl rounded-tr">
                <div class="w-1/12 px-4 py-3">#</div>
                <div class="w-2/12 px-4 py-3">Grade</div>
                <div class="w-1/12 px-4 py-3">Class</div>
                <div class="w-2/12 px-4 py-3 text-right">Number Student</div>
                <div class="w-2/12 px-4 py-3 text-right">Description</div>
            </div>
            @foreach ($grades as $grade)
                <div class="flex flex-wrap items-center text-gray-700 border-t-2 border-l-4 border-r-4 border-gray-300">
                    <div class="w-1/12 px-4 py-3 text-sm font-semibold text-gray-600 tracking-tight">#</div>
                    <div class="w-1/12 px-4 py-3 text-sm font-semibold text-gray-600 tracking-tight">{{ $grade->name }}</div>
                    <div class="w-3/12 px-4 py-3 flex flex-wrap">
                        @foreach ( $grade->classes as $class)
                            <span class="bg-gray-200 text-sm mr-1 mb-1 px-2 border rounded-full">{{ $class->name }}</span>
                        @endforeach
                    </div>
                    <div class="w-2/12 px-4 py-3 text-sm font-semibold text-gray-600 tracking-tight">111</div>
                    <div class="w-4/12 px-4 py-3 text-sm font-semibold text-gray-600 tracking-tight">{{ $grade->note }}</div>
                </div>
            @endforeach
        </div>
{{--        <div class="mt-8">--}}
{{--            {{ $grade->links() }}--}}
{{--        </div>--}}
    </div>
@endsection
