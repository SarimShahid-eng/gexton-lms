<div class=" max-w-6xl mx-auto mt-2 space-y-8">

    <!-- Card 2: Question count + MCQ -->
    @if (!$testStarted && !$isCompleted)
        <div class=" min-h-screen flex items-center justify-center">
            <div class="my-3 bg-white shadow-2xl rounded-2xl max-w-3xl w-full p-8 md:p-12">
                <!-- Header -->
                <div class="text-center mb-8">
                    <h1 class="text-3xl font-bold">📝 Exam Instructions</h1>
                    <p class="text-gray-600 mt-2">Please read the instructions carefully before you begin.</p>
                </div>

                <div class="flex justify-between mb-8">
                    <h3 class="text-l text-gray-600 font-bold">User Name: <span
                            class="text-orange-500">{{ $user->full_name }}</span></h3>
                    <h3 class="text-l text-gray-600 font-bold">Selected Course: <span
                            class="text-orange-500">{{ $user->student_details->course->course_title }}</span></h3>
                </div>

                <!-- Instructions -->
                <div
                    class="bg-gray-100 border border-gray-50 p-6 rounded-xl space-y-3 text-gray-700 text-sm md:text-base">
                    <p>1. The exam consists of <strong>20 questions</strong> and must be completed within <strong>30
                            minutes</strong>.</p>
                    <p>2. Each correct answer awards <strong>1 mark</strong>. There is <strong>no negative
                            marking</strong>.</p>
                    <p>3. Do not refresh or close the browser tab during the exam.</p>
                    <p>4. Ensure a stable internet connection throughout the exam.</p>
                    <p>5. Questions will appear one by one and cannot be revisited.</p>
                    <p>6. Use only one device to take the exam.</p>
                </div>



                <!-- Action Buttons -->
                <div class="mt-8 flex justify-center gap-4">
                    <button wire:click="startTest"
                        class="bg-orange-600 text-white px-6 py-3 rounded-xl font-semibold hover:bg-orange-700 transition duration-300">
                        Start Exam
                    </button>

                </div>
            </div>
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
        {{-- x-show="completed" x-transition.opacity.duration.500ms --}}

        <section x-show="completed" x-transition.opacity.duration.500ms class=" w-full h-full relative min-h-screen flex items-center justify-center p-3">

            <div class="bg-white rounded-3xl shadow-2xl p-10 max-w-xl w-full text-center fade-in">

                <!-- Check Icon -->
                <div class="flex justify-center mb-6">
                    <div
                        class="bg-[#df5c1a] text-white w-20 h-20 rounded-full flex items-center justify-center text-4xl shadow-lg animate-bounce">
                        ✓
                    </div>
                </div>

                <!-- Main Heading -->
                <h1 class="text-3xl md:text-4xl font-bold text-[#df5c1a] mb-2">Thank You, <br> <span
                        id="studentName">Student Name</span>!</h1>
                <p class="text-gray-700 text-base md:text-lg mb-6">Your exam has been submitted successfully.</p>

                <!-- Score Block -->
                <div class="flex flex-col sm:flex-row items-center justify-around mb-8 space-y-4 sm:space-y-0">
                    <div
                        class="relative w-36 h-36 rounded-full flex items-center justify-center bg-gradient-to-br from-[#f26822] to-[#df5c1a] text-white text-3xl font-bold shadow-inner">
                        <div class="bg-white w-28 h-28 rounded-full flex items-center justify-center text-[#df5c1a]">
                            <span id="studentScore">{{ $correctQuestionCount }} /
                                {{ $totalStudentAttemptedQuest }}</span>
                        </div>
                    </div>
                    <div>
                        <div id="resultBox" @class([
                            $percentage >= 40 => 'bg-green-200 text-green-800',
                            $percentage < 40 => 'bg-red-200 text-red-800',
                            'inline-block',
                            'px-5',
                            'py-2',
                            'rounded-full',
                            'text-sm',
                            'font-semibold',
                            'shadow-md',
                        ])>
                            <!-- JS will insert status -->
                            {{ $percentage >= 40 ? 'Congratulations! You Passed.' : '❌ Unfortunately, You Did Not Pass.' }}

                        </div>
                        <p class="text-gray-500 mt-2 text-sm">
                            {{-- Minimum score to pass: 5 out of 10 --}}
                            Percentage: {{ $percentage }}
                        </p>
                    </div>
                </div>


                <!-- Button -->
                <button wire:click="showResultModal"
                    class="inline-block bg-gradient-to-r from-[#ee7752] via-[#f26822] to-[#fc8b52] text-white font-semibold py-3 px-8 rounded-full shadow-md hover:scale-105 transition transform duration-300">
                    Result
                </button>
                <button wire:click="exitToLogin"
                    class="inline-block ms-3 bg-gradient-to-r from-[#ee7752] via-[#f26822] to-[#fc8b52] text-white font-semibold py-3 px-8 rounded-full shadow-md hover:scale-105 transition transform duration-300">
                    Exit
                </button>

            </div>
        </section>


        {{-- @endif --}}
    </div>
    @include('livewire.entry-test-question-modal')
</div>
<script>
    //  // Example dynamic values
    // const studentName = "Muhammad Tahir";
    // const obtainedMarks = 7;
    // const totalMarks = 10;
    // const isPass = obtainedMarks >= 5; // Pass condition

    // // Insert data into DOM
    // document.getElementById("studentName").textContent = studentName;
    // document.getElementById("studentScore").textContent = `${obtainedMarks} / ${totalMarks}`;

    // const resultBox = document.getElementById("resultBox");
    // if (isPass) {
    //   resultBox.textContent = "🎉 Congratulations! You Passed.";
    //   resultBox.classList.add("bg-green-200");
    // } else {
    //   resultBox.textContent = "❌ Unfortunately, You Did Not Pass.";
    //   resultBox.classList.add("bg-orange-200");
    // }
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
