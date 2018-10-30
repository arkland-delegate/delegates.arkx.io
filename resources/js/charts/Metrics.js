import { Line } from 'vue-chartjs'

/**
 * Draw the grey drop-shadow of the green line.
 */
const draw = Chart.controllers.line.prototype.draw
Chart.controllers.line = Chart.controllers.line.extend({
  draw: function() {
    draw.apply(this, arguments)
    const ctx = this.chart.chart.ctx
    const _stroke = ctx.stroke
    ctx.stroke = function() {
      ctx.save()
      ctx.shadowColor = '#e0e3e7'
      ctx.shadowBlur = 0
      ctx.shadowOffsetX = 6
      ctx.shadowOffsetY = 6
      _stroke.apply(this, arguments)
      ctx.restore()
    }
  }
})

export default {
  name: 'chart-metrics',
  extends: Line,
  props: ['labels', 'data'],
  mounted() {
    this.renderChart({
      labels: this.labels,
      datasets: [{
        data: this.data,
        label: 'Balance',
        borderColor: '#41af72',
        borderWidth: 3,
        pointHoverRadius: 10,
        borderCapStyle: 'round',
        fill: false
      }]
    }, {
      responsive: true,
      legend: {
        display: false
      },
      tooltips: {
        enabled: false
      },
      elements: {
        point: {
          radius: 0,
          hitRadius: 12,
          hoverRadius: 12
        }
      },
      title: {
        display: true,
        text: ''
      },

      hover: {
        mode: 'nearest',
        intersect: true
      },
      scales: {
        xAxes: [{
          display: true,
          gridLines: {
            display: false,
          },
          scaleLabel: {
            display: true,
          },
          ticks: {
            fontColor: '#a0a6c8'
          }
        }],
        yAxes: [{
          display: true,
          gridLines: {
            drawBorder: false,
            zeroLineBorderDash: [3, 5],
            zeroLineColor: '#a0a6c8',
            borderDash: [3, 5]
          },
          scaleLabel: {
            display: true,
            labelString: ''
          },
          ticks: {
            fontColor: '#a0a6c8'
          }
        }]
      }
    })
  }
}
