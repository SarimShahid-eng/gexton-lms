<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
    @foreach ($tasks as $task)
        <div class="bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-700 rounded-xl shadow-md p-5">
            <div class="flex justify-between items-center mb-2">
                <h2 class="text-lg font-bold text-gray-800 dark:text-white">📌 {{ $task->task_title }}</h2>
                <span
                    class="text-xs px-2 py-1 rounded-full
                            {{ $task->status == 'completed' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                    {{ ucfirst($task->status) }}
                </span>
            </div>

            {{-- Marks --}}
            <p class="text-sm text-gray-600 dark:text-gray-300 mb-2">
                📊 Marks: <span
                    class="font-semibold text-green-600 dark:text-green-400">{{ @$task->task_marks->obtain_marks }}</span>
                /
                <span class="text-gray-500 dark:text-gray-400">{{ $task->total_marks }}</span>
            </p>

            {{-- Footer --}}
            <div class="flex justify-between items-center mt-4">
                <span class="text-xs text-gray-500 dark:text-gray-400">
                    📅 Days : {{ $task->number_of_days }}
                </span>

                {{-- <a href="{{ asset('attachments/' . $task->attachment_link) }}"
                   class="bg-blue-600 text-white text-xs px-3 py-1.5 rounded-md hover:bg-blue-700 transition"
                   download>
                    ⬇️ Download
                </a> --}}
                <button wire:click="view_task({{ $task->id }})"
                    class="inline-flex items-center gap-1 px-4 py-1.5 border border-gray-300 text-gray-700 hover:border-blue-500 hover:text-blue-600 dark:border-gray-600 dark:text-gray-300 dark:hover:text-white dark:hover:border-white rounded-md text-sm transition"
                    title="View Task">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M2.458 12C3.732 7.943 7.523 5 12 5s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7s-8.268-2.943-9.542-7z" />
                    </svg>
                    View Task
                </button>

            </div>
        </div>
    @endforeach
    <div x-data="{ showTaskViewModal: false }" x-on:open-task-view-modal.window="showTaskViewModal = true" class="z-[99999]">

        <!-- Modal Backdrop -->
        <div x-show="showTaskViewModal" x-transition class="fixed inset-0 bg-black/50 backdrop-blur-sm z-40"
            style="display: none;"></div>

        <!-- Modal -->
        <div x-show="showTaskViewModal" x-transition
            class="fixed inset-0 z-50 flex items-center justify-center px-4 sm:px-6 py-8 overflow-y-auto"
            style="display: none;">

            <!-- Modal Content -->
            <div @click.outside="showTaskViewModal = false"
                class="relative w-full max-w-3xl bg-white dark:bg-gray-900 rounded-xl p-6 sm:p-8 shadow-2xl max-h-[90vh] overflow-y-auto">

                <!-- Header -->
                <div class="flex justify-between items-start sm:items-center border-b pb-4 mb-6 flex-col sm:flex-row gap-2">
                    <h2 class="text-2xl font-semibold text-gray-800 dark:text-white">
                        📂 Task Detail
                    </h2>

                    <div class="flex items-center gap-4">
                        <span class="text-sm text-gray-600 dark:text-gray-400 font-medium">
                            ⏳ Duration: {{ $number_of_days }} day(s)
                        </span>

                        <button @click="showTaskViewModal = false"
                            class="text-2xl text-gray-400 hover:text-red-600 dark:hover:text-red-400 font-bold leading-none">
                            &times;
                        </button>
                    </div>
                </div>


                <!-- Task Info -->
                <div class="space-y-5 text-gray-800 dark:text-gray-200 text-sm sm:text-base">

                    <div>
                        <h3 class="font-semibold text-gray-700 dark:text-gray-300">📌 Task Title:</h3>
                        <p class="mt-1">{{ $task_title }}</p>
                    </div>

                    <div>
                        <h3 class="font-semibold text-gray-700 dark:text-gray-300">📝 Description:</h3>
                        <p class="mt-1 whitespace-pre-line leading-relaxed">{{ $task_description }}</p>
                    </div>

                    <div>
                        <h3 class="font-semibold text-gray-700 dark:text-gray-300">📎 Attachment:</h3>
                        @if ($attachment_link)
                            <a href="{{ $attachment_link }}" target="_blank"
                                class="mt-1 inline-block text-blue-600 dark:text-blue-400 hover:underline">
                                🔗 View Attachment
                            </a>
                        @else
                            <p class="mt-1 italic text-gray-500">No attachment available.</p>
                        @endif
                    </div>
                </div>

                <!-- Footer -->
                <div class="mt-8 text-right">
                    <button @click="showTaskViewModal = false"
                        class="px-6 py-2 rounded-md bg-gray-100 hover:bg-gray-200 dark:bg-gray-700 dark:text-white dark:hover:bg-gray-600 transition">
                        Close
                    </button>
                </div>
            </div>
        </div>
    </div>


</div>
