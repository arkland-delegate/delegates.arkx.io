<template>
    <span class="inline-block">
        {{ formattedDateTime }}
    </span>
</template>

<script>
    import moment from 'moment-timezone'

    export default {
        props: {
            datetime: {
                type: String,
                required: true
            }
        },
        computed: {
            formattedDateTime () {
                return moment(this.datetime).format('ddd, MMM D, Y h:mm A')
            }
        }
    }
</script>
