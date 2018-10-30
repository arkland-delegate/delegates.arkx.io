@extends('layouts.dashboard')

@section('content')
    <div class="flex justify-between px-6 py-8 pt-8">
        <h2>Statuses</h2>
        <form method="POST" action="{{ route('dashboard.delegate.statuses.search', $delegate) }}">
            @include('shared.search')
        </form>
    </div>

    <div class="page-transactions">
        <span class="block p-6 pt-0 float-right">
            <a href="{{ route('dashboard.delegate.statuses.create', $delegate) }}" class="button-grey">
                New Status
            </a>
        </span>

        @if($statuses->count())
            <table>
                <thead>
                    <tr>
                        <th>Title</th>
                        <th class="text-right">Actions</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($statuses as $status)
                        <tr>
                            <td>{{ $status->title }}</td>
                            <td class="text-right">
                                @include('shared.actions.edit', [
                                    'action' => route('dashboard.delegate.statuses.edit', [$delegate, $status])
                                ])
                                @include('shared.actions.delete', [
                                    'action' => route('dashboard.delegate.statuses.destroy', [$delegate, $status])
                                ])
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            {{ $statuses->links() }}
        @else
            <div class="alert-warning m-6 mb-0" role="alert">
                There are no statuses for your delegate.
            </div>
        @endif
    </div>
@endsection
