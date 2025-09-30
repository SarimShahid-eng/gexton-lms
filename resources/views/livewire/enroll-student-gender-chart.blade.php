<div class="p-6 bg-white rounded-l-lg shadow">

    <div class="w-[400px] h-[300px]" wire:ignore x-data="{
        {{-- // 💡 Pass PHP data to Alpine.js using the @js Blade directive --}}
        chartData: @js($enrollmentData),
            chart: null,

            {{-- // 💡 x-init runs when Alpine component is mounted --}}
        init() {
            const ctx = this.$refs.enrollmentChart.getContext('2d');

            this.chart = new Chart(ctx, {
                type: 'pie',
                {{-- // Or 'bar', 'line', etc. --}}
                data: {
                    labels: this.chartData.labels,
                    datasets: [{
                        data: this.chartData.data,
                        backgroundColor: this.chartData.backgroundColor,
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'top',
                        },
                        title: {
                            display: true,
                            text: 'Enrollment by Gender'
                        }
                    }
                }
            });
        },
    }">
        <canvas x-ref="enrollmentChart"></canvas>
    </div>

</div>
