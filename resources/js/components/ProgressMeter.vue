<template>
  <svg style="transform: rotate(-90deg);" :viewBox="`-5 -5 ${width + 10} ${width + 10}`">
    <!-- Glow -->
    <defs>
      <filter id="dropshadow" x="-40%" y="-40%" width="180%" height="180%" filterUnits="userSpaceOnUse">
        <feDropShadow dx="0" dy="0" stdDeviation="4" :flood-color="shadowColor" flood-opacity="1" />
      </filter>
    </defs>

    <!-- Background -->
    <circle
      fill="none"
      :stroke="strokeColor"
      :cx="width / 2" :cy="width / 2" :r="radius" :stroke-width="backgroundStroke || stroke" />

    <!-- Green Circle -->
    <circle v-if="percentage"
      :style="{strokeDashoffset: dashoffset, strokeDasharray: circumference }"
      stroke-linecap="round"
      fill="none"
      style="filter:url(#dropshadow)"
      :cx="width / 2" :cy="width / 2" :r="radius" :stroke-width="stroke" stroke="currentColor"
    />

    <!-- Inner Circle -->
    <circle v-if="innerIcon"
      :style="{strokeDashoffset: dashoffset, strokeDasharray: circumference }"
      stroke-linecap="round"
      fill="none"
      stylse="filter:url(#dropshadow)"
      :cx="width / 2" :cy="width / 2" r="1" :stroke-width="2" stroke="currentColor"
    />
    <circle v-if="innerIcon"
      :style="{strokeDashoffset: dashoffset, strokeDasharray: circumference }"
      stroke-linecap="round"
      fill="none"
      stylse="filter:url(#dropshadow)"
      :cx="width / 2" :cy="width / 2" r="5" :stroke-width="1" :stroke="strokeColor"
    />
    <circle v-if="innerIcon"
      :style="{strokeDashoffset: dashoffset, strokeDasharray: circumference }"
      stroke-linecap="round"
      fill="none"
      stylse="filter:url(#dropshadow)"
      :cx="width / 2" :cy="width / 2" r="6" :stroke-width="1" :stroke="strokeColor"
    />
  </svg>
</template>

<script type="text/ecmascript-6">
export default {
  props: {
    percentage: {
      type: Number,
      default: 0,
    },
    radius: {
      type: Number,
      default: 25,
    },
    stroke: {
      type: Number,
      default: 4,
    },
    backgroundStroke: {
      type: Number,
      default: 4,
    },
    strokeColor: {
      type: String,
      default: "#f0f3f9",
    },
    shadowColor: {
      type: String,
      default: "currentColor"
    },
    innerIcon: {
      type: Boolean,
      default: false
    }
  },

  computed: {
    circumference() {
      return 2 * Math.PI * this.radius
    },

    width() {
      return this.radius * 2 + this.stroke * 2
    },

    dashoffset() {
      const progress = this.percentage / 100

      return this.circumference * (1 - progress)
    }
  }
}
</script>
