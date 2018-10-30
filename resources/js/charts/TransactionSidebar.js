import { Line } from 'vue-chartjs'

Chart.plugins.register({
  afterDatasetsDraw: function(chart) {
    if (chart.tooltip._active && chart.tooltip._active.length) {
      const activePoint = chart.tooltip._active[0]
      const ctx = chart.ctx
      const y_axis = chart.scales['y-axis-0']
      const x = activePoint.tooltipPosition().x
      const topY = y_axis.top
      const bottomY = y_axis.bottom

      // draw line
      ctx.save()
      ctx.beginPath()
      ctx.moveTo(x, topY)
      ctx.lineTo(x, bottomY)
      ctx.setLineDash([5, 2])
      ctx.lineWidth = 2
      ctx.strokeStyle = '#a0a6c8'
      ctx.stroke()
      ctx.restore()
    }
  }
})

export default {
  name: 'chart-transaction',
  extends: Line,
  props: ['labels', 'data'],
  mounted() {
    this.renderChart({
      labels: this.labels,
      datasets: [{
        data: this.data,
        label: "Balance",
        borderColor: "#41af72",
        borderWidth: 2,
        borderCapStyle: "round",
        fill: false,
      }]
    }, {
      responsive: false,
      legend: {
        display: false
      },
      tooltips: {
        enabled: false
      },
      elements: {
        point: {
          radius: 0
        }
      },
      title: {
        display: false,
        text: ''
      },
      hover: {
        mode: 'nearest',
        intersect: true
      },
      scales: {
        xAxes: [{
          display: false,
          scaleLabel: {
            display: false,
            labelString: ''
          }
        }],
        yAxes: [{
          display: false,
          scaleLabel: {
            display: false,
            labelString: ''
          }
        }]
      }
    })
  }
}
