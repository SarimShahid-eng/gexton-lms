<div class="max-w-6xl mx-auto mt-2 space-y-8">

    <!-- Card 2: Question count + MCQ -->
    @if (!$testStarted && !$isCompleted)

        <div
            class="max-w-md mx-auto mt-30 bg-white dark:bg-gray-800 rounded-xl shadow-lg overflow-hidden p-6 text-center space-y-6">
            <h2 class="text-2xl font-bold text-gray-800 dark:text-white">Ready to Begin Your Test?</h2>
            <p class="text-gray-600 dark:text-gray-300">
                Click the button below to start your internship test. Make sure you're prepared before beginning, as the
                timer will start immediately.
            </p>

            <!-- Circular Start Button -->
            <button wire:click="startTest"
                class="w-24 h-24 flex items-center justify-center rounded-full bg-blue-600 hover:bg-blue-700 text-white text-lg font-semibold mx-auto transition duration-300">
                Start
            </button>
        </div>
    @endif

    <div class="max-w-6xl mx-auto mt-2 space-y-8" x-data="{ completed: @entangle('isCompleted') }">
        @if ($testStarted && !$isCompleted && ($durationMinutes > 0 || $durationSeconds > 0))
            <!-- Top Bar -->
            <div class="flex items-center justify-between px-6 py-3 bg-white dark:bg-gray-800 rounded-xl shadow-md">

                <div class="text-xl font-semibold text-gray-800 dark:text-white">

                    <div>
                        {{ $user->student_details->course->course_title ?? 'Course Name' }}
                    </div>

                </div>
                {{-- !-- Alpine.js component wrapper --> --}}
                <div x-data="quizTimer({{ $durationMinutes }}, {{ $durationSeconds }}, {{ $totalTestTimeInSeconds }})" x-init="start()" x-ref="timer" class="relative w-32 h-32">
                    <svg class="absolute top-0 left-0 w-full h-full" viewBox="0 0 40 40">
                        <!-- Background Track -->
                        <circle class="text-gray-300 dark:text-gray-600" stroke="currentColor" stroke-width="1"
                            fill="none" cx="20" cy="20" r="17" />

                        <!-- Progress Fill (Filling with time) -->
                        <circle :class="remainingTime <= 60 ? 'text-red-500' : 'text-blue-500'" stroke="currentColor"
                            stroke-width="1" fill="none" class="transition-colors duration-500"
                            stroke-linecap="round" cx="20" cy="20" r="17" stroke-dasharray="107"
                            :stroke-dashoffset="strokeDashoffset"
                            style="transform: rotate(-90deg); transform-origin: center;" />
                    </svg>

                    <!-- Countdown Text -->
                    <div class="absolute inset-0 flex items-center justify-center text-center px-6 py-4">
                        <div x-text="remainingTime > 0 ? formattedTime : 'Time is up'"
                            class="text-lg font-semibold text-gray-800 dark:text-white leading-tight">
                        </div>
                    </div>
                </div>
            </div>
            <div class="py-6 px-8 bg-white dark:bg-gray-800 rounded-xl shadow-md"
                wire:key="question-{{ $currentIndex }}">
                <div class="flex items-center mb-6">
                    <div class="px-4 py-3 rounded-lg text-lg font-semibold text-blue-500">
                        Question {{ $currentIndex + 1 }} <span>out of</span> {{ $questions->count() }}
                    </div>
                </div>

                <h2 class="mb-6 text-lg font-medium text-gray-800 dark:text-white">
                    {!! $currentQuestion->question !!}
                </h2>
                @error('selectedOption')
                    <span class="text-red-500 ms-2 my-2 text-lg">{{ $message }}</span>
                @enderror

                <!-- Options -->
                <div class="space-y-4">
                    @foreach (unserialize($currentQuestion->options) as $index => $option)
                        <label
                            class="flex items-center p-4 border border-gray-300 dark:border-gray-700 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 cursor-pointer">
                            <input type="radio" wire:model="selectedOption" value="{{ $option }}"
                                class="form-radio text-blue-600 mr-4">
                            <span class="text-gray-700 dark:text-gray-200">{{ $option }}</span>
                        </label>
                    @endforeach

                </div>

                <!-- Submit -->
                <div class="mt-6 text-right">
                    <button
                        x-on:click="Livewire.dispatch('setRemainingTime', { time: window.remainingTimeGlobal });$wire.submitAnswer()"
                        class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                        Submit
                    </button>
                </div>
            </div>

        @endif
        <div x-show="completed" x-transition.opacity.duration.500ms
            class="max-w-xl mx-auto mt-10 p-8 bg-white dark:bg-gray-800 rounded-2xl shadow-xl text-center space-y-4">

            {{-- Course Title --}}
            <h2 class="text-2xl  font-semibold text-gray-800 dark:text-gray-100">
                {{ $user->student_details->course->course_title ?? 'Course Title' }}
            </h2>

            {{-- Pass/Fail Icon --}}
            <div class="flex justify-center">
                @if ($percentage >= 40)
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                        class="w-[120px] text-green-600 dark:text-green-400">
                        <path fill-rule="evenodd"
                            d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12Zm13.36-1.814a.75.75 0 1 0-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 0 0-1.06 1.06l2.25 2.25a.75.75 0 0 0 1.14-.094l3.75-5.25Z"
                            clip-rule="evenodd" />
                    </svg>
                @else
                    {{-- Heroicon: X Circle --}}
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                        class="w-[120px] text-red-600 dark:text-red-400">
                        <path fill-rule="evenodd"
                            d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25Zm-1.72 6.97a.75.75 0 1 0-1.06 1.06L10.94 12l-1.72 1.72a.75.75 0 1 0 1.06 1.06L12 13.06l1.72 1.72a.75.75 0 1 0 1.06-1.06L13.06 12l1.72-1.72a.75.75 0 1 0-1.06-1.06L12 10.94l-1.72-1.72Z"
                            clip-rule="evenodd" />
                    </svg>
                @endif
            </div>

            {{-- Status Message --}}
            <div
                class="text-xl font-semibold {{ $percentage >= 40 ? 'text-green-700 dark:text-green-400' : 'text-red-700 dark:text-red-400' }}">
                You are {{ $percentage >= 40 ? 'Passed' : 'Failed' }}!
            </div>
            <div class="text-sm text-gray-500 dark:text-gray-300">
                Question Attempt:{{ $totalStudentAttemptedQuest }}
            </div>
            {{-- Subtext --}}
            <div class="text-sm text-gray-500 dark:text-gray-300">
                {{ $percentage >= 40
                    ? 'Congratulations on successfully completing the internship test.'
                    : 'Sorry, you did not successfully complete the internship test.' }}
            </div>

            {{-- Score --}}
            <div class="text-xl font-medium text-gray-800 dark:text-gray-200">
                Score: {{ $percentage }}
            </div>

            {{-- Action Buttons --}}
            <div class="flex justify-center gap-4 pt-2">
                <button wire:click="exitToLogin"
                    class="px-5 py-2 bg-gray-200 hover:bg-gray-300 text-gray-800 dark:bg-gray-700 dark:hover:bg-gray-600 dark:text-white rounded-lg shadow">
                    Exit
                </button>
                <button wire:click="showResultModal"
                    class="px-5 py-2 bg-blue-600 hover:bg-blue-700 text-white dark:bg-blue-500 dark:hover:bg-blue-600 rounded-lg shadow">
                    View Result
                </button>
            </div>
        </div>

        {{-- @endif --}}
    </div>
    @include('livewire.entry-test-question-modal')
