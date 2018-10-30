@extends('layouts.app')

@section('content')
    <calculator :forging='@json($delegates)' inline-template>
        <div>
            <div class="p-8">
                <h2>Profit Share Calculator</h2>

                <div class="flex items-center mt-8">
                    <div>
                        <label>ARK Balance</label>
                        <input type="number" v-model="balance" @keydown="calculate" min="1" max="10000000" />
                    </div>

                    <div class="mt-6 mx-6 text-blue-lighter text-sm">or</div>

                    <div>
                        <label>ARK Address</label>
                        <input type="text" v-model="address" @keydown="fetchWallet" />
                    </div>
                </div>
            </div>

            <div>
                <table style="border-collapse: collapse;">
                    <thead>
                        <tr>
                            <th @click="sortBy('rank')">
                                <i :class="sortIcon('rank')"></i>
                                Rank
                            </th>
                            <th @click="sortBy('username')">
                                <i :class="sortIcon('username')"></i>
                                Username
                            </th>
                            <th @click="sortBy('share')">
                                <i :class="sortIcon('share')"></i>
                                Profit Share
                            </th>
                            <th @click="sortBy('votes')">
                                <i :class="sortIcon('votes')"></i>
                                Total Votes
                            </th>
                            <th @click="sortBy('excluded')" class="hidden md:table-cell">
                                <i :class="sortIcon('excluded')"></i>
                                Excluded Votes
                            </th>
                            <th @click="sortBy('voteWeight')">
                                <i :class="sortIcon('voteWeight')"></i>
                                Vote Weight
                            </th>
                            <th @click="sortBy('sharePerDay')">
                                <i :class="sortIcon('sharePerDay')"></i>
                                Ѧ Per Day
                            </th>
                            <th @click="sortBy('sharePerWeek')" class="hidden md:table-cell">
                                <i :class="sortIcon('sharePerWeek')"></i>
                                Ѧ Per Week
                            </th>
                            <th @click="sortBy('sharePerMonth')" class="hidden md:table-cell">
                                <i :class="sortIcon('sharePerMonth')"></i>
                                Ѧ Per Month
                            </th>
                            <th @click="sortBy('sharePerYear')" class="hidden md:table-cell">
                                <i :class="sortIcon('sharePerYear')"></i>
                                Ѧ Per Year
                            </th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr v-for="delegate in delegates" @click="setChosenDelegate(delegate)">
                            <td>@{{ delegate.rank }}</td>
                            <td><a :href="getProfileLink(delegate)">@{{ delegate.username }}</a></td>
                            <td>@{{ delegate.share }}%</td>
                            <td>@{{ formatArktoshi(delegate.votes, 0) }}</td>
                            <td class="hidden md:table-cell">@{{ formatArktoshi(delegate.excluded) }}</td>
                            <td>@{{ delegate.voteWeight }}%</td>
                            <td>@{{ delegate.sharePerDay }}</td>
                            <td class="hidden md:table-cell">@{{ delegate.sharePerWeek }}</td>
                            <td class="hidden md:table-cell">@{{ delegate.sharePerMonth }}</td>
                            <td class="hidden md:table-cell">@{{ delegate.sharePerYear }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            @include('front.calculator._aside')
        </div>
    </calculator>
@endsection

@section('sidebar')
    {{-- ... --}}
@overwrite
