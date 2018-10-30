@extends('layouts.app')

@section('content')
    <div class="p-8">
        <h2>Contributions for <strong><a href="{{ route('delegate', $delegate) }}">{{ $delegate->username }}</a></strong> <em>({{ $delegate->cached_contributions_count }})</em></h2>
        {{-- <form method="POST" action="{{ route('delegate.contributions.search') }}">
            @include('shared.search')
        </form> --}}
    </div>

    <div class="page-top-100">
        <table class="hidden sm:table">
            <thead>
                <tr>
                    <th>Title</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($contributions as $contribution)
                    <tr>
                        <td>{{ $contribution->title }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        @foreach ($contributions as $contribution)
            <ul class="info-list sm:hidden">
                <li>
                    <span>Title</span>
                    <span class="text-right">{{ $contribution->title }}</span>
                </li>
            </ul>
        @endforeach

        {{ $contributions->links() }}
    </div>
@endsection

@section('sidebar')
    @include('layouts.sidebars.app')
@endsection
