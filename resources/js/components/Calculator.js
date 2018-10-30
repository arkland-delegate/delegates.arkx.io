const BigNumber = require('bignumber.js')
const axios = require('axios')
const sortBy = require('lodash/sortBy')

BigNumber.config({
    DECIMAL_PLACES: 8
})

module.exports = {
    props: ['forging'],

    data() {
        return {
            delegates: [],
            chosenDelegate: null,
            balance: 1000,
            address: null,
            sortColumn: 'rank',
            sortDirection: 'asc',
            sortNumerical: [
                'votes',
                'excluded',
                'sharePerDay',
                'sharePerWeek',
                'sharePerMonth',
                'sharePerYear',
            ]
        }
    },

    mounted() {
        this.delegates = this.forging

        this.calculate()
    },

    watch: {
        balance: function(value) {
            if (value >= 2000000) {
                this.balance = 2000000
            }

            this.calculate()
        }
    },

    methods: {
        calculate() {
            this.delegates = this.delegates.map(delegate => {
                delegate.sharePerDay = this.calculateSharePerDay(delegate)
                delegate.sharePerWeek = this.calculateSharePerWeek(delegate)
                delegate.sharePerMonth = this.calculateSharePerMonth(delegate)
                delegate.sharePerYear = this.calculateSharePerYear(delegate)
                delegate.voteWeight = this.calculateVoteWeight(delegate)

                return delegate
            })

            this.sortBy('rank')
        },
        fetchWallet() {
            if (this.address) {
                axios
                    .get(`https://explorer.ark.io:8443/api/accounts?address=${this.address}`)
                    .then(response => (this.balance = response.data.account.balance / Math.pow(10, 8)))
                    .then(() => this.calculate())
            }
        },
        calculateShare(delegate, multiplier) {
            let balance = this.balance * Math.pow(10, 8)

            if (delegate.settings.calculator.cap_at_maximum_balance === 'yes') {
                if (delegate.settings.voting.requirements.max_balance > 0) {
                    balance = delegate.settings.voting.requirements.max_balance * Math.pow(10, 8)
                }
            }

            if (delegate.settings.calculator.ignore_above_maximum_balance === 'yes') {
                return parseInt(0).toFixed(8)
            }

            let earnings = (new BigNumber(422 * Math.pow(10, 8)))
                .times(delegate.share / 100)
                .times(balance)
                .dividedBy((delegate.votes - delegate.excluded) + balance)
                .dividedBy(1 * Math.pow(10, 8))
                .times(multiplier)

            if (delegate.settings.sharing.covers_fee === 'no') {
                earnings = earnings.minus(0.1)
            }

            if (earnings.isLessThanOrEqualTo(0)) {
                return parseInt(0).toFixed(8)
            }

            return earnings.toFixed(8)
        },
        calculateSharePerDay(delegate) {
            return this.calculateShare(delegate, 1)
        },
        calculateSharePerWeek(delegate) {
            return this.calculateShare(delegate, 7)
        },
        calculateSharePerMonth(delegate) {
            return this.calculateShare(delegate, 30)
        },
        calculateSharePerYear(delegate) {
            return this.calculateShare(delegate, 365)
        },
        calculateVoteWeight(delegate) {
            const balance = this.balance * Math.pow(10, 8)
            const value = (balance / (delegate.votes + balance)) * 100

            return (value).toLocaleString(undefined, {
                minimumFractionDigits: 8,
                maximumFractionDigits: 8,
            })
        },
        formatArktoshi(value, digits = 2) {
            value = (new BigNumber(value))
                .dividedBy(1 * Math.pow(10, 8))
                .integerValue()

            return parseInt(value).toLocaleString(undefined, {
                minimumFractionDigits: digits,
                maximumFractionDigits: digits,
            })
        },
        getProfileLink(delegate) {
            return `/delegates/${delegate.username}`
        },
        setChosenDelegate(delegate) {
            this.chosenDelegate = delegate
        },
        sortBy(column) {
            this.sortColumn = column
            this.sortDirection = this.sortDirection === 'asc' ? 'desc' : 'asc'

            let delegates

            if (this.sortNumerical.includes(this.sortColumn)) {
                delegates = sortBy(this.delegates, [delegate => {
                    return delegate[this.sortColumn] * Math.pow(10, 8)
                }])
            } else {
                delegates = sortBy(this.delegates, this.sortColumn).reverse()
            }

            if (this.sortDirection === 'desc') {
                delegates = delegates.reverse()
            }

            this.delegates = delegates
        },
        sortIcon(column) {
            if (this.sortColumn !== column) {
                return []
            }

            return [
                'far',
                this.sortDirection === 'asc' ? 'fa-sort-amount-down' : 'fa-sort-amount-up'
            ]
        }
    }
}