</div>
<script>
    function quizTimer(durationMin, durationSec, totalDurationInSec) {
        return {
            radius: 17,
            totalTime: totalDurationInSec,
            remainingTime: (durationMin * 60) + durationSec,
            interval: null,

            start() {
                this.interval = setInterval(() => {
                    if (this.remainingTime <= 0) {
                        clearInterval(this.interval);
                        this.remainingTime = 0;
                        Livewire.dispatch('setRemainingTime', {
                            time: window.remainingTimeGlobal
                        });
                        // Livewire.dispatch('autoSubmitWhenTimeUp');
                    } else {
                        this.remainingTime--;
                    }
                    window.remainingTimeGlobal = this.remainingTime;
                }, 1000);

                setInterval(() => {
                    if (typeof window.remainingTimeGlobal !== 'undefined') {
                        Livewire.dispatch('setRemainingTime', {
                            time: window.remainingTimeGlobal
                        });
                    }
                }, 10000);
            },

            get strokeDashoffset() {
                const circumference = 2 * Math.PI * this.radius;
                const elapsed = this.totalTime - this.remainingTime;
                const progress = elapsed / this.totalTime;
                return circumference * (1 - progress);
            },

            get formattedTime() {
                const m = Math.floor(this.remainingTime / 60);
                const s = this.remainingTime % 60;
                return `${m} mins - ${String(s).padStart(2, '0')} sec`;
            }
        }
    }
</script>
