<div class=" bg-white  shadow flex items-center rounded-l-lg">
    <div
        wire:ignore

        x-data="{
            {{-- // 💡 Pass the new PHP ageGroupData to Alpine.js --}}
            chartData: @js($educationGroupData),
            chart: null,

            init() {
                const ctx = this.$refs.enrollmentChart.getContext('2d');

                this.chart = new Chart(ctx, {
                    {{-- // 💡 CHART TYPE IS NOW 'bar' --}}
                    type: 'bar',
                    data: {
                        labels: this.chartData.labels,
                        datasets: [{
                            label: 'Total Enrollment',
                             {{-- // Label for the legend/tooltip --}}
                            data: this.chartData.data,
                            backgroundColor: this.chartData.backgroundColor[0],
                            {{-- // Use single color --}}
                            borderColor: this.chartData.borderColor[0],
                            borderWidth: 1
                        }]
                    },
                    options: {
                        {{-- // Fixed size settings from previous step --}}
                        responsive: true,
                        maintainAspectRatio: false,

                        {{-- // 💡 SIZING IS APPLIED TO THE CONTAINER
                        // This div container sets the size to 400px x 400px --}}

                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        },
                        plugins: {
                            legend: {
                                display: false
                                 {{-- // Hide legend for a single dataset --}}
                            },
                            title: {
                                display: true,
                                {{-- // 💡 NEW CHART TITLE --}}
                                text: 'Education Group (Enrolled Students)'
                            }
                        }
                    }
                });
            },
        }"
        {{-- 💡 Container classes for 400px x 400px size --}}
        class="w-[400px] h-[400px] p-3"
    >
        <canvas x-ref="enrollmentChart"></canvas>
    </div>

</div>
