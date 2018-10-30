@extends('layouts.app')

@section('content')
    <div class="p-8">
        <h2>Tags</h2>
    </div>

    @if($tags->count())
        <div class="page-top-100">
            <table class="hidden sm:table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Delegates</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($tags as $tag)
                        <tr>
                            <td><a href="{{ route('tag', $tag->slug) }}">{{ $tag->name }}</a></td>
                            <td>{{ App\Models\Delegate::withAnyTags([$tag])->count() }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            @foreach ($tags as $tag)
                <ul class="info-list sm:hidden">
                    <li>
                        <span>Name</span>
                        <span class="text-right"><a href="{{ route('tag', $tag->slug) }}">{{ $tag->name }}</a></span>
                    </li>

                    <li>
                        <span>Delegates</span>
                        <span class="text-right">{{ App\Models\Delegate::withAnyTags([$tag])->count() }}</span>
                    </li>
                </ul>
            @endforeach

            {{ $tags->links() }}
        </div>
    @else
        <div class="alert-warning m-6 mb-0" role="alert">
            There are no tags yet.
        </div>
    @endif
@endsection

@section('sidebar')
    @include('layouts.sidebars.app')
@endsection
