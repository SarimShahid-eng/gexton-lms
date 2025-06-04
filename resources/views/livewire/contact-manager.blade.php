<div class="p-4">
    <div class="mb-4">
        <button wire:click="create" class="bg-blue-500 text-white px-4 py-2 rounded">+ Add Contact</button>
    </div>

    @if (session()->has('message'))
        <div class="bg-green-100 text-green-700 p-2 rounded mb-4">
            {{ session('message') }}
        </div>
    @endif

    <table class="w-full table-auto border-collapse border">
        <thead>
            <tr class="bg-gray-100">
                <th class="border p-2">Name</th>
                <th class="border p-2">Email</th>
                <th class="border p-2">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($contacts as $contact)
                <tr>
                    <td class="border p-2">{{ $contact->name }}</td>
                    <td class="border p-2">{{ $contact->email }}</td>
                    <td class="border p-2">
                        <button wire:click="edit({{ $contact->id }})"
                            class="bg-yellow-500 text-white px-2 py-1 rounded">Edit</button>
                        <button wire:click="delete({{ $contact->id }})"
                            class="bg-red-500 text-white px-2 py-1 rounded ml-1">Delete</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{-- Modal --}}
    <div x-data="{ showModal: @entangle('isModalOpen') }" x-show="showModal"
        class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
        <div @click.away="showModal = false" class="bg-white p-6 rounded shadow w-96">
            <h2 class="text-lg font-bold mb-4">{{ $contactId ? 'Edit Contact' : 'Add Contact' }}</h2>

            <input wire:model="name" type="text" placeholder="Name" class="w-full border p-2 rounded mb-2">
            <input wire:model="email" type="email" placeholder="Email" class="w-full border p-2 rounded mb-4">

            <div class="flex justify-end">
                <button @click="showModal = false" class="mr-2 px-4 py-2 bg-gray-300 rounded">Cancel</button>
                <button wire:click="store" class="px-4 py-2 bg-blue-500 text-white rounded">Save</button>
            </div>
        </div>
    </div>
</div>
