<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            EITSEC Technologies Task Management System
        </h2>
    </x-slot>
    @if ($errors->any())
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-red-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-red-900 dark:text-red-100 text-center">
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif

    <div role="alert" class="container mx-auto w-11/12 md:w-2/3 max-w-lg py-12 ">
            <div class="relative py-8 px-5 md:px-10 bg-white dark:bg-gray-800 shadow-md rounded border border-gray-400">
                <div class="w-full flex justify-start text-gray-600 mb-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-wallet" width="52" height="52" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" />
                        <path d="M17 8v-3a1 1 0 0 0 -1 -1h-10a2 2 0 0 0 0 4h12a1 1 0 0 1 1 1v3m0 4v3a1 1 0 0 1 -1 1h-12a2 2 0 0 1 -2 -2v-12" />
                        <path d="M20 12v4h-4a2 2 0 0 1 0 -4h4" />
                    </svg>
                </div>
                <form action="{{ route('tasks.update', $task->id) }}" method="post">
                    @method("PUT")
                    @csrf
                    <h1 class="text-white font-lg text-2xl font-bold tracking-normal leading-tight mb-4">Edit Task Details</h1>
                    <label for="name" class="text-white text-sm font-bold leading-tight tracking-normal">Task Name</label>
                    <input id="name" name="title" class="mb-5 mt-2 text-white bg-gray-900 focus:outline-none focus:border focus:border-indigo-700 font-normal w-full h-10 flex items-center pl-3 text-sm border-gray-300 rounded border" value="{{$task->title}}" placeholder="Design Profile Page" />
                    <label for="description" class="text-white text-sm font-bold leading-tight tracking-normal">Task Description</label>
                    <textarea id="description" name="description" class="text-white bg-gray-900 mb-5 focus:outline-none focus:border focus:border-indigo-700 font-normal w-full h-20 flex items-center pl-16 text-sm border-gray-300 rounded border">{{$task->description}}</textarea>
                    
                    <div class="flex items-center justify-start w-full">
                        <button class="focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-700 transition duration-150 ease-in-out hover:bg-indigo-600 bg-indigo-700 rounded text-white px-8 py-2 text-sm">Update</button>
                    </div>
                </form>
            </div>
        </div>

    </x-app-layout>