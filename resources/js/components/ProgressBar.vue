<template>
  <svg :height="height" :width="width" :class="colorClass">
    <!-- Glow -->
    <defs>
      <filter id="dropshadow" x="-40%" y="-40%" width="180%" height="180%" filterUnits="userSpaceOnUse">
        <feDropShadow dx="0" dy="0" stdDeviation="4" :flood-color="shadowColor" flood-opacity="1" />
      </filter>
    </defs>

    <!-- Background -->
    <line
      fill="none"
      :stroke="strokeColor"
      :x1="0" :y1="height / 2" :x2="width" :y2="height / 2" :stroke-width="backgroundStroke || stroke" />

    <!-- Green Circle -->
    <line v-if="percentage"
      :style="{strokeDashoffset: dashoffset }"
      stroke-linecap="round"
      fill="none"
      style="filter:url(#dropshadow)"
      :x1="0" :y1="height / 2" :x2="(width / 100) * percentage" :y2="height / 2"
      :stroke-width="stroke"
    />
  </svg>
</template>

<script type="text/ecmascript-6">
export default {
  props: {
    height: {
      type: Number,
      default: 10
    },
    width: {
      type: Number,
      default: 271
    },
    percentage: {
      type: Number,
      default: 0,
    },
    stroke: {
      type: Number,
      default: 4,
    },
    backgroundStroke: {
      type: Number,
      default: 2,
    },
    strokeColor: {
      type: String,
      default: "#f0f3f9",
    },
    colorClass: {
      type: String,
      default: "stroke-main-green",
    },
    shadowColor: {
      type: String,
      default: "currentColor"
    }
  },

  computed: {
    dashoffset() {
      const progress = this.percentage / 100

      return this.circumference * (1 - progress)
    }
  }
}
</script>
