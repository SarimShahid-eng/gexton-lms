<div class="p-2 bg-white rounded-lg shadow">
    <div
        wire:ignore
        x-data="{
            // The structure here now contains: { labels: [...], colors: [...] }
            chartData: @js($timeSlotData),
            // Data arrays are passed directly from PHP properties
            morning: @js($morning),
            afternoon: @js($afternoon),
            earlyEvening: @js($earlyEvening),
            lateEvening: @js($lateEvening),
            weekend: @js($weekend),
            chart: null,

            init() {
                const ctx = this.$refs.timeSlotChart.getContext('2d');

                this.chart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: this.chartData.labels,
                        datasets: [
                            {
                                // 💡 New Long Label
                                label: 'Morning (9 AM to 12 PM)',
                                data: this.morning,
                                backgroundColor: this.chartData.colors.morning,
                            },
                            {
                                // 💡 New Long Label
                                label: 'Afternoon (12 PM to 3 PM)',
                                data: this.afternoon,
                                backgroundColor: this.chartData.colors.afternoon,
                            },
                            {
                                // 💡 New Long Label
                                label: 'Early Evening (3 PM to 6 PM)',
                                data: this.earlyEvening,
                                backgroundColor: this.chartData.colors.earlyEvening,
                            },
                            {
                                // 💡 New Long Label
                                label: 'Late Evening (6 PM to 9 PM)',
                                data: this.lateEvening,
                                backgroundColor: this.chartData.colors.lateEvening,
                            },
                            {
                                // 💡 New Long Label
                                label: 'Weekend (Sat & Sun)', // Adjusted for brevity
                                data: this.weekend,
                                backgroundColor: this.chartData.colors.weekend,
                            }
                        ]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,

                        scales: {
                            x: {
                                stacked: true,
                                grid: { display: false },
                                ticks: { autoSkip: false, maxRotation: 45, minRotation: 45 }
                            },
                            y: {
                                stacked: true,
                                beginAtZero: true,
                                grid: {
                                    borderDash: [5, 5]
                                }
                            }
                        },
                        plugins: {
                            legend: {
                                position: 'top',
                            },
                            title: {
                                display: true,
                                text: 'Enrollment by Time Slot'
                            }
                        }
                    }
                });
            },
        }"
        class="w-[600px] h-[400px]"
    >
        <canvas x-ref="timeSlotChart"></canvas>
    </div>
</div>
