@extends('layouts.dashboard')

@section('content')
    <div class="flex justify-between px-6 py-8 pt-8">
        <h2>Contributions</h2>
        <form method="POST" action="{{ route('dashboard.delegate.contributions.search', $delegate) }}">
            @include('shared.search')
        </form>
    </div>

    <div class="page-transactions">
        <span class="block p-6 pt-0 float-right">
            <a href="{{ route('dashboard.delegate.contributions.create', $delegate) }}" class="button-grey">
                New Contribution
            </a>
        </span>

        @if($contributions->count())
            <table>
                <thead>
                    <tr>
                        <th>Title</th>
                        <th class="text-right">Actions</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($contributions as $contribution)
                        <tr>
                            <td>{{ $contribution->title }}</td>
                            <td class="text-right">
                                @include('shared.actions.edit', [
                                    'action' => route('dashboard.delegate.contributions.edit', [$delegate, $contribution])
                                ])
                                @include('shared.actions.delete', [
                                    'action' => route('dashboard.delegate.contributions.destroy', [$delegate, $contribution])
                                ])
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            {{ $contributions->links() }}
        @else
            <div class="alert-warning m-6 mb-0" role="alert">
                There are no contributions for your delegate.
            </div>
        @endif
    </div>
@endsection
