module.exports = {
  data() {
    return {
      selected: 'statuses'
    }
  },

  methods: {
    switchTab(value) {
      this.selected = value
    }
  }
}
