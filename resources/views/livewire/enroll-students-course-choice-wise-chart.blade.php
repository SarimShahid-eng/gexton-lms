<div class="bg-white rounded-r-lg shadow flex items-center">
    <div
        wire:ignore
        x-data="{
            chartData: @js($courseChoiceData),
            chart: null,

            init() {
                const ctx = this.$refs.courseChoiceChart.getContext('2d');

                this.chart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: this.chartData.labels,
                        datasets: [{
                            label: 'Enrolled Students',
                            data: this.chartData.data,
                            backgroundColor: '#42A5F5',
                            borderColor: '#1E88E5',
                            borderWidth: 1
                        }]
                    },
                    options: {
                        indexAxis: 'y', // ✅ horizontal bar chart
                        responsive: true,
                        maintainAspectRatio: false,
                        scales: {
                            x: {
                                beginAtZero: true
                            }
                        },
                        plugins: {
                            legend: {
                                display: false
                            },
                            title: {
                                display: true,
                                text: 'Enrolled Students by Course Choice'
                            }
                        }
                    }
                });
            },
        }"
        class="w-[1000px] h-[400px] p-4"
    >
        <canvas x-ref="courseChoiceChart"></canvas>
    </div>
</div>
