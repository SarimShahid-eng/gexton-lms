<div class="bg-white rounded-r-lg shadow flex items-center">
    <div
        wire:ignore
        x-data="{
            chartData: @js($centerGroupData),
            chart: null,

            init() {
                const ctx = this.$refs.centerChart.getContext('2d');

                this.chart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: this.chartData.labels,
                        datasets: [{
                            label: 'Total Enrollment',
                            data: this.chartData.data,
                            backgroundColor: this.chartData.backgroundColor,
                            borderColor: this.chartData.borderColor,
                            borderWidth: 1
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        },
                        plugins: {
                            legend: {
                                display: false
                            },
                            title: {
                                display: true,
                                text: 'Preferred Study Center (Enrolled Students)'
                            }
                        }
                    }
                });
            },
        }"
        class="w-[1000px] h-[400px] p-3"
    >
        <canvas x-ref="centerChart"></canvas>
    </div>
</div>
